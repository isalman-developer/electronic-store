<div class="container px-0">
    <div class="row gy-4">
        <div class="col-lg-6">
            <div class="position-relative d-flex flex-column h-100" id="zoomPane">
                <div><span class="badge bg-info">New</span></div>
                <div class="d-flex align-items-start flex-md-row flex-column justify-content-between mt-3 mb-md-2 mb-3">
                    <div class="mb-md-3">
                        <h2 class="h4">{{ $product->title }}</h2>
                        <span>( {{ $product->brand->title }} )</span>
                    </div>
                    <div class="text-success d-flex align-items-center gap-2 mt-2">
                        @include('user.svgs.tick-mark-svg')
                        In Stock
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-md-center">
                    <div class="d-flex flex-md-row flex-column gap-2 align-items-md-center">
                        <p class="mb-0">
                            <span class="text-danger">PKR {{ $product->price }}</span>
                            <span class="text-decoration-line-through">PKR {{ $product->price + 100 }}</span>
                        </p>
                        <span class="badge bg-danger">Save PKR 100.00</span>
                    </div>
                    <span class="">
                        4.5
                        @include('user.svgs.rating-star-svg')
                    </span>
                </div>
                <div class="mt-auto">
                    <hr class="my-3" />
                    <div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold pb-1 mb-2">
                                Color:
                                <span class="text-body fw-normal" id="colorOption">
                                    {{ $product->colors->first()->title ?? 'N/A' }}
                                </span>
                            </label>
                            <div class="d-flex flex-wrap gap-2 align-items-center" data-label="#colorOption">
                                @foreach ($product->colors as $color)
                                    <input type="radio" class="btn-check" name="colors" id="{{ $color->title }}Color"
                                        {{ $loop->first ? 'checked' : '' }} />

                                    <label for="{{ $color->title }}Color" class="btn-color-swatch"
                                        data-label="{{ $color->title }}">
                                        <span class="icon-shape icon-xxs bg-{{ $color->color_class }}"></span>
                                        <span class="visually-hidden">{{ $color->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span>Quantity:</span>
                        <div class="d-flex align-items-center border p-2">
                            <button class="btn btn-icon btn-xs btn-focus-none quantity-btn minus fs-5">-</button>
                            <input type="number" class="form-control quantity-input text-center mx-1 p-0 border-0"
                                value="1" min="1" style="width: 50px" />
                            <button class="btn btn-icon btn-xs btn-focus-none quantity-btn plus fs-5">+</button>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-column gap-2 gap-md-1">
                        <button type="button" class="btn btn-dark quick-add-btn" data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->title }}" data-product-price="{{ $product->price }}"
                            data-product-img="{{ getFirstImageUrl($product) }}">
                            Add to Cart
                        </button>
                        <a href="#!" class="btn btn-outline-dark">
                            @include('user.svgs.heart-svg')
                            Add to Wishlist
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Images -->
        <div class="col-lg-6">
            <div id="productGalleryCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($product->media as $key => $media)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ getImageUrl($media) }}" alt="{{ $product->title }}"
                                class="d-block w-100 img-fluid">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#productGalleryCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#productGalleryCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
