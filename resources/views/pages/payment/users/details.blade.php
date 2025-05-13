@extends('layouts.basic')
@section('title', 'Comprar Usuários')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Comprar Usuários</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('usuarios') }}">Usuários</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Comprar Usuários</li>
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
                    <form action="{{ route('usuarios.comprar.confirm-detalhes') }}" method="post" id="form">
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
                                                    <div class="">
                                                        {{ $total }}un
                                                    </div>
                                                    <div class=" text-end ">
                                                        <strong>R$
                                                            <span id="valor-compra">
                                                                {{ number_format($valor, 2, ',', '.') }}
                                                            </span>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-center py-5">
                                                <div class="mb-2 pb-1 fs-5   text-center" role="alert">
                                                    <strong>O valor dessa compra será cobrada em sua próxima fatura (assinatura mensal).</strong>
                                                </div>

                                                <button type="submit" class="btn btn-orange btn-lg px-5">
                                                    Efetuar Compra
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

@endsection
