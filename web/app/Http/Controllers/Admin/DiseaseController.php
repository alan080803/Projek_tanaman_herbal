<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disease;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DiseaseController extends Controller
{
    /**
     * Display a listing of diseases in admin.
     */
    public function index(Request $request)
    {
        $query = Disease::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $diseases = $query->withCount('herbalRecipes')
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        return view('admin.diseases.index', compact('diseases'));
    }

    /**
     * Show the form for creating a new disease.
     */
    public function create()
    {
        return view('admin.diseases.create');
    }

    /**
     * Store a newly created disease.
     */
    public function store(Request $request)
    {
        // Auto-generate slug from name if slug is not provided
        if (!$request->filled('slug') && $request->filled('name')) {
            $generatedSlug = Str::slug($request->name);
            $request->merge(['slug' => $generatedSlug ?: 'penyakit-' . time()]);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diseases', 'name')->whereNull('deleted_at'),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diseases', 'slug')->whereNull('deleted_at'),
            ],
            'description' => 'required|string',
            'symptoms' => 'nullable|string',
            'causes' => 'nullable|string',
            'prevention' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama penyakit wajib diisi.',
            'name.unique' => 'Nama penyakit sudah terdaftar.',
            'slug.required' => 'Slug URL wajib diisi.',
            'slug.unique' => 'Slug URL untuk penyakit ini sudah digunakan.',
            'description.required' => 'Deskripsi penyakit wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle checkbox (unchecked = not present in request)
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('diseases', 'public');
        }
        unset($validated['image']);

        Disease::create($validated);

        return redirect()->route('admin.diseases.index')
            ->with('success', 'Penyakit berhasil ditambahkan!');
    }

    /**
     * Display the specified disease.
     */
    public function show($id)
    {
        $disease = Disease::with('herbalRecipes')->findOrFail($id);
        
        return view('admin.diseases.show', compact('disease'));
    }

    /**
     * Show the form for editing the specified disease.
     */
    public function edit($id)
    {
        $disease = Disease::findOrFail($id);
        
        return view('admin.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified disease.
     */
    public function update(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);

        // Auto-generate slug from name if slug is not provided
        if (!$request->filled('slug') && $request->filled('name')) {
            $generatedSlug = Str::slug($request->name);
            $request->merge(['slug' => $generatedSlug ?: 'penyakit-' . time()]);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diseases', 'name')->ignore($disease->id)->whereNull('deleted_at'),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('diseases', 'slug')->ignore($disease->id)->whereNull('deleted_at'),
            ],
            'description' => 'required|string',
            'symptoms' => 'nullable|string',
            'causes' => 'nullable|string',
            'prevention' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ], [
            'name.required' => 'Nama penyakit wajib diisi.',
            'name.unique' => 'Nama penyakit sudah terdaftar.',
            'slug.required' => 'Slug URL wajib diisi.',
            'slug.unique' => 'Slug URL untuk penyakit ini sudah digunakan.',
            'description.required' => 'Deskripsi penyakit wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Handle checkbox (unchecked = not present in request)
        $validated['is_active'] = $request->boolean('is_active', true);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($disease->image_path) {
                Storage::disk('public')->delete($disease->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('diseases', 'public');
        }
        unset($validated['image']);

        $disease->update($validated);

        return redirect()->route('admin.diseases.index')
            ->with('success', 'Penyakit berhasil diupdate!');
    }

    /**
     * Remove the specified disease.
     */
    public function destroy($id)
    {
        $disease = Disease::findOrFail($id);
        
        // Check if disease has recipes
        if ($disease->herbalRecipes()->count() > 0) {
            return redirect()->route('admin.diseases.index')
                ->with('error', 'Penyakit tidak dapat dihapus karena masih memiliki racikan herbal!');
        }
        
        // Delete image if exists
        if ($disease->image_path) {
            Storage::disk('public')->delete($disease->image_path);
        }
        
        // Append timestamp to slug before deleting to avoid collision if recreated later
        $disease->slug = $disease->slug . '-deleted-' . time();
        $disease->save();

        $disease->delete();

        return redirect()->route('admin.diseases.index')
            ->with('success', 'Penyakit berhasil dihapus!');
    }
}
