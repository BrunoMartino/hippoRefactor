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
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <form action="{{ route('usuarios.comprar.confirm-payment-card') }}" method="post"
                        onsubmit="verificarFormCartao(event)">
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
                                                        {{ $total == 1 ? 'Usuário' : 'Usuários' }}
                                                    </div>
                                                    <div class=" text-center">
                                                        {{ $total }}un
                                                    </div>
                                                    <div class=" text-end ">
                                                        <strong>R$
                                                            {{ number_format($valor, 2, ',', '.') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <!-- Cartão -->
                                            <div class="mt-5 " id="cartao" role="tabpanel">
                                                <div class="pt-4">
                                                    <div class="row  justify-content-center">
                                                        <div class=" col-12 col-xl-10 row  gx-5 align-items-center px-0">
                                                            <!-- form -->
                                                            <div class="col-12 col-lg-6 px-2 px-md-3 ">
                                                                <!-- número -->
                                                                <div class="mb-3">
                                                                    <label for="num_cartao" class="form-label mb-1">Número
                                                                        do
                                                                        cartão</label>
                                                                    <input type="text"
                                                                        class="form-control @error('num_cartao') is-invalid @enderror"
                                                                        name="num_cartao" id="num_cartao"
                                                                        value="{{ old('num_cartao') }}"
                                                                        placeholder="Digite o número do cartão" required />
                                                                    @error('num_cartao')
                                                                        <div class="invalid-feedback fw-semibold">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <!-- Nome -->
                                                                <div class="mb-3">
                                                                    <label for="nome"
                                                                        class="form-label mb-1">Nome</label>
                                                                    <input type="text"
                                                                        class="form-control @error('nome') is-invalid @enderror"
                                                                        name="nome" id="nome"
                                                                        value="{{ old('nome') }}"
                                                                        placeholder="Digite o nome inscrito no cartão"
                                                                        required />
                                                                    @error('nome')
                                                                        <div class="invalid-feedback fw-semibold">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 col-lg-6">
                                                                        <!-- Data de vencimento -->
                                                                        <div class="row mb-3 gx-3">
                                                                            <div class="col-12">
                                                                                <label for="mes_venc"
                                                                                    class="form-label mb-1">
                                                                                    Data de vencimento
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-5">
                                                                                <input type="text"
                                                                                    class="form-control @error('mes_venc') is-invalid @enderror"
                                                                                    name="mes_venc" id="mes_venc"
                                                                                    value="{{ old('mes_venc') }}"
                                                                                    placeholder="Mês" required />
                                                                                @error('mes_venc')
                                                                                    <div class="invalid-feedback fw-semibold">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-7 col-md-6">
                                                                                <input type="text"
                                                                                    class="form-control @error('ano_venc') is-invalid @enderror"
                                                                                    name="ano_venc" id="ano_venc"
                                                                                    value="{{ old('ano_venc') }}"
                                                                                    placeholder="Ano" required />
                                                                                @error('ano_venc')
                                                                                    <div class="invalid-feedback fw-semibold">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 col-lg-6">
                                                                        <!-- Cód. de segurança -->
                                                                        <div class="mb-3">
                                                                            <label for="cvc"
                                                                                class="form-label mb-1">Cód.
                                                                                de
                                                                                segurança</label>
                                                                            <input type="text"
                                                                                class="form-control @error('cvc') is-invalid @enderror"
                                                                                name="cvc" id="cvc"
                                                                                value="{{ old('cvc') }}"
                                                                                placeholder="CVC" required />
                                                                            @error('cvc')
                                                                                <div class="invalid-feedback fw-semibold">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Cartão de crédito -->
                                                            <div class="col-12 col-lg-6  px-2 px-md-3">
                                                                <div class="d-flex justify-content-lg-end">
                                                                    <div class="cartao-credito ">
                                                                        <div class="faixa-magnetica mt-1"></div>
                                                                        <div class="numeros mt-2 pt-3 d-flex "
                                                                            id="numeros-cartao">
                                                                            @for ($i = 0; $i < 4; $i++)
                                                                                <div class="numeros-bloco">
                                                                                    <div class="numeros-item">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <div class="numeros-item">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <div class="numeros-item">
                                                                                        <span></span>
                                                                                    </div>
                                                                                    <div class="numeros-item">
                                                                                        <span></span>
                                                                                    </div>
                                                                                </div>
                                                                            @endfor
                                                                        </div>
                                                                        <div class="text-end lh-sm mt-3 pe-5">
                                                                            <div class="" style="font-size: 9px">
                                                                                MÊS/ANO
                                                                            </div>
                                                                            <div class=""><span
                                                                                    id="cartao-mes">00</span>/<span
                                                                                    id="cartao-ano">00</span></div>
                                                                        </div>
                                                                        <div class="text-uppercase mt-1 pt-2"
                                                                            id="nome-cartao">
                                                                            Nome completo
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-12 col-lg-10  mx-auto">
                                                            <div class="text-center mt-4 lh-sm fs-2 ">
                                                                <h5>Pagamento Seguro SSL - Seu pagamento é protegido por
                                                                    criptografia
                                                                    SSL de alta qualidade.</h5>
                                                                <h6>Os dados do seu cartão são
                                                                    criptografados e é gerado um token para processar o
                                                                    pagamento.</h6>
                                                                <h6>Não
                                                                    armazenamos nenhum dado direto do seu cartão em nosso
                                                                    banco de
                                                                    dados.</h6>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="text-center mt-3 mb-5 pt-5">
                                                        <div
                                                            class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                                            <button type="submit" class="btn btn-primary  px-5 fs-4">
                                                                <div class="px-lg-4">
                                                                    <div class="px-3">Realizar Pagamento</div>
                                                                </div>
                                                            </button>
                                                            <a href="{{ route('usuarios.comprar.pagar.pix') }}"
                                                                class="btn btn-light text-primary  px-5 fs-4" id="btn-voltar">
                                                                <div class="px-lg-4">
                                                                    Pagar com Pix
                                                                </div>
                                                            </a>
                                                            {{-- <a href="{{ route('config.user-account.current-plan') }}"
                                                                class="btn btn-light  px-5 fs-4 text-primary"
                                                                id="btn-cancelar">
                                                                <div class="px-lg-4">Cancelar</div>
                                                            </a> --}}
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

@endsection
