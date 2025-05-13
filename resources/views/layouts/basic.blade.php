<!DOCTYPE html>
<html lang="pt-BR" dir="ltr" data-bs-theme="{{ isset($_COOKIE['tema']) ? $_COOKIE['tema'] : 'light' }}"
    data-color-theme="Blue_Theme">

<head>
    <!-- impedir bots -->
    <meta name="robots" content="noindex, nofollow">

    <title>HippoNotify - @yield('title') </title>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- SetTheme -->
    <script src="{{ asset('assets/js/settheme.js') }}"></script>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon-hippo.png') }}" />
    <!-- Core Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" />
    {{-- TODO: talvez remover a dependência de datatable --}}
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <!-- Toastify -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Sweetalert2 -->
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <!-- custom style -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-custom.css') }}" />
    @yield('head')
    @yield('style')
    @if (isset($_COOKIE['tema']) && $_COOKIE['tema'] == 'dark')
        <style>
            .preloader {
                background-color: #2a3447
            }
        </style>
    @endif
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('assets/images/logos/favicon-hippo.png') }}" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <div id="main-wrapper">
        <aside class="left-sidebar with-vertical">
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="logo-azul-lg"
                            alt="Logo-Dark" />
                        <img src="{{ asset('assets/images/logos/logo-mini.png') }}" class="logo-azul-sm"
                            alt="Logo-Dark" style="max-width: 40px;" />
                        <img src="{{ asset('assets/images/logos/logo-min-2.png') }}" class="logo-branco-sm"
                            alt="Logo-Dark" style="max-width: 40px;" />
                        <img src="{{ asset('assets/images/logos/hippo-dark.png') }}" class="logo-branco-lg"
                            alt="Logo-light" />

                    </a>
                    <a href="javascript:void(0)"
                        class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                        <i class="ti ti-x"></i>
                    </a>
                </div>

                @include('layouts.sidebar_menu')

            </div>
        </aside>
        <div class="page-wrapper">

            @include('layouts.navbar_top_desktop')

            <div class="body-wrapper">
                <div class="container-fluid">

                    @yield('content')

                    <div class="py-4"></div>

                </div>
            </div>

            @include('layouts.configuracoes')
        </div>
    </div>
    <div class="dark-transparent sidebartoggler"></div>
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards/dashboard.js') }}"></script>
    <script src="{{ asset('assets/libs/moment-js/build/moment.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Sweetalert2 -->
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/js/forms/sweet-alert.init.js') }}"></script>

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
