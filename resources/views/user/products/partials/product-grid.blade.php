@forelse ($products as $product)
    <!--Product-->
    <div class="col-lg-4 col-md-6">
        <div class="product-card">
            <div class="text-center product-card-img mb-4">
                <a href="{{ route('product.show', $product->slug) }}">
                    <img src="{{ getFirstImageUrl($product) }}" alt="{{ $product->title }}" class="img-fluid"
                        loading="lazy">
                    <img src="{{ getImageUrl($product->media->skip(1)->first()) }}" alt="{{ $product->title }}"
                        class="img-fluid product-img-hover" loading="lazy">
                </a>
                <div class="product-card-btn">
                    <button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse quick-view-btn"
                        data-product-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                        @include('user.svgs.quick-view-svg')
                    </button>

                    <!-- Quick Add Button -->
                    <button class="btn btn-dark btn-icon btn-sm quick-add-btn" data-product-name="{{ $product->title }}"
                        data-product-price="{{ $product->price }}" data-product-img="{{ getFirstImageUrl($product) }}">
                        <i class="bi bi-cart-plus"></i>
                    </button>
                </div>
            </div>
            <!-- Product details -->
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="small fw-medium text-uppercase">
                    {{ $product->brand->title ?? 'BRAND' }}
                </span>
                <div class="d-flex gap-3 align-items-center">
                    <span class="">
                        {{ number_format($product->rating, 1) }}
                        @include('user.svgs.rating-star-warning-svg')
                    </span>
                    <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                        @include('user.svgs.animated-hear-svg')
                    </button>
                </div>
            </div>
            <div class="mb-3">
                <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                    <a href="{{ route('product.show', $product->slug) }}">{{ $product->title }}</a>
                </h3>
                <p class="mb-0 lh-1 text-dark fw-semibold">PKR {{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mb-4">
                @foreach ($product->colors as $key => $color)
                    <input type="radio" class="btn-check" name="colors{{ $product->id }}"
                        id="color{{ $color->id }}" @checked($key == 0) />

                    <label for="color{{ $color->id }}" class="btn-color-swatch" data-label="{{ $color->title }}">
                        <span class="icon-shape icon-xxs bg-{{ $color->color_class }}"></span>
                        <span class="visually-hidden">{{ $color->title }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
@empty
    <div class="col-12 text-center py-5">
        <h3>No products found</h3>
    </div>
@endforelse

@push('scripts')
    <script>
        // Debug quick add functionality
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Product grid loaded');

            // Test localStorage access
            try {
                localStorage.setItem('test', 'test');
                console.log('localStorage is working');
                localStorage.removeItem('test');
            } catch (e) {
                console.error('localStorage error:', e);
            }

            // Log current cart state
            console.log('Current cart items:', localStorage.getItem('cartItems'));
            console.log('Current quick buy count:', localStorage.getItem('quickBuyCount'));
        });
    </script>
@endpush
