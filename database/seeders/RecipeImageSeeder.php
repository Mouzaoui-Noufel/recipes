<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeImageSeeder extends Seeder
{
    public function run()
    {
        // Map of recipe titles to image filenames
        $titleToImage = [
            'Classic Spaghetti Carbonara' => 'Classic Spaghetti Carbonara.jpg',
            'Chicken Caesar Salad' => 'Chicken Caesar Salad.jpg',
            'Chocolate Chip Cookies' => 'Chocolate Chip Cookies.jpg',
            'Beef Stir Fry' => 'Beef Stir Fry.jpg',
            'Pancakes' => 'Pancakesjpg.jpg',
            'Tomato Soup' => 'Tomato Soup.jpg',
            'Grilled Cheese Sandwich' => 'Grilled Cheese Sandwich.jpg',
            'Cauliflower Rice' => 'Cauliflower Rice.jpg',
            'Fruit Smoothie' => 'Fruit Smoothie.jpg',
            'Garlic Roasted Potatoes' => 'Garlic Roasted Potatoes.jpg',
        ];

        $recipes = Recipe::all();

        foreach ($recipes as $recipe) {
            if (array_key_exists($recipe->title, $titleToImage)) {
                $recipe->image = 'recipes/' . $titleToImage[$recipe->title];
                $recipe->save();
            }
        }
    }
}
