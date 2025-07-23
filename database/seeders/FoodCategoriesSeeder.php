<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodCategories;

class FoodCategoriesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categories = [
      ['name' => 'Restoran'],
      ['name' => 'Kedai Kopi'],
      ['name' => 'Kedai Makanan'],
      ['name' => 'Warung Makan'],
      ['name' => 'Cafe'],
      ['name' => 'Fast Food'],
      ['name' => 'Street Food'],
    ];

    foreach ($categories as $category) {
      FoodCategories::firstOrCreate($category);
    }
  }
}
