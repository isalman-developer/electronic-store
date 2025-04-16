<div class="swiper-container swiper" id="swiper-5" data-pagination-type="" data-speed="800" data-space-between="100"
    data-pagination="false" data-navigation="true" data-autoplay="true" data-effect="fade" data-autoplay-delay="3000"
    data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 1}}'>
    <div class="swiper-wrapper pb-lg-8">
        @foreach ($sliders as $slider)
            <!--Swiper-->
            <div class="swiper-slide w-100 bg-light bg-opacity-50 border-bottom">
                <div class="container d-flex flex-column justify-content-center h-100">
                    <div class="row align-items-center py-md-8 py-6">
                        <div class="col-lg-5">
                            <div class="">
                                <span class="badge bg-info">New Arrival</span>
                                <h1 class="mb-3 mt-4 display-5 fw-bold">{{ $slider->title }}</h1>
                                <p class="mb-4 pe-lg-6">{{ $slider->description }}</p>
                                <a href="{{ $slider->redirect_link }}" class="btn btn-outline-primary">Discover More</a>
                            </div>
                        </div>
                        <div class="offset-lg-1 col-lg-6">
                            <div class="position-relative">
                                <img src="{{ asset($slider->image_url) }}" alt="slider image"
                                    class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Swiper-->
        @endforeach
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
    <div class="swiper-navigation position-absolute end-25 bottom-0 bottom-md-10 me-md-n10 mb-8">
        <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
        <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
    </div>
</div>
