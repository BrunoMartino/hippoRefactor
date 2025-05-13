@extends('layouts.basic')
@section('title', 'Pagamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Pagamento</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('config.user-account.current-plan') }}">Conta usuário</a>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('config.user-account.change-plan') }}">Trocar Plano</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Pagamento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    <form action="{{ route('payment.change-plan.confirm-payment-pix') }}" method="post"
                        id="form">
                        @csrf
                        <div class="pagamento">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 px-0">
                                        <div class="row">
                                            <div class="col-12 px-0 px-md-3">
                                                <div class="fw-semibold fs-4 mb-1">
                                                    Itens da compra:
                                                </div>
                                                <div class="mb-4 mb-md-0 d-flex gap-3 fs-7 justify-content-between px-3 py-2 rounded  align-items-center text-truncate "
                                                    style="background: #f5f6f6">
                                                    <div class="">
                                                        {{ $itensCompra }}
                                                    </div>
                                                    <div class=" text-end ">
                                                        <strong>R$
                                                            <span id="valor-compra">
                                                                {{ number_format($valorPagar, 2, ',', '.') }}
                                                            </span>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Pix -->
                                            <div class="tab-pane" id="pix" role="tabpanel">
                                                <div class="pt-0">
                                                    <ul class="list-unstyled fs-5">
                                                    </ul>

                                                    <div class="" id="pg-pix-pendente">

                                                        <div class="text-center fw-semibold fs-4 my-4 py-3">
                                                            Abra o aplicativo do seu banco, escolha pagar com PIX e
                                                            aponte a câmera para o QR Code.
                                                        </div>
                                                        <div class="text-center">
                                                            <img src="{{ $imgQRCode }}" alt="" srcset=""
                                                                width="225">

                                                            <div class="pt-4">
                                                                <div class="fs-4 mt-4 mb-2 fs-4 pt-2 fw-semibold">
                                                                    Código copia e cola
                                                                </div>
                                                                <div class="mx-auto" style="max-width: 400px">
                                                                    <div class="input-group mb-3">
                                                                        <input type="text" class="form-control fs-4"
                                                                            placeholder="Código" id="pix-copia-cola"
                                                                            value="{{ $qrcode }}" aria-label="Código"
                                                                            aria-describedby="button-addon2">
                                                                        <button class="input-group-text bg-transparent px-2"
                                                                            style="border: var(--bs-border-width) solid #dfe5ef"
                                                                            type="button" data-bs-toggle="tooltip"
                                                                            data-bs-placement="top" title="Copiar"
                                                                            id="btn-copiar" onclick="copyCode()">
                                                                            <i class="ti ti-copy fs-6"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <div class="pt-4">
                                                                    A compensação do pagamento leva até 10
                                                                    segundos após o
                                                                    pagamento.
                                                                </div>
                                                                <div class="d-flex justify-content-center mt-2  pt-3">
                                                                    <div class="  d-flex justify-content-center align-items-center gap-1 px-3 py-1 rounded"
                                                                        style="background: #ff75322b">
                                                                        <i class="ti ti-reload"></i>
                                                                        Aguardando pelo seu pagamento...
                                                                    </div>
                                                                </div>
                                                                <div class="text-center mt-5 mb-5 pt-3">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                                                        <button type="submit"
                                                                            class="btn btn-primary  px-5 fs-4"
                                                                            id="btn-confirmar-pix" onclick="confirmarPix()">
                                                                            <div class="px-lg-2">Confirmar Pagamento
                                                                            </div>
                                                                        </button>
                                                                        @if (!session()->has('tipoPagamento'))
                                                                        <a href="{{ route('payment.change-plan.cartao') }}"
                                                                            class="btn btn-light text-orange  px-5 fs-4"
                                                                            id="btn-voltar">
                                                                            <div class="px-lg-4">Pagar com cartão
                                                                            </div>
                                                                        </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <form action="{{ route('payment.change-plan.confirm-payment-pix', $plan) }}" method="POST" id="confirmPaymentPix"> --}}
    <form action="#" method="POST" id="confirmPaymentPix">
        @csrf
    </form>
