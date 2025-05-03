<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Rating;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create some categories
        Category::factory()->count(5)->create();

        // Create some users
        User::factory()->count(10)->create();

        // Create recipes with relationships
        Recipe::factory()->count(20)->create()->each(function ($recipe) {
            // Assign random category
            $recipe->category_id = Category::inRandomOrder()->first()->id;
            // Assign random user
            $recipe->user_id = User::inRandomOrder()->first()->id;
            $recipe->save();

            // Create unique ratings for the recipe
            $users = User::inRandomOrder()->take(3)->get();
            foreach ($users as $user) {
                Rating::updateOrCreate(
                    ['recipe_id' => $recipe->id, 'user_id' => $user->id],
                    ['rating' => rand(1, 5)]
                );
            }
        });
    }
}