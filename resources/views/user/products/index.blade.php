@extends('user.layouts.app')
@push('page-style-bottom')
    <style>
        .thumbnail-slider {
            overflow-x: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .thumbnail-slider::-webkit-scrollbar {
            display: none;
        }

        .thumbnail-wrapper {
            display: flex;
            white-space: nowrap;
            padding: 10px 0;
        }

        .thumbnail-img {
            transition: transform 0.3s ease, opacity 0.3s ease;
            opacity: 0.6;
        }

        .thumbnail-img.active {
            opacity: 1;
            transform: scale(1.1);
            border: 2px solid #000;
        }

        .thumbnail-img:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }
    </style>
@endpush
@section('content')
    <!--Breadcrumb start-->
    <div class="container">
        <div class="row">
            <div class="col-12 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 fw-medium">
                        <li class="breadcrumb-item"><a href="#!">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Office</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Breadcrumb end-->
    <!--Filter button start-->
    <div class="position-fixed bottom-0 start-50 translate-middle d-block d-lg-none z-1">
        <a class="btn btn-dark d-flex align-items-center gap-2" data-bs-toggle="offcanvas" href="#offcanvasCategory"
            role="button" aria-controls="offcanvasCategory">
            @include('user.svgs.filter-svg')
            <span>Filter</span>
        </a>
    </div>
    <!--Filter button end-->
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
                                        id="flexSwitchCheckChecked" checked />
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                </div>
                            </div>
                            <!--Color-->
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between" data-bs-toggle="collapse"
                                    href="#collapseColor" role="button" aria-expanded="true" aria-controls="collapseColor">
                                    <h5 class="mb-0 fs-6">Color</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseColor">
                                    <div class="mt-3 ps-1" style="height: 180px" data-simplebar>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value="" id="filterBlack"
                                                checked />
                                            <label class="form-check-label" for="filterBlack">Black</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterBrown" />
                                            <label class="form-check-label" for="filterBrown">Brown</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterGreen" />
                                            <label class="form-check-label" for="filterGreen">Green</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterYellow" />
                                            <label class="form-check-label" for="filterYellow">Yellow</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value="" id="filterRed" />
                                            <label class="form-check-label" for="filterRed">Red</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterPink" />
                                            <label class="form-check-label" for="filterPink">Pink</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterCyan" />
                                            <label class="form-check-label" for="filterCyan">Cyan</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterBlue" />
                                            <label class="form-check-label" for="filterBlue">Blue</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="filterGray" />
                                            <label class="form-check-label" for="filterGray">Gray</label>
                                        </div>
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
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Brand1" checked />
                                            <label class="form-check-label" for="Brand1">Brand-1</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Brand2" />
                                            <label class="form-check-label" for="Brand2">Brand-2</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Brand3" />
                                            <label class="form-check-label" for="Brand3">Brand-3</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Brand4" />
                                            <label class="form-check-label" for="Brand4">Brand-4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Brand-->
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
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Kitchen" checked />
                                            <label class="form-check-label" for="Kitchen">Kitchen</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Decoration" />
                                            <label class="form-check-label" for="Decoration">Decoration</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Lighting" />
                                            <label class="form-check-label" for="Lighting">Lighting</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Office" />
                                            <label class="form-check-label" for="Office">Office</label>
                                        </div>
                                        <!-- form check -->
                                        <div class="form-check mb-2">
                                            <!-- input -->
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="Chair" />
                                            <label class="form-check-label" for="Chair">Chair</label>
                                        </div>
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
                                        <!-- range -->
                                        <div id="priceRange" class="mb-3"></div>
                                        <!-- <small class="text-muted">Price:</small> -->
                                        <span id="priceRange-value" class="small d-flex justify-content-between"></span>
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
                                            <!-- form check -->
                                            <div class="form-check mb-2">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="ratingFive" />
                                                <label class="form-check-label" for="ratingFive">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </label>
                                            </div>
                                            <!-- form check -->
                                            <div class="form-check mb-2">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="ratingFour" checked />
                                                <label class="form-check-label" for="ratingFour">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </label>
                                            </div>
                                            <!-- form check -->
                                            <div class="form-check mb-2">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="ratingThree" />
                                                <label class="form-check-label" for="ratingThree">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </label>
                                            </div>
                                            <!-- form check -->
                                            <div class="form-check mb-2">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="ratingTwo" />
                                                <label class="form-check-label" for="ratingTwo">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </label>
                                            </div>
                                            <!-- form check -->
                                            <div class="form-check mb-2">
                                                <!-- input -->
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="ratingOne" />
                                                <label class="form-check-label" for="ratingOne">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                    <i class="bi bi-star text-warning"></i>
                                                </label>
                                            </div>
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
                            <div class="mb-4 d-flex flex-column flex-lg-row flex-row justify-content-between gap-4">
                                <div class="d-flex gap-2 flex-wrap align-items-center">
                                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        In Stock
                                        <i class="bi bi-x lh-1"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        Black
                                        <i class="bi bi-x lh-1"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        Brand
                                        <i class="bi bi-x lh-1"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        Kitchen
                                        <i class="bi bi-x lh-1"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        $10 - $259
                                        <i class="bi bi-x lh-1"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-focus-none">Clear all</button>
                                </div>
                                <div class="col-sm-4 col-xxl-3">
                                    <select data-choices data-choices-removeitembutton="true"
                                        data-choices-classname="form-select" aria-label="Default select example">
                                        <option value="">Sort by: Featured</option>
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
                        </div>
                    </div>
                    <div class="row gy-6 gx-4">
                        <!--Product-->
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="product-card">
                                    <div class=" text-center product-card-img mb-4">
                                        <a href="#!">
                                            <img src="{{ getFirstImageUrl($product) }}" alt="product image"
                                                class="img-fluid">
                                            <img src="{{ getImageUrl($product->media->skip(1)->first() ?? ($product->media->skip(1)->first() ?? null)) }}"
                                                alt="product image" class="img-fluid product-img-hover"></a>
                                        <div class="product-card-btn">
                                            <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse"
                                                onclick="openQuickView({{ $product->id }})">
                                                @include('user.svgs.quick-view-svg')
                                            </button>

                                            <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                                data-product-name="Sofa with wood legs" data-product-price="34.00"
                                                data-product-img="assets/images/product/product-img-1.jpg">
                                                @include('user.svgs.quick-add-svg')
                                                Quick add
                                            </button>
                                        </div>
                                    </div>
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
                                        @foreach ($product->colors as $key => $color)
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
@endsection

@push('page-script-bottom')
    <script>
        function openQuickView(productId) {
            // For Livewire v3
            if (typeof Livewire.dispatch === 'function') {
                Livewire.dispatch('showQuickView', {
                    productId
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Only initialize if the modal is visible
            if (document.querySelector('#quickViewModal.show')) {
                initializeSlider();
            }

            // Listen for modal show event to initialize slider
            document.querySelector('#quickViewModal').addEventListener('show.bs.modal', initializeSlider);
        });

        function initializeSlider() {
            // Ensure thumbnails are clickable and main image is set
            const thumbnails = document.querySelectorAll('.thumbnail-img');
            const mainImage = document.querySelector('#mainImage');

            if (thumbnails.length > 0 && mainImage) {
                // Set initial main image if not already set
                if (!mainImage.src) {
                    mainImage.src = thumbnails[0].src;
                    thumbnails[0].classList.add('active');
                }
            }
        }

        function changeMainImage(thumbnail) {
            const mainImage = document.querySelector('#mainImage');
            if (mainImage && thumbnail) {
                // Update main image source
                mainImage.src = thumbnail.src;

                // Update active thumbnail
                document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
                thumbnail.classList.add('active');
            }
        }
    </script>
@endpush
