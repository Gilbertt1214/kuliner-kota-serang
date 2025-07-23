<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'food_place_id',
        'rating',
        'comment',
        'taste_rating',
        'price_rating',
        'service_rating',
        'ambiance_rating',
        'tags',
        'photos',
        'is_anonymous'
    ];

    protected $casts = [
        'tags' => 'array',
        'photos' => 'array',
        'is_anonymous' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function foodPlace()
    {
        return $this->belongsTo(FoodPlace::class);
    } //
}
