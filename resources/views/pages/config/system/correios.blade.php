@extends('layouts.basic')
@section('title', 'Correios')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">
                        Correios -
                        @switch($modulo->nome)
                            @case('cobrancas')
                                Cobranças
                            @break

                            @case('remarketing')
                                Remarketing
                            @break

                            @case('rastreamento')
                                Rastreamento
                            @break

                            @case('faturamento')
                                Faturamento
                            @break

                            @default
                        @endswitch
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Correios</li>
                            <li class="breadcrumb-item" aria-current="page">
                                @switch($modulo->nome)
                                    @case('cobrancas')
                                        Cobranças
                                    @break

                                    @case('remarketing')
                                        Remarketing
                                    @break

                                    @case('rastreamento')
                                        Rastreamento
                                    @break

                                    @case('faturamento')
                                        Faturamento
                                    @break

                                    @default
                                @endswitch
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    @php
        $routeModulo = route('dashboard');
        if ($modulo->nome == 'cobrancas') {
            $routeModulo = route('config.sistema.charges.index');
        }
        if ($modulo->nome == 'remarketing') {
            $routeModulo = route('config.sistema.remarketing.index');
        }
        if ($modulo->nome == 'rastreamento') {
            $routeModulo = route('config.sistema.rastreamento.index');
        }
        if ($modulo->nome == 'faturamento') {
            $routeModulo = route('config.sistema.faturamento.index');
        }

        // para redirecinar a outro modulo
        if (session('modulo_id_para_redirect') == 1) {
            $routeModulo = route('config.sistema.charges.index');
        }
        if (session('modulo_id_para_redirect') == 3) {
            $routeModulo = route('config.sistema.remarketing.index');
        }
        if (session('modulo_id_para_redirect') == 4) {
            $routeModulo = route('config.sistema.rastreamento.index');
        }
        if (session('modulo_id_para_redirect') == 2) {
            $routeModulo = route('config.sistema.faturamento.index');
        }
    @endphp

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />


                    <form action="{{ route('config.sistema.store-correios', $modulo->id) }}" method="post">
                        @csrf

                        {{-- <div class="alert alert-light text-dark text-center mb-4">
                            🔒 Seus dados serão armazenados totalmente encriptados e usados apenas para geração do token de
                            acesso e refresh.
                        </div> --}}
                        <div class="alert alert-light text-dark text-center mb-4">
                            <a href="https://hipponotify.com.br/manual-integracao-correios" class="" target="_blank">
                                <strong>Clique aqui e acesse o tutorial de integração.</strong>
                            </a>
                        </div>

                        <div class="row gy-3 pt-2">
                            <!--  -->
                            <input type="password" class="visually-hidden">
                            <label class="visually-hidden" for="user_123">user</label>
                            <input class="visually-hidden" type="text" name="user_123" id="user_123" />



                            <div class="col-12 col-lg-6">
                                <label for="user" class="form-label">
                                    Usuário (Meu Correios)<span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('user') is-invalid @enderror"
                                    name="user" id="user" autocomplete="off" required />
                                @error('user')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- <div class="col-12 col-lg-4">
                                <div class="position-relative">
                                    <label for="password" class="form-label">Senha (Meu Correios)<span
                                            class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <button type="button" tabindex="-1"
                                            onclick="showPass('password', 'icon-eye', 'icon-eye-off')"
                                            class="btn d-flex align-items-center btn-show-pass" style="height: 35px;">
                                            <i class="ti ti-eye fs-5" id="icon-eye" style="display: none"></i>
                                            <i class="ti ti-eye-off fs-5" id="icon-eye-off" style="display: block"></i>
                                        </button>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            name="password" id="password" placeholder="" autocomplete="off" required>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="col-12 col-lg-6">
                                <label for="contrato" class="form-label">
                                    Contrato (Correios)<span class="text-danger">*</span>
                                </label>
                                <input type="text" value="{{ $config ? $config->contrato : '' }}"
                                    class="form-control @error('contrato') is-invalid @enderror" name="contrato"
                                    id="contrato" autocomplete="off" required />
                                @error('contrato')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 ">
                                <label for="codigo_api" class="form-label">
                                    Código de acesso a(s) API(s)<span class="text-danger">*</span>
                                </label>
                                <input type="text" value="{{ $config ? $config->codigo_api : '' }}"
                                    class="form-control @error('codigo_api') is-invalid @enderror" name="codigo_api"
                                    id="codigo_api" autocomplete="off" required />
                                @error('codigo_api')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="">
                            <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-4 mt-3">
                                <button type="submit" class="btn btn-primary  px-5 fs-5">
                                    <div class="px-lg-5">
                                        @if ($config)
                                            Atualizar
                                        @else
                                            Salvar
                                        @endif
                                    </div>
                                </button>
                                <a href="{{ $routeModulo }}" class="btn btn-light  px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Cancelar</div>
                                </a>
                            </div>

                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
