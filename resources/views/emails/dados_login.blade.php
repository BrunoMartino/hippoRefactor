@extends('emails.layout.mail')
@section('content')
    <div class="body-mail">
        <div class="mail-title fs-28px">
            Olá <span class="text-orange">{{ explode(' ', $user->nome_usuario)[0] }}</span>,
        </div>
        <div class="">
            <div class="mail-subtitle fs-17px" style="margin-top: 20px">
                <strong>Seja muito bem-vindo(a) a nossa
                    <span class="text-primary">PLATAFORMA</span>
                </strong>
            </div>
        </div>


        {{-- Se user for afiliado --}}
        @if ($user->nivel_id == 3)
            <!-- Dados de acesso -->
            <div class="" style="margin-top: 40px">
                {{-- <img src="{{ asset('assets/images/pngs/user-filled.png') }}" alt="" class="icon-user"> --}}
                <img src="{{ asset('https://i.imgur.com/IKKCjf5.png') }}" alt="" class="icon-user">
                <span style="">
                    Link de afiliado: {{ route('home', ['ref' => $user->affiliate->ref_id]) }}
                </span>
            </div>
        @endif

        <!-- Dados de acesso -->
        <div class="" style="margin-top: @if ($user->nivel_id == 3) 10px @else 40px @endif">
            {{-- <img src="{{ asset('assets/images/pngs/user-filled.png') }}" alt="" class="icon-user"> --}}
            <img src="{{ asset('https://i.imgur.com/JwlbT2V.png') }}" alt="" class="icon-user">
            <span style="">
                Dados de acesso:
            </span>
        </div>

        <div class="data">
            <div class="data-item">
                {{-- <img src="{{ asset('assets/images/pngs/mail-filled.png') }}" alt="" class="icon-email"> --}}
                <img src="{{ asset('https://i.imgur.com/pm8RyEn.png') }}" alt="" class="icon-email">
                E-mail: <span class="text-primary">
                    <strong>{{ $user->email }}</strong>
                </span>
            </div>
            <div class="data-item">
                {{-- <img src="{{ asset('assets/images/pngs/lock.png') }}" alt="" class="icon-email"> --}}
                <img src="{{ asset('https://i.imgur.com/U7IVkpL.png') }}" alt="" class="icon-email">
                Senha: <span class="text-primary">
                    <strong>{{ $pass }}</strong>
                </span>
            </div>
        </div>



        <div class="text-center mt-3 fs-18px">
            {{-- <img src="{{ asset('assets/images/pngs/bell-z.png') }}" alt="" class="icon-bell"> --}}
            <img src="{{ asset('https://i.imgur.com/uLUHRhR.png') }}" alt="" class="icon-bell">
            Altere a sua senha após o primeiro acesso.
        </div>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class=" btn-primary fs-18px">
                ACESSAR PLATAFORMA
            </a>


        </div>


        <div class="mt-4 text-center">
            <div class="fs-18px" style="padding-top: 15px">
                Dúvidas? Entre em contato com nosso suporte:<br>
                (44) 99123-4567
            </div>
        </div>



    </div>
@endsection
