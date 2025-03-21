@extends('admin.layouts.app')

@section('title', 'Products List')
@section('toogle-button', 'Products List')
@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center gap-1">
          <h4 class="card-title flex-grow-1">All Products</h4>

          <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
            Add Product
          </a>
        </div>
        <div>
          <div class="table-responsive">
            <table class="table align-middle mb-0 table-hover table-centered">
              <thead class="bg-light-subtle">
                <tr>
                  <th>ID</th>
                  <th>Product</th>
                  <th>Tag #</th>
                  <th>Price</th>
                  <th>Stock</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr>
                  <td>{{ $product->id }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="rounded bg-light avatar-lg d-flex align-items-center justify-content-center">
                        <img src="{{ getSingleImageUrl($product) }}" alt="{{ $product->title }} - product Image" class="rounded avatar-lg">
                      </div>
                      <div>
                        <a href="{{ route('admin.products.show', $product->id)}}" class="text-dark fw-medium fs-15">{{ $product->title }}</a>
                        <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>
                          {{ $product->sizes->pluck('title')->join(' , ') }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td>{{ $product->tag_number ?? '' }}</td>
                  <td>$ {{ $product->price ?? '' }}</td>
                  <td>
                    <p class="mb-1 text-muted">
                      <span class="text-dark fw-medium"> {{ $product->stock }} Item</span> Left
                    </p>
                    <p class="mb-0 text-muted">{{ $product->stock }} Sold</p>
                  </td>
                  <td>{{ $product->category->title }}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-light btn-sm">
                        <iconify-icon icon="solar:eye-broken" class="align-middle fs-18">
                        </iconify-icon>
                      </a>

                      <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-soft-primary btn-sm">
                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18">
                        </iconify-icon>
                      </a>

                      <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-soft-danger btn-sm">
                          <iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18">
                          </iconify-icon>
                        </button>
                      </form>

                    </div>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
          <!-- end table-responsive -->
        </div>
        <div class="card-footer border-top">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-end mb-0">
              <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
              <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
              <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- End Container Fluid -->
@endsection
