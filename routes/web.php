<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\CustomerController::class, 'index']);
Route::get('/home', [App\Http\Controllers\CustomerController::class, 'index']);

Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index']);
Route::put('/purchase', [App\Http\Controllers\CustomerController::class, 'purchase']);


Route::get('/booking', [App\Http\Controllers\CustomerController::class, 'booking']);
Route::put('/bookGym', [App\Http\Controllers\CustomerController::class, 'bookGym']);
Route::put('/approveVisit', [App\Http\Controllers\CustomerController::class, 'approveVisit']);
Route::put('/cancelBookGym', [App\Http\Controllers\CustomerController::class, 'cancelBookGym']);


Route::get('/dashboard', [App\Http\Controllers\CustomerController::class, 'dashboard']);
Route::put('/dashboardUpdate', [App\Http\Controllers\CustomerController::class, 'dashboardUpdate']);

Route::get('/visit', [App\Http\Controllers\CustomerController::class, 'visit']);
Route::get('/visits', [App\Http\Controllers\CustomerController::class, 'visits']);
Route::put('/feedbackVisit', [App\Http\Controllers\CustomerController::class, 'feedbackVisit']);
Route::put('/feedbackfinish', [App\Http\Controllers\CustomerController::class, 'feedbackfinish']);


//***** Gym routing *******//

Route::get('/gymregister', [App\Http\Controllers\GymController::class, 'gymregister']);
Route::post('/insertGMY', [App\Http\Controllers\GymController::class, 'insertGMY']);

Route::get('/waitingOrders', [App\Http\Controllers\GymController::class, 'waitingOrders']);
Route::put('/gymfeedbackVisit', [App\Http\Controllers\GymController::class, 'gymfeedbackVisit']);
Route::any('/qrScanner', [App\Http\Controllers\GymController::class, 'qrScanner']);




//***** Gym routing *******//

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
Route::put('/matchUserGym', [App\Http\Controllers\AdminController::class, 'matchUserGym']);