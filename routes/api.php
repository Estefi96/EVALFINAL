<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware(['jwt.auth'])->group(function () {
    // users
    Route::post('/users', [UserController::class, 'create']);
    Route::get('/users', [UserController::class, 'list']);
    Route::get('/users/{id}', [UserController::class, 'get']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    Route::put('/users/{id}', [UserController::class, 'update']);

    // products
    Route::post('/products', [ProductController::class, 'create']);
    Route::get('/products', [ProductController::class, 'list']);
    Route::get('/products/{id}', [ProductController::class, 'get']);
    Route::delete('/products/{id}', [ProductController::class, 'delete']);
    Route::put('/products/{id}', [ProductController::class, 'update']);

    // clients
    Route::post('/clients', [ClientController::class, 'create']);
    Route::get('/clients', [ClientController::class, 'list']);
    Route::get('/clients/{id}', [ClientController::class, 'get']);
    Route::delete('/clients/{id}', [ClientController::class, 'delete']);
    Route::put('/clients/{id}', [ClientController::class, 'update']);
});

