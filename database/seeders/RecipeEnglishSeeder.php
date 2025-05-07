<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeEnglishSeeder extends Seeder
{
    public function run()
    {
        $englishRecipes = [
            [
                'title' => 'Avocado Toast',
                'description' => 'Simple and delicious avocado toast with lemon and chili flakes.',
                'ingredients' => "2 slices bread\n1 ripe avocado\n1 tbsp lemon juice\nChili flakes\nSalt and pepper",
                'steps' => "1. Toast the bread.\n2. Mash avocado with lemon juice, salt, and pepper.\n3. Spread avocado on toast.\n4. Sprinkle chili flakes on top.\n5. Serve immediately.",
            ],
            [
                'title' => 'Vegetable Stir Fry',
                'description' => 'Quick and healthy vegetable stir fry with soy sauce.',
                'ingredients' => "1 cup broccoli\n1 cup bell peppers\n1 cup carrots\n2 cloves garlic\n2 tbsp soy sauce\n1 tbsp olive oil",
                'steps' => "1. Heat oil in a pan.\n2. Add garlic and sauté.\n3. Add vegetables and stir fry.\n4. Add soy sauce and cook for 5 minutes.\n5. Serve hot with rice or noodles.",
            ],
        ];

        $recipes = Recipe::all();

        foreach ($recipes as $index => $recipe) {
            if ($index < 2) {
                $data = $englishRecipes[$index];
                $recipe->title = $data['title'];
                $recipe->description = $data['description'];
                $recipe->ingredients = $data['ingredients'];
                $recipe->steps = $data['steps'];
                $recipe->save();
            }
        }
    }
}
