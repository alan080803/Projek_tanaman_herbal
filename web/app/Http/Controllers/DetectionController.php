<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantDetection;
use App\Models\Plant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class DetectionController extends Controller
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
     * Show detection upload form.
     */
    public function index()
    {
        $recentDetections = collect();
        if (auth()->check()) {
            $recentDetections = PlantDetection::where('user_id', auth()->id())
                ->with(['plant.primaryImage'])
                ->latest()
                ->limit(6)
                ->get();
        }

        return view('detection.index', compact('recentDetections'));
    }

    /**
     * Handle image upload for plant detection.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240', // 10MB max
        ]);

        try {
            // Store uploaded image with UUID filename
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('plant_detections', $imageName, 'public');

            // Create detection record
            $detection = PlantDetection::create([
                'user_id' => auth()->id(), // null if not authenticated
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

                    // Jika tidak ada daun yang terdeteksi oleh YOLO
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

                        return redirect()->route('detection.result', $detection->id)
                            ->with('warning', 'Tidak ada objek daun yang terdeteksi di dalam gambar.');
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

                    return redirect()->route('detection.result', $detection->id)
                        ->with('success', 'Deteksi tanaman berhasil!');
                } else {
                    // Flask API returned error
                    $detection->update([
                        'detection_status' => 'failed',
                    ]);

                    return redirect()->route('detection.result', $detection->id)
                        ->with('error', 'Deteksi gagal. Silakan coba lagi.');
                }
            } catch (\Exception $e) {
                // Flask API call failed
                $detection->update([
                    'detection_status' => 'failed',
                ]);

                return redirect()->route('detection.result', $detection->id)
                    ->with('error', 'Gagal terhubung ke layanan deteksi. Pastikan Flask API berjalan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show detection result.
     */
    public function result($id)
    {
        $detection = PlantDetection::with([
            'plant.images',
            'plant.recipes.disease',
        ])->findOrFail($id);

        return view('detection.result', compact('detection'));
    }

    /**
     * Show detection history.
     */
    public function history(Request $request)
    {
        $query = PlantDetection::with('plant.primaryImage');

        // Filter by user if authenticated, otherwise by IP
        if (auth()->check()) {
            $query->where('user_id', auth()->id());
        } else {
            $query->where('ip_address', $request->ip());
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('detection_status', $request->status);
        }

        $detections = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Calculate user statistics across all pages
        $statsQuery = PlantDetection::query();
        if (auth()->check()) {
            $statsQuery->where('user_id', auth()->id());
        } else {
            $statsQuery->where('ip_address', $request->ip());
        }

        $totalDetections = (clone $statsQuery)->count();
        $successfulCount = (clone $statsQuery)->where('detection_status', 'success')->count();
        $uniquePlantsCount = (clone $statsQuery)->where('detection_status', 'success')->whereNotNull('plant_id')->distinct('plant_id')->count('plant_id');
        $noLeafCount = (clone $statsQuery)->where('detection_status', 'no_leaf')->count();

        return view('detection.history', compact('detections', 'totalDetections', 'successfulCount', 'uniquePlantsCount', 'noLeafCount'));
    }

    /**
     * Mock detection for testing (will be removed when ML integrated).
     */
    public function mockDetection(Request $request, $id)
    {
        $request->validate([
            'plant_id' => 'required|exists:plants,id',
            'confidence_score' => 'required|numeric|min:0|max:100',
        ]);

        $detection = PlantDetection::findOrFail($id);
        
        $detection->update([
            'plant_id' => $request->plant_id,
            'confidence_score' => $request->confidence_score,
            'detection_status' => 'success',
            'detected_at' => now(),
            'detection_result' => [
                'model' => 'MobileNetV2',
                'version' => '1.0.0',
                'mock' => true,
            ],
        ]);

        return redirect()->route('detection.result', $detection->id)
            ->with('success', 'Deteksi berhasil!');
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
}
