<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;


// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

// Brands
Route::get('/brands', [BrandController::class, 'index'])->name('brands');

// Product routes with SEO-friendly URLs
Route::prefix('products')->name('product.')->group(function () {
    // All products with filters
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // Category-specific products
    Route::get('/category/{categorySlug}', [ProductController::class, 'categoryProducts'])
        ->name('category');

    // Brand-specific products
    Route::get('/brand/{brandSlug}', [ProductController::class, 'brandProducts'])
        ->name('brand');

    // Combined category and brand filtering
    Route::get('/category/{categorySlug}/brand/{brandSlug}', [ProductController::class, 'categoryBrandProducts'])
        ->name('category.brand');

    // Single product detail
    Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
});

Route::get('/products/{product}/quick-view', [ProductController::class, 'quickView']);

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
Route::post('/cart/checkout', [App\Http\Controllers\User\CartController::class, 'checkout'])->name('cart.checkout');

// Cart and Checkout Routes
Route::get('/cart', [App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [App\Http\Controllers\User\OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/place', [App\Http\Controllers\User\OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success/{order_number}', [App\Http\Controllers\User\OrderController::class, 'success'])->name('order.success');

// User Order History (for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', [App\Http\Controllers\User\OrderController::class, 'userOrders'])->name('user.orders');
    Route::get('/my-orders/{order}', [App\Http\Controllers\User\OrderController::class, 'userOrderDetail'])->name('user.order.detail');
});

// Admin Panel
Route::group((['prefix' => 'admin', 'as' => 'admin.']), function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
});