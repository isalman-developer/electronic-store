<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body>
    <!-- START Wrapper -->
    <div class="wrapper">

        <!-- Topbar Start -->
        @include('admin.partials.header')
        <!-- Activity Timeline -->

        @include('admin.partials.activity')

        <!-- Topbar End -->

        <!-- App Menu Start -->
        @include('admin.partials.navbar')
        <!-- App Menu End -->

        <!-- Page Content Start -->
        <div class="page-content">
            {{-- showing all of the errors here --}}
            @if ($errors->any())
                <div class="container-xxl alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Start Container Fluid -->
            @yield('content')
            <!-- End Container Fluid -->

            <!-- Footer Start -->
            @include('admin.partials.footer')
            <!-- Footer End -->

        </div>
        <!-- End Page Content -->

    </div>
    <!-- END Wrapper -->
    @include('admin.partials.scripts')
    <!-- Toast container for notifications -->
    <div class="toast-container position-fixed top-0 end-0 p-3"></div>
</body>

</html>
