@extends('layouts.auth.basic_auth')
@section('style')
@endsection
@section('content')
    <div class="choose-plan">
        <nav>
            <div class="container pt-4 pt-3 pt-lg-4 mt-4 mb-3">
                <div class="row align-items-center g-4 g-lg-5 justify-content-center justify-content-lg-between">
                    <div class="col-12 col-lg-6 col-xl-4 order-1 order-xl-1">
                        <div class="mx-auto mx-lg-0" style="max-width: 230px">
                            <a class="navbar-brand" href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/backgrounds/logo-hippo.png') }}" alt="Hippo Notify"
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 pt-4 pt-lg-0  col-xl-4 text-center order-3 order-xl-2 ">
                        <div class="mx-auto d-inline-block text-uppercase text-primary fs-9 border px-5 border-2 fw-bolder py-2 rounded-pill border-primary"
                            style="">
                            Remarketing
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-4 order-2 order-xl-3">
                        <div class="d-flex gap-2 btns-navbar justify-content-center justify-content-lg-end">
                            <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                Cobrança
                            </a>
                            <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                Ratreio
                            </a>
                            <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                Faturamento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class=" mt-2">
                <div class="text-center pt-4">
                    @if ($planTest != null)
                        <form action="{{ route('usuario.salvar-plano') }}" method="POST">
                            @csrf
                            <input type="hidden"  value="{{ $planTest->id }}"
                                name="plano_id">
                            <button type="submit"
                                class="btn btn-primary text-white rounded-pill px-5 py-2 fs-8 d-inline-block mx-auto text-center">
                                <div class="px-lg-5">
                                    <div class="px-lg-5">
                                        Teste grátis por 15 dias
                                    </div>
                                </div>
                            </button>
                        </form>
                    @endif
                </div>
                <div class="text-center fw-semibold fs-7 mb-md-4 pb-2 pb-md-2 pt-3 pt-md-4">
                    <div class="pt-md-2">
                        Selecione seu plano:
                    </div>
                </div>
                <!-- Planos -->
                <div class="row gy-4 justify-content-center pb-4 gx-5 ">
                    @foreach ($planos as $key => $plan)
                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 px-lg-4 ">
                            <div class="shadow overflow-hidden position-relative  rounded-1 p-4 bg-white">
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
                                        <div class="fs-2 d-inline-block " style="padding-top: 3px">R$</div>
                                        <div class="d-inline-block">
                                            {{ number_format($plan->valor, 2, ',', '.') }}/ Mês
                                        </div>
                                    </div>
                                    <div class="pt-4 pb-3">
                                        <form action="{{ route('usuario.salvar-plano') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="plano-{{ $key }}"
                                                value="{{ $plan->id }}" name="plano_id">
                                            <button type="submit" class="btn-submit-plan btn w-100 fs-5 text-white"
                                                style="background-color: {{ $plan->color }}; border-color: {{ $plan->color }}">
                                                Selecionar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
