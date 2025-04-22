<div>
    <div class="row mb-4">
        <!-- Category Filter -->
        <div class="col-md-3">
            <label>Category</label>
            <select wire:model="category" class="form-control">
                <option value="">All Categories</option>
                @foreach(App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Sorting -->
        <div class="col-md-3">
            <label>Sort By</label>
            <select wire:model.live="sortBy" class="form-control">
                <option value="latest">Latest</option>
                <option value="price_low">Price: Low to High</option>
                <option value="price_high">Price: High to Low</option>
            </select>
        </div>

        <!-- Price Range -->
        <div class="col-md-3">
            <label>Min Price</label>
            <input type="number" wire:model="minPrice" class="form-control">
        </div>
        <div class="col-md-3">
            <label>Max Price</label>
            <input type="number" wire:model="maxPrice" class="form-control">
        </div>
    </div>

    <!-- Product Listing -->
    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ getFirstImageUrl($product) }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">Price: ${{ $product->price }}</p>
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No products found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
