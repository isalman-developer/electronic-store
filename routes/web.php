<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SliderController as AdminSliderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Brands
Route::get('/brands', [BrandController::class, 'index'])->name('brands');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');


// Featured products, new arrivals, and top rated products


// Product routes with SEO-friendly URLs
Route::prefix('products')->name('product.')->group(function () {
    // All products with filters
    Route::get('/', [ProductController::class, 'index'])->name('index');

    Route::get('/featured-products', [ProductController::class, 'featuredProducts'])->name('featured');
    Route::get('/new-arrivals', [ProductController::class, 'newArrivals'])->name('new-arrivals');
    Route::get('/top-rated', [ProductController::class, 'topRated'])->name('top-rated');

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
    Route::resource('brands', AdminBrandController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('sliders', AdminSliderController::class);
    Route::get('/settings/edit', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::resource('settings', AdminSettingController::class)->except(['update', 'edit']);


    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        // Order timeline routes
        Route::post('/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('status.update');
        Route::get('/{order}/invoice/download', [AdminOrderController::class, 'downloadInvoice'])->name('invoice.download');
        Route::post('/{order}/invoice/resend', [AdminOrderController::class, 'resendInvoice'])->name('invoice.resend');
        Route::post('/{order}/tracking', [AdminOrderController::class, 'updateTracking'])->name('tracking.update');
        Route::post('/{order}/refund', [AdminOrderController::class, 'refund'])->name('refund');
        Route::post('/{order}/return', [AdminOrderController::class, 'return'])->name('return');
    });
});
