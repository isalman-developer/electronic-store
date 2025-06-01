@extends('admin.layouts.app')

@section('title', 'Settings List')
@section('toogle-button', 'Settings List')
@section('content')
    <!-- Start Container Fluid -->
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Settings</h4>

                        <a href="{{ route('admin.settings.create') }}" class="btn btn-sm btn-primary">
                            Add Settings
                        </a>

                        <a href="{{ route('admin.settings.edit') }}" class="btn btn-sm btn-light">
                            Edit Settings
                        </a>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>ID</th>
                                        <th>Key</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $setting)
                                        <tr>
                                            <td>{{ $setting->id }}</td>
                                            <td>{{ $setting->key }}</td>
                                            <td>{{ $setting->value }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{ route('admin.settings.destroy', $setting->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm">
                                                            <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                class="align-middle fs-18">
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
                </div>
            </div>
        </div>
    </div>
    <!-- End Container Fluid -->
@endsection
