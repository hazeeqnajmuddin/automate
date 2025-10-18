<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route to SHOW the login page
Route::get('/login', [LoginController::class, 'show'])->name('login');

// Route to HANDLE the login form submission
Route::post('/login', [LoginController::class, 'login']);

// Add this line with your other routes
Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

// --- Registration Routes ---
// Shows the registration page
Route::get('/register', [RegisterController::class, 'show'])->name('register');
// Handles the form submission
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');