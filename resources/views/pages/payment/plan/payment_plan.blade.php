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
                    <form action="{{ route('payment-plan.save-coupon-exists') }}"
                        method="post" id="form" >
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
                                                                {{ number_format($plan->valor, 2, ',', '.') }}
                                                            </span>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-1 mt-4 ">
                                            <!-- input cupm valido -->
                                            <input type="hidden" name="cupom_valido" value="{{ old('cupom_valido') }}"
                                                id="cupom-valido">
                                            <div class="ms-lg-auto " style="max-width:350px">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-lg fs-7 ps-4"
                                                        placeholder="Cupom de desconto" id="cupom-desconto"
                                                        value="{{ old('cupom_valido') }}">
                                                    <button class="btn btn-primary fw-semibold px-4 fs-4" type="button"
                                                        id="aplicar-cupom">Aplicar</button>
                                                </div>
                                                <div class="" style="height: 25px">
                                                    <!-- msg cupom valido -->
                                                    <div id="div-msg-cupom-success" style="display: none;">
                                                        <div class="text-success d-flex gap-1 align-items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="#37bb37"
                                                                class="icon icon-tabler icons-tabler-filled icon-tabler-rosette-discount-check">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" />
                                                            </svg>
                                                            <div id="msg-cupom-success">
                                                                <!-- msg -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- msg cupom invalido -->
                                                    <div id="div-msg-cupom-erro" style="display: none;">
                                                        <div class=" d-flex gap-1 align-items-center"
                                                            style="color: #ff4b1b">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                height="12" viewBox="0 0 24 24" fill="none"
                                                                stroke="#ff4b1b" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 9v4" />
                                                                <path
                                                                    d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" />
                                                                <path d="M12 16h.01" />
                                                            </svg>
                                                            <div id="msg-cupom-erro">
                                                                <!-- msg -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-center py-5">
                                                <button type="submit" class="btn btn-orange btn-lg px-5">
                                                    Realizar Pagamento
                                                </button>
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
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
        integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Cupom -->
    <script>
        /* Obter cupom desconto */
        function obterCupom() {
            resetMsgs()
            // desabilitar btn 'aplicar'
            document.getElementById('aplicar-cupom').disabled = true
            // limpar campo de cupom valido
            document.getElementById('cupom-valido').value = ''
            // adicionar o valor sem desconto
            document.getElementById('valor-compra').innerHTML = "{{ number_format($plan->valor, 2, ',', '.') }}"

            let cupom = document.getElementById('cupom-desconto').value
            console.log(cupom);

            // se input cupom for vazio
            if (cupom == '') {
                setMsgErroCupom('informe um cupom.');
                document.getElementById('aplicar-cupom').disabled = false
                return;
            }

            // requisição para obter dados do cupom
            let url = "{{ route('cupons.get-discount') }}";
            axios.get(url + `?coupon=${cupom}`)
                .then(res => {
                    let response = res.data
                    setMsgSucessoCupom(response.message)
                    document.getElementById('cupom-valido').value = response.discount.coupon
                    document.getElementById('aplicar-cupom').disabled = false;
                    // adicionar valor com desconto
                    // document.getElementById('valor-compra').innerHTML = getValorComDesconto(response.discount)
                    getValorComDesconto(response.discount)
                })
                .catch(err => {
                    let response = err.response.data
                    setMsgErroCupom(response.message)
                    document.getElementById('aplicar-cupom').disabled = false
                });
        }

        function getValorComDesconto(cupomDesconto) {
            let valorOriginal = Number("{{ $plan->valor }}");
            let novoValor = valorOriginal;

            // se o desconto não for porcentagem
            if (cupomDesconto.type == 'currency') {
                novoValor = valorOriginal - cupomDesconto.value
            }
            // se o desconto for porcentagem
            if (cupomDesconto.type == 'percent') {
                novoValor = calcularPorcentagem(valorOriginal, cupomDesconto.value);
            }

            novoValor = novoValor.toFixed(2)

            if (novoValor < 0)
                novoValor = 0;

            novoValor = Number(novoValor).toLocaleString('pt-br', {
                minimumFractionDigits: 2
            });

            document.getElementById('valor-compra').innerHTML = novoValor
        }

        function calcularPorcentagem(valor, porcentagem) {
            // Calcula a porcentagem do valor
            let porcentagemCalculada = (porcentagem / 100) * valor;
            // Retorna o valor menos a porcentagem
            return valor - porcentagemCalculada;
        }

        function setMsgErroCupom(msg) {
            document.getElementById('div-msg-cupom-erro').style.display = 'block'
            document.getElementById('msg-cupom-erro').innerHTML = msg
        }

        function setMsgSucessoCupom(msg) {
            document.getElementById('div-msg-cupom-success').style.display = 'block'
            document.getElementById('msg-cupom-success').innerHTML = msg
        }

        function resetMsgs() {
            document.getElementById('div-msg-cupom-erro').style.display = 'none'
            document.getElementById('div-msg-cupom-success').style.display = 'none'
        }

        document.getElementById('aplicar-cupom').onclick = function() {
            obterCupom()
        }
    </script>

    @if (old('cupom_valido'))
        <script>
            obterCupom()
        </script>
    @endif
@endsection
