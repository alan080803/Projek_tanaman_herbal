<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantDetection extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plant_detections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'plant_id',
        'uploaded_image_path',
        'confidence_score',
        'detection_result',
        'detection_status',
        'notes',
        'ip_address',
        'user_agent',
        'detected_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'confidence_score' => 'decimal:2',
        'detection_result' => 'array',
        'detected_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who performed this detection.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the detected plant.
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * Get the full URL for the uploaded image.
     */
    public function getUploadedImageUrlAttribute()
    {
        if ($this->uploaded_image_path) {
            return asset('storage/' . $this->uploaded_image_path);
        }
        return null;
    }

    /**
     * Scope a query to only include successful detections.
     */
    public function scopeSuccessful($query)
    {
        return $query->where('detection_status', 'success');
    }

    /**
     * Scope a query to only include failed detections.
     */
    public function scopeFailed($query)
    {
        return $query->where('detection_status', 'failed');
    }

    /**
     * Scope a query to only include pending detections.
     */
    public function scopePending($query)
    {
        return $query->where('detection_status', 'pending');
    }

    /**
     * Scope a query to only include detections where no leaf was detected.
     */
    public function scopeNoLeaf($query)
    {
        return $query->where('detection_status', 'no_leaf');
    }

    /**
     * Scope a query to filter by minimum confidence score.
     */
    public function scopeMinConfidence($query, $score)
    {
        return $query->where('confidence_score', '>=', $score);
    }

    /**
     * Scope a query to get recent detections.
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Get formatted detection data for API responses.
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'plant_id' => $this->plant_id,
            'plant' => $this->plant ? $this->plant->toApiArray() : null,
            'uploaded_image_url' => $this->uploaded_image_url,
            'confidence_score' => $this->confidence_score,
            'detection_result' => $this->detection_result,
            'detection_status' => $this->detection_status,
            'notes' => $this->notes,
            'detected_at' => $this->detected_at?->toISOString(),
            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}
