<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserWebController;
use App\Http\Controllers\ProductWebController;
use App\Http\Controllers\ClientWebController;

// Página de inicio pública
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'submitLogin'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UserWebController::class)->except(['show']);
    Route::resource('products', ProductWebController::class)->except(['show']);
    Route::resource('clients', ClientWebController::class)->except(['show']);
});