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

Route::group(['prefix' => '{locale}', 'middleware' => ['locale']], function () {
    Auth::routes();
});

Route::group(['prefix' => '{locale}', 'middleware' => ['locale', 'auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('reservations', App\Http\Controllers\ReservationController::class)->parameter('id', 'id');
    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::resource('types', App\Http\Controllers\TypeController::class);
    Route::resource('statuses', App\Http\Controllers\StatusController::class);

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
});

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});
