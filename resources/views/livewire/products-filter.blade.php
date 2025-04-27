<div>
    <!--Product left filter start-->
    <section class="py-md-6 pb-6">
        <div class="container">
            <div class="row">
                <!--Filter-->
                <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                    <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 border-end-0" tabindex="-1"
                        id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                        <div class="offcanvas-header d-lg-none">
                            <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                            </button>
                        </div>
                        <div class="offcanvas-body ps-lg-2 pt-lg-0">

                            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                                <!--In stock only-->
                                <div>
                                    <h5 class="mb-0 fs-6">In stock only</h5>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" wire:change="toggleStock" />
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                </div>
                            </div>
                            <!--Color-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapseColor" role="button" aria-expanded="true"
                                    aria-controls="collapseColor">
                                    <h5 class="mb-0 fs-6">Color</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseColor">
                                    <div class="mt-3 ps-1">
                                        @foreach ($colors as $color)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" value="filter{{ $color->id }}"
                                                    id="filter{{ $color->title }}"
                                                    wire:click="toggleColor('{{ $color->id }}')"
                                                    {{ in_array($color->id, $selectedColors) ? 'checked' : '' }} />

                                                <label class="form-check-label" for="filter{{ $color->id }}">
                                                    {{ $color->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--Brand-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapseBrand" role="button" aria-expanded="true"
                                    aria-controls="collapseBrand">
                                    <h5 class="mb-0 fs-6">Brand</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseBrand">
                                    <div class="mt-3">
                                        @foreach ($brands as $brand)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" value="{{ $brand->id }}"
                                                    id="brand{{ $brand->id }}"
                                                    wire:click="toggleBrand('{{ $brand->id }}')"
                                                    {{ in_array($brand->id, $selectedBrands) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="brand{{ $brand->id }}">
                                                    {{ $brand->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--Product type-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapseProductType" role="button" aria-expanded="true"
                                    aria-controls="collapseProductType">
                                    <h5 class="mb-0 fs-6">Product Type</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseProductType">
                                    <div class="mt-3">
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" value="{{ $category->id }}"
                                                    id="category{{ $category->id }}"
                                                    wire:click="toggleCategory('{{ $category->id }}')"
                                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }} />
                                                <label class="form-check-label" for="category{{ $category->id }}">
                                                    {{ $category->title }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!--Price-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapsePrice" role="button" aria-expanded="true"
                                    aria-controls="collapsePrice">
                                    <h5 class="mb-0 fs-6">Price</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapsePrice">
                                    <div class="mt-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="priceMin" class="form-label">Min (PKR)</label>
                                                <input type="number" class="form-control" id="priceMin"
                                                    wire:model="priceMin" wire:change="updatePrice">
                                            </div>
                                            <div class="col-6">
                                                <label for="priceMax" class="form-label">Max (PKR)</label>
                                                <input type="number" class="form-control" id="priceMax"
                                                    wire:model="priceMax" wire:change="updatePrice">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Rating-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapseRating" role="button" aria-expanded="true"
                                    aria-controls="collapseRating">
                                    <h5 class="mb-0 fs-6">Rating</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseRating">
                                    <div class="mt-3">
                                        <div>
                                            @for ($i = 5; $i >= 1; $i--)
                                                <div class="form-check mb-2">
                                                    <input type="radio" value="{{ $i }}"
                                                        id="rating{{ $i }}"
                                                        wire:click="toggleRating({{ $i }})"
                                                        {{ $rating == $i ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="rating{{ $i }}">
                                                        @for ($j = 1; $j <= 5; $j++)
                                                            <i
                                                                class="bi bi-star{{ $j <= $i ? '-fill' : '' }} text-warning"></i>
                                                        @endfor
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-12">
                            <!--Selected filter-->
                            <div class="mb-4 d-flex flex-column flex-lg-row justify-content-between gap-4">
                                <div class="d-flex gap-2 flex-wrap align-items-center">
                                    @if ($inStock)
                                        <button type="button"
                                            class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                            wire:click="removeFilter('stock')">
                                            In Stock
                                            <i class="bi bi-x lh-1"></i>
                                        </button>
                                    @endif

                                    @foreach ($selectedColors as $colorId)
                                        @php $color = $colors->firstWhere('id', $colorId); @endphp
                                        @if ($color)
                                            <button type="button"
                                                class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                                wire:click="removeFilter('color', '{{ $colorId }}')">
                                                {{ $color->title }}
                                                <i class="bi bi-x lh-1"></i>
                                            </button>
                                        @endif
                                    @endforeach

                                    @foreach ($selectedBrands as $brandId)
                                        @php $brand = $brands->firstWhere('id', $brandId); @endphp
                                        @if ($brand)
                                            <button type="button"
                                                class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                                wire:click="removeFilter('brand', '{{ $brandId }}')">
                                                {{ $brand->title }}
                                                <i class="bi bi-x lh-1"></i>
                                            </button>
                                        @endif
                                    @endforeach

                                    @foreach ($selectedCategories as $categoryId)
                                        @php $category = $categories->firstWhere('id', $categoryId); @endphp
                                        @if ($category)
                                            <button type="button"
                                                class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                                wire:click="removeFilter('category', '{{ $categoryId }}')">
                                                {{ $category->title }}
                                                <i class="bi bi-x lh-1"></i>
                                            </button>
                                        @endif
                                    @endforeach

                                    @if ($priceMin > 0 || $priceMax < 1000)
                                        <button type="button"
                                            class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                            wire:click="removeFilter('price')">
                                            PKR{{ $priceMin }} - PKR{{ $priceMax }}
                                            <i class="bi bi-x lh-1"></i>
                                        </button>
                                    @endif

                                    @if ($rating)
                                        <button type="button"
                                            class="btn btn-sm btn-light d-flex align-items-center gap-2"
                                            wire:click="removeFilter('rating')">
                                            {{ $rating }}+ Stars
                                            <i class="bi bi-x lh-1"></i>
                                        </button>
                                    @endif

                                    @if (
                                        $inStock ||
                                            !empty($selectedColors) ||
                                            !empty($selectedBrands) ||
                                            !empty($selectedCategories) ||
                                            $priceMin > 0 ||
                                            $priceMax < 1000 ||
                                            $rating)
                                        <button type="button" class="btn btn-sm btn-focus-none"
                                            wire:click="resetFilters">Clear all</button>
                                    @endif
                                </div>
                                <div class="col-sm-4 col-xxl-3">
                                    <select class="form-select" wire:change="updateSort($event.target.value)">
                                        <option value="featured" {{ $sortBy == 'featured' ? 'selected' : '' }}>Sort
                                            by: Featured</option>
                                        <option value="best_selling"
                                            {{ $sortBy == 'best_selling' ? 'selected' : '' }}>Best selling</option>
                                        <option value="alpha_asc" {{ $sortBy == 'alpha_asc' ? 'selected' : '' }}>
                                            Alphabetically, A-Z</option>
                                        <option value="alpha_desc" {{ $sortBy == 'alpha_desc' ? 'selected' : '' }}>
                                            Alphabetically, Z-A</option>
                                        <option value="price_asc" {{ $sortBy == 'price_asc' ? 'selected' : '' }}>
                                            Price, low to high</option>
                                        <option value="price_desc" {{ $sortBy == 'price_desc' ? 'selected' : '' }}>
                                            Price, high to low</option>
                                        <option value="date_old" {{ $sortBy == 'date_old' ? 'selected' : '' }}>Date,
                                            old to new</option>
                                        <option value="date_new" {{ $sortBy == 'date_new' ? 'selected' : '' }}>Date,
                                            new to old</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-6 gx-4">
                        <!-- Loading indicator -->
                        <div wire:loading.flex class="col-12 justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <!-- Products -->
                        <div class="row" wire:loading.remove>
                            @forelse ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product-card">
                                        <div class="text-center product-card-img mb-4">
                                            <a href="{{ route('product.show', $product->slug) }}">
                                                <img src="{{ getFirstImageUrl($product) }}"
                                                    alt="{{ $product->title }}" class="img-fluid" loading="lazy">
                                                <img src="{{ getImageUrl($product->media->skip(1)->first()) }}"
                                                    alt="{{ $product->title }}" class="img-fluid product-img-hover" loading="lazy">
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
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="small fw-medium text-uppercase">
                                                {{ $product->brand->title ?? 'BRAND' }}
                                            </span>
                                            <div class="d-flex gap-3 align-items-center">
                                                <span class="">
                                                    {{ number_format($product->rating, 1) }}
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
                                                <a
                                                    href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
                                            </h3>
                                            <p class="mb-0 lh-1 text-dark fw-semibold">PKR
                                                {{ number_format($product->price, 2) }}</p>
                                        </div>

                                        <div class="mb-4">
                                            @foreach ($product->colors as $key => $color)
                                                <input type="radio" class="btn-check"
                                                    name="colors{{ $product->id }}" id="color{{ $color->id }}"
                                                    @checked($key == 0) />

                                                <label for="color{{ $color->id }}" class="btn-color-swatch"
                                                    data-label="{{ $color->title }}">
                                                    <span
                                                        class="icon-shape icon-xxs bg-{{ $color->color_class }}"></span>
                                                    <span class="visually-hidden">{{ $color->title }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No products found matching your criteria. Try changing your filters.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!--Pagination-->
                        <div class="col-12 mt-8">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product left filter end-->

    <!-- Quick View Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <!-- Close button -->
                    <div
                        class="position-absolute top-0 start-100 translate-middle mt-n4 ms-4 bg-white p-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <!-- Product details will be loaded here -->
                    <div id="quickViewContent"></div>
                </div>
            </div>
        </div>
    </div>
</div>
