@extends('admin.layouts.app')

@section('title', 'Create Slider')
@section('toogle-button', 'Create Slider')

@push('page-style')
@include('admin.partials.image-input-style')
@endpush

@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-xl-8 col-lg-8">

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">General Information</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 mb-3">
                <label for="slider-title" class="form-label">Slider Title</label>
                <input type="text" id="slider-title" class="form-control @error('title') is-invalid @enderror" placeholder="Heater" name="title" required value="{{ old('title') }}">
                {{ showValidationMessage($errors->first('title')) }}
              </div>

              <div class="col-lg-6 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-control @error('status') is-invalid @enderror" id="status" data-choices data-choices-groups data-placeholder="Select Status" name="status" required>
                  <option value="1" @selected(old('status')==1)>Active</option>
                  <option value="0" @selected(old('status')==1)>In Active</option>
                </select>
                {{ showValidationMessage($errors->first('status')) }}
              </div>
              <div class="col-lg-12 mb-3">
                <label for="redirect_link" class="form-label">Redirect Link</label>
                <input type="text" id="slider-redirect-link" class="form-control @error('redirect_link') is-invalid @enderror" placeholder="https://seco.com.pk/products" name="redirect_link" required value="{{ old('redirect_link') }}">
                {{ showValidationMessage($errors->first('redirect_link')) }}
              </div>

              <div class="col-lg-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror bg-light-subtle" id="description" rows="7" placeholder="Type description" name="description">{{ old('description') }}</textarea>
                {{ showValidationMessage($errors->first('description')) }}
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
                    600 x 600 recommended.
                  </p>
                  <p>
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
