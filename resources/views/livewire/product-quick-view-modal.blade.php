<div class="modal fade {{ $isVisible ? 'show d-block' : '' }}" id="quickViewModal" tabindex="-1"
    style="{{ $isVisible ? 'background: rgba(0,0,0,0.5);' : 'display: none;' }}" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div class="position-absolute top-0 start-100 translate-middle bg-white">
                    <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="hideModal"></button>
                </div>
                <div class="container px-0">
                    <div class="row gy-4">
                        <div class="col-lg-6">
                            <div class="position-relative d-flex flex-column h-100" id="zoomPane">
                                <div><span class="badge bg-info">New</span></div>
                                <div
                                    class="d-flex align-items-start flex-md-row flex-column justify-content-between mt-3 mb-md-2 mb-3">
                                    <div class="mb-md-3">
                                        <h2 class="h4">{{ $product->title ?? 'Test Product' }}</h2>
                                        <span>( {{ $product->brand->title ?? 'Test Brand' }} )</span>
                                    </div>
                                    <div class="text-success d-flex align-items-center gap-2 mt-2">
                                        @include('user.svgs.tick-mark-svg')
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
                                        @include('user.svgs.rating-star-svg')
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

                                            <div class="mb-4">
                                                @if (isset($product) && isset($product->colors))
                                                    <label class="form-label fw-semibold pb-1 mb-2">
                                                        Colors:
                                                    </label>
                                                    @foreach ($product->colors as $key => $color)
                                                        <span class="text-body fw-normal"
                                                            id="colorOption">{{ $color->title }}
                                                        </span>
                                                    @endforeach
                                                @endif
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
                                            @include('user.svgs.heart-svg')
                                            Add to Wishlist
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="main-image-container">
                                @if (isset($product))
                                    @foreach ($product->media as $media)
                                        <img src="{{ getImageUrl($media) }}" class="main-image img-fluid"
                                            id="mainImage" />
                                    @endforeach
                                @else
                                <img src="{{ getImageUrl(null) }}" class="main-image img-fluid"
                                            id="mainImage" />
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
