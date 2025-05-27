<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCategories extends Model
{
    protected $table = 'food_categories';

        // App\Models\FoodPlace.php
    protected $fillable = [
        'name',
        
    ];

    public function kategoriPengusaha()
    {
        return $this->hasMany(FoodPlace::class, 'food_category_id');
    }
}
