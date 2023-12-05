<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}" type="text/css">
    @yield('title_meta')

    @yield('css')

    {{-- @vite('resources/js/app.js') --}}
    @yield('vite-web')

</head>
<body>

     <!-- Page Preloder -->
     <div id="preloder">
        <div class="loader"></div>
    </div>

     <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    @include('layout.web.canvas-menu')

    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    @include('layout.web.header')
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    @yield('breadcrumb')
    <!-- Breadcrumb Section End -->

    {{-- @section('content')
         <home-component />

    @show --}}

    @hasSection('content')
        @yield('content')
    @else
        @include('layout.web.home')
        {{-- <div id="main-home-page">
            <home-component />
        </div> --}}
    @endif

    @include('layout.web.footer')

    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>

  <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
  <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
  <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('frontend/js/main.js') }}"></script>
  @yield('js')

  {{-- @section('vite-web')
    @vite('resources/js/webs/pages/homes/home.js')
  @stop --}}
  
</body>
</html>
