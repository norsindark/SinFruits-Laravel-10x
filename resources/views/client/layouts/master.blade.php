<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>SinFruits</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/favicon.ico')}}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font.awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/ionicons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />

</head>

<body>

    <div class="home-wrapper home-1">

        {{-- ========== header =========== --}}
        @include('client.layouts.menu')

        {{-- ========== header =========== --}}

        @yield('content')

        {{-- ========Footer======== --}}
        @include('client.layouts.footer')
        {{-- ========Footer======== --}}

    </div>

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="ion-chevron-up"></i>
    </a>


    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
