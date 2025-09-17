<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\ClientWebController;

Route::get('/login', [AuthWebController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthWebController::class, 'login'])->name('login.attempt');
Route::post('/logout',[AuthWebController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserWebController::class);
    Route::resource('products', ProductWebController::class);
    Route::resource('clients', ClientWebController::class);

});
