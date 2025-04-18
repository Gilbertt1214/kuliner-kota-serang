<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\FoodPlace;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Fahrian',
            'email' => 'fahri@gmail.com',
        ]);

          $data = [
            [
                'title'       => 'Warung Soto Betawi',
                'description' => 'Menikmati kelezatan Soto Betawi yang autentik dengan kuah gurih khas Jakarta.',
                'category'    => 'Soto',
                'min_price'   => '20.00',   // Harga minimal
                'max_price'   => '30.00',   // Harga maksimal
                'location'    => 'Jakarta',
                'rating'      => '4.2',
                'image'       => 'soto_betawi.jpg',
                'menu'        => 'soto_menu.pdf',
            ],
            [
                'title'       => 'Bakso Bakar Pak Slamet',
                'description' => 'Bakso bakar dengan cita rasa khas dan bumbu rempah yang menggugah selera.',
                'category'    => 'Bakso',
                'min_price'   => '25.00',
                'max_price'   => '35.50',
                'location'    => 'Surabaya',
                'rating'      => '4.6',
                'image'       => 'bakso_bakar.jpg',
                'menu'        => 'bakso_menu.pdf',
            ],
            [
                'title'       => 'Nasi Goreng Mbak Eko',
                'description' => 'Nasi goreng dengan paduan bumbu spesial yang membuat hidangan ini selalu dicari.',
                'category'    => 'Nasi Goreng',
                'min_price'   => '10.00',
                'max_price'   => '20.00',
                'location'    => 'Yogyakarta',
                'rating'      => '4.4',
                'image'       => 'nasi_goreng.jpg',
                'menu'        => 'nasi_menu.pdf',
            ],
            [
                'title'       => 'Pecel Lele Lela',
                'description' => 'Pecel lele dengan sambal khas dan lauk pendamping yang membuat setiap gigitan terasa istimewa.',
                'category'    => 'Seafood',
                'min_price'   => '15.00',
                'max_price'   => '25.00',
                'location'    => 'Bandung',
                'rating'      => '4.3',
                'image'       => 'pecel_lele.jpg',
                'menu'        => 'pecel_menu.pdf',
            ],
            [
                'title'       => 'Rendang Minang Sari',
                'description' => 'Rendang asli Minang yang lembut dan kaya rempah, disajikan dengan nasi hangat.',
                'category'    => 'Minang',
                'min_price'   => '30.00',
                'max_price'   => '40.00',
                'location'    => 'Padang',
                'rating'      => '4.7',
                'image'       => 'rendang_minang.jpg',
                'menu'        => 'rendang_menu.pdf',
            ],
        ];

        FoodPlace::insert($data);

        
    }
}
