<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HerbalRecipe extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'herbal_recipes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'disease_id',
        'name',
        'description',
        'instructions',
        'dosage',
        'duration',
        'warnings',
        'side_effects',
        'preparation_time',
        'difficulty_level',
        'servings',
        'is_recommended',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_recommended' => 'boolean',
        'is_active' => 'boolean',
        'servings' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the disease that this recipe belongs to.
     */
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }

    /**
     * Get all ingredients for this recipe.
     */
    public function ingredients()
    {
        return $this->hasMany(RecipeIngredient::class, 'recipe_id')->orderBy('order');
    }

    /**
     * Get all preparation steps for this recipe.
     */
    public function steps()
    {
        return $this->hasMany(RecipeStep::class, 'recipe_id')->orderBy('step_number');
    }

    /**
     * Scope a query to only include active recipes.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include recommended recipes.
     */
    public function scopeRecommended($query)
    {
        return $query->where('is_recommended', true);
    }

    /**
     * Scope a query to filter by difficulty level.
     */
    public function scopeDifficulty($query, $level)
    {
        return $query->where('difficulty_level', $level);
    }

    /**
     * Scope a query to search recipes by name or description.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Get formatted recipe data for API responses.
     */
    public function toApiArray($includeDetails = false)
    {
        $data = [
            'id' => $this->id,
            'disease_id' => $this->disease_id,
            'disease_name' => $this->disease?->name,
            'name' => $this->name,
            'description' => $this->description,
            'instructions' => $this->instructions,
            'dosage' => $this->dosage,
            'duration' => $this->duration,
            'warnings' => $this->warnings,
            'side_effects' => $this->side_effects,
            'preparation_time' => $this->preparation_time,
            'difficulty_level' => $this->difficulty_level,
            'servings' => $this->servings,
            'is_recommended' => $this->is_recommended,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];

        if ($includeDetails) {
            $data['ingredients'] = $this->ingredients->map(fn($ing) => $ing->toApiArray());
            $data['steps'] = $this->steps->map(fn($step) => $step->toApiArray());
        }

        return $data;
    }
}
