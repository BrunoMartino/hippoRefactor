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
                    <form action="{{ route('usuarios.comprar.confirm-payment-pix') }}" method="post" id="form">
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
<br><br><h3>
@php
    echo 'Id fatura: '.session('invoiceId');
@endphp
</h3>
                                                                <div class="text-center mt-5 mb-5 pt-3">
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                                                        <button type="submit"
                                                                            class="btn btn-primary  px-5 fs-4"
                                                                            id="btn-confirmar-pix">
                                                                            <div class="px-lg-2">Confirmar Pagamento
                                                                            </div>
                                                                        </button>
                                                                        @if (!session()->has('tipoPagamento'))
                                                                            <a href="{{ route('usuarios.comprar.pagar.cartao') }}"
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
@endsection
@section('scripts')
    <script>
        function copyCode(target) {
            document.getElementById('pix-copia-cola').select()
            document.execCommand('copy');
        }
    </script>
@endsection