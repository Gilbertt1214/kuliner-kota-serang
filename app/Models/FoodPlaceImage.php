<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodPlaceImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_place_id',
        'image_path',
    ];

    /**
     * Relasi ke FoodPlace (satu gambar milik satu tempat makan)
     */
    public function foodPlace()
    {
        return $this->belongsTo(FoodPlace::class);
    }

    /**
     * Akses URL gambar dari penyimpanan publik
     */
    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image_path);
    }
}
