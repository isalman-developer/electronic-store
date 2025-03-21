@extends('admin.layouts.app')
@section('title', 'Create Product')
@section('toogle-button', 'Create Product')

@push('page-style')
@include('admin.partials.image-input-style')
@endpush

@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="row">
    @csrf
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">General Information</h4>
            {{ showValidationMessage($errors->first('images')) }}
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 mb-3">
                <label for="product-title" class="form-label">Product Title</label>
                <input type="text" id="product-title" name="title" required class="@error('title') is-invalid @enderror form-control" placeholder="Heater">
                {{ showValidationMessage($errors->first('title')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="@error('category_id') is-invalid @enderror form-control" id="category" name="category_id" required>
                  <option value="" disabled selected>Select Category</option>
                  @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->title }}</option>
                  @endforeach
                </select>
                {{ showValidationMessage($errors->first('category_id')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="@error('status') is-invalid @enderror form-control" id="status" name="status" required>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
                {{ showValidationMessage($errors->first('status')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="brand-title" class="form-label">Brand </label>
                <input type="text" id="brand-title" name="brand" required class="@error('brand') is-invalid @enderror form-control" placeholder="Seco">
                {{ showValidationMessage($errors->first('brand')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="tag-number" class="form-label">Tag Number</label>
                <input type="text" id="tag-number" name="tag_number" required class="@error('tag_number') is-invalid @enderror form-control" placeholder="HTR112">
                {{ showValidationMessage($errors->first('tag_number')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="price-id" class="form-label">Price (RS)</label>
                <input type="number" id="price-id" name="price" step="0.01" min="0" required class="@error('price') is-invalid @enderror form-control" placeholder="1250">
                {{ showValidationMessage($errors->first('price')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="product-weight" class="form-label">Weight (KG)</label>
                <input type="number" id="product-weight" name="weight" class="@error('weight') is-invalid @enderror form-control" placeholder="2">
                {{ showValidationMessage($errors->first('weight')) }}
              </div>

              <div class="col-lg-3 mb-3">
                <label for="stock-id" class="form-label">Stock</label>
                <input type="number" id="stock-id" name="stock" step="0.01" min="0" class="@error('stock') is-invalid @enderror form-control" placeholder="100">
                {{ showValidationMessage($errors->first('stock')) }}
              </div>

              <div class="row mb-3">
                <!-- Sizes Section -->
                <div class="col-lg-3">
                  <h5 class="text-dark fw-medium">Size:</h5>
                  <div class="d-flex flex-wrap gap-2" role="group" aria-label="Size selection">
                    @foreach ($sizes as $size)
                    <input type="checkbox" class="btn-check" value="{{ $size->id }}" id="size-{{ strtolower($size->title) }}" name="sizes[]">
                    <label for="size-{{ strtolower($size->title) }}" class="btn btn-light avatar-sm rounded d-flex justify-content-center align-items-center">
                      {{ $size->title }}
                    </label>
                    @endforeach
                  </div>
                  {{ showValidationMessage($errors->first('sizes')) }}
                </div>

                <!-- Colors Section -->
                <div class="col-9">
                  <h5 class="text-dark fw-medium">Colors:</h5>
                  <div class="d-flex flex-wrap gap-2" role="group" aria-label="Color selection">
                    @foreach ($colors as $color)
                    <input type="checkbox" class="btn-check" value="{{ $color->id }}" id="color-{{ strtolower($color->title) }}" name="colors[]">
                    <label class="btn btn-light avatar-m rounded d-flex justify-content-center align-items-center" for="color-{{ strtolower($color->title) }}">
                      {{ $color->title }}&nbsp;
                      <i class="bx bxs-circle fs-18 text-{{ $color->color_class }}"></i>
                    </label>
                    @endforeach
                  </div>
                  {{ showValidationMessage($errors->first('colors')) }}
                </div>
              </div>


              <div class="col-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control bg-light-subtle @error('description') is-invalid @enderror" id="description" rows="7" placeholder="Type description" name="description"></textarea>
                {{ showValidationMessage($errors->first('description')) }}
              </div>

            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Media Options</h4>
          </div>

          <div class="card-body">
            <div class="image-upload-container">
              <div class="upload-area" id="uploadArea">
                <div class="drop-zone">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="upload-icon">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                      <polyline points="17 8 12 3 7 8"></polyline>
                      <line x1="12" y1="3" x2="12" y2="15">
                      </line>
                    </svg>
                  </div>
                  <p class="drop-text">
                    Drop your images here, or
                    <span class="browse-text">click to browse</span>
                  </p>
                  <p class="file-info">
                    PNG, JPG and GIF files are allowed
                  </p>
                  <input type="file" id="fileInput" name="images[]" class="file-input" accept="image/png,image/jpeg,image/gif,image/jpg" required multiple />
                </div>
              </div>
              {{ showValidationMessage($errors->first('images')) }}
              <div class="preview-container" id="previewContainer"></div>
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
                  <input type="text" id="meta-title" class="@error('meta_title') is-invalid @enderror form-control" placeholder="Buy Heaters Online | Seco Store" name="meta_title">
                  {{ showValidationMessage($errors->first('meta_title')) }}
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="meta-keywords" class="form-label">Meta Keywords</label>
                  <input type="text" id="meta-keywords" name="meta_keywords" class="@error('meta_keywords') is-invalid @enderror form-control" placeholder="heaters, heating systems, CoolHeat Store, buy seco heaters online">
                  {{ showValidationMessage($errors->first('meta_keywords')) }}
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-0">
                  <label for="meta-description" class="form-label">Meta Description</label>
                  <textarea class="form-control bg-light-subtle" id="@error('meta_description') is-invalid @enderror meta-description" rows="4" placeholder="Shop top-quality heaters at Seco Store..." name="meta_description"></textarea>
                  {{ showValidationMessage($errors->first('meta_description')) }}
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="p-3 bg-light mb-3 rounded">
              <div class="row justify-content-end g-2">
                <div class="col-lg-3 offset-6">
                  <button class="btn btn-primary w-100">Cancel</button>
                </div>
                <div class="col-lg-3">
                  <button type="submit" class="btn btn-secondary w-100">Save</button>
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
