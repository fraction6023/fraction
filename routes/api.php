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
Route::any(uri: 'myvisits', action: [FractionController::class, 'myvisits']);
Route::any(uri: 'updateStatus', action: [FractionController::class, 'updateStatus']);
Route::any(uri: 'saveFeedback', action: [FractionController::class, 'saveFeedback']);
Route::any(uri: 'book-club', action: [FractionController::class, 'book_club']);
Route::get(uri: 'user/{user_id}', action: [FractionController::class, 'user']);
Route::put(uri: 'user/{user_id}', action: [FractionController::class, 'update_user_info']);
Route::get(uri: 'get_user_kind/{user_id}', action: [FractionController::class, 'get_user_kind']);
Route::get(uri: 'pending-bookings/{user_id}', action: [FractionController::class, 'pending_bookings']);


Route::post(uri: 'user/change-password', action: [FractionController::class, 'change_password']);