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
                                <img src="{{ getFirstImageUrl($newArrival) }}"
                                    alt="{{ $newArrival->title }} product image" class="img-fluid">

                                <img src="{{ $newArrival->media->skip(1)->first() ? getImageUrl($newArrival->media->skip(1)->first()) : getFirstImageUrl($newArrival) }}"
                                    alt="{{ $newArrival->title }} product hover image"
                                    class="img-fluid product-img-hover">
                            </a>
                            <div class="product-card-btn">
                                <button type="button"
                                    class="btn btn-primary btn-icon btn-sm animate-pulse quick-view-btn"
                                    data-product-id="{{ $newArrival->id }}" data-bs-toggle="modal"
                                    data-bs-target="#quickViewModal">
                                    @include('user.svgs.quick-view-svg')
                                </button>

                                <button type="button" class="btn btn-primary btn-sm quick-add-btn"
                                    data-product-name="{{ $newArrival->title }}"
                                    data-product-price="{{ $newArrival->price }}"
                                    data-product-img="{{ getFirstImageUrl($newArrival) }}">
                                    @include('user.svgs.quick-add-svg')
                                    Quick add
                                </button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-medium text-uppercase">{{ $newArrival->brand->title }}</span>
                            <div class="d-flex gap-3 align-items-center">
                                <span class="">
                                    4.3
                                    @include('user.partials.home.star-svg')
                                </span>
                                <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                    @include('user.partials.home.heart-svg')
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

                        <div class="mb-4">
                            @foreach ($newArrival->colors as $key => $color)
                                <input type="radio" class="btn-check" name="colors{{ $newArrival->id }}"
                                    id="color{{ $color->id }}" @checked($key == 0) />

                                <label for="color{{ $color->id }}" class="btn-color-swatch"
                                    data-label="{{ $color->title }}">
                                    <span class="icon-shape icon-xxs bg-{{ $color->color_class }}"></span>
                                    <span class="visually-hidden">{{ $color->title }}</span>
                                </label>
                            @endforeach
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


@push('page-script-bottom')
    <script src="{{ asset('user/js/quick-view.js') }}"></script>
@endpush
