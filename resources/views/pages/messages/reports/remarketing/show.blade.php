@extends('layouts.basic')
@section('title', 'Visualizar Envio')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Envio</h4>
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
                                    href="{{ route('messages.rm-report.index') }}">Relatório Remarketing</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Envio</li>
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
                                    @if ($report->nome_cliente)
                                        {{ $report->nome_cliente }}
                                    @else
                                        <span class="text-danger">Deletada</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Tipo Mensagem -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Tipo Mensagem:</strong></div>
                                <div class="fs-5">
                                    {{ $report->message->type }}
                                </div>
                            </div>
                        </div>
                        <!-- Pedido -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Pedido:</strong></div>
                                <div class="fs-5">
                                    {{ $report->pedido }}
                                </div>
                            </div>
                        </div>
                        <!-- Nota fiscal -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Nota fiscal:</strong></div>
                                <div class="fs-5">
                                    {{ $report->nota_fiscal }}
                                </div>
                            </div>
                        </div>
                        <!-- Data envio -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data envio:</strong></div>
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
                                            <span class="d-inline-block bg-primary badge px-4 fw-semibold rounded-pill"
                                                style=" background: #0853FC !important; border-color: #0853FC !important">
                                                Entregue
                                            </span>
                                        @break

                                        @case('nao_entregue')
                                            <span class="d-inline-block bg-orange badge px-4 fw-semibold rounded-pill"
                                                style=" background: var(--bs-orange) !important; border-color: var(--bs-orange) !important">
                                                Não entregue
                                            </span>
                                        @break

                                        @case('visualizado')
                                            <span class="d-inline-block bg-success badge px-4 fw-semibold rounded-pill"
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
                        <!-- Mensagem enviada -->
                        <div class="mb-3 col-12 col-sm-6 col-md-12 col-lg-12">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Mensagem enviada:</strong></div>
                                <div class="fs-5">
                                    @if ($report->message)
                                        @if ($report->message->type == 'PESQUISA SATISFAÇÃO')
                                            {{ isset($report->message->satisfaction_survey['pergunta_inicial']['pergunta']) ? Str::limit($report->message->satisfaction_survey['pergunta_inicial']['pergunta'], 10000000) : '' }}
                                        @else
                                            {{ $report->message->description }}
                                        @endif
                                    @else
                                        --
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
                            <a href="{{ route('messages.rm-report.index') }}" class="btn btn-primary  px-5 fs-5 ">
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
