<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\CustomerController::class, 'dashboard']);
