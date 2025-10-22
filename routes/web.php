<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarController;

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

    // --- ADMIN-ONLY ROUTES ---
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // ADDED: This single line creates all the routes for the UserController
        Route::resource('users', UserController::class);
    });
});

