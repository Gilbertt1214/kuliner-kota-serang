<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodPlaceImage;

class FoodPlaceImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = [
            // 1. Sate Kambing Pak Yono
            ['food_place_id' => 1, 'image_path' => 'https://images.unsplash.com/photo-1529692236671-f1f6cf9683ba?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 1, 'image_path' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 2. Gudeg Yu Djum Serang
            ['food_place_id' => 2, 'image_path' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 2, 'image_path' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 3. RM Sederhana Padang
            ['food_place_id' => 3, 'image_path' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 3, 'image_path' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 4. Warung Nasi Ampera
            ['food_place_id' => 4, 'image_path' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 4, 'image_path' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 5. Cafe Teras Kota
            ['food_place_id' => 5, 'image_path' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 5, 'image_path' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 6. Kedai Kopi Serang
            ['food_place_id' => 6, 'image_path' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 6, 'image_path' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 7. Bakso Malang Pak Kumis
            ['food_place_id' => 7, 'image_path' => 'https://images.unsplash.com/photo-1482049016688-2d3e1b311543?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 7, 'image_path' => 'https://images.unsplash.com/photo-1569058242253-92a9c755a0ec?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 8. Soto Betawi Pak Darmo
            ['food_place_id' => 8, 'image_path' => 'https://images.unsplash.com/photo-1559329007-40df8a9345d8?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 8, 'image_path' => 'https://images.unsplash.com/photo-1547424450-8d6f51dd2966?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 9. Mie Ayam Pak Hasan
            ['food_place_id' => 9, 'image_path' => 'https://images.unsplash.com/photo-1582878826629-29b7ad1cdc43?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 9, 'image_path' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 10. Nasi Uduk Bu Imas
            ['food_place_id' => 10, 'image_path' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 10, 'image_path' => 'https://images.unsplash.com/photo-1563379091339-03246963d4de?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 11. Gado-gado Bu Tini
            ['food_place_id' => 11, 'image_path' => 'https://images.unsplash.com/photo-1466978913421-dad2ebd01d17?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 11, 'image_path' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 12. Pecel Lele Bu Tinah
            ['food_place_id' => 12, 'image_path' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 12, 'image_path' => 'https://images.unsplash.com/photo-1544943910-4c1dc44aab44?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 13. Nasi Goreng Kampung Pak Edi
            ['food_place_id' => 13, 'image_path' => 'https://images.unsplash.com/photo-1516684669134-de6f8d1cdcd8?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 13, 'image_path' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 14. Ketoprak Jakarta Ibu Yati
            ['food_place_id' => 14, 'image_path' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 14, 'image_path' => 'https://images.unsplash.com/photo-1565299507177-b0ac66763828?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 15. Es Cendol Durian Mbak Sari
            ['food_place_id' => 15, 'image_path' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 15, 'image_path' => 'https://images.unsplash.com/photo-1570197788417-0e82375c9371?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 16. Martabak Manis & Telur Pak Ucup
            ['food_place_id' => 16, 'image_path' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 16, 'image_path' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 17. KFC Serang
            ['food_place_id' => 17, 'image_path' => 'https://images.unsplash.com/photo-1513639776629-7b61b0ac49cb?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 17, 'image_path' => 'https://images.unsplash.com/photo-1626645738196-c2a7c87a8f58?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 18. McDonald's Serang Mall
            ['food_place_id' => 18, 'image_path' => 'https://images.unsplash.com/photo-1552566820-3a4c27d4a4b4?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 18, 'image_path' => 'https://images.unsplash.com/photo-1571091655789-405eb7a3a3a8?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 19. Pizza Hut Serang
            ['food_place_id' => 19, 'image_path' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 19, 'image_path' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
            
            // 20. Bakmi GM Serang
            ['food_place_id' => 20, 'image_path' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=600&h=400&fit=crop&crop=center', 'type' => 'business'],
            ['food_place_id' => 20, 'image_path' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=600&h=400&fit=crop&crop=center', 'type' => 'menu'],
        ];

        foreach ($images as $image) {
            FoodPlaceImage::create($image);
        }
    }
}
