@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden  min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-4">
                    <div class="card mb-0 shadow" style="max-width: 500px">
                        <div class="card-body pt-5">
                            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img text-center d-block mb-4 w-100">
                                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="dark-logo"
                                    alt="Logo-Dark" />
                                <img src="{{ asset('assets/images/logos/hippo-dark.png') }}" class="light-logo"
                                    alt="Logo-light" />
                            </a>
                            <div class="px-lg-1">
                                <div class="mb-4 text-center">
                                    <h5 class="fw-bolder ">
                                        Insira o código de 6 dígitos enviado para o seu e-mail:
                                        @isset(session('usuario')['email'])
                                            @php
                                                $email = session('usuario')['email'];
                                                $emailPrevia1 = explode('@', $email)[0];
                                                $emailPrevia2 = explode('@', $email)[1];
                                                $emaiPreviaCompleto =
                                                    '*****' . substr($emailPrevia1, -3) . '@' . $emailPrevia2;
                                            @endphp
                                            {{ $emaiPreviaCompleto }}
                                        @endisset
                                    </h5>
                                </div>
                                <form method="POST" action="{{ route('send.confirmacao') }}" autocomplete="off">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="d-flex align-items-center gap-2 gap-sm-3">
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit1" autofocus required>
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit2" required>
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit3" required>
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit4" required>
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit5" required>
                                            <input type="text" class="form-control numeric-input" maxlength="1"
                                                name="digitos[]" id="digit6" required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 mb-4 rounded-2 fw-semibold fs-4"
                                        id="enviar">Enviar</button>
                                </form>

                                <form action="{{ route('confirmacao.reenviar') }}" method="post">
                                    @csrf
                                    <div class="d-flex justify-content-center align-items-top">
                                        <div class="fs-4 mb-0 text-dark d-flex align-items-center flex-wrap">Não recebeu o
                                            e-mail?
                                            <button type="submit" class="btn btn-link p-0 text-primary fw-medium ms-2">
                                                Reenviar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Função para atualizar os dígitos quando o texto é colado ou inserido manualmente
        function updateDigits(digits) {

            const pastedText = digits.split('');

            if (pastedText.length == 6)
                for (let i = 0; i < 6; i++) {
                    if (pastedText[i])
                        document.getElementById('digit' + (i + 1)).value = pastedText[i];
                }
        }

        // rodar a logica qundo inserir números em inputs
        function runSetDigits(elInput) {
            elInput.setAttribute('maxlength', 6)

            // agurardar para inserir o valor
            setTimeout(function() {
                // se tem 6 digitos
                if (elInput.value.length == 6) {
                    updateDigits(elInput.value)
                    elInput.setAttribute('maxlength', 1)
                } else { // adicionar apens o primeiro digito se o total não for 6
                    if (elInput.value.split('')[0])
                        elInput.value = elInput.value.split('')[0]
                }
                elInput.setAttribute('maxlength', 1) // voltar o maxlength 1 no input
            }, 10);
        }

        const inputsId = ['digit1', 'digit2', 'digit3', 'digit4', 'digit5', 'digit6', ];

        for (item of inputsId) {
            // colar
            document.getElementById(item).addEventListener('paste', function(event) {
                runSetDigits(event.target)
            });
            // para mobile
            document.getElementById(item).addEventListener('input', function(event) {
                runSetDigits(event.target)
            });
        }

        document.getElementById('digit6').onchange = function() {
            let value = document.getElementById('digit6').value
            if (value != '') {
                document.getElementById('enviar').focus()
            }

        }
    </script>
@endsection
