<?php
use App\Http\Controllers\Api\RecipeApiController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('recipes', RecipeApiController::class);
    Route::post('/recipes/{recipe}/rate', [RecipeApiController::class, 'rate']);
});