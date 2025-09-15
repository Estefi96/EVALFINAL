<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;

// Usuarios
Route::get('/users', [UserController::class, 'list']);
Route::get('/users/{id}', [UserController::class, 'get']);
Route::post('/users', [UserController::class, 'create']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

// Productos
Route::get('/products', [ProductController::class, 'list']);
Route::get('/products/{id}', [ProductController::class, 'get']);
Route::post('/products', [ProductController::class, 'create']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'delete']);

// Clientes
Route::get('/clients', [ClientController::class, 'list']);
Route::get('/clients/{id}', [ClientController::class, 'get']);
Route::post('/clients', [ClientController::class, 'create']);
Route::put('/clients/{id}', [ClientController::class, 'update']);
Route::delete('/clients/{id}', [ClientController::class, 'delete']);