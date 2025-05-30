<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Observers\BrandObserver;
use App\Observers\SliderObserver;
use App\Observers\CategoryObserver;
use App\Observers\ColorObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Brand::observe(BrandObserver::class);
        Category::observe(CategoryObserver::class);
        Slider::observe(SliderObserver::class);
        Color::observe(ColorObserver::class);
    }
}
