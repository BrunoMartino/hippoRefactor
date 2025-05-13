@extends('layouts.basic')
@section('title', 'Plano Atual')
@section('style')
    <style>
        .nav-tabs .nav-link.active {
            display: none
        }

        .tab-content {
            transition: all .3s;
            opacity: 1;
        }

        .tab-content.op {
            opacity: 0;
        }
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Plano atual</h4>
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
                            <li class="breadcrumb-item" aria-current="page">Plano atual</li>
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
                    <x-alerts.disable title="Cancelar Plano" desc="Você tem certeza de que deseja cancelar o plano?" />

                    <div class="pt-3">

                        @if ($subs->count() == 0)
                            <div class="alert alert-danger fs-4 text-center" role="alert">
                                Você não tem nenhum plano ativo. <a
                                    href="{{ route('config.user-account.change-plan-adquirir') }}"
                                    class='text-primary'>Clique
                                    aqui</a> para adquirir um novo plano.
                            </div>
                        @else
                            <!-- Nav tabs -->
                            <div
                                class="d-flex flex-column flex-column-reverse flex-lg-row @if ($subs->count() == 1) justify-content-center gap-0 @else  justify-content-between gap-3 gap-lg-5 @endif; align-items-center">
                                <div class="">
                                    <div
                                        class="d-inline-block px-5 py-2 fs-7 text-uppercase bg-orange-default text-white rounded-pill">
                                        @foreach ($subs as $key => $sub)
                                            <strong id="text-module">{{ $sub->plan->modulo->titulo }}</strong>
                                            @php
                                                break;
                                            @endphp
                                        @endforeach
                                    </div>
                                </div>
                                <div class="">
                                    <ul class="nav nav-tabs gap-0   " id="myTab" role="tablist">
                                        @foreach ($subs as $key => $sub)
                                            <li class="nav-item" role="presentation">
                                                <button onclick="setTextModule(this)"
                                                    class="nav-link mx-2 my-2 my-lg-0 rounded-pill px-3 py-1 fs-3 text-uppercase border-2 border-primary fw-semibold text-primary @if ($key == 0) active @endif"
                                                    id="tap-{{ $sub->plan->modulo->id }}" data-bs-toggle="tab"
                                                    data-bs-target="#item-{{ $sub->plan->modulo->id }}" type="button"
                                                    role="tab" aria-controls="item-{{ $sub->plan->modulo->id }}"
                                                    aria-selected="true">
                                                    {{ $sub->plan->modulo->titulo }}
                                                </button>
                                            </li>
                                        @endforeach
                                        {{-- <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill px-3 px-xxl-4" id="tipo-cliente-tab"
                                            data-bs-toggle="tab" data-bs-target="#tipo-cliente-item" type="button"
                                            role="tab" aria-controls="tipo-cliente-item" aria-selected="false">
                                            <div class="px-0 px-xl-2">Tipo cliente</div>
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link rounded-pill px-3 px-xxl-4" id="op-envio-tab"
                                            data-bs-toggle="tab" data-bs-target="#op-envio-item" type="button"
                                            role="tab" aria-controls="op-envio-item" aria-selected="false">
                                            <div class="px-0 px-xl-2">Opções de envio</div>
                                        </button>
                                    </li> --}}
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content" id="tab-content">
                                @foreach ($subs as $key => $sub)
                                    <div class="tab-pane @if ($key == 0) active @endif"
                                        id="item-{{ $sub->plan->modulo->id }}" role="tabpanel"
                                        aria-labelledby="tap-{{ $sub->plan->modulo->id }}">
                                        <div class="pt-4 mb-2"></div>
                                        <div class="choose-plan">
                                            <div class="row gy-4  mb-5 justify-content-center">
                                                <div class="col-12 col-md-6 col-lg-4 col-xl-4 px-lg-4 ">
                                                    <div
                                                        class="shadow overflow-hidden position-relative  rounded-1 p-4 bg-white">
                                                        <div class="icon-plan"
                                                            style="background-color: {{ $sub->plan->color }}; background-image: url({{ asset($sub->plan->icon) }});">
                                                        </div>
                                                        <div class="fs-8 fw-semibold "
                                                            style="color: {{ $sub->plan->color }}">
                                                            {{ ucfirst($sub->plan->nome) }}
                                                        </div>
                                                        <ul class="mt-2 pt-3">
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ $sub->plan->qtd_usuarios }}
                                                                    {{ $sub->plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário' }}
                                                                </div>
                                                            </li>
                                                            {{-- <li class="d-flex align-items-center gap-2 my-1">
                                                        <i class="ti ti-check fs-8"></i>
                                                        <div class="fw-semibold">
                                                            {{ $sub->plan->qtd_instancias }}
                                                            {{ $sub->plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância' }}
                                                        </div>
                                                    </li> --}}
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ number_format($sub->plan->limite_mensagens, 0, ',', '.') }}
                                                                    Mensagens
                                                                </div>
                                                            </li>
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ number_format($sub->plan->custo_excedente, 3, ',', '.') }}
                                                                    por mensagem excedente</div>
                                                            </li>
                                                        </ul>
                                                        <div class="fs-8 d-flex justify-content-center pt-2 fw-semibold">
                                                            @if ($sub->plan->valor == 0)
                                                                7 dias grátis
                                                            @else
                                                                <div class="fs-2 d-inline-block " style="padding-top: 3px">
                                                                    R$
                                                                </div>
                                                                <div class="d-inline-block">
                                                                    {{ number_format($sub->plan->valor, 2, ',', '.') }}/
                                                                    Mês
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="py-3">
                                                            @if ($sub->days_expire_paid_plan == 'Expirado')
                                                                <div class="text-danger text-center fw-semibold fs-4"
                                                                    style="margin-bottom: -15px; margin-top: -10px">
                                                                    Expirado
                                                                </div>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-3 pb-3 d-flex justify-content-center gap-2 {{$sub->days_expire_paid_plan == 'Expirado' ? 'gap-lg-3' : 'gap-lg-4'}}  mb-3">
                                            <div class="">
                                                @if ($sub->days_expire_paid_plan == 'Expirado')
                                                    <a href="{{ route('payment.change-plan', $sub->plan->id) }}"
                                                        type="submit"
                                                        class="btn btn-primary w-100 fs-5 text-white px-4 px-lg-5 @if (auth()->user()->hasPermissionTo('edit-config-conta') == false) disabled @endif">
                                                        <div class="px-lg-3">
                                                            Renovar Plano
                                                        </div>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="">
                                                <a href="{{ route('config.user-account.change-plan-set-session', $sub->plan->modulo->id) }}"
                                                    type="submit"
                                                    class="btn btn-orange w-100 fs-5 text-white px-4 px-lg-5 @if (auth()->user()->hasPermissionTo('edit-config-conta') == false) disabled @endif">
                                                    <div class="px-lg-3">
                                                        Trocar de Plano
                                                    </div>
                                                </a>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    onclick="serUrlDisable(`{{ route('config.user-account.cancel-plan', $sub->plan->id) }}`)"
                                                    class="btn btn-light btn-light-2 w-100 fs-5 px-4 px-lg-5 @if (auth()->user()->hasPermissionTo('edit-config-conta') == false) disabled @endif ">
                                                    <div class="px-lg-3">Cancelar Plano</div>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setTextModule(el) {
            if (el.className.indexOf('active') != -1) {
                document.getElementById('text-module').innerHTML = el.innerHTML
                localStorage.setItem('tab_module', el.id)
                document.getElementById('tab-content').classList.add('op')
                setTimeout(() => {
                    document.getElementById('tab-content').classList.remove('op')
                }, 500);
            }
        }
        setTimeout(() => {
            if (localStorage.getItem('tab_module')) {
                document.getElementById(localStorage.getItem('tab_module')).click()
            }
        }, 10);
    </script>
@endsection
