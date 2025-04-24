@extends('user.layouts.app')
@push('page-style-bottom')
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
                                        @foreach ($colors as $color)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $color->id }}"
                                                    id="filter{{ $color->title }}" />
                                                <label class="form-check-label" for="filter{{ $color->title }}">
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
                                    href="#collapseBrand" role="button" aria-expanded="true" aria-controls="collapseBrand">
                                    <h5 class="mb-0 fs-6">Brand</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show" id="collapseBrand">
                                    <div class="mt-3">
                                        @foreach ($brands as $brand)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" value="{{ $brand->slug }}"
                                                    id="{{ $brand->slug }}" />
                                                <label class="form-check-label" for="{{ $brand->title }}">
                                                    {{ $brand->title }}
                                                </label>
                                            </div>
                                        @endforeach
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
                                        @foreach ($categories as $category)
                                            <div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox"
                                                    value="{{ $category->slug }}" id="{{ $category->title }}" />
                                                <label class="form-check-label" for="{{ $category->title }}">
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
                                    {{-- add functionality for price range --}}
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
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="rating{{ $i }}" @checked($i == 4) />
                                                    <label class="form-check-label" for="rating{{ $i }}">
                                                        @for ($j = 1; $j <= 5; $j++)
                                                            <i class="bi bi-star{{ $j <= $i ? '-fill' : '' }} text-warning"></i>
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
                                            <button type="button"
                                                class="btn btn-primary btn-icon btn-sm animate-pulse quick-view-btn"
                                                data-product-id="{{ $product->id }}" data-bs-toggle="modal"
                                                data-bs-target="#quickViewModal">
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
                                            <a
                                                href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
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
@endsection

@push('page-script-bottom')
    <script src="{{ asset('user/js/quick-view.js') }}"></script>
@endpush
