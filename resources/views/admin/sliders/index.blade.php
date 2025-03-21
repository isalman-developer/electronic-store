@extends('admin.layouts.app')

@section('title', 'Sliders List')
@section('toogle-button', 'Sliders List')
@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center gap-1">
          <h4 class="card-title flex-grow-1">All Sliders</h4>

          <a href="{{ route('admin.sliders.create') }}" class="btn btn-sm btn-primary">
            Add slider
          </a>
        </div>
        <div>
          <div class="table-responsive">
            <table class="table align-middle mb-0 table-hover table-centered">
              <thead class="bg-light-subtle">
                <tr>
                  <th>ID</th>
                  <th>Slider</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($sliders as $slider)
                <tr>
                  <td>{{ $slider->id }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <a href="{{ route('admin.sliders.show', $slider->id) }}" class="rounded bg-light avatar-lg d-flex align-items-center justify-content-center">
                        <img src="{{ getSingleImageUrl($slider) }}" alt="{{ $slider->title }} - slider Image" class="rounded avatar-lg">
                      </a>
                      <a href="{{ route('admin.sliders.show', $slider->id) }}" class="text-dark fw-medium fs-15 mb-0">
                        {{ $slider->title }}
                      </a>
                    </div>
                  </td>
                  <td>{{ $slider->status == 1 ? 'Active' : 'In Active' }}</td>
                  <td>
                    <div class="d-flex gap-2">
                      <a href="{{ route('admin.sliders.show', $slider->id) }}" class="btn btn-light btn-sm">
                        <iconify-icon icon="solar:eye-broken" class="align-middle fs-18">
                        </iconify-icon>
                      </a>

                      <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="btn btn-soft-primary btn-sm">
                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18">
                        </iconify-icon>
                      </a>

                      <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
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
