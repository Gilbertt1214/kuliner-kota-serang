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
        'type',
    ];

    /**
     * Relasi ke FoodPlace (satu gambar milik satu tempat makan)
     */
    public function foodPlace()
    {
        return $this->belongsTo(FoodPlace::class);
    }

    /**
     * Akses URL gambar dari penyimpanan publik atau URL external
     */
    public function getImageUrlAttribute()
    {
        // Jika image_path sudah berupa URL lengkap (http/https)
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }
        
        // Jika masih path lokal, gunakan asset
        return asset('storage/' . $this->image_path);
    }
}
