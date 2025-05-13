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
                                    href="{{ route('config.user-account.change-plan') }}">Pagar Plano</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Pagamento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="pagamento">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 px-0">

                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif


                                    <div class="row">
                                        <div class="col-12 px-0 px-md-3">
                                            <div class="fw-semibold fs-4 mb-1">
                                                Itens da compra:
                                            </div>
                                            <div class="mb-4 mb-md-0 d-flex gap-3 fs-7 justify-content-between px-3 py-2 rounded  align-items-center text-truncate "
                                                style="background: #f5f6f6">
                                                <div class="">
                                                    {{ $itensCompra }}
                                                </div>
                                                <div class=" text-end ">
                                                    <strong>R$
                                                        <span id="valor-compra">
                                                            {{ number_format($valorPagar, 2, ',', '.') }}
                                                        </span>
                                                    </strong>
                                                </div>
                                            </div>

                                            <div class="fw-semibold fs-4 mb-1 mt-4">
                                                Formas de pagamento:
                                            </div>
                                        </div>
                                    </div>



                                    <div>
                                        <!-- Nav tabs -->
                                        <ul id="tabs-metodo-pg"
                                            class="nav tabs-modulos nav-tabs  gap-4 flex-column flex-md-row flex-nowrap "
                                            role="tablist">
                                            <li class="nav-item  w-100 p-lg-3 px-lg-5 " id='nav-tab-cartao'>
                                                <a class="nav-link py-0 px-5 mx-auto me-md-0 ms-md-auto text-center active"
                                                    id="btn-selecionar-cartao" href="{{ route('payment.cartao') }}"
                                                    role="tab" style="max-width: 250px">
                                                    <div class="py-4">
                                                        <div class="mb-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-credit-card-filled"
                                                                width="55" height="55" viewBox="0 0 24 24"
                                                                stroke-width="1.5" stroke="currentColor" fill="none"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M22 10v6a4 4 0 0 1 -4 4h-12a4 4 0 0 1 -4 -4v-6h20zm-14.99 4h-.01a1 1 0 1 0 .01 2a1 1 0 0 0 0 -2zm5.99 0h-2a1 1 0 0 0 0 2h2a1 1 0 0 0 0 -2zm5 -10a4 4 0 0 1 4 4h-20a4 4 0 0 1 4 -4h12z"
                                                                    stroke-width="0" fill="currentColor" />
                                                            </svg>
                                                        </div>
                                                        <span>Cartão de crédito</span>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item w-100 p-lg-3 px-lg-5" id="nav-tab-pix">
                                                {{-- <a class=" " --}}
                                                <a class=" nav-link py-0 px-5 mx-auto text-center bg-orange active ms-md-0 me-md-auto"
                                                    id="btn-pix" href="{{ route('payment.pix') }}" role="tab"
                                                    style="max-width: 250px">
                                                    <div class="py-4">
                                                        <div class="mb-2">
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-api-app" width="55"
                                                                height="55" viewBox="0 0 24 24" stroke-width="1"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M12 15h-6.5a2.5 2.5 0 1 1 0 -5h.5" />
                                                                <path d="M15 12v6.5a2.5 2.5 0 1 1 -5 0v-.5" />
                                                                <path d="M12 9h6.5a2.5 2.5 0 1 1 0 5h-.5" />
                                                                <path d="M9 12v-6.5a2.5 2.5 0 0 1 5 0v.5" />
                                                            </svg> --}}

                                                            <div class="">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="55"
                                                                    height="55" fill="white"
                                                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                                    <path
                                                                        d="M242.4 292.5C247.8 287.1 257.1 287.1 262.5 292.5L339.5 369.5C353.7 383.7 372.6 391.5 392.6 391.5H407.7L310.6 488.6C280.3 518.1 231.1 518.1 200.8 488.6L103.3 391.2H112.6C132.6 391.2 151.5 383.4 165.7 369.2L242.4 292.5zM262.5 218.9C256.1 224.4 247.9 224.5 242.4 218.9L165.7 142.2C151.5 127.1 132.6 120.2 112.6 120.2H103.3L200.7 22.8C231.1-7.6 280.3-7.6 310.6 22.8L407.8 119.9H392.6C372.6 119.9 353.7 127.7 339.5 141.9L262.5 218.9zM112.6 142.7C126.4 142.7 139.1 148.3 149.7 158.1L226.4 234.8C233.6 241.1 243 245.6 252.5 245.6C261.9 245.6 271.3 241.1 278.5 234.8L355.5 157.8C365.3 148.1 378.8 142.5 392.6 142.5H430.3L488.6 200.8C518.9 231.1 518.9 280.3 488.6 310.6L430.3 368.9H392.6C378.8 368.9 365.3 363.3 355.5 353.5L278.5 276.5C264.6 262.6 240.3 262.6 226.4 276.6L149.7 353.2C139.1 363 126.4 368.6 112.6 368.6H80.8L22.8 310.6C-7.6 280.3-7.6 231.1 22.8 200.8L80.8 142.7H112.6z" />
                                                                </svg>
                                                            </div>
                                                        </div>
                                                        <span>Pix</span>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="py-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection
