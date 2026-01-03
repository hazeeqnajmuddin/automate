<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AiController;

use App\Http\Controllers\CustomForgotPasswordController;
use App\Http\Controllers\CustomResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you can register web routes for your application.
|
*/

// --- Public Welcome Route ---
// Anyone can see this page.
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


// --- GUEST ROUTES ---
// These routes are only accessible to users who are NOT logged in.
// If a logged-in user tries to visit /login, they'll be redirected to /home.
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // --- CUSTOM PASSWORD RESET ROUTES ---
    // THIS IS THE ROUTE THAT WAS MISSING OR INCORRECT:
    Route::get('password/reset', [CustomForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [CustomForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [CustomResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/update', [CustomResetPasswordController::class, 'reset'])->name('password.update');
});


// --- AUTHENTICATED ROUTES ---
// These routes are only accessible to users who ARE logged in.
// If a guest tries to visit /home, they'll be redirected to the /login page.
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // --- CAR MANAGEMENT ROUTES ---
    // This creates routes like /cars, /cars/create, /cars/{car}/edit, etc.
    Route::resource('cars', CarController::class);
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::resource('cars', CarController::class)->except(['show']);

    Route::get('/cars/{car}/accident-history', [CarController::class, 'accidentHistory'])->name('cars.accident_history');
    Route::get('/cars/{car}/accident-management', [CarController::class, 'manageAccidents'])->name('cars.manage_accidents');
    Route::post('/cars/{car}/accident', [CarController::class, 'storeAccident'])->name('cars.accident.store');
    Route::delete('/cars/{car}/accident/{accident}', [CarController::class, 'destroyAccident'])->name('cars.accident.destroy');
    
    Route::get('/cars/{car}/service-history', [CarController::class, 'serviceHistory'])->name('cars.service_history');
    Route::get('/cars/{car}/service-management', [CarController::class, 'manageServices'])->name('cars.manage_services');
    Route::post('/cars/{car}/service', [CarController::class, 'storeService'])->name('cars.service.store');
    Route::delete('/cars/{car}/service/{service}', [CarController::class, 'destroyService'])->name('cars.service.destroy');

    // --- AI SERVICE RECOMMENDATION ROUTES ---
    // ADD THESE TWO LINES:
    Route::get('/ai-recommender', [AiController::class, 'index'])->name('ai.index');
    Route::get('/ai-recommender/generate', [AiController::class, 'generateRecommendations'])->name('ai.recommend');

    // --- ADMIN-ONLY ROUTES ---
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // ADDED: This single line creates all the routes for the UserController
        Route::resource('users', UserController::class);
        Route::get('/users/{user}/cars', [UserController::class, 'showCars'])->name('users.cars');
        Route::get('/users/{user}/cars/{car}', [UserController::class, 'showCarDetails'])->name('users.car_details');
    });
});

