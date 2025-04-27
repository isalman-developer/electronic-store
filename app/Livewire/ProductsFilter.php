<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Request;

class ProductsFilter extends Component
{
    use WithPagination;

    // Filter properties
    public $colors = [];
    public $brands = [];
    public $categories = [];
    public $selectedColors = [];
    public $selectedBrands = [];
    public $selectedCategories = [];
    public $inStock = false;
    public $priceMin = 0;
    public $priceMax = 1000;
    public $rating = null;
    public $sortBy = 'featured';

    // URL tracking
    public $queryString = [
        'selectedColors' => ['except' => []],
        'selectedBrands' => ['except' => []],
        'selectedCategories' => ['except' => []],
        'inStock' => ['except' => false],
        'priceMin' => ['except' => 0],
        'priceMax' => ['except' => 1000],
        'rating' => ['except' => null],
        'sortBy' => ['except' => 'featured'],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        // Load filter options
        $this->colors = Color::all();
        $this->brands = Brand::all();
        $this->categories = Category::all();

        // Initialize filters from URL parameters if they exist
        $this->selectedColors = Request::query('colors', []);
        $this->selectedBrands = Request::query('brands', []);
        $this->selectedCategories = Request::query('categories', []);
        $this->inStock = (bool) Request::query('in_stock', false);
        $this->priceMin = (int) Request::query('price_min', $this->priceMin);
        $this->priceMax = (int) Request::query('price_max', $this->priceMax);
        $this->rating = Request::query('rating');
        $this->sortBy = Request::query('sort', 'featured');
    }

    // Reset all filters
    public function resetFilters()
    {
        $this->selectedColors = [];
        $this->selectedBrands = [];
        $this->selectedCategories = [];
        $this->inStock = false;
        $this->priceMin = 0;
        $this->priceMax = 1000;
        $this->rating = null;
        $this->sortBy = 'featured';
        $this->resetPage();
    }

    // Method to remove a single filter
    public function removeFilter($type, $value = null)
    {
        switch ($type) {
            case 'color':
                $this->selectedColors = array_diff($this->selectedColors, [$value]);
                break;
            case 'brand':
                $this->selectedBrands = array_diff($this->selectedBrands, [$value]);
                break;
            case 'category':
                $this->selectedCategories = array_diff($this->selectedCategories, [$value]);
                break;
            case 'stock':
                $this->inStock = false;
                break;
            case 'price':
                $this->priceMin = 0;
                $this->priceMax = 1000;
                break;
            case 'rating':
                $this->rating = null;
                break;
        }
        $this->resetPage();
    }

    public function toggleStock()
    {
        $this->inStock = !$this->inStock;
        $this->resetPage();
    }

    public function toggleColor($colorId)
    {
        if (in_array($colorId, $this->selectedColors)) {
            $this->selectedColors = array_diff($this->selectedColors, [$colorId]);
        } else {
            $this->selectedColors[] = $colorId;
        }
    }

    public function toggleBrand($brandId)
    {
        if (in_array($brandId, $this->selectedBrands)) {
            $this->selectedBrands = array_diff($this->selectedBrands, [$brandId]);
        } else {
            $this->selectedBrands[] = $brandId;
        }
        $this->resetPage();
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        } else {
            $this->selectedCategories[] = $categoryId;
        }
        $this->resetPage();
    }

    public function toggleRating($rating)
    {
        if ($this->rating == $rating) {
            $this->rating = null;
        } else {
            $this->rating = $rating;
        }
        $this->resetPage();
    }

    public function updatePrice()
    {
        $this->resetPage();
    }

    public function updateSort($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with(['brand', 'category', 'colors', 'media']);

        // Apply filters
        if (!empty($this->selectedColors)) {
            $query->whereHas('colors', function ($q) {
                $q->whereIn('color_id', $this->selectedColors);
            });
        }

        if (!empty($this->selectedBrands)) {
            $query->whereIn('brand_id', $this->selectedBrands);
        }

        if (!empty($this->selectedCategories)) {
            $query->whereIn('category_id', $this->selectedCategories);
        }

        if ($this->inStock) {
            $query->where('stock', '>', 0);
        }

        $query->whereBetween('price', [$this->priceMin, $this->priceMax]);

        if ($this->rating) {
            // $query->where('rating', '>=', $this->rating);
        }

        // Apply sorting
        switch ($this->sortBy) {
            case 'best_selling':
                $query->orderBy('sales_count', 'desc');
                break;
            case 'alpha_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'alpha_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'date_old':
                $query->orderBy('created_at', 'asc');
                break;
            case 'date_new':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        $products = $query->paginate(9);

        return view('livewire.products-filter', [
            'products' => $products,
        ]);
    }
}
