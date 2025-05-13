<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HippoNotify</title>
    <!-- css -->
    @include('emails.layout.css')
</head>

<body>

    <body>

        <div class="mail">
            <!-- header -->
            <div class="header-mail">
                {{-- <img src="{{ asset('assets/images/logos/hippo-dark.png') }}" alt="Hippo Notify"> --}}
                <img src="https://i.imgur.com/UwlRAc9.png" alt="Hippo Notify">
            </div>
            <!-- content -->
            @yield('content')
            <!-- footer -->
            <div class="footer-mail mt-2">
                <a href="http://google.com" class="">
                    {{-- <img src="{{ asset('assets/images/pngs/brand-instagram.png') }}" alt="Instagram" width="40"
                        style="margin: 0 10px"> --}}
                    <img src="{{ asset('https://i.imgur.com/uZlqZaa.png') }}" alt="Instagram" width="40"
                        style="margin: 0 10px">
                </a>
                <a href="http://google.com" class="">
                    {{-- <img src="{{ asset('assets/images/pngs/brand-whatsapp.png') }}" alt="WhatsApp" width="40"
                        style="margin: 0 10px"> --}}
                    <img src="{{ asset('https://i.imgur.com/8cGIwJo.png') }}" alt="WhatsApp" width="40"
                        style="margin: 0 10px">
                </a>
                <a href="http://google.com" class="">
                    {{-- <img src="{{ asset('assets/images/pngs/brand-youtube.png') }}" alt="YouTube" width="40"
                        style="margin: 0 10px"> --}}
                    <img src="{{ asset('https://i.imgur.com/3Dab2Bo.png') }}" alt="YouTube" width="40"
                        style="margin: 0 10px">
                </a>
            </div>
        </div>

    </body>

</html>
