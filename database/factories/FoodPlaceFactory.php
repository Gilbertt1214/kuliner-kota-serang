<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FoodPlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(2),
            'category' => $this->faker->word(),
            'min_price' => $this->faker->randomFloat(2, 5, 100),
            'max_price' => $this->faker->randomFloat(2, 10, 200),
            'location' => $this->faker->address(),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'image' => $this->faker->imageUrl(640, 480, 'food'),
            'menu' => $this->faker->word() . '.pdf',
        ];
    }
}
