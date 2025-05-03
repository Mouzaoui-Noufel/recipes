<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// Signin Routes (registration)
Route::get('/signin', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('signin');

Route::post('/signin', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    
    Route::post('/recipes/{recipe}/rate', [RecipeController::class, 'rate'])
        ->name('recipes.rate');
    
    Route::post('/recipes/{recipe}/comment', [RecipeController::class, 'comment'])
        ->name('recipes.comment');
});

Route::resource('recipes', RecipeController::class)->only(['index', 'show']);

Route::get('/dashboard', function () {
    return redirect()->route('recipes.index');
})->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
});
