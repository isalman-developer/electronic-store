<!-- App favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon_io/apple-touch-icon.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon_io/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon_io/favicon-16x16.png')}}">
<link rel="manifest" href="{{asset('favicon_io/site.webmanifest')}}">


<!-- Vendor css (Require in all Page) -->
<link href="{{ asset('admin/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Icons css (Require in all Page) -->
<link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App css (Require in all Page) -->
<link href="{{ asset('admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Theme Config js (Require in all Page) -->
<script src="{{ asset('admin/assets/js/config.js') }}"></script>

@stack('page-style')
