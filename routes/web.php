<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\AdminController;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Product Searching
Route::prefix('brand')->group(function () {
    Route::get('{brand_slug}', [ProductController::class, 'brandProducts'])->name('brand.products');
    Route::get('{brand_slug}/category/{category_slug}', [ProductController::class, 'brandCategoryProducts'])->name('brand.category.products');
    Route::get('{brand_slug}/price/{min}-{max}', [ProductController::class, 'brandPriceProducts'])->name('brand.price.products');
    Route::get('{brand_slug}/in-stock', [ProductController::class, 'brandInStockProducts'])->name('brand.instock.products');
    Route::get('{brand_slug}/sort/{sort_option}', [ProductController::class, 'brandSortedProducts'])->name('brand.sort.products');
});

Route::prefix('category')->group(function () {
    Route::get('{category_slug}', [ProductController::class, 'categoryProducts'])->name('category.products');
    Route::get('{category_slug}/brand/{brand_slug}', [ProductController::class, 'categoryBrandProducts'])->name('category.brand.products');
    Route::get('{category_slug}/price/{min}-{max}', [ProductController::class, 'categoryPriceProducts'])->name('category.price.products');
    Route::get('{category_slug}/in-stock', [ProductController::class, 'categoryInStockProducts'])->name('category.instock.products');
    Route::get('{category_slug}/sort/{sort_option}', [ProductController::class, 'categorySortedProducts'])->name('category.sort.products');
    Route::get('{category_slug}/brand/{brand_slug}/price/{min}-{max}/sort/{sort_option}', [ProductController::class, 'filteredProducts'])->name('category.filtered.products');
});

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Orders
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

// Admin Panel
Route::group((['prefix' => 'admin', 'as' => 'admin.']), function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brands', App\Http\Controllers\Admin\BrandController::class);
    Route::resource('sliders', App\Http\Controllers\Admin\SliderController::class);
});
