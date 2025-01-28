<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']); // List all users
Route::post('/users', [UserController::class, 'store']); // Create a new user
Route::get('/users/{id}', [UserController::class, 'show']); // Show a specific user
Route::put('/users/{id}', [UserController::class, 'update']); // Update a user
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user
