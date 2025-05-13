@extends('emails.layout.mail')
@section('content')
    <div class="body-mail">
        <div class="mail-title fs-28px">
            Olá <span class="text-orange">{{ explode(' ', $nome)[0] }}</span>,
        </div>
        <div class="">
            <div class="mail-subtitle fs-17px" style="margin-top: 20px">
                <strong>Recebemos sua solicitação para redefinir sua senha de acesso a nossa
                    <span class="text-primary">PLATAFORMA</span>
                </strong>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ $link }}" class=" btn-primary fs-18px">
                REDEFINIR SENHA
            </a>
        </div>

        <div class="text-center mt-3 fs-18px">
            {{-- <img src="{{ asset('assets/images/pngs/bell-z.png') }}" alt="" class="icon-bell"> --}}
            <img src="{{ asset('https://i.imgur.com/uLUHRhR.png') }}" alt="" class="icon-bell">
            Se não solicitou a redefinição de sua senhal, ignore este e-mail.
        </div>

        <div class="mt-4 text-center">
            <div class="fs-18px" style="padding-top: 15px">
                Dúvidas? Entre em contato com nosso suporte:<br>
                (44) 99123-4567
            </div>
        </div>
    </div>
@endsection
