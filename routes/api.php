<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
//use App\Http\Controllers\UserController;
//use App\Http\Controllers\ProductController;
//use App\Http\Controllers\ClientController;

Route::post('auth/login', [AuthController::class, 'login']); //devuelve jwt
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('auth/me', [AuthController::class, 'me'])->middleware('auth:api');


//== cruds protegidos (jwt)==
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ClientController;

Route::middleware('auth:api')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('clients', ClientController::class);


// Usuarios
//Route::get('/users', [UserController::class, 'list']);
//Route::get('/users/{id}', [UserController::class, 'get']);
//Route::post('/users', [UserController::class, 'create']);
//Route::put('/users/{id}', [UserController::class, 'update']);
//Route::delete('/users/{id}', [UserController::class, 'delete']);

// Productos
//Route::get('/products', [ProductController::class, 'list']);
//Route::get('/products/{id}', [ProductController::class, 'get']);
//Route::post('/products', [ProductController::class, 'create']);
//Route::put('/products/{id}', [ProductController::class, 'update']);
//Route::delete('/products/{id}', [ProductController::class, 'delete']);

// Clientes
//Route::get('/clients', [ClientController::class, 'list']);
//Route::get('/clients/{id}', [ClientController::class, 'get']);
//Route::post('/clients', [ClientController::class, 'create']);
//Route::put('/clients/{id}', [ClientController::class, 'update']);
//Route::delete('/clients/{id}', [ClientController::class, 'delete']);
});