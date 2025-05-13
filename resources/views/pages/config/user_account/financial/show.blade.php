@extends('layouts.basic')
@section('title', 'Visualizar Fatura')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Fatura - Financeiro</h4>
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
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('config.user-account.financial') }}">Financeiro</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Fatura</li>
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
                    <div class="row">
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Módulo:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $fatura->plan->modulo->titulo }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Plano:
                            <div class="text-dark fs-6 border-bottom">
                                {{ ucfirst($fatura->plan->nome) }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Tipo:
                            <div class="text-dark fs-6 border-bottom">
                                {{ typeInvoice($fatura->type) }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Valor:
                            <div class="text-dark fs-6 border-bottom">
                                {{ convertStringNumber($fatura->total_value) }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data emissão:
                            <div class="text-dark fs-6 border-bottom">
                                {{ convertStringDate($fatura->created_at) }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data pagamento:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $fatura->date_payment == '' ? '-' : convertStringDate($fatura->date_payment) }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Status:
                            <div class="text-dark fs-6 border-bottom">
                                @if ($fatura->status == 'waitingPayment')
                                    <span class="" style="width: 90px"
                                        style="padding-top: 6px; padding-bottom: 6px">
                                        Gerado
                                    </span>
                                @endif
                                @if ($fatura->status == 'overdue')
                                    <span class="-" style="width: 90px"
                                        style="padding-top: 6px; padding-bottom: 6px">
                                        Aberto
                                    </span>
                                @endif
                                @if ($fatura->status == 'paid')
                                    <span class="" style="width: 90px"
                                        style="padding-top: 6px; padding-bottom: 6px">
                                        Pago
                                    </span>
                                @endif
                                @if ($fatura->status == 'processing')
                                    <span class=""
                                        style="width: 90px" style="padding-top: 6px; padding-bottom: 6px">
                                        Processando
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('config.user-account.financial') }}" class="btn btn-primary  px-5 fs-5 ">
                            <div class="px-lg-5">Voltar</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
