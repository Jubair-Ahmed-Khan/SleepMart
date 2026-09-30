<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
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

Route::get(
    '/cart',
    [CartController::class, 'index']
)->name('cart.index');

Route::post(
    '/cart/add/{product:slug}',
    [CartController::class, 'add']
)->name('cart.add');

Route::patch(
    '/cart/{cartKey}',
    [CartController::class, 'update']
)->name('cart.update');

Route::delete(
    '/cart/{cartKey}',
    [CartController::class, 'remove']
)->name('cart.remove');

Route::delete(
    '/cart',
    [CartController::class, 'clear']
)->name('cart.clear');
