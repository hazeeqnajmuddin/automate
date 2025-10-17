<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/Login', function () {
    return view('manageLogin.login');
})->name('login');

Route::get('/signup', function () {
    return view('manageSignUp.signUp');
})->name('signUp');
