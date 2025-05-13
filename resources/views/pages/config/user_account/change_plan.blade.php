@extends('layouts.basic')
@section('title', 'Trocar de Plano')
@section('style')
    <style>
        .link-modulos:hover {
            transition: all .2s;
            background: var(--bs-primary);
            color: white !important
        }

        @media (max-width: 600px) {
            .btn-teste-gratis {
                font-size: 14px !important
            }
        }
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Trocar de Plano</h4>
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
                            <li class="breadcrumb-item" aria-current="page">Trocar de Plano</li>
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
                    <x-alerts.disable title="Teste grátis por 7 dias"
                        desc="Você tem certeza de que deseja trocar seu plano para o teste grátis?" />

                    <div class="choose-plan">

                        <!--  -->
                        {{-- 
                        <nav>
                            <div class="container pt-4 pt-3 pt-lg-4 mt-4 mb-3">
                                <div
                                    class="row align-items-center g-4 g-lg-5 justify-content-center justify-content-lg-between">

                                    <div class="col-12 pt-4 pt-lg-0  col-xl-4 text-center order-3 order-xl-2 ">
                                        <div class="mx-auto d-inline-block text-uppercase text-primary fs-9 border px-5 border-2 fw-bolder py-2 rounded-pill border-primary"
                                            style="">
                                            Remarketing
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-xl-4 order-2 order-xl-3">
                                        <div class="d-flex gap-2 btns-navbar justify-content-center justify-content-lg-end">
                                            <a href=""
                                                class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                                Cobrança
                                            </a>
                                            <a href=""
                                                class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                                Ratreio
                                            </a>
                                            <a href=""
                                                class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                                Faturamento
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </nav>
                         --}}

                        <div class="container">
                            <div class="">

                                @if (!is_null(session('current_module_id')))
                                    <div class="alert alert-light text-dark fs-4 fw-semibold " role="alert">
                                        <div class="mb-1">Aqui você pode realizar a mudança de plano(s) do(s) módulo(s) já
                                            adquirido(s).</div>
                                        <div class="">Para trocar/adquirir plano(s) de novo(s) módulo(s) basta <a
                                                href="{{ route('config.user-account.change-plan-adquirir') }}"
                                                class="text-primary">clicar aqui</a> ou clicar no botão Trocar/Adquirir
                                            plano
                                            (botão laranja) no menu superior.</div>
                                    </div>
                                @endif

                                <div class="text-center fw-semibold fs-7 mb-md-4 pb-2">
                                    <div class="pt-md-2">
                                        Selecione um plano:
                                    </div>
                                </div>
                                <!-- Planos -->
                                <div class="row gy-5  pb-4 gx-5  ">
                                    @if (is_null(session('current_module_id')))
                                        @php
                                            $modulos = \App\Models\Modulo::orderBy('titulo')->get();
                                        @endphp

                                        @foreach ($modulos as $keyM => $modulo)
                                            @php
                                                $ocultarBtnGratis = false;

                                                if (
                                                    !\App\Models\Subscription::whereHas('plan', function ($q) use (
                                                        $modulo,
                                                    ) {
                                                        return $q
                                                            ->where('modulo_id', $modulo->id)
                                                            ->where('valor', '>', 0);
                                                    })
                                                        ->where('status', 'ativo')
                                                        ->where('user_id', user_princ()->id)
                                                        ->exists()
                                                ) {
                                                    $ocultarBtnGratis = true;
                                                }
                                            @endphp


                                            <div class="@if ($keyM > 0) pt-4 @endif d-flex align-items-center flex-wrap justify-content-center  justify-content-md-between gap-3 "
                                                style="margin-bottom: -20px">
                                                <div class="">
                                                    <div class="fs-8 text-uppercase d-inline-block px-5 py-1 rounded-pill text-primary "
                                                        style="border:2px solid var(--bs-primary)">
                                                        <div class="px-1 px-lg-1">
                                                            <strong>
                                                                {{ $modulo->titulo }}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="">

                                                    @foreach ($planos as $key => $plan)
                                                        @if ($plan->valor == 0 && $plan->modulo_id == $modulo->id)
                                                            {{-- 'config.user-account.set-free-plan' --}}
                                                            @php
                                                                $hasFreePlan = \App\Models\Subscription::where(
                                                                    'plan_id',
                                                                    $plan->id,
                                                                )
                                                                    ->where('user_id', user_princ()->id)
                                                                    ->where('status', 'ativo')
                                                                    ->exists();
                                                            @endphp

                                                            @if ($ocultarBtnGratis)
                                                                @if (!\App\Models\Subscription::where('plan_id', $plan->id)->where('user_id', user_princ()->id)->where('status', 'inativo')->exists())
                                                                    <button type="button"
                                                                        onclick="serUrlDisable(`{{ route('config.user-account.set-free-plan', $plan->id) }}`)"
                                                                        class="btn btn-primary px-4 px-lg-5 py-1 fs-5 rounded-pill btn-teste-gratis @if ($hasFreePlan) disabled @endif">
                                                                        <div class="px-lg-2">
                                                                            Teste grátis por 7 dias
                                                                        </div>
                                                                    </button>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>

                                            @foreach ($planos as $key => $plan)
                                                @if ($plan->valor == 0 || $plan->modulo_id != $modulo->id)
                                                @else
                                                    @php
                                                        $planPaidOcultar = true;
                                                        if (
                                                            \App\Models\Subscription::where('plan_id', $plan->id)
                                                                ->where('status', 'ativo')
                                                                ->first() &&
                                                            \App\Models\Subscription::where('plan_id', $plan->id)
                                                                ->where('status', 'ativo')
                                                                ->first()->days_expire_paid_plan != 'Expirado'
                                                        ) {
                                                            $planPaidOcultar = false;
                                                        }
                                                    @endphp

                                                    <div class="col-12 col-md-6 col-lg-4 col-xl-4 px-0 px-md-2 px-lg-4 ">
                                                        <div
                                                            class="shadow overflow-hidden position-relative  rounded-1 p-4 bg-white @if (\App\Models\Subscription::where('user_id', user_princ()->id)->where('status', 'ativo')->where('plan_id', $plan->id)->exists() && $planPaidOcultar == false) card-blur @endif ">

                                                            <div class="icon-plan"
                                                                style="background-color: {{ $plan->color }}; background-image: url({{ asset($plan->icon) }}); z-index: 1">
                                                            </div>

                                                            <div class="position-relative" style="z-index: 2">
                                                                <div class="fs-8 fw-semibold "
                                                                    style="color: {{ $plan->color }}">
                                                                    {{ ucfirst($plan->nome) }}
                                                                </div>
                                                                <ul class="mt-2">
                                                                    <li class="d-flex align-items-center gap-2 my-1">
                                                                        <i class="ti ti-check fs-8"></i>
                                                                        <div class="fw-semibold">
                                                                            {{ $plan->qtd_usuarios }}
                                                                            {{ $plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário' }}
                                                                        </div>
                                                                    </li>
                                                                    {{-- <li class="d-flex align-items-center gap-2 my-1">
                                                                        <i class="ti ti-check fs-8"></i>
                                                                        <div class="fw-semibold">
                                                                            {{ $plan->qtd_instancias }}
                                                                            {{ $plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância' }}
                                                                        </div>
                                                                    </li> --}}
                                                                    <li class="d-flex align-items-center gap-2 my-1">
                                                                        <i class="ti ti-check fs-8"></i>
                                                                        <div class="fw-semibold">
                                                                            {{ number_format($plan->limite_mensagens, 0, ',', '.') }}
                                                                            Mensagens
                                                                        </div>
                                                                    </li>
                                                                    <li class="d-flex align-items-center gap-2 my-1">
                                                                        <i class="ti ti-check fs-8"></i>
                                                                        <div class="fw-semibold">
                                                                            {{ number_format($plan->custo_excedente, 3, ',', '.') }}
                                                                            por mensagem excedente</div>
                                                                    </li>
                                                                </ul>
                                                                <div
                                                                    class="fs-8 d-flex justify-content-center pt-2 fw-semibold">
                                                                    <div class="fs-2 d-inline-block "
                                                                        style="padding-top: 3px">
                                                                        R$
                                                                    </div>
                                                                    <div class="d-inline-block">
                                                                        {{ number_format($plan->valor, 2, ',', '.') }}/ Mês
                                                                    </div>
                                                                </div>
                                                                <div class="pt-4 pb-3">
                                                                    <a href="{{ route('payment.change-plan', $plan->id) }}"
                                                                        class="btn-submit-plan btn w-100 fs-5 text-white @if (\App\Models\Subscription::where('user_id', user_princ()->id)->where('status', 'ativo')->where('plan_id', $plan->id)->exists() && $planPaidOcultar == false) disabled @endif"
                                                                        style="background-color: {{ $plan->color }}; border-color: {{ $plan->color }}">
                                                                        @php
                                                                            $xSub = \App\Models\Subscription::where(
                                                                                'plan_id',
                                                                                $plan->id,
                                                                            )
                                                                                ->where('status', 'ativo')
                                                                                ->first();
                                                                        @endphp
                                                                        @if ($xSub && $xSub->days_expire_paid_plan == 'Expirado')
                                                                            Renovar
                                                                        @else
                                                                            Selecionar
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else
                                        {{-- Exibe apenas os planos no qual o usuário tem o módulo --}}

                                        <div class="d-flex align-items-center flex-wrap justify-content-between gap-3"
                                            style="margin-bottom: -20px">
                                            <div class="">
                                                <div class="fs-8 text-uppercase d-inline-block px-5 py-1 rounded-pill text-primary "
                                                    style="border:2px solid var(--bs-primary)">
                                                    @php
                                                        $modulo = \App\Models\Modulo::find(
                                                            session('current_module_id'),
                                                        );
                                                        $modulos = \App\Models\Modulo::whereNotIn('id', [$modulo->id])
                                                            ->orderBy('titulo')
                                                            ->get();
                                                    @endphp
                                                    <strong>
                                                        {{ $modulo->titulo }}
                                                    </strong>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="d-flex gap-3 ">
                                                    @foreach ($modulos as $item)
                                                        @php

                                                            if (
                                                                !\App\Models\Subscription::where(
                                                                    'user_id',
                                                                    user_princ()->id,
                                                                )
                                                                    ->where('status', 'ativo')
                                                                    ->whereHas('plan', function ($query) use ($item) {
                                                                        return $query->where('modulo_id', $item->id);
                                                                    })
                                                                    ->exists()
                                                            ) {
                                                                continue;
                                                            }
                                                        @endphp
                                                        <a href="{{ route('config.user-account.change-plan-set-session', $item->id) }}"
                                                            class="fs-3 text-uppercase d-inline-block px-3 py-1 rounded-pill text-primary fw-semibold link-modulos "
                                                            style="border:2px solid var(--bs-primary)">
                                                            {{ $item->titulo }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        @foreach ($planos as $key => $plan)
                                            @php

                                                if ($plan->valor == 0) {
                                                    continue;
                                                }
                                                if ($plan->modulo_id != session('current_module_id')) {
                                                    continue;
                                                }

                                                if (
                                                    !\App\Models\Subscription::where('user_id', user_princ()->id)
                                                        ->where('status', 'ativo')
                                                        ->whereHas('plan', function ($query) {
                                                            return $query->where(
                                                                'modulo_id',
                                                                session('current_module_id'),
                                                            );
                                                        })
                                                        ->exists()
                                                ) {
                                                    continue;
                                                }

                                            @endphp


                                            @php
                                                $planPaidOcultar = true;
                                                if (
                                                    \App\Models\Subscription::where('plan_id', $plan->id)
                                                        ->where('status', 'ativo')
                                                        ->first() &&
                                                    \App\Models\Subscription::where('plan_id', $plan->id)
                                                        ->where('status', 'ativo')
                                                        ->first()->days_expire_paid_plan != 'Expirado'
                                                ) {
                                                    $planPaidOcultar = false;
                                                }
                                            @endphp


                                            <div class="col-12 col-md-6 col-lg-4 col-xl-4 px-lg-4 ">
                                                <div
                                                    class="shadow overflow-hidden position-relative  rounded-1 p-4 bg-white @if (\App\Models\Subscription::where('user_id', user_princ()->id)->where('status', 'ativo')->where('plan_id', $plan->id)->exists() && $planPaidOcultar == false) card-blur @endif ">

                                                    <div class="icon-plan"
                                                        style="background-color: {{ $plan->color }}; background-image: url({{ asset($plan->icon) }}); z-index: 1">
                                                    </div>

                                                    <div class="position-relative" style="z-index: 2">
                                                        <div class="fs-8 fw-semibold " style="color: {{ $plan->color }}">
                                                            {{ ucfirst($plan->nome) }}
                                                        </div>
                                                        <ul class="mt-2">
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ $plan->qtd_usuarios }}
                                                                    {{ $plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário' }}
                                                                </div>
                                                            </li>
                                                            {{-- <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ $plan->qtd_instancias }}
                                                                    {{ $plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância' }}
                                                                </div>
                                                            </li> --}}
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ number_format($plan->limite_mensagens, 0, ',', '.') }}
                                                                    Mensagens
                                                                </div>
                                                            </li>
                                                            <li class="d-flex align-items-center gap-2 my-1">
                                                                <i class="ti ti-check fs-8"></i>
                                                                <div class="fw-semibold">
                                                                    {{ number_format($plan->custo_excedente, 3, ',', '.') }}
                                                                    por mensagem excedente</div>
                                                            </li>
                                                        </ul>
                                                        <div class="fs-8 d-flex justify-content-center pt-2 fw-semibold">
                                                            <div class="fs-2 d-inline-block " style="padding-top: 3px">R$
                                                            </div>
                                                            <div class="d-inline-block">
                                                                {{ number_format($plan->valor, 2, ',', '.') }}/ Mês
                                                            </div>
                                                        </div>
                                                        <div class="pt-4 pb-3">
                                                            <a href="{{ route('payment.change-plan', $plan->id) }}"
                                                                class="btn-submit-plan btn w-100 fs-5 text-white @if (\App\Models\Subscription::where('user_id', user_princ()->id)->where('status', 'ativo')->where('plan_id', $plan->id)->exists() && $planPaidOcultar == false) disabled @endif"
                                                                style="background-color: {{ $plan->color }}; border-color: {{ $plan->color }}">
                                                                @php
                                                                    $xSub = \App\Models\Subscription::where(
                                                                        'plan_id',
                                                                        $plan->id,
                                                                    )
                                                                        ->where('status', 'ativo')
                                                                        ->first();
                                                                @endphp
                                                                @if ($xSub && $xSub->days_expire_paid_plan == 'Expirado')
                                                                    Renovar
                                                                @else
                                                                    Selecionar
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
