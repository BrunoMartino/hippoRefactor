@extends('layouts.basic')
@section('title', 'Cartão')
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
                            <li class="breadcrumb-item" aria-current="page">Cartão</li>
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
                    <form action="{{ route('payment.change-plan.confirm-payment-plan', $plan->id) }}" method="post"
                        id="form">
                        @csrf
                        <div class="row">
                            <div class="col-12 px-0 px-md-3">
                                <div class="fw-semibold fs-4 mb-1">
                                    Itens da compra:
                                </div>
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

                        <div class="px-1">
                            <div class="fs-4 fw-semibold mt-3 pt-2">
                                Método de pagamento atual:
                            </div>




                            <div
                                class="d-flex flex-column flex-lg-row bg-light px-3 py-3 pt-2 align-items-center rounded mt-2">
                                {{-- <div class="fs-5">
                                    Cartão:
                                    <div class="d-inline-block ms-3">
                                        <span>{{ $card->card_number }}</span>
                                        <span class="badge rounded-pill text-bg-dark">{{ $card->brand }}</span>
                                    </div>

                                </div> --}}
                                <div class="">
                                    <div class=" ">
                                        <div class="px-2">
                                            Cartão de crédito
                                        </div>
                                        <div class="input-group" style="max-width: 330px; ">
                                            <div type="text" class="form-control fs-6 py-1 px-4 "
                                                style="border-color: rgb(189, 189, 189) !important">
                                                {{ $card->card_number }}
                                            </div>
                                            <span class="input-group-text bg-transparent border px-2 py-1"
                                                style="border-color: rgb(189, 189, 189) !important" id="basic-addon2">
                                                <img src="{{ $card->url_brand }}" class="" height="14"
                                                    alt="{{ $card->brand }}" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex gap-2 pt-2">
                                        <a href="{{ route('payment.change-plan.change-card') }}"
                                            class="btn btn-primary">
                                            TROCAR
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                               <h5>Pagamento Seguro SSL - Seu pagamento é protegido por criptografia SSL de alta qualidade.</h5> 
                            </div>


                            <div class="text-center mt-3 mb-5 pt-5">
                                <div class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                    <button type="submit" class="btn btn-primary  px-5 fs-4">
                                        <div class="px-lg-4">Realizar Pagamento</div>
                                    </button>
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
