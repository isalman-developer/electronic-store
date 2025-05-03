@extends('user.layouts.app')

@section('title', 'Shop Products')
@section('meta_description', 'Browse our collection of products')

@push('page-style-bottom')
@endpush

@section('content')
<!--Pageheader start-->
<section class="bg-light d-flex flex-column align-items-center justify-content-center" style=" background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.22)), url({{ asset('user/images/jpg/page-header-img.jpg') }}) no-repeat;
            background-position: center; background-size: cover; ">
  <div class="container">
    <div class="row align-items-center py-6">
      <div class="col-lg-6">

        <div class="position-relative z-1">
          <h1 class="mb-4 text-white">Office</h1>
          <p class="lead text-white">As everyone heads back to work, whether that be into the office or
            the classroom, having an organized desk space is essential.</p>
        </div>
      </div>
    </div>
  </div>
  <div class="w-lg-50 w-100 position-absolute end-0 top-0 object-fit-cover"></div>
</section>
<!--Pageheader end-->
<!--Breadcrumb start-->
<div class="container">
  <div class="row">
    <div class="col-12 py-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-6">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
          @if (isset($category))
          <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
          @endif
          @if (isset($brand))
          <li class="breadcrumb-item active" aria-current="page">{{ $brand->title }}</li>
          @endif
        </ol>
      </nav>
    </div>
  </div>
