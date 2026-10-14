<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Disease extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'symptoms',
        'causes',
        'prevention',
        'image_path',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from name if not provided
        static::creating(function ($disease) {
            if (empty($disease->slug)) {
                $disease->slug = Str::slug($disease->name);
            }
        });

        static::updating(function ($disease) {
            if ($disease->isDirty('name') && empty($disease->slug)) {
                $disease->slug = Str::slug($disease->name);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get all herbal recipes for this disease.
     */
    public function herbalRecipes()
    {
        return $this->hasMany(HerbalRecipe::class)->orderBy('is_recommended', 'desc');
    }

    /**
     * Get only recommended recipes for this disease.
     */
    public function recommendedRecipes()
    {
        return $this->hasMany(HerbalRecipe::class)
                    ->where('is_recommended', true)
                    ->where('is_active', true);
    }

    /**
     * Scope a query to only include active diseases.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order diseases by their order field.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * Scope a query to search diseases by name.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('symptoms', 'like', "%{$search}%");
        });
    }

    /**
     * Get the full URL for the disease image.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return null;
    }

    /**
     * Get formatted disease data for API responses.
     */
    public function toApiArray($includeRecipes = false)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'symptoms' => $this->symptoms,
            'causes' => $this->causes,
            'prevention' => $this->prevention,
            'image_url' => $this->image_url,
            'order' => $this->order,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];

        if ($includeRecipes) {
            $data['recipes'] = $this->herbalRecipes->map(fn($recipe) => $recipe->toApiArray(true));
            $data['recipes_count'] = $this->herbalRecipes->count();
        }

        return $data;
    }
}
