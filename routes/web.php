<?php

// Solo importamos lo que realmente usa este proyecto
use App\Livewire\Catalog\ItemList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Páginas públicas (La Vidriera)
|--------------------------------------------------------------------------
|
| Estas son las únicas rutas que tu Servicio Cliente necesita.
|
*/
Route::view('/', 'pages.home')->name('home');
Route::get('/products', ItemList::class)->name('catalog');
Route::view('/gallery', 'pages.gallery')->name('gallery');
Route::view('/location', 'pages.location')->name('location');
Route::view('/about', 'pages.about')->name('about');