</div>
<!--Breadcrumb end-->
<!--Filter button start-->
<div class="position-fixed bottom-0 start-50 translate-middle d-block d-lg-none z-1">
  <a class="btn btn-dark d-flex align-items-center gap-2" data-bs-toggle="offcanvas" href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory">
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
        <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 border-end-0" tabindex="-1" id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">

          <div class="offcanvas-header d-lg-none">
            <h5 class="offcanvas-title" id="offcanvasCategoryLabel">
              Filter
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
            </button>
          </div>

          <div class="offcanvas-body ps-lg-2 pt-lg-0">
            <!-- Categories -->
            <div class="mb-4">
              <h6 class="mb-3">Product Type</h6>
              <ul class="list-unstyled mb-0 border-bottom">
                @foreach ($categories as $cat)
                <li class="mb-2">
                  <a href="{{ route('product.category', $cat->slug) }}" class="text-decoration-none {{ isset($category) && $category->id == $cat->id ? 'fw-bold text-primary' : 'text-dark' }}">
                    {{ $cat->title }}
                  </a>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Brands -->
            <div class="mb-4">
              <h6 class="mb-3">Brands</h6>
              <ul class="list-unstyled mb-0 border-bottom">
                @foreach ($brands as $b)
                <li class="mb-2">
                  <a href="{{ isset($category) ? route('product.category.brand', [$category->slug, $b->slug]) : route('product.brand', $b->slug) }}" class="text-decoration-none {{ isset($brand) && $brand->id == $b->id ? 'fw-bold text-primary' : 'text-dark' }}">
                    {{ $b->title }}
                  </a>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Colors -->
            <div class="mb-4">
              <h6 class="mb-3">Colors</h6>
              <div class="collapse show" id="collapseColor" style="height: 180px" data-simplebar>
                @foreach ($colors as $color)
                <div class="form-check mb-2">
                  <input class="form-check-input filter-checkbox color-filter" type="checkbox" name="colors[]" id="color{{ $color->id }}" value="{{ $color->slug }}" {{ in_array($color->slug, (array) request('colors')) ? 'checked' : '' }}>

                  <label class="form-check-label" for="color{{ $color->id }}">
                    <span class="d-inline-block rounded-circle me-2 border-black" style="width: 16px; height: 16px; {{ $color->title == 'White' ? 'border: 2px solid #233122;' : '' }} background-color: {{ $color->hex_code }}"></span>
                    {{ $color->title }}
                  </label>
                </div>
                @endforeach
              </div>
            </div>

            <!--Price-->
            <div class="mb-3 border-bottom pb-3">
              <h5 class="mb-0 fs-6">Price</h5>
              <div>
                <div class="mt-3">
                  <div class="d-flex align-items-center gap-2">
                    <input type="number" class="form-control form-control-sm" id="minPrice" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                    <span>-</span>
                    <input type="number" class="form-control form-control-sm" id="maxPrice" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                  </div>
                </div>
              </div>
            </div>

            <!--Rating-->
            <div class="mb-4">
              <h6 class="mb-3">Rating</h6>
              <div>
                @for ($i = 5; $i >= 1; $i--)
                <div class="form-check mb-2">
                  <input class="form-check-input filter-radio" type="radio" name="rating" id="rating{{ $i }}" value="{{ $i }}" {{ request('rating') == $i ? 'checked' : '' }}>
                  <label class="form-check-label" for="rating{{ $i }}">
                    @for ($j = 1; $j <= 5; $j++) <i class="bi {{ $j <= $i ? 'bi-star-fill' : 'bi-star' }} text-warning"></i>
                      @endfor
                      {{ $i }} & Up
                  </label>
                </div>
                @endfor
              </div>
            </div>
          </div>
      </aside>
      <div class="col-lg-9">
        <div class="row">
          <div class="col-12">
            <!--Selected filter-->
            <div class="mb-4 d-flex flex-column flex-lg-row flex-row justify-content-between gap-4">
              <div class="d-flex gap-2 flex-wrap align-items-center" id="active-filters">

                @if (!empty($filters['colors'] ?? []))
                @foreach ($colors as $color)
                @if (in_array($color->slug, (array) $filters['colors']))
                <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag" data-filter="color" data-value="{{ $color->slug }}">
                  {{ $color->title }}
                  <i class="bi bi-x lh-1"></i>
                </button>
                @endif
                @endforeach
                @endif

                @if (isset($brand) && !request()->routeIs('product.brand'))
                <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag" data-filter="brand">
                  {{ $brand->title }}
                  <i class="bi bi-x lh-1"></i>
                </button>
                @endif

                @if (isset($category) && !request()->routeIs('product.category'))
                <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag" data-filter="category">
                  {{ $category->title }}
                  <i class="bi bi-x lh-1"></i>
                </button>
                @endif

                @if (request('price'))
                <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag" data-filter="price">
                  ${{ (explode('-', request('price'))[0] ?? '0') }}
                  <i class="bi bi-x lh-1"></i>
                </button>
                @endif

                @if (request('rating'))
                <button type="button" class="btn btn-sm btn-light d-flex align-items-center gap-2 filter-tag" data-filter="rating">
                  {{ request('rating') }}⭐ & Up
                  <i class="bi bi-x lh-1"></i>
                </button>
                @endif

                @if (request('colors') || request('price') || request('rating'))
                <button type="button" id="clearFilters" class="btn btn-sm btn-focus-none">Clear
                  all</button>
                @endif
              </div>
              <div class="col-sm-4 col-xxl-3">
                <select class="form-select form-select-sm" id="sortSelect" name="sort">
                  <option value="">Sort by: Featured</option>
                  <option value="Best-selling" {{ request('sort') == 'Best-selling' ? 'selected' : '' }}>Best selling</option>
                  <option value="Alphabetically-A-Z" {{ request('sort') == 'Alphabetically-A-Z' ? 'selected' : '' }}>Alphabetically,
                    A-Z</option>
                  <option value="Alphabetically-Z-A" {{ request('sort') == 'Alphabetically-Z-A' ? 'selected' : '' }}>Alphabetically,
                    Z-A</option>
                  <option value="Price-low-to-high" {{ request('sort') == 'Price-low-to-high' ? 'selected' : '' }}>Price, low to
                    high</option>
                  <option value="Price-high-to-low" {{ request('sort') == 'Price-high-to-low' ? 'selected' : '' }}>Price, high to
                    low</option>
                  <option value="Date-old-to-new" {{ request('sort') == 'Date-old-to-new' ? 'selected' : '' }}>Date, old to new
                  </option>
                  <option value="Date-new-to-old" {{ request('sort') == 'Date-new-to-old' ? 'selected' : '' }}>Date, new to old
                  </option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row gy-6 gx-4" id="products-container">
          @include('user.products.partials.product-grid')
        </div>
        <div class="col-12 mt-8">
          {{ $products->links() }}
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body p-5">
        <!-- Close button -->
        <div class="position-absolute top-0 start-100 translate-middle mt-n4 ms-4 bg-white p-1 d-flex align-items-center justify-content-center">
          <button type="button" class="btn-close opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script src="{{ asset('user/js/product-filter.js') }}"></script>
@endpush
