<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;


// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Brands
Route::get('/brands', [BrandController::class, 'index'])->name('brands');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

// Product routes with SEO-friendly URLs
Route::prefix('products')->name('product.')->group(function () {
    // All products with filters
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // Featured products, new arrivals, and top rated products
    Route::get('/{filter}', [ProductController::class, 'filterProducts'])->name('filter');

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

    Route::get('/{product}/quick-view', [ProductController::class, 'quickView']);
});


Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success/{order_number}', [OrderController::class, 'success'])->name('order.success');

// User Order Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/orders', [OrderController::class, 'userOrders'])->name('user.orders');
    Route::get('/user/orders/{order}', [OrderController::class, 'userOrderDetail'])->name('user.order.detail');
});

// Admin Panel
Route::group((['prefix' => 'admin', 'as' => 'admin.']), function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
});

// Admin order timeline routes
Route::post('/admin/orders/{order}/timeline', [App\Http\Controllers\Admin\OrderController::class, 'addTimelineEntry'])
    ->name('admin.orders.timeline.add');
Route::post('/admin/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])
    ->name('admin.orders.status.update');
Route::get('/admin/invoice/orders/{order}/download', [App\Http\Controllers\Admin\OrderController::class, 'downloadInvoice'])
    ->name('admin.orders.invoice.download');
Route::post('/admin/invoice/orders/{order}/resend', [App\Http\Controllers\Admin\OrderController::class, 'resendInvoice'])
    ->name('admin.orders.invoice.resend');
