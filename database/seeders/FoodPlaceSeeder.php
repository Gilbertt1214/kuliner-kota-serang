<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodPlace;
use App\Models\User;

class FoodPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get pengusaha users by email for consistent mapping
        $pengusahaUsers = [
            'yono' => User::where('email', 'yono@pengusaha.com')->first()->id,
            'djum' => User::where('email', 'djum@pengusaha.com')->first()->id,
            'darmo' => User::where('email', 'darmo@pengusaha.com')->first()->id,
            'imas' => User::where('email', 'imas@pengusaha.com')->first()->id,
            'kumis' => User::where('email', 'kumis@pengusaha.com')->first()->id,
            'tini' => User::where('email', 'tini@pengusaha.com')->first()->id,
            'hasan' => User::where('email', 'hasan@pengusaha.com')->first()->id,
            'tinah' => User::where('email', 'tinah@pengusaha.com')->first()->id,
        ];

        $foodPlaces = [
            // RESTORAN (Category ID: 1)
            [
                'title' => 'Sate Kambing Pak Yono',
                'description' => 'Sate kambing legendaris dengan bumbu kacang yang gurih dan daging kambing yang empuk. Sudah buka sejak tahun 1990 dan menjadi ikon kuliner Serang.',
                'food_category_id' => 1,
                'min_price' => 15000,
                'max_price' => 50000,
                'location' => 'Jl. Raya Serang-Jakarta No. 45, Cipocok Jaya, Serang',
                'source_location' => 'https://maps.google.com/yono-sate',
                'user_id' => $pengusahaUsers['yono'],
                'status' => 'active',
            ],
            [
                'title' => 'Gudeg Yu Djum Serang',
                'description' => 'Gudeg khas Jogja dengan cita rasa autentik yang telah disesuaikan dengan lidah Serang. Lengkap dengan ayam, telur, dan krecek.',
                'food_category_id' => 1,
                'min_price' => 18000,
                'max_price' => 35000,
                'location' => 'Jl. Sudirman No. 156, Sumur Pecung, Serang',
                'source_location' => 'https://maps.google.com/djum-gudeg',
                'user_id' => $pengusahaUsers['djum'],
                'status' => 'active',
            ],
            [
                'title' => 'RM Sederhana Padang',
                'description' => 'Restoran Padang dengan cita rasa autentik. Menyajikan berbagai masakan Minang seperti rendang, gulai, dan dendeng.',
                'food_category_id' => 1,
                'min_price' => 20000,
                'max_price' => 75000,
                'location' => 'Jl. Ahmad Yani No. 88, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/sederhana-padang',
                'user_id' => $pengusahaUsers['darmo'],
                'status' => 'active',
            ],
            [
                'title' => 'Warung Nasi Ampera',
                'description' => 'Warung tradisional dengan menu nasi dan lauk-pauk khas Betawi. Terkenal dengan soto betawi dan kerak telor.',
                'food_category_id' => 1,
                'min_price' => 12000,
                'max_price' => 35000,
                'location' => 'Jl. KH. Abdul Fatah Hasan No. 23, Kasemen, Serang',
                'source_location' => 'https://maps.google.com/nasi-ampera',
                'user_id' => $pengusahaUsers['imas'],
                'status' => 'active',
            ],

            // KEDAI KOPI (Category ID: 2)
            [
                'title' => 'Cafe Teras Kota',
                'description' => 'Cafe modern dengan suasana santai dan pemandangan kota Serang. Menu kopi specialty dan makanan ringan tersedia.',
                'food_category_id' => 2,
                'min_price' => 15000,
                'max_price' => 45000,
                'location' => 'Jl. Veteran No. 45, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/cafe-teras-kota',
                'user_id' => $pengusahaUsers['yono'],
                'status' => 'active',
            ],
            [
                'title' => 'Kedai Kopi Serang',
                'description' => 'Kedai kopi lokal dengan biji kopi pilihan dan suasana yang cozy. Cocok untuk meeting atau sekedar bersantai.',
                'food_category_id' => 2,
                'min_price' => 8000,
                'max_price' => 25000,
                'location' => 'Jl. Diponegoro No. 67, Cipocok Jaya, Serang',
                'source_location' => 'https://maps.google.com/kedai-kopi-serang',
                'user_id' => $pengusahaUsers['tini'],
                'status' => 'active',
            ],

            // KEDAI MAKANAN (Category ID: 3)
            [
                'title' => 'Bakso Malang Pak Kumis',
                'description' => 'Bakso malang dengan isian yang beragam dan kuah kaldu sapi yang lezat. Dilengkapi dengan mie kuning dan pangsit.',
                'food_category_id' => 3,
                'min_price' => 12000,
                'max_price' => 30000,
                'location' => 'Jl. Ahmad Yani No. 78, Kasemen, Serang',
                'source_location' => 'https://maps.google.com/bakso-pak-kumis',
                'user_id' => $pengusahaUsers['kumis'],
                'status' => 'active',
            ],
            [
                'title' => 'Soto Betawi Pak Darmo',
                'description' => 'Soto betawi dengan kuah santan yang kental dan daging sapi yang empuk. Disajikan dengan emping dan kerupuk.',
                'food_category_id' => 3,
                'min_price' => 15000,
                'max_price' => 25000,
                'location' => 'Jl. Banten Lama No. 67, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/soto-pak-darmo',
                'user_id' => $pengusahaUsers['darmo'],
                'status' => 'active',
            ],
            [
                'title' => 'Mie Ayam Pak Hasan',
                'description' => 'Mie ayam dengan topping ayam fillet yang lezat dan pangsit goreng yang crispy. Kuah kaldu ayam yang hangat.',
                'food_category_id' => 3,
                'min_price' => 10000,
                'max_price' => 20000,
                'location' => 'Jl. Raya Cilegon No. 45, Taktakan, Serang',
                'source_location' => 'https://maps.google.com/mie-ayam-hasan',
                'user_id' => $pengusahaUsers['hasan'],
                'status' => 'active',
            ],

            // WARUNG MAKAN (Category ID: 4)
            [
                'title' => 'Nasi Uduk Bu Imas',
                'description' => 'Nasi uduk dengan lauk lengkap seperti ayam goreng, tempe, tahu, dan sambal terasi yang pedas mantap.',
                'food_category_id' => 4,
                'min_price' => 8000,
                'max_price' => 25000,
                'location' => 'Jl. KH. Tb. Khalil No. 12, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/nasi-uduk-imas',
                'user_id' => $pengusahaUsers['imas'],
                'status' => 'active',
            ],
            [
                'title' => 'Gado-gado Bu Tini',
                'description' => 'Gado-gado dengan sayuran segar dan bumbu kacang yang kental. Dilengkapi dengan kerupuk dan emping.',
                'food_category_id' => 4,
                'min_price' => 8000,
                'max_price' => 15000,
                'location' => 'Jl. Cilegon No. 89, Walantaka, Serang',
                'source_location' => 'https://maps.google.com/gado-gado-tini',
                'user_id' => $pengusahaUsers['tini'],
                'status' => 'active',
            ],
            [
                'title' => 'Pecel Lele Bu Tinah',
                'description' => 'Pecel lele goreng crispy dengan sambal terasi yang pedas dan lalapan segar. Menu favorit keluarga.',
                'food_category_id' => 4,
                'min_price' => 12000,
                'max_price' => 20000,
                'location' => 'Jl. Kyai Haji Agus Salim No. 56, Cipocok Jaya, Serang',
                'source_location' => 'https://maps.google.com/pecel-lele-tinah',
                'user_id' => $pengusahaUsers['tinah'],
                'status' => 'active',
            ],
            [
                'title' => 'Nasi Goreng Kampung Pak Edi',
                'description' => 'Nasi goreng kampung dengan cita rasa tradisional. Dilengkapi dengan telur ceplok, kerupuk, dan acar.',
                'food_category_id' => 4,
                'min_price' => 10000,
                'max_price' => 18000,
                'location' => 'Jl. Pangeran Diponegoro No. 78, Kasemen, Serang',
                'source_location' => 'https://maps.google.com/nasi-goreng-edi',
                'user_id' => $pengusahaUsers['hasan'],
                'status' => 'active',
            ],
            [
                'title' => 'Ketoprak Jakarta Ibu Yati',
                'description' => 'Ketoprak jakarta dengan tahu, ketupat, dan bumbu kacang yang gurih. Camilan sehat dan mengenyangkan.',
                'food_category_id' => 4,
                'min_price' => 7000,
                'max_price' => 15000,
                'location' => 'Jl. Sultan Ageng Tirtayasa No. 34, Sumur Pecung, Serang',
                'source_location' => 'https://maps.google.com/ketoprak-yati',
                'user_id' => $pengusahaUsers['yono'],
                'status' => 'pending', // Some pending for variety
            ],

            // CAFE (Category ID: 5)
            [
                'title' => 'Es Cendol Durian Mbak Sari',
                'description' => 'Es cendol dengan topping durian segar dan santan yang creamy. Minuman segar khas Serang yang wajib dicoba.',
                'food_category_id' => 5,
                'min_price' => 10000,
                'max_price' => 20000,
                'location' => 'Jl. Veteran No. 23, Curug, Serang',
                'source_location' => 'https://maps.google.com/es-cendol-sari',
                'user_id' => $pengusahaUsers['djum'],
                'status' => 'active',
            ],
            [
                'title' => 'Martabak Manis & Telur Pak Ucup',
                'description' => 'Martabak manis dengan berbagai topping dan martabak telur yang gurih. Camilan malam favorit warga Serang.',
                'food_category_id' => 5,
                'min_price' => 12000,
                'max_price' => 35000,
                'location' => 'Jl. Ahmad Yani No. 123, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/martabak-ucup',
                'user_id' => $pengusahaUsers['kumis'],
                'status' => 'pending',
            ],

            // FAST FOOD (Category ID: 6)
            [
                'title' => 'KFC Serang',
                'description' => 'Fast food fried chicken terkenal dengan 11 herbs and spices. Lokasi strategis di pusat kota Serang.',
                'food_category_id' => 6,
                'min_price' => 25000,
                'max_price' => 150000,
                'location' => 'Jl. Ahmad Yani No. 150, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/kfc-serang',
                'user_id' => $pengusahaUsers['tinah'],
                'status' => 'active',
            ],
            [
                'title' => 'McDonald\'s Serang Mall',
                'description' => 'Fast food burger dan kentang goreng dengan standard internasional. Tersedia layanan drive-thru dan delivery.',
                'food_category_id' => 6,
                'min_price' => 20000,
                'max_price' => 120000,
                'location' => 'Serang Mall, Jl. Ahmad Yani, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/mcdonalds-serang',
                'user_id' => $pengusahaUsers['tini'],
                'status' => 'active',
            ],
            [
                'title' => 'Pizza Hut Serang',
                'description' => 'Pizza dengan berbagai varian topping dan pasta yang lezat. Cocok untuk makan bersama keluarga.',
                'food_category_id' => 6,
                'min_price' => 45000,
                'max_price' => 300000,
                'location' => 'Jl. Sudirman No. 88, Sumur Pecung, Serang',
                'source_location' => 'https://maps.google.com/pizza-hut-serang',
                'user_id' => $pengusahaUsers['djum'],
                'status' => 'active',
            ],
            [
                'title' => 'Bakmi GM Serang',
                'description' => 'Bakmi dan nasi campur dengan cita rasa Tionghoa yang sudah disesuaikan dengan lidah Indonesia.',
                'food_category_id' => 6,
                'min_price' => 25000,
                'max_price' => 80000,
                'location' => 'Jl. Diponegoro No. 156, Serang Kota, Serang',
                'source_location' => 'https://maps.google.com/bakmi-gm-serang',
                'user_id' => $pengusahaUsers['darmo'],
                'status' => 'rejected', // Some rejected for variety
            ],
        ];

        foreach ($foodPlaces as $foodPlace) {
            FoodPlace::create($foodPlace);
        }
    }
}
