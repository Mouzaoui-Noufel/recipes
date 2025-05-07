<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return redirect('/recipes');
})->name('home');

Route::redirect('/login', '/user/login')->name('login');
Route::redirect('/register', '/user/register')->name('register');
Route::redirect('/signin', '/user/register')->name('signin');




// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::get('/register', [UserAuthController::class, 'showRegistrationForm'])
        ->middleware('guest')
        ->name('user.register');

    Route::post('/register', [UserAuthController::class, 'register'])
        ->middleware('guest');

    Route::get('/login', [UserAuthController::class, 'showLoginForm'])
        ->middleware('guest')
        ->name('user.login');

    Route::post('/login', [UserAuthController::class, 'login'])
        ->middleware('guest');

    Route::post('/logout', [UserAuthController::class, 'logout'])
        ->middleware('auth')
        ->name('user.logout');

    Route::get('/dashboard', [UserAuthController::class, 'dashboard'])
        ->middleware('auth')
        ->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    
    Route::post('/recipes/{recipe}/rate', [RecipeController::class, 'rate'])
        ->name('recipes.rate');
    
    Route::post('/recipes/{recipe}/comment', [RecipeController::class, 'comment'])
        ->name('recipes.comment');
});

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

