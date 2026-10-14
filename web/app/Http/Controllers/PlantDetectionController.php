<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantDetection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PlantDetectionController extends Controller
{
    /**
     * Flask API base URL
     */
    private $flaskApiUrl;

    /**
     * Flask API timeout in seconds
     */
    private $flaskApiTimeout;

    public function __construct()
    {
        $this->flaskApiUrl = config('services.flask_api.url', 'http://localhost:6000');
        $this->flaskApiTimeout = config('services.flask_api.timeout', 30);
    }

    /**
     * Display a listing of plant detections.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $status = $request->input('status');
        $userId = $request->input('user_id');

        $query = PlantDetection::with(['user', 'plant'])
            ->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('detection_status', $status);
        }

        if ($userId) {
            $query->where('user_id', $userId);
        }

        $detections = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $detections,
        ]);
    }

    /**
     * Store a new plant detection.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10240', // Max 10MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Save uploaded image
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('plant_detections', $imageName, 'public');

            // Create initial detection record
            $detection = PlantDetection::create([
                'user_id' => auth()->id(),
                'uploaded_image_path' => $imagePath,
                'detection_status' => 'pending',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // Call Flask API for prediction
            try {
                $flaskResponse = $this->callFlaskAPI($imagePath);

                if ($flaskResponse['success']) {
                    $responseData = $flaskResponse['data'];
                    $leafDetected = $responseData['leaf_detected'] ?? true;

                    if (!$leafDetected) {
                        $detection->update([
                            'plant_id' => null,
                            'confidence_score' => null,
                            'detection_result' => [
                                'leaf_detected' => false,
                                'message' => $responseData['message'] ?? 'Tidak ada daun yang terdeteksi di dalam gambar.',
                                'yolo_result' => $responseData['yolo_result'] ?? null,
                            ],
                            'detection_status' => 'no_leaf',
                            'detected_at' => now(),
                        ]);

                        $detection->load(['user']);

                        return response()->json([
                            'success' => false,
                            'leaf_detected' => false,
                            'message' => 'Tidak ada daun yang terdeteksi di dalam gambar. Klasifikasi tanaman tidak dilanjutkan.',
                            'data' => [
                                'detection' => $detection,
                                'yolo_result' => $responseData['yolo_result'] ?? null,
                            ],
                        ], 200);
                    }

                    // Get the top prediction
                    $topPrediction = $responseData['top_prediction'];
                    $allPredictions = $responseData['predictions'];

                    // Find matching plant in database
                    $plant = $this->findPlantByName($topPrediction['plant_name']);

                    // Update detection record with results
                    $detection->update([
                        'plant_id' => $plant ? $plant->id : null,
                        'confidence_score' => $topPrediction['confidence_percentage'],
                        'detection_result' => [
                            'leaf_detected' => true,
                            'yolo_result' => $responseData['yolo_result'] ?? null,
                            'predictions' => $allPredictions,
                            'top_prediction' => $topPrediction,
                        ],
                        'detection_status' => 'success',
                        'detected_at' => now(),
                    ]);

                    // Load relationships for response
                    $detection->load(['user', 'plant']);

                    return response()->json([
                        'success' => true,
                        'leaf_detected' => true,
                        'message' => 'Plant detection completed successfully',
                        'data' => [
                            'detection' => $detection,
                            'plant_info' => $plant,
                            'confidence' => $topPrediction['confidence_percentage'],
                            'all_predictions' => $allPredictions,
                            'yolo_result' => $responseData['yolo_result'] ?? null,
                        ],
                    ], 201);
                } else {
                    // Flask API returned error
                    $detection->update([
                        'detection_status' => 'failed',
                    ]);

                    return response()->json([
                        'success' => false,
                        'message' => 'Plant detection failed',
                        'error' => $flaskResponse['error'],
                        'data' => [
                            'detection' => $detection,
                        ],
                    ], 500);
                }
            } catch (\Exception $e) {
                // Flask API call failed
                $detection->update([
                    'detection_status' => 'failed',
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to connect to detection service',
                    'error' => $e->getMessage(),
                    'data' => [
                        'detection' => $detection,
                    ],
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified plant detection.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $detection = PlantDetection::with(['user', 'plant'])->find($id);

        if (!$detection) {
            return response()->json([
                'success' => false,
                'message' => 'Detection not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $detection,
        ]);
    }

    /**
     * Remove the specified plant detection.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $detection = PlantDetection::find($id);

        if (!$detection) {
            return response()->json([
                'success' => false,
                'message' => 'Detection not found',
            ], 404);
        }

        // Delete image file
        if ($detection->uploaded_image_path) {
            Storage::disk('public')->delete($detection->uploaded_image_path);
        }

        // Delete detection record
        $detection->delete();

        return response()->json([
            'success' => true,
            'message' => 'Detection deleted successfully',
        ]);
    }

    /**
     * Call Flask API for plant detection.
     *
     * @param string $imagePath
     * @return array
     */
    private function callFlaskAPI($imagePath)
    {
        try {
            $fullPath = Storage::disk('public')->path($imagePath);

            $response = Http::timeout($this->flaskApiTimeout)
                ->attach('image', file_get_contents($fullPath), basename($imagePath))
                ->post($this->flaskApiUrl . '/api/predict');

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => $data['success'] ?? false,
                    'data' => $data,
                    'error' => null,
                ];
            } else {
                return [
                    'success' => false,
                    'data' => null,
                    'error' => 'Flask API returned error: ' . $response->status(),
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'data' => null,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Find plant by name (case-insensitive, fuzzy matching).
     *
     * @param string $plantName
     * @return Plant|null
     */
    private function findPlantByName($plantName)
    {
        // Try exact match first (case-insensitive)
        $plant = Plant::whereRaw('LOWER(name) = ?', [strtolower($plantName)])
            ->orWhereRaw('LOWER(local_name) = ?', [strtolower($plantName)])
            ->first();

        if ($plant) {
            return $plant;
        }

        // Try fuzzy match with LIKE
        $plant = Plant::where('name', 'LIKE', '%' . $plantName . '%')
            ->orWhere('local_name', 'LIKE', '%' . $plantName . '%')
            ->first();

        return $plant;
    }

    /**
     * Get detection statistics.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statistics()
    {
        $totalDetections = PlantDetection::count();
        $successfulDetections = PlantDetection::where('detection_status', 'success')->count();
        $failedDetections = PlantDetection::where('detection_status', 'failed')->count();
        $pendingDetections = PlantDetection::where('detection_status', 'pending')->count();

        $mostDetectedPlants = PlantDetection::select('plant_id')
            ->selectRaw('COUNT(*) as count')
            ->where('detection_status', 'success')
            ->whereNotNull('plant_id')
            ->groupBy('plant_id')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->with('plant')
            ->get();

        $averageConfidence = PlantDetection::where('detection_status', 'success')
            ->whereNotNull('confidence_score')
            ->avg('confidence_score');

        return response()->json([
            'success' => true,
            'data' => [
                'total_detections' => $totalDetections,
                'successful_detections' => $successfulDetections,
                'failed_detections' => $failedDetections,
                'pending_detections' => $pendingDetections,
                'success_rate' => $totalDetections > 0 ? round(($successfulDetections / $totalDetections) * 100, 2) : 0,
                'average_confidence' => round($averageConfidence, 2),
                'most_detected_plants' => $mostDetectedPlants,
            ],
        ]);
    }
}
