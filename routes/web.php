<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/shop', function () {
    return view('products.index');
})->name('products.index');
