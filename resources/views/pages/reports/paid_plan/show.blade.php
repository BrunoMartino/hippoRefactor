@extends('layouts.basic')
@section('title', 'Visualizar Relatórios - Plano pago')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Relatórios - Plano pago</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('reports.paid.plan') }}">Relatórios</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Plano pago</li>
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
                            Cliente:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['cliente'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Módulo:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['modulo'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Plano:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['plano'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Valor Plano:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['valor_plano'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Valor Pago:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['valor_pago'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Cupom:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['cupom'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Valor Cupom:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['valor_cupom'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data Compra:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['data_compra'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data Troca Plano:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['data_troca_plano'] }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data Cancelamento:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $dataPaidPlan['data_cancelamento'] }}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('reports.paid.plan') }}" class="btn btn-primary  px-5 fs-5 ">
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
