<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;


/*
|--------------------------------------------------------------------------
| SleepMart Home
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


Route::get(
    '/locations/divisions',
    [LocationController::class, 'divisions']
)->name('locations.divisions');

Route::get(
    '/locations/divisions/{division}/districts',
    [LocationController::class, 'districts']
)->name('locations.districts');

Route::get(
    '/locations/districts/{district}/upazilas',
    [LocationController::class, 'upazilas']
)->name('locations.upazilas');


/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/

// Product listing / shop
Route::get(
    '/shop',
    [ProductController::class, 'index']
)->name('products.index');

// Product details
Route::get(
    '/product/{product:slug}',
    [ProductController::class, 'show']
)->name('products.show');


/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/

// Cart page
Route::get(
    '/cart',
    [CartController::class, 'index']
)->name('cart.index');

// Add product to cart
Route::post(
    '/cart/add/{product:slug}',
    [CartController::class, 'add']
)->name('cart.add');

// Update cart quantity
Route::patch(
    '/cart/{cartKey}',
    [CartController::class, 'update']
)->name('cart.update');

// Remove cart item
Route::delete(
    '/cart/{cartKey}',
    [CartController::class, 'remove']
)->name('cart.remove');

// Clear entire cart
Route::delete(
    '/cart',
    [CartController::class, 'clear']
)->name('cart.clear');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/



Route::middleware([
    'auth',
    'verified',
    'customer',
])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get(
            '/checkout',
            [CheckoutController::class, 'index']
        )->name('checkout.index');

        Route::post(
            '/checkout',
            [CheckoutController::class, 'store']
        )->name('checkout.store');

        Route::get(
            '/checkout/success/{order}',
            [CheckoutController::class, 'success']
        )->name('checkout.success');

        Route::get(
            '/orders',
            [OrderController::class, 'index']
        )->name('orders.index');

        Route::get(
            '/orders/{order}',
            [OrderController::class, 'show']
        )->name('orders.show');
    }
);

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/dashboard',
            [AdminController::class, 'dashboard']
        )->name('dashboard');

        Route::get(
            '/products',
            [AdminProductController::class, 'index']
        )->name('products.index');

        Route::get(
            '/products/{product}/images',
            [ProductImageController::class, 'index']
        )->name('products.images.index');

        Route::post(
            '/products/{product}/images',
            [ProductImageController::class, 'store']
        )->name('products.images.store');

        Route::post(
            '/products/{product}/images/{image}/primary',
            [ProductImageController::class, 'primary']
        )->name('products.images.primary');

        Route::patch(
            '/products/{product}/images/order',
            [ProductImageController::class, 'updateOrder']
        )->name('products.images.order');

        Route::delete(
            '/products/{product}/images/{image}',
            [ProductImageController::class, 'destroy']
        )->name('products.images.destroy');
    }
);

require __DIR__.'/auth.php';