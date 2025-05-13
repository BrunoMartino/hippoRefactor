@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden  min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-4">
                    <div class="card mb-0 shadow">
                        <div class="card-body pt-5">
                            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img text-center d-block mb-4 w-100">
                                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="dark-logo"
                                    alt="Logo-Dark" />
                                <img src="{{ asset('assets/images/logos/hippo-dark.png') }}" class="light-logo"
                                    alt="Logo-light" />
                            </a>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h4 fw-bolder">Cadastrar nova senha</h1>
                            </div>
                            <form method="POST" action="{{ route('salvar.nova.senha', ['dados' => $dados]) }}"
                                autocomplete="off" class="mt-4" id='form-register'>
                                @csrf


                                <div class="alert alert-danger @if (count($errors->all()) > 0) d-block @else d-none @endif"
                                    role="alert" id='msg-invalid-pass'>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>


                                <div class="mb-3">
                                    <label for="password" class="form-label">Informe uma nova senha</label>
                                    <div class="position-relative">
                                        <button type="button" onclick="showPass('password', 'icon-eye', 'icon-eye-off')"
                                            class="btn d-flex align-items-center btn-show-pass" style=""
                                            tabindex="-1">
                                            <i class="ti ti-eye fs-5" id="icon-eye" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off" style="display: block"></i>
                                        </button>
                                        <input type="password" class="form-control" name="password" id="password" autofocus
                                            required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirme a nova senha</label>
                                    <div class="position-relative">
                                        <button type="button"
                                            onclick="showPass('password-2', 'icon-eye1', 'icon-eye-off2')"
                                            class="btn d-flex align-items-center btn-show-pass" style=""
                                            tabindex="-1">
                                            <i class="ti ti-eye fs-5" id="icon-eye1" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off2" style="display: block"></i>
                                        </button>
                                        <input type="password" class="form-control" name="confirm_password" id="password-2"
                                            required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-3 rounded-2">Enviar</button>
                                <a href="{{ route('login') }}" class="btn btn-light text-primary w-100 py-8">Voltar</a>
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

        document.getElementById('password').onkeyup = function() {
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
