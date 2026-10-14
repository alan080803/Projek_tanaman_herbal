<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;

class DiseaseController extends Controller
{
    /**
     * Display a listing of diseases (for public visitors).
     */
    public function index(Request $request)
    {
        $query = Disease::query()->active()->ordered();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $diseases = $query->paginate(20)->withQueryString();

        return view('diseases.index', compact('diseases'));
    }

    /**
     * Display the specified disease with its herbal recipes.
     */
    public function show($slug)
    {
        $disease = Disease::where('slug', $slug)
            ->with([
                'herbalRecipes' => function ($query) {
                    $query->active()
                        ->with(['ingredients.plant.primaryImage', 'steps'])
                        ->orderBy('is_recommended', 'desc')
                        ->orderBy('name');
                }
            ])
            ->firstOrFail();

        return view('diseases.show', compact('disease'));
    }
}
