<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Register Route
Route::get('register', function () {
    return view('register');
});
Route::post('register', [RegistrationController::class, 'register']);

//Login Route
Route::get('login', function () {
    return view('login');
});
Route::post('login', [AuthController::class, 'login']);

//Logout Route
Route::get('logout', function () {
    return view('logout');
});

Route::get('dashboard', function () {
    return view('dashboard');
});
