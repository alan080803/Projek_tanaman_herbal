<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recipe_ingredients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'recipe_id',
        'plant_id',
        'quantity',
        'unit',
        'preparation_notes',
        'part_used',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the recipe that this ingredient belongs to.
     */
    public function recipe()
    {
        return $this->belongsTo(HerbalRecipe::class, 'recipe_id');
    }

    /**
     * Get the plant for this ingredient.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * Get human-readable part used label.
     */
    public function getPartUsedLabelAttribute()
    {
        $labels = [
            'leaf' => 'Daun',
            'root' => 'Akar',
            'stem' => 'Batang',
            'flower' => 'Bunga',
            'fruit' => 'Buah',
            'seed' => 'Biji',
            'bark' => 'Kulit Kayu',
            'rhizome' => 'Rimpang',
            'whole_plant' => 'Seluruh Bagian',
        ];

        return $labels[$this->part_used] ?? $this->part_used;
    }

    /**
     * Get formatted ingredient data for API responses.
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'plant_id' => $this->plant_id,
            'plant_name' => $this->plant?->name,
            'plant_local_name' => $this->plant?->local_name,
            'plant_image' => $this->plant?->image_url,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'preparation_notes' => $this->preparation_notes,
            'part_used' => $this->part_used,
            'part_used_label' => $this->part_used_label,
            'order' => $this->order,
        ];
    }
}
