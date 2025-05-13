@extends('layouts.basic')
@section('title', 'Bling')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">
                        Bling -
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
                            <li class="breadcrumb-item" aria-current="page">Bling</li>
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
                    <x-alerts.delete title="Deletar Bling"
                        desc="Tem certeza de que deseja deletar esta integração com o Bling?" />

                    @php
                        $moduloRemarketing = $modulo;

                        if ($moduloRemarketing) {
                            $dataBling = \App\Models\ConfSistema::where('modulo_id', $modulo->id)
                                ->where('user_id', user_princ()->id)
                                ->where('tipo', 'bling')
                                ->first();
                        }

                        // dd($dataBling['integracao']['nf_situation'], );

                        $nf_situation = isset($dataBling['integracao']['nf_situation'])
                            ? $dataBling['integracao']['nf_situation']
                            : [];
                        $checkAutorizada = in_array(5, $nf_situation, true);
                        $checkEmitidaDanfe = in_array(6, $nf_situation, true);

                        $order_situation = isset($dataBling['integracao']['order_situation'])
                            ? $dataBling['integracao']['order_situation']
                            : [];
                        $checkEmAberto = in_array(6, $order_situation, true);
                        $checkAtendido = in_array(9, $order_situation, true);
                        $checkEmAndamento = in_array(15, $order_situation, true);
                        $checkVerificado = in_array(24, $order_situation, true);
                        $checkSeparacao = in_array(382716, $order_situation, true);

                        $checkAutorizacaoBling =
                            isset($dataBling['integracao']['autorizacao_bling']) &&
                            $dataBling['integracao']['autorizacao_bling'] == true
                                ? true
                                : false;

                    @endphp

                    @if ($getConfigModuleExist && (isset($dataBling->id) ? $dataBling->id : 0) != $getConfigModuleExist->id)

                        <div class="alert alert-light text-dark" role="alert">
                            <div class="fs-5 mb-2">
                                Somente uma conta Bling pode ser configurada, porém você pode editar as configurações de
                                Pedidos e Notas Fiscais a serem integrados.
                            </div>
                            <div class="text-center pt-1 pb-2">
                                <a href="{{ route('config.sistema.bling', $getConfigModuleExist->modulo_id) }}"
                                    class="btn btn-orange px-5 fw-semibold ">
                                    Editar Configuração Bling
                                </a>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('config.sistema.store-bling', $modulo->id) }}" method="post">
                            @csrf
                            <div class="">

                                <div class="mt-4 pb-3 d-none">
                                    <label for="" class="fs-5 fw-semibold mb-3">
                                        Deseja usar qual situação da Nota Fiscal para envio de mensagens?
                                    </label>

                                    <div class="">
                                        <div class="row gy-3 mb-3">
                                            <div class=" me-sm-5 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                                                <div class="form-check form-switch d-flex pe-lg-3">
                                                    <input class="form-check-input " name="autorizada" value="5"
                                                        type="checkbox" id="autorizada" style="width: 43px; height: 22px;"
                                                        checked />
                                                    {{-- @if (old('autorizada', $checkAutorizada)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="autorizada">
                                                        Autorizada
                                                    </label>
                                                </div>
                                            </div>
                                            <div class=" me-sm-2 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="emitida_danfe" value="6"
                                                        type="checkbox" id="emitida_danfe"
                                                        style="width: 43px; height: 22px;" checked />
                                                    {{-- @if (old('emitida_danfe', $checkEmitidaDanfe)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="emitida_danfe">
                                                        Emitida DANFE
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-3 pb-4 d-none">
                                    <label for="" class="fs-5 fw-semibold mb-3">
                                        Deseja usar qual situação do Pedido para envio de mensagens?
                                    </label>
                                    <div class="">
                                        <div class="row gy-3 mb-3">
                                            <div class=" me-sm-5 col-md-3 col-lg-2 col-xl-2 col-xxl-2">
                                                <div class="form-check form-switch d-flex ">
                                                    <input class="form-check-input " name="em_aberto" value="6"
                                                        type="checkbox" id="em_aberto" style="width: 43px; height: 22px;"
                                                        checked />
                                                    {{-- @if (old('em_aberto', $checkEmAberto)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="em_aberto">
                                                        Em aberto
                                                    </label>
                                                </div>
                                            </div>
                                            <div class=" me-sm-0 col-md-4 col-lg-3 col-xl-3 col-xxl-3"
                                                style="max-width: 250px">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="em_andamento" value="15"
                                                        type="checkbox" id="em_andamento" style="width: 43px; height: 22px;"
                                                        checked />
                                                    {{-- @if (old('em_andamento', $checkEmAndamento)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="em_andamento">
                                                        Em andamento
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="  col-md-4 col-md-2 col-lg-3 col-xl-4 col-xxl-4">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="atendido" value="9"
                                                        type="checkbox" id="atendido" style="width: 43px; height: 22px;"
                                                        checked />
                                                    {{-- @if (old('atendido', $checkAtendido)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="atendido">
                                                        Atendido
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gy-3 mb-3">
                                            <div class="me-sm-5 col-md-3 col-lg-2 col-xl-2 col-xxl-2 text-truncate">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="em_separacao" value="382716"
                                                        type="checkbox" id="em_separacao"
                                                        style="width: 43px; height: 22px;" checked />
                                                    {{-- @if (old('em_separacao', $checkSeparacao)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="em_separacao">
                                                        Em separação
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="me-sm-2 col-md-4 col-lg-3 col-xl-3 col-xxl-3">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="verificado" value="24"
                                                        type="checkbox" id="verificado"
                                                        style="width: 43px; height: 22px;" checked />
                                                    {{-- @if (old('verificado', $checkVerificado)) checked @endif /> --}}
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="verificado">
                                                        Verificado
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                @if (is_null(session('trocar_bling')) && ($order_situation != [] || $nf_situation != []))
                                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4">
                                        <a href="{{ route('config.sistema.change-bling', $modulo->id) }}"
                                            class="btn btn-primary px-5 fs-5">
                                            Trocar Bling
                                        </a>
                                        <a href="{{ $routeModulo }}" class="btn btn-light  px-5 fs-5 text-primary">
                                            Cancelar
                                        </a>
                                        <button
                                            onclick="serUrlDelete(`{{ route('config.sistema.destroy-bling', $modulo->id) }}`)"
                                            type="button" class="btn btn-orange px-5 fs-5">
                                            Excluir Bling
                                        </button>
                                    </div>
                                @else
                                    @php
                                        $access_token = null;
                                        // dd($dataBling['integracao']);
                                        if (isset($dataBling['integracao']['access_token'])) {
                                            $access_token = $dataBling['integracao']['access_token'];
                                        }
                                        $refresh_token = null;
                                        if (isset($dataBling['integracao']['refresh_token'])) {
                                            $refresh_token = $dataBling['integracao']['refresh_token'];
                                        }
                                    @endphp
                                    @if (is_null($access_token) || is_null($refresh_token))
                                        <div class="pt-3">
                                            <div class="mb-2">

                                                <div class="alert alert-light text-dark text-center mb-4">
                                                    <a href="#" class="" target="_blank">
                                                        <strong>Clique aqui e acesse o tutorial de integração.</strong>
                                                    </a>
                                                </div>
                                                
                                                <div class="form-check form-switch d-flex pe-lg-3">
                                                    <input class="form-check-input " name="autorizacao_bling"
                                                        value="5" type="checkbox" id="autorizacao_bling"
                                                        style="width: 43px; height: 22px;"
                                                        @if (old('autorizacao_bling', $checkAutorizacaoBling)) checked @endif required />
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="autorizacao_bling" style="margin-top: -2px">
                                                        <div class="fs-5 mb-1">
                                                            Autorizo o uso dos dados da minha conta Bling para envio de
                                                            notificações.
                                                        </div>
                                                        <p class="fw-normal">
                                                            Ao clicar em "Salvar", você precisará autorizar o uso do
                                                            aplicativo
                                                            HippoNotify em
                                                            sua conta Bling. Após a autorização, você será redirecionado
                                                            para o
                                                            nosso
                                                            sistema e
                                                            estará apto a enviar notificações.
                                                        </p>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    @else
                                        <input type="hidden" name="autorizacao_bling" value="true" />
                                    @endif
                                    <div class="">
                                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-4 mt-3">
                                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                                <div class="px-lg-5">
                                                    @if ($order_situation != [] || $nf_situation != [])
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
                                    </div>
                                @endif
                            </div>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        function setConfigSelecionada(el) {
            let elChecked = el.checked
            for (let i in document.querySelectorAll('.config-checkbox')) {
                document.querySelectorAll('.config-checkbox')[i].checked = false
            }

            setTimeout(() => {
                el.checked = elChecked

                let int = 0
                for (let i in document.querySelectorAll('.config-checkbox')) {
                    if (document.querySelectorAll('.config-checkbox')[i].checked) {
                        int++
                    }
                }

                if (int == 0) {
                    el.checked = true
                }
            }, 10);


        }
    </script>
@endsection
