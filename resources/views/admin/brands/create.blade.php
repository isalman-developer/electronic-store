@extends('admin.layouts.app')

@section('title', 'Create Brand')
@section('toogle-button', 'Create Brand')
@push('page-style')
@include('admin.partials.image-input-style')
@endpush
@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-xl-8 col-lg-8">

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">General Information</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="brand-title" class="form-label">Brand Title</label>
                  <input type="text" id="brand-title" class="form-control" placeholder="Heater" name="title" required>
                </div>
              </div>

              <div class="col-lg-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" data-choices data-choices-groups data-placeholder="Select Status" name="status" required>
                  <option value="1">Active</option>
                  <option value="0">In Active</option>
                </select>
              </div>
              <div class="col-lg-12">
                <div class="mb-0">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control bg-light-subtle" id="description" rows="7" placeholder="Type description" name="description"></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Meta Options</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="meta-title" class="form-label">Meta Title</label>
                  <input type="text" id="meta-title" class="form-control" placeholder="Buy Heaters Online | Seco Store" name="meta_title">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="meta-keywords" class="form-label">Meta Keywords</label>
                  <input type="text" id="meta-keywords" class="form-control" placeholder="heaters, heating systems, CoolHeat Store, buy seco heaters online" name="meta_keywords">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-0">
                  <label for="meta-description" class="form-label">Meta Description</label>
                  <textarea class="form-control bg-light-subtle" id="meta-description" rows="4" placeholder="Shop top-quality heaters at Seco Store..." name="meta_description"></textarea>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-lg-4">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add Thumbnail Photo</h4>
          </div>
          <div class="card-body">
            <div class="image-upload-container">
              <div class="upload-area" id="uploadArea">
                <div class="drop-zone">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="upload-icon">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                      <polyline points="17 8 12 3 7 8"></polyline>
                      <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                  </div>
                  <p class="drop-text">
                    Drop your images here, or
                    <span class="browse-text">
                      click to browse
                    </span>
                  </p>
                  <p class="file-info">
                    PNG, JPG and GIF files are allowed
                  </p>
                  <input type="file" id="fileInput" name="image" class="file-input" accept="image/png,image/jpeg,image/gif,image/jpg" required />
                </div>
              </div>

              <div class="preview-container" id="previewContainer"></div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="p-3 bg-light mb-3 rounded">
              <div class="row justify-content-end g-2">
                <div class="col-lg">
                  <button class="btn btn-primary w-100">Cancel</button>
                </div>
                <div class="col-lg">
                  <button type="submit" class="btn btn-outline-secondary w-100">Save</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- End Container Fluid -->
@endsection
@push('page-script')
@include('admin.partials.image-input-script')
@endpush
