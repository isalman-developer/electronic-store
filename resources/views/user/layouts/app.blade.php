<!doctype html>
<html lang="en">

<head>
    @include('user.partials.head')
    @livewireStyles
</head>

<body>
    @include('user.partials.promotional-top-stripe')

    @include('user.partials.navbar')

    @yield('content')

    @include('user.partials.footer')

    @include('user.partials.scroll-top')

    @include('user.partials.search-modal')

    @include('user.partials.cart')

    @include('user.partials.scripts')
    {{ $slot ?? '' }}
    @livewireScripts
</body>

</html>
