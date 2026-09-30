<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get(
    '/shop',
    [ProductController::class, 'index']
)->name('products.index');

Route::get(
    '/product/{product:slug}',
    [ProductController::class, 'show']
)->name('products.show');
