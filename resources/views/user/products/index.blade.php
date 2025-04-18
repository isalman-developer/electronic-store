@extends('user.layouts.app')

@push('page-style-top')
    <link rel="stylesheet" href="{{ asset('assets/libs/drift-zoom/dist/drift-basic.min.css') }}" />
    <link href="{{ asset('assets/libs/nouislider/dist/nouislider.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <!--Product left filter start-->
    <section class="py-md-6 pb-6">
        <div class="container">
            <div class="row">

                <div class="col-lg-9">

                    <div class="row gy-6 gx-4">
                        <!--Product-->
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="product-card">
                                    <div class=" text-center product-card-img mb-4">
                                        <a href="#!"><img src="assets/images/product/product-img-1.jpg"
                                                alt="product image" class="img-fluid">
                                            <img src="assets/images/product/product-img-hover-1.jpg" alt="product image"
                                                class="img-fluid product-img-hover"></a>
                                        <div class="product-card-btn">
                                            <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                                data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye animate-target"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                    <path
                                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                                data-product-name="Sofa with wood legs" data-product-price="34.00"
                                                data-product-img="assets/images/product/product-img-1.jpg">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                                Quick add
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"> <a
                                                href="#!">Sofa with wood legs</a></h3>
                                        <p class="mb-0 lh-1 text-dark fw-semibold">$34.00</p>
                                    </div>


                                </div>
                            </div>
                        @endforeach

                        <!--Pagination-->
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
                    <div
                        class="position-absolute top-0 start-100 translate-middle mt-n4 ms-4 bg-white p-1 d-flex align-items-center justify-content-center">
                        <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="container px-0">
                        <div class="row gy-4">
                            <div class="col-lg-6">
                                <div class="position-relative d-flex flex-column h-100" id="zoomPane">
                                    <div><span class="badge bg-info">New</span></div>
                                    <div
                                        class="d-flex align-items-start flex-md-row flex-column justify-content-between mt-3 mb-md-2 mb-3">
                                        <div class="mb-md-3">
                                            <h2 class="h4">Office Chair Pillow</h2>
                                            <span>( Brand Name )</span>
                                        </div>
                                        <div class="text-success d-flex align-items-center gap-2 mt-2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.2"
                                                    d="M14 8C14 9.18669 13.6481 10.3467 12.9888 11.3334C12.3295 12.3201 11.3925 13.0892 10.2961 13.5433C9.19975 13.9974 7.99335 14.1162 6.82946 13.8847C5.66558 13.6532 4.59648 13.0818 3.75736 12.2426C2.91825 11.4035 2.3468 10.3344 2.11529 9.17054C1.88378 8.00666 2.0026 6.80026 2.45673 5.7039C2.91085 4.60754 3.67989 3.67047 4.66658 3.01118C5.65328 2.35189 6.81331 2 8 2C9.5913 2 11.1174 2.63214 12.2426 3.75736C13.3679 4.88258 14 6.4087 14 8Z"
                                                    fill="#16A34A" />
                                                <path
                                                    d="M10.8538 6.14625C10.9002 6.19269 10.9371 6.24783 10.9623 6.30853C10.9874 6.36923 11.0004 6.43429 11.0004 6.5C11.0004 6.56571 10.9874 6.63077 10.9623 6.69147C10.9371 6.75217 10.9002 6.80731 10.8538 6.85375L7.35375 10.3538C7.30732 10.4002 7.25217 10.4371 7.19147 10.4623C7.13077 10.4874 7.06571 10.5004 7 10.5004C6.9343 10.5004 6.86923 10.4874 6.80853 10.4623C6.74783 10.4371 6.69269 10.4002 6.64625 10.3538L5.14625 8.85375C5.05243 8.75993 4.99972 8.63268 4.99972 8.5C4.99972 8.36732 5.05243 8.24007 5.14625 8.14625C5.24007 8.05243 5.36732 7.99972 5.5 7.99972C5.63268 7.99972 5.75993 8.05243 5.85375 8.14625L7 9.29313L10.1463 6.14625C10.1927 6.09976 10.2478 6.06288 10.3085 6.03772C10.3692 6.01256 10.4343 5.99961 10.5 5.99961C10.5657 5.99961 10.6308 6.01256 10.6915 6.03772C10.7522 6.06288 10.8073 6.09976 10.8538 6.14625ZM14.5 8C14.5 9.28558 14.1188 10.5423 13.4046 11.6112C12.6903 12.6801 11.6752 13.5132 10.4874 14.0052C9.29973 14.4972 7.99279 14.6259 6.73192 14.3751C5.47104 14.1243 4.31285 13.5052 3.40381 12.5962C2.49477 11.6872 1.8757 10.529 1.6249 9.26809C1.37409 8.00721 1.50282 6.70028 1.99479 5.51256C2.48676 4.32484 3.31988 3.30968 4.3888 2.59545C5.45772 1.88122 6.71442 1.5 8 1.5C9.72335 1.50182 11.3756 2.18722 12.5942 3.40582C13.8128 4.62441 14.4982 6.27665 14.5 8ZM13.5 8C13.5 6.9122 13.1774 5.84883 12.5731 4.94436C11.9687 4.03989 11.1098 3.33494 10.1048 2.91866C9.09977 2.50238 7.9939 2.39346 6.92701 2.60568C5.86011 2.8179 4.8801 3.34172 4.11092 4.11091C3.34173 4.8801 2.8179 5.86011 2.60568 6.927C2.39347 7.9939 2.50238 9.09977 2.91867 10.1048C3.33495 11.1098 4.0399 11.9687 4.94437 12.5731C5.84884 13.1774 6.91221 13.5 8 13.5C9.45819 13.4983 10.8562 12.9184 11.8873 11.8873C12.9184 10.8562 13.4983 9.45818 13.5 8Z"
                                                    fill="#16A34A" />
                                            </svg>
                                            In Stock
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-md-center">
                                        <div class="d-flex flex-md-row flex-column gap-2 align-items-md-center">
                                            <p class="mb-0">
                                                <span class="text-danger">$300.00</span>
                                                <span class="text-decoration-line-through">$400.00</span>
                                            </p>
                                            <span class="badge bg-danger">Save $100.00</span>
                                        </div>
                                        <span class="">
                                            4.5
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                fill="currentColor" class="bi bi-star-fill align-baseline text-primary"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="mt-auto">
                                        <hr class="my-3" />
                                        <div>
                                            <div class="mb-4">
                                                <label class="form-label fw-semibold pb-1 mb-2">
                                                    Color:
                                                    <span class="text-body fw-normal" id="colorOption">Gray</span>
                                                </label>
                                                <div class="d-flex flex-wrap gap-2 align-items-center"
                                                    data-label="#colorOption">
                                                    <input type="radio" class="btn-check" name="colors"
                                                        id="grayColor" checked="" />
                                                    <label for="grayColor" class="btn-color-swatch" data-label="Gray">
                                                        <span class="icon-shape icon-xxs bg-light"></span>
                                                        <span class="visually-hidden">Gray</span>
                                                    </label>
                                                    <input type="radio" class="btn-check" name="colors"
                                                        id="BlackColor" />
                                                    <label for="BlackColor" class="btn-color-swatch" data-label="Green">
                                                        <span class="icon-shape icon-xxs bg-success"></span>
                                                        <span class="visually-hidden">Black</span>
                                                    </label>
                                                    <input type="radio" class="btn-check" name="colors"
                                                        id="blueColor" />
                                                    <label for="blueColor" class="btn-color-swatch" data-label="Blue">
                                                        <span class="icon-shape icon-xxs bg-info"></span>
                                                        <span class="visually-hidden">Blue</span>
                                                    </label>
                                                    <input type="radio" class="btn-check" name="colors"
                                                        id="redColor" />
                                                    <label for="redColor" class="btn-color-swatch" data-label="Red">
                                                        <span class="icon-shape icon-xxs bg-danger"></span>
                                                        <span class="visually-hidden">Red</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-3" />
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <span>Quantity:</span>
                                            <div class="d-flex align-items-center border p-2">
                                                <button
                                                    class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                                <input type="number"
                                                    class="form-control quantity-input text-center mx-1 p-0 border-0"
                                                    value="1" min="1" style="width: 50px" />
                                                <button
                                                    class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-md-row flex-column gap-2 gap-md-1">
                                            <a href="#!" class="btn btn-dark">Add to Cart</a>
                                            <a href="#!" class="btn btn-outline-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                                    <path
                                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                                </svg>
                                                Add to Wishlist
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="swiper-container swiper" data-thumbs="true" id="swiper-4"
                                    data-pagination-type="" data-speed="400" data-space-between="120"
                                    data-pagination="false" data-navigation="false" data-autoplay="false"
                                    data-effect="fade" data-autoplay-delay="3000"
                                    data-breakpoints='{"480": {"slidesPerView": 1}, "768": {"slidesPerView": 1}, "1024": {"slidesPerView": 1}}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="assets/images/product/product-single-img1.jpg"
                                                data-zoom="assets/images/product/product-single-img1.jpg" alt="Preview"
                                                class="drift w-100"
                                                data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/product/product-single-img2.jpg"
                                                data-zoom="assets/images/product/product-single-img2.jpg" alt="Preview"
                                                class="drift w-100"
                                                data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/product/product-single-img3.jpg"
                                                data-zoom="assets/images/product/product-single-img3.jpg" alt="Preview"
                                                class="drift w-100"
                                                data-zoom-options='{
                                            "paneSelector": "#zoomPane",

                                            "hoverDelay": 500,
                                            "touchDisable": true
                                    }' />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="assets/images/product/product-single-img4.jpg"
                                                data-zoom="assets/images/product/product-single-img4.jpg" alt="Preview"
                                                class="drift w-100"
                                                data-zoom-options='{
                                                "paneSelector": "#zoomPane",

                                                "hoverDelay": 500,
                                                "touchDisable": true
                                        }' />
                                        </div>

                                        <!-- Add more slides as needed -->
                                    </div>
                                </div>

                                <!-- Thumbs Swiper Container -->
                                <div class="swiper-container swiper-thumbs mt-2 overflow-hidden">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-1x1 border">
                                                <img src="assets/images/product/product-single-img1.jpg"
                                                    alt="product image" class="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-1x1 border">
                                                <img src="assets/images/product/product-single-img2.jpg"
                                                    alt="product image" class="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-1x1 border">
                                                <img src="assets/images/product/product-single-img3.jpg"
                                                    alt="product image" class="" />
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="ratio ratio-1x1 border">
                                                <img src="assets/images/product/product-single-img4.jpg"
                                                    alt="product image" class="" />
                                            </div>
                                        </div>

                                        <!-- Add more thumbnails as needed -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script-top')
    <script src="{{ asset('assets/libs/drift-zoom/dist/Drift.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/drift.js') }}"></script>
    <script src="{{ asset('assets/libs/nouislider/dist/nouislider.min.js') }}"></script>
@endpush
