<section class="pt-6 mx-3 mx-lg-0">
    <div class="container">
        <div class="row mb-md-8 mb-4">
            <div class="col-lg-12">
                <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                    <!--Heading-->
                    <div class="col-sm-7">
                        <h2>New arrivals</h2>
                        <p class="mb-0">
                            We are inspired by the realities of life today, in which traditional divides between
                            personal and professional space are more fluid.
                        </p>
                    </div>
                    <div class="col-auto">
                        <a href="#!" class="d-flex align-items-center gap-2 btn-dark-link">
                            <span class="text-link">View all</span>
                            <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Slider-->
    <div class="swiper-container swiper px-3" id="swiper-3" data-pagination-type="progressbar" data-speed="400"
        data-space-between="30" data-pagination="true" data-navigation="true" data-autoplay="false" data-effect="slides"
        data-autoplay-delay="3000"
        data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 6}}'>
        <div class="swiper-wrapper pb-10">

            @foreach ($newArrivals as $newArrival)
                <div class="swiper-slide mb-5">
                    <div class="product-card">
                        <div class=" text-center product-card-img mb-4">
                            <a href="{{ route('product.show', $newArrival->id) }}">
                                <img src="{{ getSingleImageUrl($newArrival) }}"
                                    alt="{{ $newArrival->title }} product image" class="img-fluid">

                                <img src="{{ $newArrival->media->skip(1)->first() ? getImageUrl($newArrival->media->skip(1)->first()) : getSingleImageUrl($newArrival) }}"
                                    alt="{{ $newArrival->title }} product hover image"
                                    class="img-fluid product-img-hover">
                            </a>
                            <div class="product-card-btn">
                                <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
                                    data-bs-toggle="modal" data-bs-target="#quickViewModal">

                                    @include('partials.home.quick-view-svg')
                                </button>
                                <button type="button" class="btn btn-primary  btn-sm quick-add-btn"
                                    data-product-name="{{ $newArrival->title }}"
                                    data-product-price="{{ $newArrival->price }}"
                                    data-product-img="{{ getSingleImageUrl($newArrival) }}"
                                    data-product-id="{{ $newArrival->id }}">
                                    @include('partials.home.quick-add-svg')
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">{{ $newArrival->brand }}</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    @include('partials.home.star-svg')
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    @include('partials.home.heart-svg')
                                </button>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                <a href="{{ route('product.show', $newArrival->id) }}">
                                    {{ $newArrival->title }}
                                </a>
                            </h3>
                            <p class="mb-0 lh-1 text-dark fw-semibold">${{ $newArrival->price }}</p>
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
            @endforeach
            <!-- Add more slides as needed -->
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination top-100 mt-n4 start-lg-10 w-lg-75"></div>
        <!-- Add Navigation -->
        <div class="swiper-navigation position-absolute end-10 bottom-0 mb-4 d-none d-lg-block">
            <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide2">
            </div>
            <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide1">
            </div>
        </div>
    </div>
</section>


@include('partials.home.quick-view-modal')
