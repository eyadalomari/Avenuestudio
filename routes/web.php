<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth::routes();

// Route::get('/{locale}', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');
// Route::get('/{locale}/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');

// Route::middleware('auth')->resource('{locale}/reservations', App\Http\Controllers\ReservationController::class);
// Route::middleware('auth')->resource('{locale}/staffs', App\Http\Controllers\StaffController::class);

// Auth routes with locale
Route::group(['prefix' => '{locale}', 'middleware' => ['locale', 'auth']], function () {
   Auth::routes(['register' => false, 'reset' => false, 'verify' => false]); // Adjust according to your needs

   Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
   
   Route::resource('reservations', App\Http\Controllers\ReservationController::class);
   Route::resource('staffs', App\Http\Controllers\StaffController::class);
});

// Default route to redirect to a locale
Route::get('/', function () {
   return redirect('/' . app()->getLocale());
});
