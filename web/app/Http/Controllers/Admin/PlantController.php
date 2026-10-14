<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PlantController extends Controller
{
    /**
     * Display a listing of plants in admin.
     */
    public function index(Request $request)
    {
        $query = Plant::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $plants = $query->withCount('recipeIngredients')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.plants.index', compact('plants'));
    }

    /**
     * Show the form for creating a new plant.
     */
    public function create()
    {
        return view('admin.plants.create');
    }

    /**
     * Store a newly created plant.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('plants', 'name')->whereNull('deleted_at'),
            ],
            'local_name' => 'nullable|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'characteristics' => 'nullable|string',
            'benefits' => 'required|string',
            'usage_notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama tanaman wajib diisi.',
            'name.unique' => 'Nama tanaman sudah terdaftar.',
            'description.required' => 'Deskripsi tanaman wajib diisi.',
            'benefits.required' => 'Khasiat & manfaat tanaman wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle checkbox (unchecked = not present in request)
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('plants', 'public');
        }

        $plant = Plant::create($validated);

        return redirect()->route('admin.plants.index')
            ->with('success', 'Tanaman berhasil ditambahkan!');
    }

    /**
     * Display the specified plant.
     */
    public function show($id)
    {
        $plant = Plant::with(['images', 'recipeIngredients.recipe.disease'])->findOrFail($id);
        
        return view('admin.plants.show', compact('plant'));
    }

    /**
     * Show the form for editing the specified plant.
     */
    public function edit($id)
    {
        $plant = Plant::with('images')->findOrFail($id);
        
        return view('admin.plants.edit', compact('plant'));
    }

    /**
     * Update the specified plant.
     */
    public function update(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('plants', 'name')->ignore($plant->id)->whereNull('deleted_at'),
            ],
            'local_name' => 'nullable|string|max:255',
            'scientific_name' => 'nullable|string|max:255',
            'description' => 'required|string',
            'characteristics' => 'nullable|string',
            'benefits' => 'required|string',
            'usage_notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama tanaman wajib diisi.',
            'name.unique' => 'Nama tanaman sudah terdaftar.',
            'description.required' => 'Deskripsi tanaman wajib diisi.',
            'benefits.required' => 'Khasiat & manfaat tanaman wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle checkbox (unchecked = not present in request)
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($plant->image_path) {
                Storage::disk('public')->delete($plant->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('plants', 'public');
        }

        $plant->update($validated);

        return redirect()->route('admin.plants.index')
            ->with('success', 'Tanaman berhasil diupdate!');
    }

    /**
     * Remove the specified plant.
     */
    public function destroy($id)
    {
        $plant = Plant::findOrFail($id);
        
        // Check if plant is used in any recipes
        if ($plant->recipeIngredients()->count() > 0) {
            return redirect()->route('admin.plants.index')
                ->with('error', 'Tanaman tidak dapat dihapus karena masih digunakan dalam racikan!');
        }
        
        // Delete image if exists
        if ($plant->image_path) {
            Storage::disk('public')->delete($plant->image_path);
        }
        
        // Delete all plant images
        foreach ($plant->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $plant->delete();

        return redirect()->route('admin.plants.index')
            ->with('success', 'Tanaman berhasil dihapus!');
    }

    /**
     * Upload additional images for a plant.
     */
    public function uploadImage(Request $request, $id)
    {
        $plant = Plant::findOrFail($id);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image_type' => 'required|in:main,leaf,flower,fruit,root,stem,habitat,processed',
            'is_primary' => 'boolean',
        ]);

        $imagePath = $request->file('image')->store('plants/gallery', 'public');

        // If this is set as primary, unset other primary images
        if ($request->boolean('is_primary')) {
            PlantImage::where('plant_id', $plant->id)
                ->update(['is_primary' => false]);
        }

        PlantImage::create([
            'plant_id' => $plant->id,
            'image_path' => $imagePath,
            'title' => $request->title,
            'description' => $request->description,
            'image_type' => $request->image_type,
            'is_primary' => $request->boolean('is_primary'),
            'order' => PlantImage::where('plant_id', $plant->id)->max('order') + 1,
        ]);

        return redirect()->route('admin.plants.edit', $plant->id)
            ->with('success', 'Gambar berhasil ditambahkan!');
    }

    /**
     * Delete a plant image.
     */
    public function deleteImage($plantId, $imageId)
    {
        $image = PlantImage::where('plant_id', $plantId)
            ->where('id', $imageId)
            ->firstOrFail();

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->route('admin.plants.edit', $plantId)
            ->with('success', 'Gambar berhasil dihapus!');
    }
}
