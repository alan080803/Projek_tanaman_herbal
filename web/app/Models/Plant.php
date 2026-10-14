<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plant extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'local_name',
        'scientific_name',
        'description',
        'characteristics',
        'benefits',
        'usage_notes',
        'image_path',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the images for the plant.
     */
    public function images()
    {
        return $this->hasMany(PlantImage::class)->orderBy('order');
    }

    /**
     * Get the primary image for the plant.
     */
    public function primaryImage()
    {
        return $this->hasOne(PlantImage::class)->where('is_primary', true);
    }

    /**
     * Get all recipe ingredients that use this plant.
     */
    public function recipeIngredients()
    {
        return $this->hasMany(RecipeIngredient::class);
    }

    /**
     * Get all recipes that use this plant through ingredients.
     */
    public function recipes()
    {
        return $this->hasManyThrough(
            HerbalRecipe::class,
            RecipeIngredient::class,
            'plant_id', // Foreign key on recipe_ingredients table
            'id', // Foreign key on herbal_recipes table
            'id', // Local key on plants table
            'recipe_id' // Local key on recipe_ingredients table
        );
    }

    /**
     * Get all detections for this plant.
     */
    public function detections()
    {
        return $this->hasMany(PlantDetection::class);
    }

    /**
     * Scope a query to only include active plants.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to search plants by name.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('local_name', 'like', "%{$search}%")
              ->orWhere('scientific_name', 'like', "%{$search}%");
        });
    }

    /**
     * Get the full URL for the plant image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    /**
     * Get formatted plant data for API responses.
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'local_name' => $this->local_name,
            'scientific_name' => $this->scientific_name,
            'description' => $this->description,
            'characteristics' => $this->characteristics,
            'benefits' => $this->benefits,
            'usage_notes' => $this->usage_notes,
            'image_url' => $this->image_url,
            'images' => $this->images->map(fn($img) => $img->toApiArray()),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
