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
                    <form action="{{ route('payment-plan.confirm-payment', ['invoice_id' => $invoiceId]) }}" method="post" id="form"
                        onsubmit="verificarFormCartao(event)">
                        @csrf
                        <div class="pagamento">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 px-0">
                                        <div class="row">
                                            <div class="col-12 px-0 px-md-3">
                                                <div class="mb-4 mb-md-0 d-flex gap-3 fs-7 justify-content-between px-3 py-2 rounded  align-items-center text-truncate "
                                                    style="background: #f5f6f6">
                                                    <div class="">
                                                        {{ $plan->modulo->titulo }}/Plano {{ ucfirst($plan->nome) }}
                                                        - {{ $plan->qtd_usuarios }}
                                                        {{ $plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário' }}
                                                        {{-- - {{ $plan->qtd_instancias }}
                                                        {{ $plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância' }} --}}
                                                        - {{ number_format($plan->limite_mensagens, 0, ',', '.') }}
                                                        Mensagens
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
                                        <div class="px-1 mt-4 ">
                                            <!-- input cupm valido -->
                                            <input type="hidden" name="cupom_valido"
                                                value="{{ old('cupom_valido', request()->get('c')) }}" id="cupom-valido">
                                        </div>
                                        <div>
                                            <!-- Nav tabs -->
                                            <ul id="tabs-metodo-pg"
                                                class="nav tabs-modulos nav-tabs  gap-4 flex-column flex-md-row flex-nowrap "
                                                role="tablist">
                                                <li class="nav-item  w-100 p-lg-5" id='nav-tab-cartao'>
                                                    <a class="nav-link py-3 px-5 mx-auto me-md-0 ms-md-auto text-center active"
                                                        id="btn-selecionar-cartao" data-bs-toggle="tab" href="#cartao"
                                                        role="tab" style="max-width: 330px">
                                                        <div class="py-4">
                                                            <div class="mb-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-credit-card-filled"
                                                                    width="55" height="55" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path
                                                                        d="M22 10v6a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-6h20zm-14.99 4h-.01a1 1 0 1 0 .01 2a1 1 0 0 0 0 -2zm5.99 0h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0 -2zm5 -10a4 4 0 0 1 4 4h-20a4 4 0 0 1 4 -4h12z"
                                                                        stroke-width="0" fill="currentColor" />
                                                                </svg>
                                                            </div>
                                                            <span>Cartão de crédito</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="nav-item w-100 p-lg-5" id="nav-tab-pix">
                                                    <a class="nav-link py-3 px-5 mx-auto ms-md-0 me-md-auto text-center"
                                                        data-bs-toggle="tab" id="btn-pix" href="#pix" role="tab"
                                                        style="max-width: 330px">
                                                        <div class="py-4">
                                                            <div class="mb-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="icon icon-tabler icon-tabler-api-app"
                                                                    width="55" height="55" viewBox="0 0 24 24"
                                                                    stroke-width="0.8" stroke="currentColor" fill="none"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path d="M12 15h-6.5a2.5 2.5 0 1 1 0 -5h.5" />
                                                                    <path d="M15 12v6.5a2.5 2.5 0 1 1 -5 0v-.5" />
                                                                    <path d="M12 9h6.5a2.5 2.5 0 1 1 0 5h-.5" />
                                                                    <path d="M9 12v-6.5a2.5 2.5 0 0 1 5 0v.5" />
                                                                </svg>
                                                            </div>
                                                            <span>Pix</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="row">
                                                <div class="col-12 px-0 px-md-3">
                                                    <hr class="mt-5 mt-lg-0 " id="divisor">
                                                </div>
                                            </div>
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <!-- Cartão -->
                                                <div class="tab-pane active" id="cartao" role="tabpanel">
                                                    <div class="pt-4">
                                                        <div class="row  justify-content-center">
                                                            <div
                                                                class=" col-12 col-xl-10 row  gx-5 align-items-center px-0">
                                                                <!-- form -->
                                                                <div class="col-12 col-lg-6 px-2 px-md-3 ">
                                                                    <!-- número -->
                                                                    <div class="mb-3">
                                                                        <label for="num_cartao"
                                                                            class="form-label mb-1">Número
                                                                            do
                                                                            cartão</label>
                                                                        <input type="text"
                                                                            class="form-control @error('num_cartao') is-invalid @enderror"
                                                                            name="num_cartao" id="num_cartao"
                                                                            value="{{ old('num_cartao') }}"
                                                                            placeholder="Digite o número do cartão"
                                                                            required />
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
                                                                                        <div
                                                                                            class="invalid-feedback fw-semibold">
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
                                                                                        <div
                                                                                            class="invalid-feedback fw-semibold">
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
                                                                                <div class=""
                                                                                    style="font-size: 9px">
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
                                                        <div class="text-center mt-5 mb-5 pt-5">
                                                            <div
                                                                class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                                                <button type="submit" class="btn btn-primary  px-5 fs-4">
                                                                    <div class="px-lg-4">Finalizar</div>
                                                                </button>
                                                                <a href="{{ route('usuarios') }}"
                                                                    class="btn btn-light  px-5 fs-4 text-primary"
                                                                    id="btn-cancelar">
                                                                    <div class="px-lg-4">Cancelar</div>
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-light  px-5 fs-4 text-primary"
                                                                    style="display: none" id="btn-voltar"
                                                                    onclick="resetarFormCartao()">
                                                                    <div class="px-lg-4">Voltar</div>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pix -->
                                                <div class="tab-pane" id="pix" role="tabpanel">
                                                    <div class="pt-0">
                                                        <ul class="list-unstyled fs-5">
                                                        </ul>
                                                        <div class="" id="pg-pix-pendente">
                                                            <div class="text-center fw-semibold fs-4 my-4  py-3">
                                                                Abra o aplicativo do seu banco, escolha pagar com PIX e
                                                                aponte a câmera para o QR Code.
                                                            </div>
                                                            <div class="text-center">
                                                                <img src="{{ $imgQRCode }}" alt=""
                                                                    srcset="" width="225">

                                                                <div class="pt-4">
                                                                    <div class="fs-4 mt-4 mb-2 fs-4 pt-2 fw-semibold">
                                                                        Código copia e cola
                                                                    </div>
                                                                    <div class="mx-auto" style="max-width: 400px">
                                                                        <div class="input-group mb-3">

                                <input type="text"
                                    class="form-control fs-4"
                                        placeholder="Código" id="pix-copia-cola"
                                            value="{{ $qrcode }}"

                                                                                aria-label="Código"
                                                                                aria-describedby="button-addon2">
                                                                            <button
                                                                                class="input-group-text bg-transparent px-2"
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
                                                                            <button type="button"
                                                                                class="btn btn-light  px-5 fs-4 text-primary"
                                                                                id="btn-voltar" onclick="pixVoltar()">
                                                                                <div class="px-lg-4">Voltar</div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- Pagamento efetivado -->
                                                        <div class="" style="display: none" id="pg-pix-efetivado">
                                                            <!--  -->
                                                            {{-- 
                                                                <div class="d-flex justify-content-center mt-4 mb-5"> <div class="pagament-efetivado rounded-3 bg-primary text-white px-5 py-5 fs-7 text-center"> <div class="px-4"> <div class="mb-3  "> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled" width="55" height="55" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor" /> </svg> </div> Pagamento efetivado </div> </div> </div>
                                                            --}}
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
        setInterval(() => {
            let urlBaseStatusPix = "{{ route('payment-plan.confirm-payment-pix', $invoiceId) }}"
            axios.get(urlBaseStatusPix)
                .then(res => {
                    console.log(res.data);
                    if (res.data.status == 'confirmado') {
                        window.location.href = "{{ route('payment-confirmed') }}"
                        // document.getElementById('pg-pix-efetivado').style.display = 'block'
                        // document.getElementById('pg-pix-pendente').style.display = 'none'
                        // document.getElementById('tabs-metodo-pg').style.display = 'none'
                        // document.getElementById('divisor').style.display = 'none'


                        // let b64 =
                        //     'PGRpdiBjbGFzcz0iZC1mbGV4IGp1c3RpZnktY29udGVudC1jZW50ZXIgbXQtNCBtYi01Ij4gPGRpdiBjbGFzcz0icGFnYW1lbnQtZWZldGl2YWRvIHJvdW5kZWQtMyBiZy1wcmltYXJ5IHRleHQtd2hpdGUgcHgtNSBweS01IGZzLTcgdGV4dC1jZW50ZXIiPiA8ZGl2IGNsYXNzPSJweC00Ij4gPGRpdiBjbGFzcz0ibWItMyAgIj4gPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJpY29uIGljb24tdGFibGVyIGljb24tdGFibGVyLWNpcmNsZS1jaGVjay1maWxsZWQiIHdpZHRoPSI1NSIgaGVpZ2h0PSI1NSIgdmlld0JveD0iMCAwIDI0IDI0IiBzdHJva2Utd2lkdGg9IjEuNSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIGZpbGw9Im5vbmUiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+IDxwYXRoIHN0cm9rZT0ibm9uZSIgZD0iTTAgMGgyNHYyNEgweiIgZmlsbD0ibm9uZSIgLz4gPHBhdGggZD0iTTE3IDMuMzRhMTAgMTAgMCAxIDEgLTE0Ljk5NSA4Ljk4NGwtLjAwNSAtLjMyNGwuMDA1IC0uMzI0YTEwIDEwIDAgMCAxIDE0Ljk5NSAtOC4zMzZ6bS0xLjI5MyA1Ljk1M2ExIDEgMCAwIDAgLTEuMzIgLS4wODNsLS4wOTQgLjA4M2wtMy4yOTMgMy4yOTJsLTEuMjkzIC0xLjI5MmwtLjA5NCAtLjA4M2ExIDEgMCAwIDAgLTEuNDAzIDEuNDAzbC4wODMgLjA5NGwyIDJsLjA5NCAuMDgzYTEgMSAwIDAgMCAxLjIyNiAwbC4wOTQgLS4wODNsNCAtNGwuMDgzIC0uMDk0YTEgMSAwIDAgMCAtLjA4MyAtMS4zMnoiIHN0cm9rZS13aWR0aD0iMCIgZmlsbD0iY3VycmVudENvbG9yIiAvPiA8L3N2Zz4gPC9kaXY+IFBhZ2FtZW50byBlZmV0aXZhZG8gPC9kaXY+IDwvZGl2PiA8L2Rpdj4=';
                        // document.getElementById('pg-pix-efetivado').innerHTML = atob(b64)

                        /* 
                            <div class="d-flex justify-content-center mt-4 mb-5"> <div class="pagament-efetivado rounded-3 bg-primary text-white px-5 py-5 fs-7 text-center"> <div class="px-4"> <div class="mb-3  "> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check-filled" width="55" height="55" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none" /> <path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor" /> </svg> </div> Pagamento efetivado </div> </div> </div>
                        */
                        // setTimeout(() => {
                        //     window.location.href = "{{ route('dashboard') }}"
                        // }, 3000);
                    } else {
                        document.getElementById('pg-pix-efetivado').style.display = 'none'
                        document.getElementById('pg-pix-pendente').style.display = 'block'
                    }
                })
                .cath(err => {
                    console.log(err);
                })
        }, 10000);
    </script>

@endsection
