<?php

use App\Http\Controllers\Api\ItemsController;
use Illuminate\Support\Facades\Route;

Route::get('/items', [ItemsController::class, 'index']);
Route::get('/items/{item}', [ItemsController::class, 'show']);
