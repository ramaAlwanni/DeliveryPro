<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'en' => fake()->word(),
                'ar' => fake()->word(),
            ],
            'description' => [
                'en' => fake()->word(),
                'ar' => fake()->word(),
            ],
            'image' => fake()->imageUrl(),
            'price' => fake()->randomFloat(2, 10, 500), 
            'quantity' => fake()->numberBetween(0, 100), 
            'store_id' => Store::factory(), 
        ];
    }
}
