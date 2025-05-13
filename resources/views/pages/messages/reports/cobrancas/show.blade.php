@extends('layouts.basic')
@section('title', 'Visualizar Cobrança')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Cobrança</h4>
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
                                    href="{{ route('messages.charge-report.index') }}">Relatório Cobranças</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Cobrança</li>
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
                                    {{ $billingsReport->nome_cliente }}
                                </div>
                            </div>
                        </div>
                        <!-- Pedido -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Pedido:</strong></div>
                                <div class="fs-5">
                                    @if ($billingsReport->idPedido)
                                        {{ $billingsReport->idPedido }}
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Nota fiscal -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Nota fiscal:</strong></div>
                                <div class="fs-5">
                                    @if ($billingsReport->idNotaFiscal)
                                        {{ $billingsReport->idNotaFiscal }}
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Contrato -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Contrato:</strong></div>
                                <div class="fs-5">
                                    @if ($billingsReport->idContrato)
                                        {{ $billingsReport->idContrato }}
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Vencimento -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Vencimento:</strong></div>
                                <div class="fs-5">
                                    @if ($contasReceber)
                                        {{ date('d/m/Y', strtotime($contasReceber->vencimento)) }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Tipo -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Tipo:</strong></div>
                                <div class="fs-5">
                                    @switch($billingsReport->message->type)
                                        @case('COBRANÇA GERADA')
                                            <span class="" style="">
                                                Gerada
                                            </span>
                                        @break

                                        @case('COBRANÇA VENCENDO')
                                            <span class="" style="">
                                                Vencendo
                                            </span>
                                        @break

                                        @case('COBRANÇA VENCIMENTO')
                                            <span class="" style="">
                                                Vencimento
                                            </span>
                                        @break

                                        @case('COBRANÇA VENCIDA')
                                            <span class="" style="">
                                                Vencido
                                            </span>
                                        @break
                                    @endswitch
                                </div>
                            </div>
                        </div>

                        <!-- Data Envio -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Envio:</strong></div>
                                <div class="fs-5">
                                    {{ date('d/m/Y H:i', strtotime($billingsReport->data_envio)) }}
                                </div>
                            </div>
                        </div>
                        <!-- Situação -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Situação:</strong></div>
                                <div class="fs-5">
                                    @switch($billingsReport->situacao)
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
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Visualização:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($billingsReport->data_visualizado))
                                        -
                                    @else
                                        {{ date('d/m/Y H:i', strtotime($billingsReport->data_visualizado)) }}
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
                            <a href="{{ route('messages.charge-report.index') }}" class="btn btn-primary  px-5 fs-5">
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
