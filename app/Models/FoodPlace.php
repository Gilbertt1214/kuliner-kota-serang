<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodPlace extends Model
{
    protected $table = 'food_places';

    protected $fillable = [
        "title",
        "description",
        "category",
        "price",
        "location",
        "rating",
        "image",
        "menu"
    ];
    
}
