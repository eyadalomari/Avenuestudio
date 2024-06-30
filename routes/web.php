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

    Route::resource('reservations', App\Http\Controllers\ReservationController::class)->middleware('permission');
    Route::resource('staffs', App\Http\Controllers\StaffController::class)->middleware('permission');
    Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('permission');
    Route::resource('types', App\Http\Controllers\TypeController::class)->middleware('permission');
    Route::resource('statuses', App\Http\Controllers\StatusController::class)->middleware('permission');
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');

    Route::middleware(['admin'])->group(function () {
        Route::get('/permission', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
        Route::post('/permission/assign-role', [App\Http\Controllers\AdminController::class, 'assignRole'])->name('admin.assign-role');
        Route::post('/permission/assign-permission', [App\Http\Controllers\AdminController::class, 'assignPermission'])->name('admin.assign-permission');
    });
    
});

Route::get('/', function () {
    return redirect('/' . app()->getLocale());
});

// Route::group(['middleware' => ['permission:view-dashboard']], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });
