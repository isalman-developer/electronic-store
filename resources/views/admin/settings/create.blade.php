@extends('admin.layouts.app')

@section('title', 'Create Setting')
@section('toogle-button', 'Create Setting')
@section('content')
<!-- Start Container Fluid -->
<div class="container-xxl">
  <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Setting Information</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="setting-key" class="form-label">Setting Key</label>
                  <input type="text" id="setting-key" class="form-control" placeholder="Site Name" name="key" required>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="setting-value" class="form-label">Setting Value</label>
                  <input type="text" id="setting-value" class="form-control" placeholder="My E-commerce Site" name="value" required>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="p-3 bg-light mb-3 rounded">
              <div class="row justify-content-end g-2">
                <div class="col-lg-auto">
                  <a href="{{ route('admin.settings.index') }}" class="btn btn-primary">Cancel</a>
                </div>
                <div class="col-lg-auto">
                  <button type="submit" class="btn btn-outline-secondary">Save</button>
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
