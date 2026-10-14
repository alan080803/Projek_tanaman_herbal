<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Disease;
use App\Models\HerbalRecipe;
use App\Models\Plant;
use App\Models\PlantDetection;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Statistics
        $totalDiseases = Disease::count();
        $totalPlants = Plant::count();
        $totalRecipes = HerbalRecipe::count();
        $totalDetections = PlantDetection::count();
        
        // Recent detections
        $recentDetections = PlantDetection::with('plant')
            ->latest()
            ->limit(10)
            ->get();
        
        // Detection statistics
        $successfulDetections = PlantDetection::successful()->count();
        $pendingDetections = PlantDetection::pending()->count();
        $failedDetections = PlantDetection::failed()->count();
        $noLeafDetections = PlantDetection::noLeaf()->count();
        
        // Most detected plants
        $mostDetectedPlants = PlantDetection::successful()
            ->with('plant')
            ->select('plant_id', DB::raw('count(*) as detection_count'))
            ->groupBy('plant_id')
            ->orderBy('detection_count', 'desc')
            ->limit(5)
            ->get();
        
        // Recent activity stats
        $detectionsLastWeek = PlantDetection::recent(7)->count();
        $detectionsLastMonth = PlantDetection::recent(30)->count();
        
        return view('admin.dashboard.index', compact(
            'totalDiseases',
            'totalPlants',
            'totalRecipes',
            'totalDetections',
            'recentDetections',
            'successfulDetections',
            'pendingDetections',
            'failedDetections',
            'noLeafDetections',
            'mostDetectedPlants',
            'detectionsLastWeek',
            'detectionsLastMonth'
        ));
    }
}
