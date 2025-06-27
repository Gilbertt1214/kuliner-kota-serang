<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
