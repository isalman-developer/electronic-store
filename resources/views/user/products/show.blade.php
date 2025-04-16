@extends('user.layouts.app')

@push('page-style')
    <style>
        .side-images-div {
            height: 30rem;
            overflow-y: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
            position: relative;
        }

        .more-images-div {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <!--Breadcrumb start-->
    <div class="container py-4">
        <div class="row">
            <div class="col-12 py-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Shop</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('category.products', $product->category->slug) }}">
                                {{ $product->category->title }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $product->title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!--Breadcrumb end-->

    <!--Product start-->
    <section class="pb-lg-8">
        <div class="container">
            <div class="row gy-4 gy-lg-0">
                <!--Product image-->
                <div class="col-lg-6">
                    <!--Swiper-->
                    <div class="row">
                        <div class="swiper-container swiper" data-thumbs="true" id="swiper-1" data-pagination-type=""
                            data-speed="4000" data-space-between="120" data-pagination="true" data-navigation="true"
                            data-autoplay="true" data-effect="fade" data-autoplay-delay="3000"
                            data-breakpoints='{"480": {"slidesPerView": 1}, "768": {"slidesPerView": 1}, "1024": {"slidesPerView": 1}}'>
                            <div class="swiper-wrapper">
                                @foreach ($product->media as $media)
                                    <div class="swiper-slide">
                                        <img src="{{ getImageUrl($media) }}" width="538px" />
                                    </div>
                                @endforeach
                                <!-- Add more slides as needed -->
                            </div>
                        </div>

                        <!-- Thumbs Swiper Container -->
                        <div class="swiper-container swiper-thumbs mt-4 overflow-hidden">
                            <div class="swiper-wrapper">
                                @foreach ($product->media as $media)
                                    <div class="swiper-slide">
                                        <div class="ratio ratio-1x1 border">
                                            <img src="{{ getImageUrl($media) }}"
                                                alt="product image {{ $media->file_name }}" />
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Add more thumbnails as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <!--Product details-->
                <div class="col-lg-6">
                    <div class="ps-lg-6">
                        <div class="position-relative" id="zoomPanePillow">
                            <span class="badge bg-info">New</span>
                            <div class="d-flex align-items-start justify-content-between mt-3 mb-2">
                                <div class="mb-3">
                                    <h2>{{ $product->title }}</h2>
                                    <span>( {{ $product->brand->title }} )</span>
                                </div>
                                <div class="text-success d-flex align-items-center gap-2 mt-2">
                                    @include('user.svgs.tick-mark-svg')
                                    In Stock
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center gap-3">
                                    <p class="mb-0">
                                        <span class="text-danger">PKR {{ $product->price }}</span>
                                        <span class="text-decoration-line-through">PKR {{ $product->price }}</span>
                                    </p>
                                    <span class="badge bg-danger">Save $100.00</span>
                                </div>
                                <span class="">
                                    4.5
                                    @include('user.svgs.rating-star-svg')
                                </span>
                            </div>
                            <hr class="my-3" />
                            <div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold pb-1 mb-2">
                                        Colors:
                                        <span class="text-body fw-normal" id="colorOption">Gray</span>
                                    </label>
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
                            <hr class="my-3" />
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <span>Quantity:</span>
                                <div class="d-flex align-items-center mt-2 border p-2">
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                                    <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0"
                                        value="1" min="1" style="width: 50px" />
                                    <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                                </div>
                            </div>
                            <div class="d-flex flex-md-row flex-column gap-2">
                                <a href="#!" class="btn btn-dark">Add to Cart</a>
                                <a href="#!" class="btn btn-outline-dark">
                                    @include('user.svgs.heart-svg')
                                    Add to Wishlist
                                </a>
                            </div>

                            <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Shipping & Returns
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            @include('user.svgs.chevron-down-svg')
                                        </span>
                                    </a>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <p>
                                                We are committed to making our products accessible nationwide. Our service
                                                delivers to almost all cities, meeting diverse shipping needs. Enjoy free
                                                shipping on
                                                all orders over PKR 10,000.
                                            </p>
                                            <p>You can return your product within 3 days of receiving it, provided it is
                                                unused and undamaged.</p>
                                            <a href="#!" class="text-link">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseTwo" aria-expanded="false"
                                        aria-controls="flush-collapseTwo">
                                        Warranty
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            @include('user.svgs.chevron-down-svg')
                                        </span>
                                    </a>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <p>
                                                Our products are crafted with precision and care, and we stand behind their
                                                quality.
                                                We offer a comprehensive warranty to ensure your peace of mind. If you
                                                encounter any
                                                manufacturing defects or issues with the product, our warranty covers
                                                repairs or replacements
                                                within the specified period. Please retain your proof of purchase to make
                                                the warranty process
                                                seamless and efficient.
                                            </p>
                                            <p>
                                                For more details on the warranty terms and conditions, feel free to contact
                                                our support team.
                                                We're here to assist you and ensure your satisfaction with our products.
                                            </p>
                                            <a href="#!" class="text-link">Learn More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <a class="collapsed px-0 fs-5 fw-bold d-flex justify-content-between align-items-center py-3"
                                        data-bs-toggle="collapse" href="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        More Payment option
                                        <span class="icon-shape icon-xs bg-light text-dark rounded-circle">
                                            @include('user.svgs.chevron-down-svg')
                                        </span>
                                    </a>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body px-0">
                                            <ul class="list-unstyled lh-lg">
                                                <li class="d-flex align-items-center gap-2">
                                                    @include('user.svgs.earth-svg')
                                                    Free Shipping on Products Over PKR 10,000
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    @include('user.svgs.truck-svg')
                                                    Easy Returns
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    @include('user.svgs.dollar-svg')
                                                    Price Match Guarantee
                                                </li>
                                                <li class="d-flex align-items-center gap-2">
                                                    @include('user.svgs.secure-payment-svg')
                                                    Secure Payments
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product end-->
    <!--Product tabs start-->
    <section class="py-lg-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Description
                            </button>
                        </li>

                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab"
                                data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                aria-controls="reviews-tab-pane" aria-selected="false">
                                Deliveries & Pickups
                            </button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- Description tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-6">
                                <div class="mb-5">
                                    <!-- text -->
                                    {{ $product->description }}
                                </div>
                            </div>
                        </div>
                        <!-- Deliveries and Pickups tab pane -->
                        <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab"
                            tabindex="0">
                            <div class="my-6">
                                <div class="mb-5">
                                    <h3 class="fs-5">Premium White Glove Delivery</h3>
                                    <p>
                                        Experience the convenience of our Premium White Glove Delivery service. Our team
                                        ensures your product is carefully handled, delivered, and set up at your desired
                                        location. This service is designed to provide a seamless and stress-free delivery
                                        experience, ensuring your satisfaction from start to finish.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <h3 class="fs-5">Convenient Pick-Up Options</h3>
                                    <p>
                                        For customers who prefer to pick up their orders, we offer a hassle-free pick-up
                                        service. Simply visit our designated outlets, and our team will assist you
                                        in loading your items. This option is perfect for those who want to save on delivery
                                        time and costs.
                                    </p>
                                </div>
                                <div class="mb-5">
                                    <h3 class="fs-5">Pick-Up Location and Hours</h3>
                                    <p>
                                        Local customers can pick up their orders from our main outlets. Our shop timings are
                                        designed to accommodate your schedule, ensuring a smooth and efficient
                                        process.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Reviews-->
            <div class="row">
                <div class="my-6">
                    <div class="mb-6">
                        <h3 class="mb-4">Reviews</h3>
                        <div class="my-2 p-4 bg-light">
                            <div class="row gy-4 gy-lg-0">
                                <div class="col-lg-4 col-md-8">
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">5</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">22</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">4</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                    aria-valuemax="50"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">19</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">3</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                    aria-valuemax="35"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">15</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">2</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 22%" aria-valuenow="22" aria-valuemin="0"
                                                    aria-valuemax="22"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">0</span>
                                    </div>
                                    <!-- progress -->
                                    <div class="d-flex align-items-center justify-content-between gap-3 mb-2">
                                        <div class="text-nowrap text-muted" style="width: 50px">
                                            <span class="d-inline-block align-middle text-muted">1</span>
                                            <i class="bi bi-star-fill ms-1 small text-primary"></i>
                                        </div>
                                        <div class="w-100">
                                            <div class="progress" style="height: 6px">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 14%" aria-valuenow="14" aria-valuemin="0"
                                                    aria-valuemax="14"></div>
                                            </div>
                                        </div>
                                        <span class="text-muted" style="width: 50px">0</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 d-flex justify-content-center align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="fs-2 text-dark fw-bold">5</div>
                                        <!-- rating -->
                                        <div class="d-flex flex-column">
                                            <small class="text-primary">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>

                                            <small>Based on 1 review</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 d-flex justify-content-center align-items-center">
                                    <a href="#!" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#reviewModal">Write a
                                        Review</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Search-->
                    <div class="mb-6">
                        <form>
                            <div class="row g-3">
                                <div class="col-lg-4 col-xl-3 col-md-6">
                                    <div class="position-relative">
                                        <label for="searchInput" class="visually-hidden"></label>
                                        <input type="search" id="searchInput" class="form-control ps-6"
                                            placeholder="Search Reviews" />
                                        <span class="position-absolute top-50 start-0 translate-middle ms-4">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M16.1479 15.3519L12.6273 11.8321C13.6477 10.6071 14.1566 9.03577 14.048 7.44512C13.9394 5.85447 13.2217 4.36692 12.0443 3.29193C10.8668 2.21693 9.32029 1.63725 7.72635 1.67348C6.13241 1.7097 4.6138 2.35904 3.48642 3.48642C2.35904 4.6138 1.7097 6.13241 1.67348 7.72635C1.63725 9.32029 2.21693 10.8668 3.29193 12.0443C4.36692 13.2217 5.85447 13.9394 7.44512 14.048C9.03577 14.1566 10.6071 13.6477 11.8321 12.6273L15.3519 16.1479C15.4042 16.2001 15.4663 16.2416 15.5345 16.2699C15.6028 16.2982 15.676 16.3127 15.7499 16.3127C15.8238 16.3127 15.897 16.2982 15.9653 16.2699C16.0336 16.2416 16.0956 16.2001 16.1479 16.1479C16.2001 16.0956 16.2416 16.0336 16.2699 15.9653C16.2982 15.897 16.3127 15.8238 16.3127 15.7499C16.3127 15.676 16.2982 15.6028 16.2699 15.5345C16.2416 15.4663 16.2001 15.4042 16.1479 15.3519ZM2.81242 7.87492C2.81242 6.87365 3.10933 5.89487 3.6656 5.06234C4.22188 4.22982 5.01253 3.58094 5.93758 3.19778C6.86263 2.81461 7.88053 2.71435 8.86256 2.90969C9.84459 3.10503 10.7466 3.58718 11.4546 4.29519C12.1626 5.00319 12.6448 5.90524 12.8401 6.88727C13.0355 7.8693 12.9352 8.8872 12.5521 9.81225C12.1689 10.7373 11.52 11.528 10.6875 12.0842C9.85497 12.6405 8.87618 12.9374 7.87492 12.9374C6.53271 12.9359 5.24591 12.4021 4.29683 11.453C3.34775 10.5039 2.81391 9.21712 2.81242 7.87492Z"
                                                    fill="#B3ACA3" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-2 col-md-6">
                                    <label for="ratingInput" class="visually-hidden"></label>

                                    <select id="ratingInput" class="" data-choices=""
                                        data-choices-removeitembutton="true" aria-label="Default select example">
                                        <option value="">All Rating</option>

                                        <option value="Top">Top</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Low">Low</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-6">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h3 class="mb-0 fs-4">5 Reviews</h3>
                            <div class="col-lg-3">
                                <label for="mostRaing" class="visually-hidden"></label>
                                <select id="mostRaing" class="" data-choices=""
                                    data-choices-removeitembutton="true" aria-label="Default select example">
                                    <option value="">Sort by: Most recent</option>

                                    <option value="Highest Rating">Highest Rating</option>
                                    <option value="Lowest Rating">Lowest Rating</option>
                                    <option value="Verified Purchase">Verified Purchase</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-4 mb-4">
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Exceptional Quality and Comfort</h3>
                                        <p>I purchased this chair a month ago, and it's been amazing! The design is
                                            sleek, and it's
                                            incredibly comfortable. Worth every penny!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Julia Robert
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    2
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Perfect Addition to My Living Room</h3>
                                        <p>This lamp is not only stylish but also gives off the perfect amount of light.
                                            It transformed the
                                            look of my living room. Highly recommend!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Anita Parmar
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Fast Shipping, Great Service</h3>
                                        <p>I was impressed by how quickly my order arrived. The product was exactly as
                                            described, and the
                                            customer service was outstanding. Will shop again!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Manasvi Suthar
                                            <span class="small text-danger d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M9.84375 12.6562C9.84375 12.8231 9.79427 12.9863 9.70156 13.125C9.60884 13.2638 9.47707 13.3719 9.32289 13.4358C9.16872 13.4996 8.99907 13.5163 8.8354 13.4838C8.67172 13.4512 8.52138 13.3709 8.40338 13.2529C8.28538 13.1349 8.20502 12.9845 8.17247 12.8209C8.13991 12.6572 8.15662 12.4875 8.22048 12.3334C8.28434 12.1792 8.39249 12.0474 8.53124 11.9547C8.66999 11.862 8.83313 11.8125 9 11.8125C9.22378 11.8125 9.43839 11.9014 9.59662 12.0596C9.75486 12.2179 9.84375 12.4325 9.84375 12.6562ZM9 5.0625C7.44891 5.0625 6.1875 6.19805 6.1875 7.59375V7.875C6.1875 8.02418 6.24677 8.16726 6.35226 8.27275C6.45775 8.37824 6.60082 8.4375 6.75 8.4375C6.89919 8.4375 7.04226 8.37824 7.14775 8.27275C7.25324 8.16726 7.3125 8.02418 7.3125 7.875V7.59375C7.3125 6.82031 8.06977 6.1875 9 6.1875C9.93024 6.1875 10.6875 6.82031 10.6875 7.59375C10.6875 8.36719 9.93024 9 9 9C8.85082 9 8.70775 9.05926 8.60226 9.16475C8.49677 9.27024 8.4375 9.41332 8.4375 9.5625V10.125C8.4375 10.2742 8.49677 10.4173 8.60226 10.5227C8.70775 10.6282 8.85082 10.6875 9 10.6875C9.14919 10.6875 9.29226 10.6282 9.39775 10.5227C9.50324 10.4173 9.5625 10.2742 9.5625 10.125V10.0744C10.845 9.83883 11.8125 8.81578 11.8125 7.59375C11.8125 6.19805 10.5511 5.0625 9 5.0625ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#DC2626" />
                                                </svg>

                                                Unverified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Stylish but Slightly Overpriced</h3>
                                        <p>The design is beautiful, and it complements my décor perfectly. However, I
                                            feel the price is a
                                            bit high for the size of the product.</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Vallabh Sompura
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    2
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                        <p>The dining table exceeded my expectations. It’s solid, well-constructed, and
                                            looks elegant in my
                                            home. Assembly was straightforward too!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Sandip Chauhan
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Review-->
                            <div class="col-xl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-body p-5">
                                        <small class="text-warning">
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                        <p>The dining table exceeded my expectations. It’s solid, well-constructed, and
                                            looks elegant in my
                                            home. Assembly was straightforward too!</p>
                                        <p class="d-flex align-items-center gap-3">
                                            Sandip Chauhan
                                            <span class="small text-success d-flex align-items-center gap-1">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.2"
                                                        d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                        fill="#15803D" />
                                                    <path
                                                        d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                        fill="#15803D" />
                                                </svg>
                                                Verified
                                            </span>
                                        </p>
                                        <div class="d-flex flex-row gap-3 align-items-center">
                                            <span>Was this review helpful?</span>
                                            <div class="d-flex flex-row gap-2">
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-up"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                        </path>
                                                    </svg>
                                                    1
                                                </a>
                                                <a href="#!" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-hand-thumbs-down"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                        </path>
                                                    </svg>
                                                    0
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--More reviews-->
                        <div class="collapse" id="collapseContent">
                            <div class="row g-4 mb-4">
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6">
                                    <div class="card h-100">
                                        <div class="card-body p-5">
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                            <h3 class="fs-4 my-3">Sturdy and Well-Made</h3>
                                            <p>The dining table exceeded my expectations. It’s solid, well-constructed,
                                                and looks elegant in
                                                my home. Assembly was straightforward too!</p>
                                            <p class="d-flex align-items-center gap-3">
                                                Sandip Chauhan
                                                <span class="small text-success d-flex align-items-center gap-1">
                                                    <svg width="18" height="18" viewBox="0 0 18 18"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.2"
                                                            d="M15.75 9C15.75 10.335 15.3541 11.6401 14.6124 12.7501C13.8707 13.8601 12.8165 14.7253 11.5831 15.2362C10.3497 15.7471 8.99252 15.8808 7.68314 15.6203C6.37377 15.3598 5.17104 14.717 4.22703 13.773C3.28303 12.829 2.64015 11.6262 2.3797 10.3169C2.11925 9.00749 2.25292 7.65029 2.76382 6.41689C3.27471 5.18349 4.13987 4.12928 5.2499 3.38758C6.35994 2.64588 7.66498 2.25 9 2.25C10.7902 2.25 12.5071 2.96116 13.773 4.22703C15.0388 5.4929 15.75 7.20979 15.75 9Z"
                                                            fill="#15803D" />
                                                        <path
                                                            d="M12.2105 6.91453C12.2628 6.96677 12.3043 7.02881 12.3326 7.0971C12.3609 7.16538 12.3754 7.23858 12.3754 7.3125C12.3754 7.38642 12.3609 7.45962 12.3326 7.5279C12.3043 7.59619 12.2628 7.65823 12.2105 7.71047L8.27297 11.648C8.22073 11.7003 8.15869 11.7418 8.09041 11.7701C8.02212 11.7984 7.94892 11.8129 7.875 11.8129C7.80108 11.8129 7.72789 11.7984 7.6596 11.7701C7.59131 11.7418 7.52928 11.7003 7.47703 11.648L5.78953 9.96047C5.68399 9.85492 5.62469 9.71177 5.62469 9.5625C5.62469 9.41323 5.68399 9.27008 5.78953 9.16453C5.89508 9.05898 6.03824 8.99969 6.1875 8.99969C6.33677 8.99969 6.47992 9.05898 6.58547 9.16453L7.875 10.4548L11.4145 6.91453C11.4668 6.86223 11.5288 6.82074 11.5971 6.79244C11.6654 6.76413 11.7386 6.74956 11.8125 6.74956C11.8864 6.74956 11.9596 6.76413 12.0279 6.79244C12.0962 6.82074 12.1582 6.86223 12.2105 6.91453ZM16.3125 9C16.3125 10.4463 15.8836 11.8601 15.0801 13.0626C14.2766 14.2651 13.1346 15.2024 11.7984 15.7559C10.4622 16.3093 8.99189 16.4541 7.57341 16.172C6.15492 15.8898 4.85196 15.1934 3.82928 14.1707C2.80661 13.148 2.11017 11.8451 1.82801 10.4266C1.54586 9.00811 1.69067 7.53781 2.24413 6.20163C2.7976 4.86544 3.73486 3.72339 4.9374 2.91988C6.13993 2.11637 7.55373 1.6875 9 1.6875C10.9388 1.68955 12.7975 2.46063 14.1685 3.83154C15.5394 5.20246 16.3105 7.06123 16.3125 9ZM15.1875 9C15.1875 7.77623 14.8246 6.57994 14.1447 5.56241C13.4648 4.54488 12.4985 3.75181 11.3679 3.2835C10.2372 2.81518 8.99314 2.69264 7.79288 2.93139C6.59262 3.17014 5.49012 3.75944 4.62478 4.62478C3.75944 5.49011 3.17014 6.59262 2.93139 7.79288C2.69265 8.99314 2.81518 10.2372 3.2835 11.3679C3.75182 12.4985 4.54488 13.4648 5.56241 14.1447C6.57994 14.8246 7.77623 15.1875 9 15.1875C10.6405 15.1856 12.2132 14.5331 13.3732 13.3732C14.5331 12.2132 15.1856 10.6405 15.1875 9Z"
                                                            fill="#15803D" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            </p>
                                            <div class="d-flex flex-row gap-3 align-items-center">
                                                <span>Was this review helpful?</span>
                                                <div class="d-flex flex-row gap-2">
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-up" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2 2 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a10 10 0 0 0-.443.05 9.4 9.4 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a9 9 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.2 2.2 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.9.9 0 0 1-.121.416c-.165.288-.503.56-1.066.56z">
                                                            </path>
                                                        </svg>
                                                        1
                                                    </a>
                                                    <a href="#!" class="">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-hand-thumbs-down" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.864 15.674c-.956.24-1.843-.484-1.908-1.42-.072-1.05-.23-2.015-.428-2.59-.125-.36-.479-1.012-1.04-1.638-.557-.624-1.282-1.179-2.131-1.41C2.685 8.432 2 7.85 2 7V3c0-.845.682-1.464 1.448-1.546 1.07-.113 1.564-.415 2.068-.723l.048-.029c.272-.166.578-.349.97-.484C6.931.08 7.395 0 8 0h3.5c.937 0 1.599.478 1.934 1.064.164.287.254.607.254.913 0 .152-.023.312-.077.464.201.262.38.577.488.9.11.33.172.762.004 1.15.069.13.12.268.159.403.077.27.113.567.113.856s-.036.586-.113.856c-.035.12-.08.244-.138.363.394.571.418 1.2.234 1.733-.206.592-.682 1.1-1.2 1.272-.847.283-1.803.276-2.516.211a10 10 0 0 1-.443-.05 9.36 9.36 0 0 1-.062 4.51c-.138.508-.55.848-1.012.964zM11.5 1H8c-.51 0-.863.068-1.14.163-.281.097-.506.229-.776.393l-.04.025c-.555.338-1.198.73-2.49.868-.333.035-.554.29-.554.55V7c0 .255.226.543.62.65 1.095.3 1.977.997 2.614 1.709.635.71 1.064 1.475 1.238 1.977.243.7.407 1.768.482 2.85.025.362.36.595.667.518l.262-.065c.16-.04.258-.144.288-.255a8.34 8.34 0 0 0-.145-4.726.5.5 0 0 1 .595-.643h.003l.014.004.058.013a9 9 0 0 0 1.036.157c.663.06 1.457.054 2.11-.163.175-.059.45-.301.57-.651.107-.308.087-.67-.266-1.021L12.793 7l.353-.354c.043-.042.105-.14.154-.315.048-.167.075-.37.075-.581s-.027-.414-.075-.581c-.05-.174-.111-.273-.154-.315l-.353-.354.353-.354c.047-.047.109-.176.005-.488a2.2 2.2 0 0 0-.505-.804l-.353-.354.353-.354c.006-.005.041-.05.041-.17a.9.9 0 0 0-.121-.415C12.4 1.272 12.063 1 11.5 1">
                                                            </path>
                                                        </svg>
                                                        0
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="text-center">
                                    <a class="btn btn-outline-primary" id="toggleButton" data-bs-toggle="collapse"
                                        href="#collapseContent" aria-expanded="false" aria-controls="collapseContent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                                            <path
                                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                                        </svg>
                                        Load more Reviews
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Product tabs end-->
    <!--Product start-->
    <section class="pb-10">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--Heading-->
                    <div class="text-center mb-6">
                        <h2 class="mb-0">You me also like</h2>
                    </div>
                </div>
            </div>
            <div class="row gy-6 gx-4">
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class=" text-center product-card-img mb-4">
                            <a href="#!"><img src="{{ asset('assets/images/product/product-img-1.jpg') }}"
                                    alt="product image" class="img-fluid">
                                <img src="{{ asset('assets/images/product/product-img-hover-1.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover"></a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Sofa with wood legs" data-product-price="34.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-1.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"> <a href="#!">Sofa
                                    with
                                    wood
                                    legs</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$34.00</p>
                        </div>

                        <div role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                            <label class="btn-color-swatch bg-primary" for="btnradio1"></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                            <label class="btn-color-swatch bg-success" for="btnradio2"></label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" checked>
                            <label class="btn-color-swatch bg-danger" for="btnradio3"></label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                            <label class="btn-color-swatch bg-info" for="btnradio4"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!">
                                <img src="{{ asset('assets/images/product/product-img-2.jpg') }}" alt="product image"
                                    class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-2.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" />
                            </a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm quick-add-btn"
                                    data-product-name="Floor Lamp" data-product-price="95.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-2.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.2
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Floor
                                    Lamp</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$95.00</p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio2" id="btnradio5" checked />
                            <label class="btn-color-swatch bg-primary" for="btnradio5"></label>

                            <input type="radio" class="btn-check" name="btnradio2" id="btnradio6" />
                            <label class="btn-color-swatch bg-success" for="btnradio6"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!">
                                <img src="{{ asset('assets/images/product/product-img-3.jpg') }}" alt="product image"
                                    class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-3.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" />
                            </a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Comfort Seat Chair" data-product-price="78.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-3.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                            <div class="position-absolute top-0 p-2 px-3">
                                <span class="badge bg-info">New</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Comfort
                                    Seat
                                    Chair</a></h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">$78.00</p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio3" id="btnradio9" checked>
                            <label class="btn-color-swatch bg-primary" for="btnradio9"></label>
                        </div>
                    </div>
                </div>
                <!--Product-->
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-card">
                        <div class="text-center mb-4 product-card-img">
                            <a href="#!"><img src="{{ asset('assets/images/product/product-img-4.jpg') }}"
                                    alt="product image" class="img-fluid" />
                                <img src="{{ asset('assets/images/product/product-img-hover-4.jpg') }}"
                                    alt="product image" class="img-fluid product-img-hover" /></a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="Armchair" data-product-price="75.00"
                                    data-product-img="{{ asset('assets/images/product/product-img-4.jpg') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">BRAND</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.5
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-star-fill align-baseline text-warning"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                    </svg>
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                        <path
                                            d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a
                                    href="#!">Armchair</a>
                            </h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">
                                <span class="text-danger">$75.00</span>
                                <span class="text-decoration-line-through">$95.00</span>
                            </p>
                        </div>
                        <div>
                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio13" checked />
                            <label class="btn-color-swatch bg-primary" for="btnradio13"></label>

                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio14" />
                            <label class="btn-color-swatch bg-success" for="btnradio14"></label>

                            <input type="radio" class="btn-check" name="btnradio4" id="btnradio16" />
                            <label class="btn-color-swatch bg-info" for="btnradio16"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('page-script')
    <script>
        function changeMainImage(src) {
            document.getElementById('mainProductImage').src = src;
        }
    </script>
@endpush
