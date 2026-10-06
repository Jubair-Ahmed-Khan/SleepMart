<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\CategoryController;


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

    Route::patch(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password.update');

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
            '/products/create',
            [AdminProductController::class, 'create']
        )->name('products.create');

        Route::post(
            '/products',
            [AdminProductController::class, 'store']
        )->name('products.store');

        Route::get(
            '/products/{product}',
            [AdminProductController::class, 'show']
        )->name('products.show');

        Route::get(
            '/products/{product}/edit',
            [AdminProductController::class, 'edit']
        )->name('products.edit');

        Route::patch(
            '/products/{product}',
            [AdminProductController::class, 'update']
        )->name('products.update');

        Route::patch(
            '/products/{product}/deactivate',
            [AdminProductController::class, 'deactivate']
        )->name('products.deactivate');

        Route::patch(
            '/products/{product}/activate',
            [AdminProductController::class, 'activate']
        )->name('products.activate');

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

        Route::get(
            '/products/{product}/variants',
            [ProductVariantController::class, 'index']
        )->name('products.variants.index');

        Route::post(
            '/products/{product}/variants',
            [ProductVariantController::class, 'store']
        )->name('products.variants.store');

        Route::patch(
            '/products/{product}/variants/{variant}',
            [ProductVariantController::class, 'update']
        )->name('products.variants.update');

        Route::delete(
            '/products/{product}/variants/{variant}',
            [ProductVariantController::class, 'destroy']
        )->name('products.variants.destroy');

        Route::get(
            '/categories',
            [CategoryController::class, 'index']
        )->name('categories.index');

        Route::get(
            '/categories/create',
            [CategoryController::class, 'create']
        )->name('categories.create');

        Route::post(
            '/categories',
            [CategoryController::class, 'store']
        )->name('categories.store');

        Route::get(
            '/categories/{category}/edit',
            [CategoryController::class, 'edit']
        )->name('categories.edit');

        Route::patch(
            '/categories/{category}',
            [CategoryController::class, 'update']
        )->name('categories.update');

        Route::patch(
            '/categories/{category}/deactivate',
            [CategoryController::class, 'deactivate']
        )->name('categories.deactivate');

        Route::patch(
            '/categories/{category}/activate',
            [CategoryController::class, 'activate']
        )->name('categories.activate');

        Route::delete(
            '/categories/{category}',
            [CategoryController::class, 'destroy']
        )->name('categories.destroy');

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status.update');
    }
);

require __DIR__.'/auth.php';