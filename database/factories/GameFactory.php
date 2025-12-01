<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'release_date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(400, 300, 'products', true),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}