<?php

use App\Models\User;
use App\Models\Recipe;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->actingAs($this->user);
});

test('user can create a recipe with valid data', function () {
    $response = $this->post('/recipes', [
        'title' => 'Test Recipe',
        'description' => 'This is a test recipe description.',
        'ingredients' => 'Ingredient1, Ingredient2',
        'instructions' => 'Step 1, Step 2',
    ]);

    $response->assertRedirect('/recipes');
    $this->assertDatabaseHas('recipes', [
        'title' => 'Test Recipe',
        'description' => 'This is a test recipe description.',
    ]);
});

test('user can view a recipe', function () {
    $recipe = Recipe::factory()->create();

    $response = $this->get("/recipes/{$recipe->id}");

    $response->assertOk();
    $response->assertSee($recipe->title);
});

test('user can update a recipe', function () {
    $recipe = Recipe::factory()->create(['user_id' => $this->user->id]);

    $response = $this->patch("/recipes/{$recipe->id}", [
        'title' => 'Updated Recipe Title',
        'description' => 'Updated description',
    ]);

    $response->assertRedirect("/recipes/{$recipe->id}");
    $this->assertDatabaseHas('recipes', [
        'id' => $recipe->id,
        'title' => 'Updated Recipe Title',
    ]);
});

test('user can delete a recipe', function () {
    $recipe = Recipe::factory()->create(['user_id' => $this->user->id]);

    $response = $this->delete("/recipes/{$recipe->id}");

    $response->assertRedirect('/recipes');
    $this->assertDatabaseMissing('recipes', [
        'id' => $recipe->id,
    ]);
});

test('user can rate a recipe', function () {
    $recipe = Recipe::factory()->create();

    $response = $this->post("/recipes/{$recipe->id}/rate", [
        'rating' => 4,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('ratings', [
        'recipe_id' => $recipe->id,
        'user_id' => $this->user->id,
        'rating' => 4,
    ]);
});

test('user can comment on a recipe', function () {
    $recipe = Recipe::factory()->create();

    $response = $this->post("/recipes/{$recipe->id}/comment", [
        'comment' => 'This is a test comment.',
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'recipe_id' => $recipe->id,
        'user_id' => $this->user->id,
        'comment' => 'This is a test comment.',
    ]);
});
