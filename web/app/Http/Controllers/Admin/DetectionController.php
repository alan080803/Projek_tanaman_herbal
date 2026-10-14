<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PlantDetection;
use App\Models\Plant;

class DetectionController extends Controller
{
    /**
     * Display a listing of detections in admin.
     */
    public function index(Request $request)
    {
        $query = PlantDetection::with(['plant', 'user']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('detection_status', $request->status);
        }

        // Filter by plant
        if ($request->filled('plant_id')) {
            $query->where('plant_id', $request->plant_id);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $detections = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        $plants = Plant::active()->orderBy('name')->get();

        // Calculate statistics for the cards
        $successCount = PlantDetection::successful()->count();
        $pendingCount = PlantDetection::pending()->count();
        $failedCount = PlantDetection::failed()->count();
        $noLeafCount = PlantDetection::noLeaf()->count();

        return view('admin.detections.index', compact('detections', 'plants', 'successCount', 'pendingCount', 'failedCount', 'noLeafCount'));
    }

    /**
     * Display the specified detection.
     */
    public function show($id)
    {
        $detection = PlantDetection::with(['plant.images', 'user'])->findOrFail($id);
        
        return view('admin.detections.show', compact('detection'));
    }

    /**
     * Show statistics page.
     */
    public function statistics()
    {
        $totalDetections = PlantDetection::count();
        $successfulDetections = PlantDetection::successful()->count();
        $pendingDetections = PlantDetection::pending()->count();
        $failedDetections = PlantDetection::failed()->count();
        $noLeafDetections = PlantDetection::noLeaf()->count();

        $averageConfidence = PlantDetection::successful()->avg('confidence_score');
        
        $detectionsLastWeek = PlantDetection::recent(7)->count();
        $detectionsLastMonth = PlantDetection::recent(30)->count();
        
        // Most detected plants
        $mostDetectedPlants = PlantDetection::successful()
            ->with(['plant.primaryImage'])
            ->select('plant_id', DB::raw('count(*) as detection_count'))
            ->groupBy('plant_id')
            ->orderBy('detection_count', 'desc')
            ->limit(10)
            ->get();

        // Detection trend (last 30 days)
        $detectionTrends = PlantDetection::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.detections.statistics', compact(
            'totalDetections',
            'successfulDetections',
            'pendingDetections',
            'failedDetections',
            'noLeafDetections',
            'averageConfidence',
            'detectionsLastWeek',
            'detectionsLastMonth',
            'mostDetectedPlants',
            'detectionTrends'
        ));
    }

    /**
     * Delete a detection record.
     */
    public function destroy($id)
    {
        $detection = PlantDetection::findOrFail($id);
        
        // Delete uploaded image
        if ($detection->uploaded_image_path) {
            \Storage::disk('public')->delete($detection->uploaded_image_path);
        }
        
        $detection->delete();

        return redirect()->route('admin.detections.index')
            ->with('success', 'Riwayat deteksi berhasil dihapus!');
    }
}
