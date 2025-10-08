<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Livewire (v3)
use App\Livewire\Catalog\ItemList;
use App\Livewire\Bookings\CreateBooking;
use App\Livewire\Owner\BlockedSlotsPanel;

/*
|--------------------------------------------------------------------------
| Páginas públicas
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages.home')->name('home');
Route::get('/products', ItemList::class)->name('catalog');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/location', 'pages.location')->name('location');
Route::view('/about', 'pages.about')->name('about');

// Alias legacy
Route::get('/admin/login', fn () => redirect()->route('login'))->name('admin.login');

/*
|--------------------------------------------------------------------------
| Área autenticada
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::view('/admin/home', 'admin.home')->name('admin.home');

    Route::get('/reservas/nueva', CreateBooking::class)->name('bookings.create');
    Route::get('/dueno/bloqueos', BlockedSlotsPanel::class)->name('owner.blocks');
});

/*
|--------------------------------------------------------------------------
| Autenticación (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
