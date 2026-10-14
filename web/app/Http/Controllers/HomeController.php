<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Plant;
use App\Models\PlantDetection;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Get featured data for landing page
        $featuredDiseases = Disease::active()
            ->ordered()
            ->limit(8)
            ->get();
        
        $featuredPlants = Plant::with(['images', 'primaryImage'])
            ->active()
            ->orderBy('name')
            ->limit(6)
            ->get();
        
        $totalDiseases = Disease::active()->count();
        $totalPlants = Plant::active()->count();
        $totalDetections = PlantDetection::count();
        
        return view('home', compact(
            'featuredDiseases',
            'featuredPlants',
            'totalDiseases',
            'totalPlants',
            'totalDetections'
        ));
    }

    /**
     * Display about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Display contact page.
     */
    public function contact()
    {
        return view('landing.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        return redirect()->route('contact')
            ->with('success', 'Terima kasih, ' . $validated['name'] . '! Pesan Anda telah kami terima dan akan segera kami respon.');
    }
}