@endsection
@section('scripts')
    <!-- Imask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
    <script>
        const n_cartao = IMask(document.getElementById('num_cartao'), {
            mask: '0000 0000 0000 0000'
        });
        const ano_venc = IMask(document.getElementById('ano_venc'), {
            mask: '0000'
        });
        const mes_venc = IMask(document.getElementById('mes_venc'), {
            mask: '00'
        });
        const cvc = IMask(document.getElementById('cvc'), {
            mask: '0000'
        });

        function resetarFormCartao() {
            document.getElementById('form').reset()
            document.getElementById('cartao-ano').innerHTML = '00'
            document.getElementById('cartao-mes').innerHTML = '00'
            document.getElementById('nome-cartao').innerText = 'Nome completo'
            inserirDadosCartao()
        }

        /* Inserir números no cartão */
        function inserirDadosCartao() {

            // ocultar  card pix
            if (document.getElementById('num_cartao').value != '') {
                document.getElementById('nav-tab-pix').style.display = 'none'
                document.getElementById('btn-selecionar-cartao').className =
                    'nav-link py-3 px-5 mx-auto text-center active'
                document.getElementById('btn-cancelar').style.display = 'none'
                document.getElementById('btn-voltar').style.display = 'inline-block'
            } else {
                document.getElementById('nav-tab-pix').style.display = 'block'
                document.getElementById('btn-selecionar-cartao').className =
                    'nav-link py-3 px-5 mx-auto me-md-0 ms-md-auto text-center active'
                document.getElementById('btn-cancelar').style.display = 'inline-block'
                document.getElementById('btn-voltar').style.display = 'none'
            }

            let numArray = document.getElementById('num_cartao').value.split(' ');

            // resetar html com números
            document.getElementById('numeros-cartao').innerHTML = ''

            for (let i = 0; i <= 3; i++) {
                let itemsBlock = numArray[i] ?? false;
                let html = ''

                // inserir números se exitir no bloco
                if (itemsBlock) {
                    let numsBlock = itemsBlock.split('')

                    for (let i = 0; i <= 3; i++) {
                        if (numsBlock[i]) { // inserir número
                            html += ` <div class="numeros-item"> ${numsBlock[i]} </div> `
                        } else { // inserir número vázio
                            html += ` <div class="numeros-item"> <span></span> </div> `
                        }
                    }

                } else { // adicionar números vázios em bloco
                    html += `
                                <div class="numeros-item"> <span></span> </div>
                                <div class="numeros-item"> <span></span> </div>
                                <div class="numeros-item"> <span></span> </div>
                                <div class="numeros-item"> <span></span> </div>
                            `
                }

                // inserir todo html gerado
                document.getElementById('numeros-cartao').innerHTML += `
                            <div class="numeros-bloco" > ${html} </div>
                        `
            }
        }
        document.getElementById('num_cartao').oninput = function() {
            inserirDadosCartao()
        }

        document.getElementById('nome').oninput = function() {
            if (this.value != '')
                document.getElementById('nome-cartao').innerText = this.value
            else
                document.getElementById('nome-cartao').innerText = 'Nome completo'
        }

        // Copiar link
        function copyCode(target) {
            document.getElementById('pix-copia-cola').select()
            document.execCommand('copy');
        }

        document.getElementById('mes_venc').oninput = function() {
            let num = parseInt(this.value)
            if (num > 12)
                this.value = 12
            mes_venc.updateValue()
            document.getElementById('cartao-mes').innerHTML = this.value ? this.value : '00'
        }
        document.getElementById('mes_venc').onblur = function() {
            let num = parseInt(this.value)
            if (num < 10)
                this.value = '0' + num
            if (num == 0)
                this.value = ''
            mes_venc.updateValue()
            document.getElementById('cartao-mes').innerHTML = this.value ? this.value : '00'
        }

        document.getElementById('ano_venc').oninput = function() {
            let num = parseInt(this.value)
            console.log(num);

            if (num > 2099) {
                this.value = 2099

            }

            let currentYear = (new Date()).getFullYear()
            if (num < currentYear && num.toString().length == 4)
                this.value = currentYear
            ano_venc.updateValue()
            document.getElementById('cartao-ano').innerHTML = this.value ? this.value : '00'
        }
        document.getElementById('ano_venc').onblur = function() {
            let num = parseInt(this.value)
            console.log(num);
            let currentYear = (new Date()).getFullYear()
            if (num < currentYear)
                this.value = ''
            ano_venc.updateValue()
            document.getElementById('cartao-ano').innerHTML = this.value ? this.value : '00'
        }

        function pixVoltar() {
            // deixar tab cartão ativo modificando classes e atributos
            document.getElementById('cartao').className = 'tab-pane active show'
            document.getElementById('pix').className = 'tab-pane'
            document.getElementById('btn-selecionar-cartao').classList.add('active')
            document.getElementById('btn-selecionar-cartao').tabindex = ""
            document.getElementById('btn-pix').classList.remove('active')
            document.getElementById('btn-pix').tabindex = "-1"

            // exibir novamento o btn cartao na tab
            document.getElementById('nav-tab-cartao').style.display = 'block'
            document.getElementById('btn-pix').className =
                'nav-link py-3 px-5 mx-auto ms-md-0 me-md-auto text-center'
        }

        // ocultar btn cartão quando btn pix estiver ativado
        document.getElementById('btn-pix').onclick = function() {
            // mudando estilo de tab cartao e btn-pix
            document.getElementById('nav-tab-cartao').style.display = 'none'
            document.getElementById('btn-pix').className =
                'nav-link py-3 px-5 mx-auto text-center active'

        }
    </script>

    <script>
        function validarNumeroCartao(numero) {
            // Remover espaços em branco
            numero = numero.replace(/\s/g, '');

            // Verificar se o número está vazio ou tem caracteres não numéricos
            if (!numero || isNaN(numero)) {
                return false;
            }

            // Verificar se o número tem um comprimento válido para um número de cartão
            if (numero.length < 13 || numero.length > 19) {
                return false;
            }

            // Algoritmo de Luhn para validação de números de cartão
            let soma = 0;
            let digitosPares = false;

            for (let i = numero.length - 1; i >= 0; i--) {
                let digito = parseInt(numero.charAt(i), 10);

                if (digitosPares) {
                    digito *= 2;
                    if (digito > 9) {
                        digito -= 9;
                    }
                }

                soma += digito;
                digitosPares = !digitosPares;
            }

            return soma % 10 === 0;
        }

        function validarInputCartao() {
            const inputCartao = document.getElementById('num_cartao');
            const valor = inputCartao.value;

            if (validarNumeroCartao(valor)) {
                inputCartao.classList.remove('is-invalid');
                removerMensagemErro();
                return true;
            } else {
                inputCartao.classList.add('is-invalid');
                exibirMensagemErro('Número de cartão inválido.', inputCartao.id);
                return false;
            }
        }

        function exibirMensagemErro(mensagem, input_id) {
            const divPai = document.getElementById(input_id);
            const divErro = document.createElement('div');
            divErro.className = 'invalid-feedback fw-semibold';
            divErro.textContent = mensagem;

            divPai.insertAdjacentElement('afterend', divErro)
        }

        function removerMensagemErro() {
            const divErro = document.querySelector('.invalid-feedback');
            if (divErro) {
                divErro.remove();
            }
        }


        /* submit form cartão */
        function verificarFormCartao(event) {
            removerMensagemErro()

            // bloquer envio a não ser que o cartão seja valido
            event.preventDefault();
            if (validarInputCartao()) {
                event.target.submit()
            }
        }
    </script>

    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
        integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function confirmarPix() {
            document.getElementById('confirmPaymentPix').submit();
        }
    </script>

@endsection
