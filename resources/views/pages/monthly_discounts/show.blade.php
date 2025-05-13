@extends('layouts.basic')
@section('title', 'Visualizar Desconto')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Desconto</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('coupons.index') }}">Cupons de
                                    desconto</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Desconto</li>
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
                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    <div class="row gy-4">
                        <!-- cliente -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Cliente:</strong></div>
                                <div class="fs-5">{{ $md->user->nome_usuario }}</div>
                            </div>
                        </div>
                        <!-- modulo -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Módulo:</strong></div>
                                <div class="fs-5">{{ $md->modulo->titulo }}</div>
                            </div>
                        </div>
                        <!-- plano -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Plano:</strong></div>
                                <div class="fs-5">{{ ucfirst($md->plano->nome) }}</div>
                            </div>
                        </div>
                        <!-- Desconto -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Desconto:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($md->valor))
                                        Percentual:
                                    @else
                                        Valor:
                                    @endif

                                    @if (is_null($md->valor))
                                        {{ $md->porcentagem }}%
                                    @else
                                        R$ {{ number_format($md->valor, 2, ',', '.') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Data Ínicio -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Ínicio:</strong></div>
                                <div class="fs-5">{{ date('m/Y', strtotime($md->dt_inicio)) }}</div>
                            </div>
                        </div>
                        <!-- Data Termino -->
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Data Termino:</strong></div>
                                <div class="fs-5">{{ date('m/Y', strtotime($md->dt_termino)) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('descontos-mensais.index') }}" class="btn btn-primary  px-5 fs-5">
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
