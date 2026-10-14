<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HerbalRecipe;
use App\Models\RecipeIngredient;
use App\Models\RecipeStep;
use App\Models\Disease;
use App\Models\Plant;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes in admin.
     */
    public function index(Request $request)
    {
        $query = HerbalRecipe::with('disease');

        // Filter by disease
        if ($request->filled('disease_id')) {
            $query->where('disease_id', $request->disease_id);
        }

        // Search by name or description
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $recipes = $query->orderBy('disease_id')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        $diseases = Disease::active()->ordered()->get();

        return view('admin.recipes.index', compact('recipes', 'diseases'));
    }

    /**
     * Show the form for creating a new recipe.
     */
    public function create()
    {
        $diseases = Disease::active()->ordered()->get();
        $plants = Plant::active()->orderBy('name')->get();

        return view('admin.recipes.create', compact('diseases', 'plants'));
    }

    /**
     * Store a newly created recipe.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('herbal_recipes', 'name')->where('disease_id', $request->disease_id)->whereNull('deleted_at'),
            ],
            'description' => 'nullable|string',
            'instructions' => 'required|string',
            'dosage' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'warnings' => 'nullable|string',
            'side_effects' => 'nullable|string',
            'preparation_time' => 'nullable|string|max:100',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'servings' => 'nullable|integer|min:1',
            'is_recommended' => 'boolean',
            'is_active' => 'boolean',
        ], [
            'disease_id.required' => 'Penyakit wajib dipilih.',
            'disease_id.exists' => 'Penyakit yang dipilih tidak ditemukan.',
            'name.required' => 'Nama racikan wajib diisi.',
            'name.unique' => 'Nama racikan untuk penyakit ini sudah terdaftar.',
            'instructions.required' => 'Petunjuk pembuatan racikan wajib diisi.',
            'dosage.required' => 'Dosis pemakaian wajib diisi.',
            'difficulty_level.required' => 'Tingkat kesulitan wajib dipilih.',
        ]);

        // Handle checkboxes (unchecked = not present in request)
        $validated['is_recommended'] = $request->boolean('is_recommended');
        $validated['is_active'] = $request->boolean('is_active', true);

        DB::beginTransaction();
        try {
            $recipe = HerbalRecipe::create($validated);

            // Handle ingredients if provided
            if ($request->has('ingredients')) {
                foreach ($request->ingredients as $index => $ingredient) {
                    if (!empty($ingredient['plant_id'])) {
                        RecipeIngredient::create([
                            'recipe_id' => $recipe->id,
                            'plant_id' => $ingredient['plant_id'],
                            'quantity' => $ingredient['quantity'] ?? '',
                            'unit' => $ingredient['unit'] ?? '',
                            'part_used' => $ingredient['part_used'] ?? 'leaf',
                            'preparation_notes' => $ingredient['preparation_notes'] ?? null,
                            'order' => $index + 1,
                        ]);
                    }
                }
            }

            // Handle steps if provided
            if ($request->has('steps')) {
                foreach ($request->steps as $index => $step) {
                    if (!empty($step['instruction'])) {
                        RecipeStep::create([
                            'recipe_id' => $recipe->id,
                            'step_number' => $index + 1,
                            'title' => $step['title'] ?? null,
                            'instruction' => $step['instruction'],
                            'duration' => $step['duration'] ?? null,
                            'tips' => $step['tips'] ?? null,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.recipes.index')
                ->with('success', 'Racikan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan racikan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified recipe.
     */
    public function show($id)
    {
        $recipe = HerbalRecipe::with([
            'disease',
            'ingredients.plant',
            'steps'
        ])->findOrFail($id);

        return view('admin.recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified recipe.
     */
    public function edit($id)
    {
        $recipe = HerbalRecipe::with(['ingredients.plant', 'steps'])->findOrFail($id);
        $diseases = Disease::active()->ordered()->get();
        $plants = Plant::active()->orderBy('name')->get();

        return view('admin.recipes.edit', compact('recipe', 'diseases', 'plants'));
    }

    /**
     * Update the specified recipe.
     */
    public function update(Request $request, $id)
    {
        $recipe = HerbalRecipe::findOrFail($id);

        $validated = $request->validate([
            'disease_id' => 'required|exists:diseases,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('herbal_recipes', 'name')->where('disease_id', $request->disease_id)->ignore($recipe->id)->whereNull('deleted_at'),
            ],
            'description' => 'nullable|string',
            'instructions' => 'required|string',
            'dosage' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'warnings' => 'nullable|string',
            'side_effects' => 'nullable|string',
            'preparation_time' => 'nullable|string|max:100',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'servings' => 'nullable|integer|min:1',
            'is_recommended' => 'boolean',
            'is_active' => 'boolean',
        ], [
            'disease_id.required' => 'Penyakit wajib dipilih.',
            'disease_id.exists' => 'Penyakit yang dipilih tidak ditemukan.',
            'name.required' => 'Nama racikan wajib diisi.',
            'name.unique' => 'Nama racikan untuk penyakit ini sudah terdaftar.',
            'instructions.required' => 'Petunjuk pembuatan racikan wajib diisi.',
            'dosage.required' => 'Dosis pemakaian wajib diisi.',
            'difficulty_level.required' => 'Tingkat kesulitan wajib dipilih.',
        ]);

        // Handle checkboxes (unchecked = not present in request)
        $validated['is_recommended'] = $request->boolean('is_recommended');
        $validated['is_active'] = $request->boolean('is_active', true);

        DB::beginTransaction();
        try {
            $recipe->update($validated);

            // Update ingredients
            if ($request->has('update_ingredients')) {
                // Delete existing ingredients
                $recipe->ingredients()->delete();

                // Add new ingredients
                if ($request->has('ingredients')) {
                    foreach ($request->ingredients as $index => $ingredient) {
                        if (!empty($ingredient['plant_id'])) {
                            RecipeIngredient::create([
                                'recipe_id' => $recipe->id,
                                'plant_id' => $ingredient['plant_id'],
                                'quantity' => $ingredient['quantity'] ?? '',
                                'unit' => $ingredient['unit'] ?? '',
                                'part_used' => $ingredient['part_used'] ?? 'leaf',
                                'preparation_notes' => $ingredient['preparation_notes'] ?? null,
                                'order' => $index + 1,
                            ]);
                        }
                    }
                }
            }

            // Update steps
            if ($request->has('update_steps')) {
                // Delete existing steps
                $recipe->steps()->delete();

                // Add new steps
                if ($request->has('steps')) {
                    foreach ($request->steps as $index => $step) {
                        if (!empty($step['instruction'])) {
                            RecipeStep::create([
                                'recipe_id' => $recipe->id,
                                'step_number' => $index + 1,
                                'title' => $step['title'] ?? null,
                                'instruction' => $step['instruction'],
                                'duration' => $step['duration'] ?? null,
                                'tips' => $step['tips'] ?? null,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('admin.recipes.index')
                ->with('success', 'Racikan berhasil diupdate!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengupdate racikan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified recipe.
     */
    public function destroy($id)
    {
        $recipe = HerbalRecipe::findOrFail($id);
        $recipe->delete(); // Will cascade delete ingredients and steps

        return redirect()->route('admin.recipes.index')
            ->with('success', 'Racikan berhasil dihapus!');
    }
}
