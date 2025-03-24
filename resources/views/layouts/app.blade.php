<!doctype html>
<html lang="en">

<head>
    @include('partials.head')
    @livewireStyles
</head>

<body>
    @include('partials.promotional-top-stripe')

    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    @include('partials.scroll-top')

    @include('partials.search-modal')

    @include('partials.cart')

    @include('partials.scripts')
    {{ $slot ?? '' }}
    @livewireScripts
</body>

</html>
