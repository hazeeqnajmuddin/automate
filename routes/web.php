<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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

// Route::get('/register', function () {
//     return view('manageSignUp.register');
// })->name('register');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');