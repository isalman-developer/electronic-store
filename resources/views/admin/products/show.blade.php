@extends('admin.layouts.app')

@section('title', 'Products List')
@section('toogle-button', 'Products List')

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
<!-- Start Container Fluid -->
<div class="container-xxl">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <!-- Product Images Section -->
            <div class="col-xl-6">
              <div class="">
                <div class="row">
                  <div class="col-4 col-sm-3 col-md-2 side-images-div">
                    <ul class="flex-column nav">
                      @foreach ($product->media as $key => $media)
                      <li class="nav-item mb-1">
                        <a class="active">
                          <img src="{{ asset('storage/'.$media->file_path) }}" alt="" onclick="changeMainImage('{{ asset('storage/'.$media->file_path) }}')" class="img-fluid mx-auto d-block rounded">
                        </a>
                      </li>
                      @endforeach
                    </ul>
                    @if(count($product->media) * 100 > 480)
                    <!-- Assuming each image takes approximately 100px height -->
                    <div class="more-images-div">
                      <span class="badge text-dark bg-white">More images <span style="font-size: 1rem">&#8659;</span> </span>
                    </div>
                    @endif
                  </div>
                  <div class="offset-md-1 col-8 col-sm-9 col-md-7">
                    <div class="tab-content">
                      <div class="tab-pane active">
                        <div>
                          <img id="mainProductImage" src="{{ getFirstImageUrl($product) }}" alt="" class="img-fluid mx-auto d-block">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right side - Product Info -->
            <div class="col-lg-6">
              <div class="ps-lg-3">
                <a class="text-primary text-decoration-none" href="{{ route('admin.categories.index') }}">{{ $product->category->title }}</a>
                <h4 class="mt-1 mb-3">{{ $product->title }}</h4>

                <!-- Stars and reviews -->
                <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="fas fa-star text-warning"></i>
                    <i class="far fa-star text-secondary"></i>
                  </div>
                  <span class="text-muted small">( 0 Customers Review )</span>
                </div>

                <!-- Price info -->
                <div class="mb-3">
                  <span class="badge bg-success">5 % OFF</span>
                </div>
                <h5 class="mb-4">Price :
                  <span class="text-muted me-2">
                    <del>$0.00</del>
                  </span>
                  <b>${{ $product->price }}</b>
                </h5>

                <!-- Product description -->
                <p class="text-muted mb-4">
                  {{ $product->description }}
                </p>

                <!-- Features in two columns -->
                <div class="row mb-4">
                  <div class="col-md-6">
                    <p class="mb-2 text-muted">
                      <i class="bi bi-caret-right font-size-16 align-middle text-primary">&#xf0da;</i>
                      <b>Brand :</b> {{ $product->brand->title }}
                    </p>
                    <p class="mb-2 text-muted">
                      <i class="bi bi-caret-right font-size-16 align-middle text-primary">&#xf0da;</i>
                      <b>Stock :</b> {{ $product->stock }}
                    </p>
                    <p class="mb-2 text-muted">
                      <i class="bi bi-caret-right font-size-16 align-middle text-primary">&#xf0da;</i>
                      <b>Weight :</b> {{ $product->weight }}
                    </p>
                  </div>
                  <div class="col-md-6">
                    <p class="mb-2 text-muted">
                      <i class="bi bi-caret-right font-size-16 align-middle text-primary">&#xf0da;</i>
                      <b>Tag # : </b> {{ $product->tag_number }}
                    </p>
                    <p class="mb-2 text-muted">
                      <i class="bi bi-caret-right font-size-16 align-middle text-primary">&#xf0da;</i>
                      <b>Status : </b> {{ getStatus($product->status) }}
                    </p>
                  </div>
                </div>

                <!-- Color options -->
                <div class="mb-4">
                  <h5 class="mb-3">Color :</h5>
                  <div class="d-flex gap-3">
                    @foreach ($product->colors as $color)
                    <input type="checkbox" class="btn-check" value="{{ $color->id }}" id="color-{{ strtolower($color->title) }}" name="colors[]">
                    <label class="btn btn-light avatar-m rounded d-flex justify-content-center align-items-center" for="color-{{ strtolower($color->title) }}">
                      {{ $color->title }}&nbsp;
                      <i class="bx bxs-circle fs-18 text-{{ $color->color_class }}"></i>
                    </label>
                    @endforeach
                  </div>
                </div>

                <!-- Size options -->
                <div class="mb-4">
                  <h5 class="mb-3">Size :</h5>
                  <div class="d-flex gap-3">
                    @foreach ($product->sizes as $size)
                    <input type="checkbox" class="btn-check" value="{{ $size->id }}" id="size-{{ strtolower($size->title) }}" name="sizes[]">
                    <label for="size-{{ strtolower($size->title) }}" class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center">
                      {{ $size->title }}
                    </label>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>

          <!-- Specifications section -->
          <div class="mt-2">
            <h5 class="mb-3">Specifications :</h5>
            <div class="table-responsive">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th scope="row" class="text-capitalize" style="width: 400px;">Category</th>
                    <td>{{ $product->category->title }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-capitalize" style="width: 400px;">Brand</th>
                    <td>{{ $product->brand }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-capitalize" style="width: 400px;">Size</th>
                    <td>{{ $product->sizes->pluck('title')->join(' , ') }}</td>
                  </tr>
                  <tr>
                    <th scope="row" class="text-capitalize" style="width: 400px;">Color</th>
                    <td>{{ $product->colors->pluck('title')->join(' , ') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Meta Detail</h4>
        </div>
        <div class="card-body">
          <div class="">
            <ul class="d-flex flex-column gap-2 list-unstyled fs-14 text-muted mb-0">
              <li><span class="fw-medium text-dark">Meta Title</span><span class="mx-2">:</span>{{ $product->meta_title }}</li>
              <li><span class="fw-medium text-dark">Meta Keywords</span><span class="mx-2">:</span>{{ $product->meta_keywords }}</li>
              <li><span class="fw-medium text-dark">Meta Description</span><span class="mx-2">:</span>{{ $product->meta_description }}</li>
            </ul>
          </div>
          <div class="mt-3">
            <a href="#!" class="link-primary text-decoration-underline link-offset-2">View More Details <i class="bx bx-arrow-to-right align-middle fs-16"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Top Review From World</h4>
        </div>
        <div class="card-body">
          <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('admin/assets/images/users/avatar-6.jpg') }}" alt="" class="avatar-md rounded-circle">
            <div>
              <h5 class="mb-0">Henny K. Mark</h5>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2 mt-3 mb-1">
            <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star-half"></i>
              </li>
            </ul>
            <p class="fw-medium mb-0 text-dark fs-15">Excellent Quality</p>
          </div>

          <p class="mb-0 text-dark fw-medium fs-15">Reviewed in Canada on 16 November 2023</p>
          <p class="text-muted">Medium thickness. Did not shrink after wash. Good elasticity . XL size Perfectly fit for 5.10 height and heavy body. Did not fade after wash. Only for maroon colour t-shirt colour lightly gone in first wash but not faded. I bought 5 tshirt of different colours. Highly recommended in so low price.</p>
          <div class="mt-2">
            <a href="#!" class="fs-14 me-3 text-muted"><i class="bx bx-like"></i> Helpful</a>
            <a href="#!" class="fs-14 text-muted">Report</a>
          </div>

          <hr class="my-3">

          <div class="d-flex align-items-center gap-2">
            <img src="{{ asset('admin/assets/images/users/avatar-4.jpg') }}" alt="" class="avatar-md rounded-circle">
            <div>
              <h5 class="mb-0">Jorge Herry</h5>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2 mt-3 mb-1">
            <ul class="d-flex text-warning m-0 fs-20 list-unstyled">
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star"></i>
              </li>
              <li>
                <i class="bx bxs-star-half"></i>
              </li>
            </ul>
            <p class="fw-medium mb-0 text-dark fs-15">Good Quality</p>
          </div>

          <p class="mb-0 text-dark fw-medium fs-15">Reviewed in U.S.A on 21 December 2023

          </p>
          <p class="text-muted mb-0">I liked the tshirt, it's pure cotton &amp; skin friendly, but the size is smaller to compare standard size.</p>
          <p class="text-muted mb-0">best rated</p>

          <div class="mt-2">
            <a href="#!" class="fs-14 me-3 text-muted"><i class="bx bx-like"></i> Helpful</a>
            <a href="#!" class="fs-14 text-muted">Report</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Container Fluid -->

@endsection
@push('page-script')
<script>
  function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
  }

</script>
@endpush
