<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipe_steps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'recipe_id',
        'step_number',
        'title',
        'instruction',
        'image_path',
        'duration',
        'tips',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'step_number' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the recipe that this step belongs to.
     */
    public function recipe()
    {
        return $this->belongsTo(HerbalRecipe::class, 'recipe_id');
    }

    /**
     * Get the full URL for the step image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    /**
     * Get formatted step data for API responses.
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'step_number' => $this->step_number,
            'title' => $this->title,
            'instruction' => $this->instruction,
            'image_url' => $this->image_url,
            'duration' => $this->duration,
            'tips' => $this->tips,
        ];
    }
}
