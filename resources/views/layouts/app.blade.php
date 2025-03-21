<!doctype html>
<html lang="en">

<head>
  @include('partials.head')
  @livewireStyles
</head>


<body>
  @include('partials.promotional-top-stripe')

  @yield('content')

  <!--Footer start-->
  @include('partials.footer')
  <!--Footer end-->

  <!-- Scroll top -->
  @include('partials.scroll-top')
  <!-- Scroll top -->

  <!-- search modal -->
  @include('partials.search-modal')

  <!-- Offcanvas for Cart Summary -->
  @include('partials.cart')

  <!-- Libs JS -->
  @include('partials.scripts')
  {{ $slot ?? '' }}
  @livewireScripts
</body>

</html>
