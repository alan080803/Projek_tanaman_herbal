<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HerbalRecipe;
use App\Models\Disease;

class RecipeController extends Controller
{
    /**
     * Display a listing of herbal recipes.
     */
    public function index(Request $request)
    {
        $query = HerbalRecipe::with(['disease', 'ingredients.plant'])->active();

        // Search by recipe name or description
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by disease
        if ($request->filled('disease_id')) {
            $query->where('disease_id', $request->disease_id);
        }

        // Filter by difficulty
        if ($request->filled('difficulty')) {
            $query->difficulty($request->difficulty);
        }

        // Show recommended first
        $query->orderBy('is_recommended', 'desc')->orderBy('name');

        $recipes = $query->paginate(15)->withQueryString();
        $diseases = Disease::active()->ordered()->get();

        return view('recipes.index', compact('recipes', 'diseases'));
    }

    /**
     * Display the specified recipe with full details.
     */
    public function show($id)
    {
        $recipe = HerbalRecipe::with([
            'disease',
            'ingredients' => function ($query) {
                $query->orderBy('order');
            },
            'ingredients.plant.images',
            'steps' => function ($query) {
                $query->orderBy('step_number');
            }
        ])->findOrFail($id);

        return view('recipes.show', compact('recipe'));
    }
}
