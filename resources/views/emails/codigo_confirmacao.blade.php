@extends('emails.layout.mail')
@section('content')
    <div class="body-mail">
        <div class="mail-title fs-28px">
            Olá <span class="text-orange">{{ explode(' ', $nome)[0] }}</span>, tudo bem?
        </div>
        <div class="">
            <div class="mail-subtitle fs-17px" style="margin-top: 20px">
                <strong>
                    Você solicitou uma chave de autenticação.
                </strong>
            </div>
        </div>

        <div class="mt-2 fs-17px">
            Copie e cole a chave para obter acesso à plataforma.
        </div>

        <div class="text-center mt-4" style="padding: 0 30px; max-width: 270px; margin-left: auto; margin-right: auto">
            <div class="text-center fs-17px" style="border: 2px solid #0853FC; border-radius: 10px; padding: 10px">
                Sua chave é:
                <div class="mt-2 text-orange" style="font-size: 35px; font-weight: bold">
                    {{ $codigo }}
                </div>
            </div>
        </div>

        <div class="text-center mt-3 fs-18px">
            {{-- <img src="{{ asset('assets/images/pngs/bell-z.png') }}" alt="" class="icon-bell"> --}}
            {{-- <img src="{{ asset('https://i.imgur.com/uLUHRhR.png') }}" alt="" class="icon-bell"> --}}
            Se você não fez esta solicitação, ignore este e-mail.
        </div>

        <div class="mt-4 text-center">
            <div class="fs-18px" style="padding-top: 15px">
                Dúvidas? Entre em contato com nosso suporte:<br>
                (44) 99123-4567
            </div>
        </div>
    </div>
@endsection
