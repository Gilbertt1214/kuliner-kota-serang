<?php

// File: app/Models/FoodCategories.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategories extends Model
{
    protected $table = 'food_categories';

    protected $fillable = [
        'name',
    ];

    // Relasi ke FoodPlace (one-to-many)
    public function foodPlaces()
    {
        return $this->hasMany(FoodPlace::class, 'food_category_id');
    }
}

// File: app/Models/FoodPlace.php



