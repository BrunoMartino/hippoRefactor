@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
        <div class="position-relative z-index-5">
            <div class="row gx-0">
                <div class="col-xl-7 col-xxl-7 bg-white position-relative">
                    <div class="auth-col-left-orange">
                        <div class="d-none d-xl-flex align-items-center justify-content-center auth-col-left-blue">
                            <img src="{{ asset('assets/images/logos/hippo-2.png') }}" alt="" class="img-fluid"
                                width="700">
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-xxl-5">


                    <div
                        class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4 px-xxl-5">

                        <div class="col-sm-8 col-md-6 col-xl-9 px-xxl-5">

                            <div class="text-center mb-0 mb-4 pb-3 d-xl-none pt-4">
                                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="dark-logo"
                                    alt="Logo-Dark">
                            </div>

                            @if (session('cancel'))
                                <div class="alert alert-danger " role="alert">
                                    Seu perfil está cancelado devido a sua requisição, para retornar a utilizar nosso
                                    sistema
                                    envie uma solicitação para o Whatsapp
                                    <a class="text-primary" href="https://wa.me/55999999999">(99) 99999-9999</a>
                                    ou para nosso e-mail <a class="text-primary" href="mailto:retornos@hipponotify.com.br"
                                        class="">retornos@hipponotify.com.br</a>. Agradecemos o
                                    interesse em retornar o uso.
                                </div>
                            @endif
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    As credenciais fornecidas não correspondem aos nossos registros
                                </div>
                            @enderror

                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert" id="alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger text-center" role="alert" id="alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <h2 class="mb-3 fs-7 fw-bolder">Conecte-se</h2>
                            <form method="POST" action="{{ route('send.login') }}" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Seu e-mail</label>
                                    <input type="email" class="form-control" value="{{ old('email') }}" name="email"
                                        id="email" placeholder="exemplo@exemplo.com" required autofocus>
                                </div>
                                <div class="mb-4 position-relative">
                                    <label for="password" class="form-label">Sua senha</label>
                                    <div class="position-relative">
                                        <button type="button" tabindex="-1"
                                            onclick="showPass('password', 'icon-eye', 'icon-eye-off')"
                                            class="btn d-flex align-items-center btn-show-pass" style="">
                                            <i class="ti ti-eye fs-5" id="icon-eye" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off" style="display: block"></i>
                                        </button>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Informe sua senha" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">
                                    Entrar
                                </button>

                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a class="text-primary fs-4 fw-medium" href="{{ route('recuperar.form') }}">
                                        Esqueceu sua senha?
                                    </a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-medium">Não é registrado?</p>
                                    <a class="text-primary fw-medium ms-2" href="https://hipponotify.com.br/#planos">
                                        Faça seu registro
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => {
            if (document.getElementById('alert-success'))
                document.getElementById('alert-success').remove()
        }, 5000);
    </script>
@endsection
