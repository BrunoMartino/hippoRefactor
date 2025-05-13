@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
        <div class="position-relative z-index-5">
            <div class="row">
                <div class="col-xl-7 col-xxl-7 bg-white position-relative">
                    <div class="auth-col-left-orange">
                        <div class="d-none d-xl-flex align-items-lg-center justify-content-center auth-col-left-blue">
                            <img src="{{ asset('assets/images/logos/hippo-2.png') }}" alt="" class="img-fluid"
                                width="700">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-5">
                    <div
                        class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4 px-xxl-5">
                        <div class="col-sm-8 col-md-6 col-xl-9 px-xxl-5">

                            <div class="text-center mb-0 pt-4 mb-4 pb-3 d-xl-none" style="">
                                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="dark-logo" alt="Logo-Dark">
                            </div>

                            <h2 class="mb-4 fs-7 fw-bolder">Faça seu registro</h2>
                            <form method="POST" action="{{ route('usuario.salvar.registro') }}" id="form-register"
                                class="mt-4" autocomplete="off">
                                @csrf
                                <div class="mb-3">
                                    <label for="nome_usuario" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control @error('nome_usuario') is-invalid @enderror"
                                        name="nome_usuario" value="{{ old('nome_usuario') }}" id="nome_usuario"
                                        placeholder="Insira seu nome completo" required autofocus>
                                    @error('nome_usuario')
                                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" id="email" value="{{ old('email') }}"
                                        placeholder="exemplo@exemplo.com" required>
                                    @error('email')
                                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Senha</label>
                                    <div class="position-relative">
                                        <button type="button" onclick="showPass('password', 'icon-eye', 'icon-eye-off')"
                                            class="btn d-flex align-items-center btn-show-pass" style=""
                                            tabindex="-1">
                                            <i class="ti ti-eye fs-5" id="icon-eye" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off" style="display: block"></i>
                                        </button>

                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="Informe a senha" required>
                                        @error('password')
                                            <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback fw-semibold d-none" id="msg-invalid-pass"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="conf_password" class="form-label">Confirmar a Senha</label>
                                    <div class="position-relative">
                                        <button type="button"
                                            onclick="showPass('conf_password', 'icon-eye-2', 'icon-eye-off-2')"
                                            class="btn d-flex align-items-center btn-show-pass" style=""
                                            tabindex="-1">
                                            <i class="ti ti-eye fs-5" id="icon-eye-2" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off-2" style="display: block"></i>
                                        </button>
                                        <input type="password"
                                            class="form-control @error('conf_password') is-invalid @enderror"
                                            name="conf_password" id="conf_password" placeholder="Confirme a senha" required>
                                        @error('conf_password')
                                            <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="check"
                                        name="termos_e_politica" required />
                                    <label class="form-check-label fs-4" for="check">
                                        Declaro que li e aceito os
                                        <a href="#" class="text-primary">Termos de Uso</a>
                                        e a
                                        <a href="#" class="text-primary">Política de Privacidade</a>
                                    </label>
                                </div>


                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Registrar</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 text-dark">Já tem registro?</p>
                                    <a class="text-primary fw-medium ms-2" href="{{ route('login') }}">Faça seu login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.getElementById('form-register').addEventListener('submit', function(event) {

            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('msg-invalid-pass');

            const minLength = 8;
            const regexLowercase = /[a-z]/;
            const regexUppercase = /[A-Z]/;
            const regexNumber = /[0-9]/;
            const regexSpecialChar = /[@$!%*#?&]/;

            if (password.length < minLength) {
                errorMessage.textContent = 'A senha deve ter pelo menos 8 caracteres.';
                event.preventDefault();
            } else if (!regexLowercase.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos uma letra minúscula.';
                event.preventDefault();
            } else if (!regexUppercase.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos uma letra maiúscula.';
                event.preventDefault();
            } else if (!regexNumber.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos um número.';
                event.preventDefault();
            } else if (!regexSpecialChar.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos um caractere especial (@$!%*#?&).';
                event.preventDefault();
            } else {
                errorMessage.textContent = '';
                // event.preventDefault();
            }

            if (errorMessage.textContent != '') {
                document.getElementById('password').classList.add('is-invalid')
                errorMessage.classList.remove('d-none')
            } else {
                errorMessage.classList.add('d-none')
                document.getElementById('password').classList.remove('is-invalid')
            }
            
            
        });

        document.getElementById('password').onkeyup=function () {
            const password = document.getElementById('password').value;
            const errorMessage = document.getElementById('msg-invalid-pass');

            const minLength = 8;
            const regexLowercase = /[a-z]/;
            const regexUppercase = /[A-Z]/;
            const regexNumber = /[0-9]/;
            const regexSpecialChar = /[@$!%*#?&]/;

            if (password.length < minLength) {
                errorMessage.textContent = 'A senha deve ter pelo menos 8 caracteres.';
            } else if (!regexLowercase.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos uma letra minúscula.';
            } else if (!regexUppercase.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos uma letra maiúscula.';
            } else if (!regexNumber.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos um número.';
            } else if (!regexSpecialChar.test(password)) {
                errorMessage.textContent = 'A senha deve conter pelo menos um caractere especial (@$!%*#?&).';
            } else {
                errorMessage.textContent = '';
            }

            if (errorMessage.textContent != '') {
                document.getElementById('password').classList.add('is-invalid')
                errorMessage.classList.remove('d-none')
            } else {
                errorMessage.classList.add('d-none')
                document.getElementById('password').classList.remove('is-invalid')
            }

        }
    </script>
@endsection
