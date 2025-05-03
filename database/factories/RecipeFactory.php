<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;

class RecipeFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'ingredients' => $this->faker->paragraph(),
            'steps' => $this->faker->paragraph(),
            'category_id' => Category::inRandomOrder()->first()->id ?? null,
            'user_id' => User::inRandomOrder()->first()->id ?? null,
            'image' => null,
        ];
    }
}