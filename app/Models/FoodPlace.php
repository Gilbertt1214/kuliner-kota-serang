<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FoodPlace extends Model
{
    use HasFactory;

    protected $table = 'food_places';

    protected $fillable = [
        'title',
        'description',
        'food_category_id',
        'min_price',
        'max_price',
        'location',
        'source_location',
        'user_id',
        'status',
        // 'images' dihapus karena sudah dihandle oleh relasi
    ];

    protected $casts = [
        'min_price' => 'float',
        'max_price' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['average_rating'];

    /**
     * Get the average rating attribute
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    /**
     * Get all reviews for the food place
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the category that owns the food place
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FoodCategories::class, 'food_category_id');
    }

    /**
     * Get all images for the food place
     */
    public function images(): HasMany
    {
        return $this->hasMany(FoodPlaceImage::class);
    }

    /**
     * Get the user who created the food place
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for active food places
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
