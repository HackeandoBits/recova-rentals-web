<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ItemsController;
use App\Http\Controllers\Api\BookingsController;

Route::get('/items', [ItemsController::class, 'index']);
Route::get('/items/{item}', [ItemsController::class, 'show']);
Route::post('/bookings', [BookingsController::class, 'store'])->middleware('auth:sanctum');
Route::get('/bookings/{booking}', [BookingsController::class, 'show'])->middleware('auth:sanctum'); 
Route::patch('/bookings/{booking}', [BookingsController::class, 'update'])->middleware('auth:sanctum');