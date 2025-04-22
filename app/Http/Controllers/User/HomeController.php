<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Core\Services\User\ColorService;
use App\Core\Services\User\SliderService;
use App\Core\Services\User\ProductService;
use App\Core\Services\User\CategoryService;
use App\Models\Product;

class HomeController extends Controller
{
    public function __construct(
        protected SliderService $sliderService,
        protected ProductService $productService,
        protected ColorService $colorService,
        protected CategoryService $categoryService
    ) {}

    public function index()
    {
        $sliders = $this->sliderService->getSlidersForHomePage();
        $newArrivals = $this->productService->getNewArrivalsForHomePage();
        $categories = $this->categoryService->getCategoriesForHomePage();
        $colors = $this->colorService->geColorsForHomePage();

        return view('home', compact('sliders', 'newArrivals', 'categories', 'colors'));
    }
}
