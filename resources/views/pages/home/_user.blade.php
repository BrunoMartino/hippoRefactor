<!--  Row 1 -->
<div class="row">

    <div class="col-lg-4 ">
        <x-dashboard.user-main.messages-delivered />
    </div>
    <div class="col-lg-4 ">
        <x-dashboard.user-main.messages-undelivered />
    </div>
    <div class="col-lg-4 ">
        <x-dashboard.user-main.messages-viewed />
    </div>


    <!-- Entrega de Mensagens -->
    <div class="col-lg-4 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body d-flex flex-wrap ">
                <div class="d-sm-flex d-block align-items-center justify-content-between w-100">
                    <div class=" mb-sm-0 w-100 ">
                        <div class="d-flex gap-3  justify-content-between">
                            <h5 class="card-title fw-semibold">Entrega de Mensagens</h5>
                            <div class="position-relative">
                                <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                    title="Filtrar"
                                    onclick="document.getElementById('drop-filtro-entrega-msg').style.display='block';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M6 4v4" />
                                        <path d="M6 12v8" />
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M12 4v10" />
                                        <path d="M12 18v2" />
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M18 4v1" />
                                        <path d="M18 9v11" />
                                    </svg>
                                </button>

                                <div class="dropdown-filter" id="drop-filtro-entrega-msg" style="display: none">
                                    <div class="dropdown-filter-body">
                                        <button type="button" class="btn btn-non p-0 border-0 position-absolute fs-5"
                                            onclick="document.getElementById('drop-filtro-entrega-msg').style.display='none';"
                                            title="Fechar" style="right: 8px; top: 5px">
                                            <i class="ti ti-x"></i>
                                        </button>

                                        <div class="">
                                            <!-- ini -->
                                            <div class="mb-3">
                                                <label for="input-entrega-msg-ini" class=" mb-1">
                                                    Data Inicial:
                                                </label>
                                                <input id="input-entrega-msg-ini" class="form-control   w-100"
                                                    type="date">
                                            </div>

                                            <div class="">
                                                <label for="input-entrega-msg-fin" class=" mb-1">
                                                    Data Final:
                                                </label>
                                                <input id="input-entrega-msg-fin" class="form-control  w-100"
                                                    type="date">
                                            </div>

                                            <div class="text-center mt-3">
                                                <button id="btn-filtro-entrega-msg" type="button"
                                                    class="btn btn-primary btn-sm px-3">
                                                    Aplicar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class=""> <div id="chart-pie-donut"></div> </div> --}}
                        <div class="mt-4 d-flex flex-column h-100">
                            <div class="px-lg-1">
                                <div id="chart-entrega-msgs"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mt-3 align-self-end ">
                    <div class="d-flex align-items-center">
                        <div class="text-bg-light rounded me-8 p-8 d-flex align-items-center justify-content-center">
                            <i class="ti ti-grid-dots text-muted fs-6"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-dark fs-5 mb-0" id="text-percet-entreg-msgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Visualização de Mensagens -->
    <div class="col-lg-4 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body d-flex flex-wrap">
                <div class="d-sm-flex d-block align-items-center justify-content-between w-100">
                    <div class=" mb-sm-0 w-100">
                        <div class="d-flex gap-3  justify-content-between">
                            <h5 class="card-title fw-semibold">Visualização de Mensagens</h5>
                            <div class="position-relative">
                                <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                    title="Filtrar"
                                    onclick="document.getElementById('drop-filtro-vizu-msg').style.display='block';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M6 4v4" />
                                        <path d="M6 12v8" />
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M12 4v10" />
                                        <path d="M12 18v2" />
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M18 4v1" />
                                        <path d="M18 9v11" />
                                    </svg>
                                </button>

                                <div class="dropdown-filter" id="drop-filtro-vizu-msg" style="display: none">
                                    <div class="dropdown-filter-body">
                                        <button type="button" class="btn btn-non p-0 border-0 position-absolute fs-5"
                                            onclick="document.getElementById('drop-filtro-vizu-msg').style.display='none';"
                                            title="Fechar" style="right: 8px; top: 5px">
                                            <i class="ti ti-x"></i>
                                        </button>

                                        <div class="">
                                            <!-- ini -->
                                            <div class="mb-3">
                                                <label for="input-data-visu-msg-ini" class=" mb-1">
                                                    Data Inicial:
                                                </label>
                                                <input id="input-data-visu-msg-ini" class="form-control   w-100"
                                                    type="date">
                                            </div>

                                            <div class="">
                                                <label for="input-data-visu-msg-fin" class=" mb-1">
                                                    Data Final:
                                                </label>
                                                <input id="input-data-visu-msg-fin" class="form-control  w-100"
                                                    type="date">
                                            </div>

                                            <div class="text-center mt-3">
                                                <button id="btn-filtro-visu-msg" type="button"
                                                    class="btn btn-primary btn-sm px-3">
                                                    Aplicar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- <div class=""> <div id="chart-pie-donut"></div> </div> --}}
                        <div class="mt-4 px-lg-1">
                            <div id="chart-visual-msgs"></div>

                        </div>
                    </div>
                </div>
                <div class="mt-3 align-self-end">
                    <div class="d-flex align-items-center">
                        <div class="text-bg-light rounded me-8 p-8 d-flex align-items-center justify-content-center">
                            <i class="ti ti-grid-dots text-muted fs-6"></i>
                        </div>
                        <div>
                            <div class="fw-semibold text-dark fs-5 mb-0" id="text-percet-visu-msgs">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notificações -->
    <div class="col-lg-4 d-flex align-items-strech">
        <div class="card w-100 position-relative bg-primary text-white card-notificacoes">
            <div class="card-body text-white pt-3">
                <div class="d-sm-flex d-block align-items-center justify-content-between">
                    <x-dashboard.user-main.envio-notificacoes />
                </div>
            </div>
        </div>
    </div>


    <!-- Comparativo anual -->
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between">
                    <div class=" mb-sm-0 w-100">
                        <div class="d-flex gap-3 justify-content-between">
                            <div class="">
                                <h5 class="card-title fw-semibold fs-7">
                                    <strong>Comparativo anual</strong>
                                </h5>
                                <p class="card-subtitle mb-0">
                                    Entrega de Mensagens
                                </p>
                            </div>
                            <div class="position-relative">
                                <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                    title="Filtrar"
                                    onclick="document.getElementById('drop-filtro-comp-anual').style.display='block';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M6 4v4" />
                                        <path d="M6 12v8" />
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M12 4v10" />
                                        <path d="M12 18v2" />
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M18 4v1" />
                                        <path d="M18 9v11" />
                                    </svg>
                                </button>

                                <div class="dropdown-filter" id="drop-filtro-comp-anual" style="display: none">
                                    <div class="dropdown-filter-body" style="">
                                        <button type="button" class="btn btn-non p-0 border-0 position-absolute fs-5"
                                            onclick="document.getElementById('drop-filtro-comp-anual').style.display='none';"
                                            title="Fechar" style="right: 8px; top: 5px">
                                            <i class="ti ti-x"></i>
                                        </button>

                                        <div class="">
                                            <div class="d-flex gap-4  ">
                                                <div class="pe-lg-2">
                                                    <div class="fs-4 mb-2 text-truncate">
                                                        Selecione dois anos para comparar:
                                                    </div>

                                                    @for ($i = 0; $i < 5; $i++)
                                                        <div
                                                            class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                            <input class="form-check-input change-periodo"
                                                                type="checkbox" value="{{ date('Y') - $i }}"
                                                                id="comp-arnual-op-{{ $i }}"
                                                                style="width: 32px; height: 18px;"
                                                                @if ($i == 0 || $i == 1) checked @endif />
                                                            <label class="form-check-label ms-1 text-truncate fs-5"
                                                                for="comp-arnual-op-{{ $i }}">
                                                                {{ date('Y') - $i }}
                                                            </label>
                                                        </div>
                                                    @endfor
                                                </div>

                                                <div class="">
                                                    <div class="fs-4 mb-2 text-truncate">
                                                        Selecione o tipo:
                                                    </div>
                                                    <div
                                                        class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                        <input class="form-check-input change-tipo-comp-anual"
                                                            type="checkbox" value="entregue"
                                                            id="comp-arnual-t-entregue"
                                                            style="width: 32px; height: 18px;" checked />
                                                        <label class="form-check-label ms-1 text-truncate fs-5"
                                                            for="comp-arnual-t-entregue">
                                                            Entregue
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                        <input class="form-check-input change-tipo-comp-anual"
                                                            type="checkbox" value="nao_entregue"
                                                            id="comp-arnual-t-nao_entregue"
                                                            style="width: 32px; height: 18px;" />
                                                        <label class="form-check-label ms-1 text-truncate fs-5"
                                                            for="comp-arnual-t-nao_entregue">
                                                            Não entregue
                                                        </label>
                                                    </div>
                                                    <div
                                                        class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                        <input class="form-check-input change-tipo-comp-anual"
                                                            type="checkbox" value="visualizado"
                                                            id="comp-arnual-t-visualizado"
                                                            style="width: 32px; height: 18px;" />
                                                        <label class="form-check-label ms-1 text-truncate fs-5"
                                                            for="comp-arnual-t-visualizado">
                                                            Visualizado
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="text-center mt-3">
                                                <button id="btn-filtro-comp-anual" type="button"
                                                    class="btn btn-primary btn-sm px-3">
                                                    Aplicar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="">
                            <div id="chart-comparativo-anual"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Comparativo anual -->
    <div class="col-lg-9 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between">
                    <div class=" mb-sm-0 w-100">
                        <div class="d-flex gap-3 justify-content-between">
                            @php
                                $msgPs = \App\Models\Message::where('user_id', user_princ()->id)
                                    ->whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])
                                    ->exists();
                            @endphp
                            <div class="">
                                <h5 class="card-title fw-semibold">
                                    Satisfação de clientes
                                </h5>
                            </div>
                            @if ($msgPs)
                                <div class="position-relative">
                                    <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                        title="Filtrar"
                                        onclick="document.getElementById('drop-filtro-satis-clientes').style.display='block';">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.3"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M6 4v4" />
                                            <path d="M6 12v8" />
                                            <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M12 4v10" />
                                            <path d="M12 18v2" />
                                            <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M18 4v1" />
                                            <path d="M18 9v11" />
                                        </svg>
                                    </button>

                                    <div class="dropdown-filter" id="drop-filtro-satis-clientes"
                                        style="display: none">
                                        <div class="dropdown-filter-body" style="max-width: 500px">
                                            <button type="button"
                                                class="btn btn-non p-0 border-0 position-absolute fs-5"
                                                onclick="document.getElementById('drop-filtro-satis-clientes').style.display='none';"
                                                title="Fechar" style="right: 8px; top: 5px">
                                                <i class="ti ti-x"></i>
                                            </button>

                                            <div class="">
                                                <div class="text-center mb-2">
                                                    Escolha uma pergunta para aplicar o filtro.
                                                </div>

                                                @php
                                                    $msgPs = \App\Models\Message::where('user_id', user_princ()->id)
                                                        ->whereIn('type', [
                                                            'PESQUISA SATISFAÇÃO',
                                                            'PESQUISA SATISFAÇÃO ANEXO',
                                                        ])
                                                        ->first();
                                                @endphp
                                                <div class="mt-2 mb-2">
                                                    <div class="mb-2">
                                                        <select id="satisfacao-cliente-select" class=" select-satisfacao-cliente-select  form-control custom-select2"
                                                            name="satisfacao_cliente_select" style="width: 100%; height: 36px">
                                                            <option value="pergunta_inicial">{{ $msgPs->satisfaction_survey['pergunta_inicial']['pergunta'] }}</option>
                                                            <option value="pergunta1">{{ $msgPs->satisfaction_survey['pergunta1']['pergunta'] }}</option>
                                                            <option value="pergunta2">{{$msgPs->satisfaction_survey['pergunta2']['pergunta']}}</option>
                                                            <option value="pergunta3">{{$msgPs->satisfaction_survey['pergunta3']['pergunta']}}</option>
                                                            <option value="pergunta4">{{ $msgPs->satisfaction_survey['pergunta4']['pergunta'] }}</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- ini -->
                                                <div class="mb-3 mt-3">
                                                    <label for="input-satis-cliente-ini" class=" mb-1">
                                                        Data Inicial:
                                                    </label>
                                                    <input id="input-satis-cliente-ini" style=""
                                                        class="form-control   w-100" type="date">
                                                </div>

                                                <div class="">
                                                    <label for="input-satis-cliente-fin" class=" mb-1">
                                                        Data Final:
                                                    </label>
                                                    <input id="input-satis-cliente-fin" style=""
                                                        class="form-control  w-100" type="date">
                                                </div>

                                                <div class="text-center mt-3 pt-2">
                                                    <button type="button" id="btn-filtro-satis-cliente"
                                                        class="btn btn-primary btn-sm px-3">
                                                        Aplicar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                        <div class="" style=" ">
                            @if ($msgPs)
                                <div class="text-center fs-5 pt-3" id="text-pergunt-ps">
                                </div>
                                <div id="chart-satis-clientes" class=""
                                    style="margin-left: -14px; margin-top: -30px"></div>
                            @else
                                <div class="fs-5">
                                    *Sem registros.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Satisfação média -->
    <div class="col-lg-3 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between">
                    <div class=" mb-sm-0 w-100">
                        <div class="d-flex gap-3 justify-content-between">
                            <div class="">
                                <h5 class="card-title fw-semibold">
                                    Satisfação Média
                                </h5>
                            </div>
                            <div class="position-relative">
                                <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                    title="Filtrar"
                                    onclick="document.getElementById('drop-filtro-satis-media').style.display='block';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M6 4v4" />
                                        <path d="M6 12v8" />
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M12 4v10" />
                                        <path d="M12 18v2" />
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M18 4v1" />
                                        <path d="M18 9v11" />
                                    </svg>
                                </button>

                                @if ($msgPs)
                                    <!-- filtro -->
                                    <div class="dropdown-filter" id="drop-filtro-satis-media" style="display: none">
                                        <div class="dropdown-filter-body" style="max-width: 450px">
                                            <button type="button"
                                                class="btn btn-non p-0 border-0 position-absolute fs-5"
                                                onclick="document.getElementById('drop-filtro-satis-media').style.display='none';"
                                                title="Fechar" style="right: 8px; top: 5px">
                                                <i class="ti ti-x"></i>
                                            </button>

                                            <div class="">
                                                <div class="">
                                                    <div class="text-center mb-2">
                                                        Escolha uma pergunta para aplicar o filtro.
                                                    </div>

                                                    @php
                                                        $msgPs = \App\Models\Message::where(
                                                            'user_id',
                                                            user_princ()->id,
                                                        )
                                                            ->whereIn('type', [
                                                                'PESQUISA SATISFAÇÃO',
                                                                'PESQUISA SATISFAÇÃO ANEXO',
                                                            ])
                                                            ->first();
                                                    @endphp
                                                    {{-- <div
                                                        class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                        <input class="form-check-input " type="checkbox"
                                                            id="pergunta-satis-media-cliente-1"
                                                            style="width: 32px; height: 18px;"
                                                            onchange="document.getElementById('pergunta-satis-media-cliente-2').checked= !this.checked"
                                                            checked />
                                                        <label class="form-check-label ms-1 text-truncate fs-5"
                                                            for="pergunta-satis-media-cliente-1"
                                                            title="{{ $msgPs->satisfaction_survey['pergunta1']['pergunta'] }}">
                                                            {{ $msgPs->satisfaction_survey['pergunta1']['pergunta'] }}
                                                        </label>
                                                    </div>

                                                    <div
                                                        class="form-check form-switch form-check-inline d-flex align-items-center gap-2">
                                                        <input class="form-check-input " type="checkbox"
                                                            id="pergunta-satis-media-cliente-2"
                                                            onchange="document.getElementById('pergunta-satis-media-cliente-1').checked= !this.checked"
                                                            style="width: 32px; height: 18px;" />
                                                        <label class="form-check-label ms-1 text-truncate fs-5"
                                                            for="pergunta-satis-media-cliente-2"
                                                            title="{{ $msgPs->satisfaction_survey['pergunta2']['pergunta'] }}">
                                                            {{ $msgPs->satisfaction_survey['pergunta2']['pergunta'] }}
                                                        </label>
                                                    </div> --}}


                                                    <div class="mt-2 mb-2">
                                                        <div class="mb-2">
                                                            <select id="pergunta-satis-media-cliente-select" class=" pergunta-satis-media-cliente-select  form-control custom-select2"
                                                                name="satisfacao_cliente_select" style="width: 100%; height: 36px">
                                                                <option value="pergunta1">{{ $msgPs->satisfaction_survey['pergunta1']['pergunta'] }}</option>
                                                                <option value="pergunta2">{{$msgPs->satisfaction_survey['pergunta2']['pergunta']}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- ini -->
                                                    <div class="mb-3 mt-3">
                                                        <label for="input-satis-media-ini" class=" mb-1">
                                                            Data Inicial:
                                                        </label>
                                                        <input id="input-satis-media-ini" style=""
                                                            class="form-control   w-100" type="date">
                                                    </div>

                                                    <div class="">
                                                        <label for="input-satis-media-fin" class=" mb-1">
                                                            Data Final:
                                                        </label>
                                                        <input id="input-satis-media-fin" style=""
                                                            class="form-control  w-100" type="date">
                                                    </div>

                                                    <div class="text-center mt-3 pt-2">
                                                        <button type="button" id="btn-filtro-satis-media-cliente"
                                                            class="btn btn-primary btn-sm px-3">
                                                            Aplicar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                        <div class="" style=" overflow:hidden">
                            {{-- <div id="chart-satis-clientes" class="" style="margin-left: -14px; margin-top: -15px"></div> --}}
                            <div id="chart-satis-media" class=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Envios por Estado -->
    <div class="col-lg-9 d-flex align-items-strech">
        <div class="card w-100 position-relative">
            <div class="card-body pb-2 overflow-hidden">
                <div class="d-sm-flex d-block align-items-center justify-content-between">
                    <div class=" mb-sm-0 w-100">
                        <div class="d-flex gap-3 justify-content-between">
                            <div class="">
                                <h5 class="card-title fw-semibold">
                                    Envios por Estado
                                </h5>
                            </div>

                            <div class="position-relative">
                                <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                    title="Filtrar"
                                    onclick="document.getElementById('drop-filtro-estado').style.display='block';">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.3"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M6 4v4" />
                                        <path d="M6 12v8" />
                                        <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M12 4v10" />
                                        <path d="M12 18v2" />
                                        <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                        <path d="M18 4v1" />
                                        <path d="M18 9v11" />
                                    </svg>
                                </button>

                                <div class="dropdown-filter" id="drop-filtro-estado" style="display: none">
                                    <div class="dropdown-filter-body">
                                        <button type="button" class="btn btn-non p-0 border-0 position-absolute fs-5"
                                            onclick="document.getElementById('drop-filtro-estado').style.display='none';"
                                            title="Fechar" style="right: 8px; top: 5px">
                                            <i class="ti ti-x"></i>
                                        </button>

                                        <div class="">
                                            <!-- ini -->
                                            <div class="mb-3">
                                                <label for="input-por-estado-ini" class=" mb-1">
                                                    Data Inicial:
                                                </label>
                                                <input id="input-por-estado-ini" class="form-control   w-100"
                                                    type="date">
                                            </div>

                                            <div class="">
                                                <label for="input-por-estado-fin" class=" mb-1">
                                                    Data Final:
                                                </label>
                                                <input id="input-por-estado-fin" class="form-control  w-100"
                                                    type="date">
                                            </div>

                                            <div class="text-center mt-3">
                                                <button id="btn-filtro-estado" type="button"
                                                    onclick="atualizarGraficoMapa()"
                                                    class="btn btn-primary btn-sm px-3">
                                                    Aplicar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <style>
                            @media (max-width: 1400px) {
                                .d-mapa {
                                    margin-left: -30px
                                }
                            }

                            @media (max-width: 1350px) {
                                .d-mapa {
                                    margin-left: -60px
                                }
                            }

                            @media (max-width: 1299px) {
                                .d-mapa {
                                    margin-left: 0px
                                }
                            }

                            @media (max-width: 1100px) {
                                .d-mapa {
                                    margin-left: -40px
                                }
                            }

                            @media (max-width: 1070px) {
                                .d-mapa {
                                    margin-left: -60px
                                }
                            }

                            @media (max-width: 991px) {
                                .d-mapa {
                                    margin-left: 0px
                                }
                            }

                            @media (max-width: 775px) {
                                .d-mapa {
                                    margin-left: -60px
                                }
                            }

                            @media (max-width: 730px) {
                                .d-mapa {
                                    margin-left: -80px
                                }
                            }

                            @media (max-width: 690px) {
                                .d-mapa {
                                    margin-left: -130px
                                }
                            }

                            @media (max-width: 640px) {
                                .d-mapa {
                                    transform: scale(0.7);
                                    margin-top: -80px;
                                    margin-bottom: -80px
                                }
                            }

                            @media (max-width: 510px) {
                                .d-mapa {
                                    margin-left: -160px
                                }
                            }

                            @media (max-width: 465px) {
                                .d-mapa {
                                    transform: scale(0.6)
                                }
                            }

                            @media (max-width: 423px) {
                                .d-mapa {
                                    margin-left: -180px;
                                    margin-top: -110px;
                                    margin-bottom: -110px
                                }
                            }

                            @media (max-width: 390px) {
                                .d-mapa {
                                    transform: scale(0.5);
                                    margin-top: -130px;
                                    margin-bottom: -130px
                                }
                            }
                        </style>
                        <div class="d-mapa" style="">
                            <x-dashboard.user-main.msg-envidas-estado />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 d-flex align-items-start ">
        <div class="row align-items-start">
            <!-- Faixa etária -->
            <div class="col-lg-12 d-flex flex-column ">
                <div class="card w-100 position-relative">
                    <div class="card-body pb-2">
                        <div class="d-sm-flex d-block align-items-center justify-content-between">
                            <div class=" mb-sm-0 w-100">
                                <div class="d-flex gap-3 justify-content-between">
                                    <div class="">
                                        <h5 class="card-title fw-semibold">
                                            Faixa etária
                                        </h5>
                                    </div>
                                    <div class="position-relative">
                                        <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7"
                                            title="Filtrar"
                                            onclick="document.getElementById('drop-filtro-faixa-etaria').style.display='block';">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.3"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M6 4v4" />
                                                <path d="M6 12v8" />
                                                <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M12 4v10" />
                                                <path d="M12 18v2" />
                                                <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M18 4v1" />
                                                <path d="M18 9v11" />
                                            </svg>
                                        </button>

                                        <div class="dropdown-filter" id="drop-filtro-faixa-etaria"
                                            style="display: none">
                                            <div class="dropdown-filter-body">
                                                <button type="button"
                                                    class="btn btn-non p-0 border-0 position-absolute fs-5"
                                                    onclick="document.getElementById('drop-filtro-faixa-etaria').style.display='none';"
                                                    title="Fechar" style="right: 8px; top: 5px">
                                                    <i class="ti ti-x"></i>
                                                </button>

                                                <div class="">
                                                    <!-- ini -->
                                                    <div class="mb-3">
                                                        <label for="input-faixs-etaria-ini" class=" mb-1">
                                                            Data Inicial:
                                                        </label>
                                                        <input id="input-faixs-etaria-ini"
                                                            class="form-control   w-100" type="date">
                                                    </div>

                                                    <div class="">
                                                        <label for="input-faixs-etaria-fin" class=" mb-1">
                                                            Data Final:
                                                        </label>
                                                        <input id="input-faixs-etaria-fin" class="form-control  w-100"
                                                            type="date">
                                                    </div>

                                                    <div class="text-center mt-3">
                                                        <button id="btn-filtro-faixa-etaria" type="button"
                                                            class="btn btn-primary btn-sm px-3">
                                                            Aplicar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="" style="">
                                    <style>
                                        @media (max-width: 1100px) {

                                            #chart-faixa-etaria .apexcharts-xaxis-texts-g .apexcharts-text tspan {
                                                font-size: 8px;
                                            }
                                        }
                                    </style>
                                    <div id="chart-faixa-etaria" class="" style="margin-left: -12px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card w-100 position-relative">
                    <div class="card-body pb-2 pt-3">
                        <div class="text-center fs-5 pb-3 d-flex gap-2 align-items-center justify-content-center"
                            style="">
                            <div class="text-idade-media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-heart">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h.5" />
                                    <path
                                        d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                                </svg>
                            </div>
                            <div class="text-truncate text-idade-media">
                                Idade média: <strong id="meida-faixa-etarea">...</strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Gênero -->
            <div class="col-lg-12 d-flex ">
                <div class="card w-100 position-relative">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between">
                            <div class=" mb-sm-0 w-100">
                                <div class="d-flex gap-3">
                                    <div class="">
                                        <h5 class="card-title fw-semibold">
                                            Gênero
                                        </h5>
                                    </div>
                                </div>
                                <div class="" style="">
                                    <div id="chart-genero" class=""></div>
                                </div>
                                <div class="mt-3">
                                    <div id="chart-visual-msgs"></div>
                                    <div class="mt-3">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="text-bg-light rounded me-8 p-2 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-grid-dots text-muted fs-5"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark fs-5 mb-0" id="text-percet-genero">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>

<script>
      // Satisfação clientes
      $('.select-satisfacao-cliente-select').select2({
        placeholder: '',
        dropdownParent: $('#drop-filtro-satis-clientes .dropdown-filter-body'),
        "language": "pt-BR",
    })
      // Satisfação clientes média
      $('.pergunta-satis-media-cliente-select').select2({
        placeholder: '',
        dropdownParent: $('#drop-filtro-satis-media .dropdown-filter-body'),
        "language": "pt-BR",
    })
</script>