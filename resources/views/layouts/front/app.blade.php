<!DOCTYPE html>
<html lang="pt-BR" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme">

<head>
    <!-- impedir bots -->
    <meta name="robots" content="noindex, nofollow">

    <title>HippoNotify - @yield('title') </title>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon-hippo.png') }}" />
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-custom.css') }}" />
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/front.css') }}" />
    @yield('head')
    @yield('style')
</head>

<body>

    <header>
        @include('layouts.front.partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/moment-js/build/moment.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Outros scripts -->
    @yield('scripts')

    <!-- Outros scripts -->
    @yield('scripts')

</body>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/67caa7e9cad1b51909e8c617/1ilnpvqps';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>
<!--End of Tawk.to Script-->

</html>
