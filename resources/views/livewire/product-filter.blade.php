<div>
    <div class="row">
        <div class="col-lg-3 col-md-4 mb-6 mb-md-0">
            <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 border-end-0"
                 tabindex="-1" id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                <div class="offcanvas-header d-lg-none">
                    <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body ps-lg-2 pt-lg-0">
                    <!-- In stock only -->
                    <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                        <div>
                            <h5 class="mb-0 fs-6">In stock only</h5>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                   id="flexSwitchCheckChecked" wire:model="inStock" />
                            <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="mb-3 border-bottom pb-3">
                        <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                           href="#collapseColor" role="button" aria-expanded="true" aria-controls="collapseColor">
                            <h5 class="mb-0 fs-6">Color</h5>
                            <i class="bi bi-chevron-down chevron-down"></i>
                        </a>
                        <div class="collapse show" id="collapseColor">
                            <div class="mt-3 ps-1" style="height: 180px" data-simplebar>
                                @foreach($colors as $color)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" value="{{ $color }}"
                                           id="filter{{ $color }}"
                                           wire:model="selectedColors" />
                                    <label class="form-check-label" for="filter{{ $color }}">{{ $color }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Similar sections for Brand, Product Type, etc. -->

                    <!-- Price Range -->
                    <div class="mb-3 border-bottom pb-3">
                        <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                           href="#collapsePrice" role="button" aria-expanded="true" aria-controls="collapsePrice">
                            <h5 class="mb-0 fs-6">Price</h5>
                            <i class="bi bi-chevron-down chevron-down"></i>
                        </a>
                        <div class="collapse show" id="collapsePrice">
                            <div class="mt-3">
                                <!-- For Livewire, we need some JS interop for the slider -->
                                <div id="priceRange" class="mb-3" wire:ignore></div>
                                <span id="priceRange-value" class="small d-flex justify-content-between">
                                    ${{ $minPrice }} - ${{ $maxPrice }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Other filter sections -->
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <!-- Selected filters -->
            <div class="mb-4 d-flex flex-column flex-lg-row flex-row justify-content-between gap-4">
                <div class="d-flex gap-2 flex-wrap align-items-center">
                    @if($inStock)
                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2"
                            wire:click="clearFilter('inStock')">
                        In Stock
                        <i class="bi bi-x lh-1"></i>
                    </button>
                    @endif

                    @foreach($selectedColors as $color)
                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2"
                            wire:click="toggleColor('{{ $color }}')">
                        {{ $color }}
                        <i class="bi bi-x lh-1"></i>
                    </button>
                    @endforeach

                    <!-- Similar buttons for other selected filters -->

                    @if($minPrice > 0 || $maxPrice < 500)
                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2"
                            wire:click="clearFilter('priceRange')">
                        ${{ $minPrice }} - ${{ $maxPrice }}
                        <i class="bi bi-x lh-1"></i>
                    </button>
                    @endif

                    <button type="button" class="btn btn-sm btn-focus-none"
                            wire:click="clearAllFilters">Clear all</button>
                </div>

                <div class="col-sm-4 col-xxl-3">
                    <select wire:model="sortBy" class="form-select">
                        <option value="featured">Sort by: Featured</option>
                        <option value="Best selling">Best selling</option>
                        <option value="Alphabetically, A-Z">Alphabetically, A-Z</option>
                        <option value="Alphabetically, Z-A">Alphabetically, Z-A</option>
                        <option value="Price, low to high">Price, low to high</option>
                        <option value="Price, high to low">Price, high to low</option>
                        <option value="Date, old to new">Date, old to new</option>
                        <option value="Date, new to old">Date, new to old</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row gy-6 gx-4">
                @foreach($products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center product-card-img mb-4">
                            <a href="#!">
                                <img src="{{ getFirstImageUrl($product) }}" alt="product image" class="img-fluid">
                                <img src="{{ getImageUrl($product->media->skip(1)->first() ?? ($product->media->skip(1)->first() ?? null)) }}"
                                     alt="product image" class="img-fluid product-img-hover">
                            </a>
                            <div class="product-card-btn">
                                <button type="button"
                                    class="btn btn-primary btn-icon btn-sm animate-pulse quick-view-btn"
                                    data-product-id="{{ $product->id }}" data-bs-toggle="modal"
                                    data-bs-target="#quickViewModal">
                                    @include('user.svgs.quick-view-svg')
                                </button>

                                <button type="button" class="btn btn-primary btn-sm quick-add-btn"
                                    data-product-name="{{ $product->title }}"
                                    data-product-price="{{ $product->price }}"
                                    data-product-img="{{ getFirstImageUrl($product) }}">
                                    @include('user.svgs.quick-add-svg')
                                    Quick add
                                </button>
                            </div>
                        </div>

                        <!-- Rest of the product card HTML -->
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    @include('user.svgs.rating-star-warning-svg')
                                </span>
                                <button type="button"
                                    class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    @include('user.svgs.animated-hear-svg')
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                <a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
                            </h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">PKR
                                {{ number_format($product->price, 2) }}</p>
                        </div>

                        <div class="mb-4">
                            @foreach($product->colors as $key => $color)
                                <input type="radio" class="btn-check" name="colors"
                                    id="{{ strtolower($color->title) }}Color" @checked($key == 0) />

                                <label for="{{ strtolower($color->title) }}Color" class="btn-color-swatch"
                                    data-label="{{ $color->title }}">

                                    <span class="icon-shape icon-xxs bg-{{ $color->color_class }}"></span>
                                    <span class="visually-hidden">{{ $color->title }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Pagination -->
                <div class="col-12 mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
