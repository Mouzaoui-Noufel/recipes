<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rating;
use App\Models\Recipe;
use App\Models\User;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? null,
            'recipe_id' => Recipe::inRandomOrder()->first()->id ?? null,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
