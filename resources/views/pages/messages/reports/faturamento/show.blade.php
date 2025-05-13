@extends('layouts.basic')
@section('title', 'Visualizar Faturamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Faturamento</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.crud.index') }}">Mensagens</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.charge-report.index') }}">Relatório Faturamento</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Faturamento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />

                    <div class="row gy-4">
                        
                        
                        <!-- Nome -->
                        <div class="mb-3 col-12 ">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Nome:</strong></div>
                                <div class="fs-5">
                                    {{ $report->nome_cliente }}
                                </div>
                            </div>
                        </div>
                        <!-- Pedido -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Pedido:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($report->idPedido))
                                        -
                                    @else
                                        {{$report->idPedido}}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Nota Fiscal -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Nota Fiscal:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($report->idNotaFiscal))
                                        -
                                    @else
                                        {{$report->idNotaFiscal}}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Contrato -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Contrato:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($report->idContrato))
                                        -
                                    @else
                                        {{ $report->idContrato }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Data Envio -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Envio:</strong></div>
                                <div class="fs-5">
                                    {{ date('d/m/Y H:i', strtotime($report->data_envio)) }}
                                </div>
                            </div>
                        </div>
                        <!-- Situação -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Situação:</strong></div>
                                <div class="fs-5">
                                    @switch($report->situacao)
                                        @case('entregue')
                                            <span class="bg-primary badge rounded-pill"
                                                style="background: #0853FC !important; border-color: #0853FC !important">
                                                Entregue
                                            </span>
                                        @break

                                        @case('nao_entregue')
                                            <span class="bg-orange badge rounded-pill"
                                                style="background: #ff783e !important; border-color: #ff783e !important">
                                                Não entregue
                                            </span>
                                        @break

                                        @case('visualizado')
                                            <span ty class="bg-success badge rounded-pill"
                                                style="background: #37bb37; border-color: #37bb37">
                                                Visualizado
                                            </span>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        <!-- Data Visualização -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Visualização:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($report->data_visualizado))
                                        -
                                    @else
                                        {{ date('d/m/Y H:i', strtotime($report->data_visualizado)) }}
                                    @endif
                                </div>
                            </div>
                        </div>


                        

                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        @if (url()->previous() != url()->full())
                            <a href="{{ url()->previous() }}" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Voltar</div>
                            </a>
                        @else
                            <a href="{{ route('messages.ft-report.index') }}" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Voltar</div>
                            </a>
                        @endif
                    </div>




                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
@endsection
