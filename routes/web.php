<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index']);

Route::get('/booking', [App\Http\Controllers\CustomerController::class, 'booking']);
Route::put('/bookGym', [App\Http\Controllers\CustomerController::class, 'bookGym']);


Route::get('/dashboard', [App\Http\Controllers\CustomerController::class, 'dashboard']);
Route::put('/dashboardUpdate', [App\Http\Controllers\CustomerController::class, 'dashboardUpdate']);

Route::get('/visits', [App\Http\Controllers\CustomerController::class, 'visits']);
