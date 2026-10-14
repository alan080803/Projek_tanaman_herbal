<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantImage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plant_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'plant_id',
        'image_path',
        'title',
        'description',
        'image_type',
        'is_primary',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the plant that this image belongs to.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * Get human-readable image type label.
     */
    public function getImageTypeLabelAttribute()
    {
        $labels = [
            'main' => 'Gambar Utama',
            'leaf' => 'Detail Daun',
            'flower' => 'Detail Bunga',
            'fruit' => 'Detail Buah',
            'root' => 'Detail Akar',
            'stem' => 'Detail Batang',
            'habitat' => 'Habitat Tumbuh',
            'processed' => 'Bentuk Olahan',
        ];

        return $labels[$this->image_type] ?? $this->image_type;
    }

    /**
     * Get the full URL for the image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    /**
     * Scope a query to only include primary images.
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope a query to filter by image type.
     */
    public function scopeType($query, $type)
    {
        return $query->where('image_type', $type);
    }

    /**
     * Get formatted image data for API responses.
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'image_type' => $this->image_type,
            'image_type_label' => $this->image_type_label,
            'is_primary' => $this->is_primary,
            'order' => $this->order,
        ];
    }
}
