<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\FractionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\AdminController;

//use Illuminate\Http\Request;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/buy', function (Request $request) {
//     $checkout = $request->user()->checkout(['pri_tshirt', 'pri_socks' => 5]);
 
//     return view('customer.billing', ['checkout' => $checkout]);
// });

Auth::routes();

//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [CustomerController::class, 'index']);
Route::get('/welcome', [CustomerController::class, 'welcome']);
Route::get('/home', [CustomerController::class, 'index']);
Route::get('/pay', [CustomerController::class, 'pay']);

Route::get('/customer', [CustomerController::class, 'index']);
Route::put('/purchase', [CustomerController::class, 'purchase']);
Route::get('/customerFeedBack', [CustomerController::class, 'customerFeedBack']);
Route::get('/showGymsOnMap', [CustomerController::class, 'showGymsOnMap']);


Route::get('/booking', [CustomerController::class, 'booking']);
Route::put('/bookGym', [CustomerController::class, 'bookGym']);
Route::put('/approveVisit', [CustomerController::class, 'approveVisit']);
Route::put('/cancelBookGym', [CustomerController::class, 'cancelBookGym']);

Route::get('/dashboard', [CustomerController::class, 'dashboard']);
Route::put('/dashboardUpdate', [CustomerController::class, 'dashboardUpdate']);

Route::get('/visit', [CustomerController::class, 'visit']);
Route::get('/visits', [CustomerController::class, 'visits']);
Route::put('/feedbackVisit', [CustomerController::class, 'feedbackVisit']);
Route::put('/feedbackfinish', [CustomerController::class, 'feedbackfinish']);
Route::get('/customerFinance', [CustomerController::class, 'finance']);
Route::get('/charging', [CustomerController::class, 'charging']);
Route::get('/submit', [CustomerController::class, 'submit']);

//***** API *******//

Route::get('/visitsapi', [FractionController::class, 'visits']);
Route::get('/visitapi/{id}', [FractionController::class, 'showvisit']);
Route::get('/myvisits/{id}', [FractionController::class, 'myvisits']);

//Route::any('login',[FractionController::class, 'login']);
//Route::any(uri: 'login', action: [FractionController::class, 'login']);


//***** Gym routing *******//

Route::get('/gymregister', [GymController::class, 'gymregister']);
Route::post('/insertGMY', [GymController::class, 'insertGMY']);

Route::get('/waitingOrders', [GymController::class, 'waitingOrders']);
Route::put('/gymfeedbackVisit', [GymController::class, 'gymfeedbackVisit']);
Route::any('/qrScanner', [GymController::class, 'qrScanner']);
Route::get('/gymFeedBack', [GymController::class, 'gymFeedBack']);
Route::get('/finance', [GymController::class, 'finance']);

//***** Gym routing *******//

Route::get('/admin', [AdminController::class, 'index']);
Route::put('/matchUserGym', [AdminController::class, 'matchUserGym']);