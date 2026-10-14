<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;

class PlantController extends Controller
{
    /**
     * Display a listing of plants (for public visitors).
     */
    public function index(Request $request)
    {
        $query = Plant::with(['images', 'primaryImage'])->active();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $plants = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('plants.index', compact('plants'));
    }

    /**
     * Display the specified plant with its recipes.
     */
    public function show($id)
    {
        $plant = Plant::with(['images', 'primaryImage', 'recipeIngredients.recipe.disease'])
            ->findOrFail($id);

        // Get related recipes
        $recipes = $plant->recipes()
            ->with(['disease', 'ingredients.plant', 'steps'])
            ->active()
            ->get();

        return view('plants.show', compact('plant', 'recipes'));
    }
}
