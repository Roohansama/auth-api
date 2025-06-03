<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

route::get('/ping',function(){
    return ['message' => 'pong'];
})->middleware('auth:api');

//Login Route
Route::post('/login', [AuthController::class, 'login']);

//Register Route
Route::post('/register', [AuthController::class, 'register']);

route::group(['middleware' => 'auth:api'], function($route){
//Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);

//get authenticated user
    Route::post('/me', [AuthController::class, 'me']);
});



