<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\FoodCategories;
use App\Models\Review;
use App\Models\FoodPlaceImage;

class FoodPlace extends Model
{
    protected $table = 'food_places';

    // App\Models\FoodPlace.php
protected $fillable = [
    'title',
    'description',
    'food_category_id',
    'min_price',
    'max_price',
    'location',
    'source_location',
    'image',
    'user_id',
    'status',
];

public function reviews() {
    return $this->hasMany(Review::class);
}

public function category()
{
    return $this->belongsTo(FoodCategories::class, 'food_category_id');
}

public function images()
{
    return $this->hasMany(FoodPlaceImage::class);
}

}
