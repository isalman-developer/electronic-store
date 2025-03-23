<section class="py-lg-10 py-6">
    <div class="container">
        <div class="row mb-md-8 mb-4">
            <div class="col-lg-12">
                <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                    <!--Heading-->
                    <div class="col-sm-7">
                        <h2 class="mb-0">Explore the collections</h2>
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
        <div class="row">
            <div class="swiper-container swiper" id="swiper-1" data-pagination-type="bullets" data-speed="400"
                data-space-between="30" data-pagination="true" data-navigation="false" data-autoplay="false"
                data-effect="slides" data-autoplay-delay="3000"
                data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 5}}'>
                <div class="swiper-wrapper pb-8">
                    <!--Collection-->
                    @foreach ($categories as $category)
                    <div class="swiper-slide">
                        <a href="#!" class="text-center p-4 card-animation d-block bg-light">
                            <img src="{{ getImageUrl($category->media) }}"
                                                            alt="{{ $category->title }} - Category Image" class="rounded avatar-lg">

                            <div class="d-flex align-items-center gap-2 justify-content-center link-animation">
                                <h3 class="fs-6 mb-0">{{ $category->title }}</h3>
                                <span class="btn btn-outline-dark btn-icon btn-xxs rounded-circle circle-chevron">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                        fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <!-- Add Navigation -->
                <div class="swiper-navigation position-absolute start-50 bottom-0 mb-4">
                    <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle"
                        id="slide3">
                    </div>
                    <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle"
                        id="slide4">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
