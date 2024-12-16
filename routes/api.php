<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FractionController;
use App\Http\Controllers\AuthController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::any(uri: 'login', action: [FractionController::class, 'login']);
Route::any(uri: 'register', action: [FractionController::class, 'register']);
//Route::any('/register', [FractionController::class, 'register']);


