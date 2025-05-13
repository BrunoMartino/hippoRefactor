<style>
    .nav-tabs .nav-link,
    .nav-tabs .nav-item .nav-link {
        color: var(--bs-primary);
        background-color: #f1f1f1;
        border-color: var(--bs-nav-tabs-link-active-border-color);
    }

    .nav-tabs .nav-link:hover,
    .nav-tabs .nav-item .nav-link:hover {
        color: var(--bs-nav-tabs-link-active-color);
        /* background-color: var(--bs-primary); */
        background-color: #dfe9ff;
        /* border-color: var(--bs-nav-tabs-link-active-border-color); */
        color: var(--bs-primary)
    }

    .nav-tabs .nav-link.active,
    .nav-tabs .nav-item.show .nav-link {
        color: var(--bs-nav-tabs-link-active-color);
        background-color: var(--bs-orange);
        border-color: var(--bs-nav-tabs-link-active-border-color);
    }

    .nav-tabs .nav-link.active:hover,
    .nav-tabs .nav-item.show .nav-link:hover {
        color: var(--bs-nav-tabs-link-active-color);
        background-color: var(--bs-orange);
        border-color: var(--bs-nav-tabs-link-active-border-color);
    }
</style>
<div class="">
    <!-- integrações -->
    <div class="mt-3">
        <div class="mb-2 fs-5">Integrações:</div>
        <!-- btns integrações -->
        <div class="d-flex flex-column flex-md-row gap-3">
            <div class="pe-lg-3">
                <a href="{{ route('config.sistema.connect-whatsapp', 4) }}" class="btn btn-primary fs-5 fw-semibold  @if(auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false) disabled @endif "
                    style="min-width: 250px">
                    WhatsApp
                </a>
            </div>
            @if (!$getConfigModuleExist || $getConfigModuleExist->modulo_id == 4)
                <div class="pe-lg-3">
                    <a href="{{ route('config.sistema.bling', 4) }}" class="btn btn-primary fs-5 fw-semibold @if(auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false) disabled @endif  "
                        style="min-width: 250px">
                        Bling
                    </a>
                </div>
            @endif

            @php
                $configCorreios = \App\Models\ConfigCorreio::where('user_id', user_princ()->id)->first();
            @endphp
            @if (is_null($configCorreios) || $configCorreios->modulo_id == 4)
                <div class="">
                    <a href="{{ route('config.sistema.correios', 4) }}"
                        class="btn btn-primary fs-5 fw-semibold  @if (auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false) disabled @endif"
                        style="min-width: 250px">
                        Correios
                    </a>
                </div>
            @endif
        </div>

        <div class="mt-3">
            <div class="alert alert-light text-dark d-flex align-items-center gap-1 mb-2" role="alert">
                <div class="pt-1">
                    <i class="ti ti-info-circle fs-4"></i>
                </div>
                As verificações de atualização serão realizadas de 15 em 15 minutos, e enviadas todos os dias no
                intervalo de 7h as 18h.
            </div>
        </div>
    </div>
    <form action="{{ route('config.sistema.rastreamento.store') }}" method="post" id="form-main">
        @csrf
        <div class="">

            <div class="mb-2 mt-3 pt-2 fs-5">Configurações do módulo:</div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs gap-3  " id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3 px-xxl-4 active" id="tipo-envio-tab" data-bs-toggle="tab"
                        data-bs-target="#tipo-envio-item" type="button" role="tab" aria-controls="tipo-envio-item"
                        aria-selected="true">
                        <div class="px-0 px-xl-2">Tipos de envio</div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3 px-xxl-4" id="tipo-cliente-tab" data-bs-toggle="tab"
                        data-bs-target="#tipo-cliente-item" type="button" role="tab"
                        aria-controls="tipo-cliente-item" aria-selected="false">
                        <div class="px-0 px-xl-2">Tipo cliente</div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3 px-xxl-4" id="op-envio-tab" data-bs-toggle="tab"
                        data-bs-target="#op-envio-item" type="button" role="tab" aria-controls="op-envio-item"
                        aria-selected="false">
                        <div class="px-0 px-xl-2">Opções de envio</div>
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tipos de envio -->
                <div class="tab-pane active" id="tipo-envio-item" role="tabpanel" aria-labelledby="tipo-envio-tab">
                    <div class="pt-3 mb-2"></div>

                    <div class="mt-0">
                        <div class="alert alert-light text-dark d-flex align-items-center gap-1" role="alert">
                            <div class="pt-1">
                                <i class="ti ti-info-circle fs-4"></i>
                            </div>
                            Ao clicar nas opções dos tipos de envios, poderá personalizar as mensagens que serão
                            enviadas.
                        </div>
                    </div>

                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-1 gy-4">

                        <!-- Enviar código de rastreamento -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_codigo_de_rastreamento" type="checkbox"
                                    @if (old('enviar_codigo_de_rastreamento', $dataConfigCharge->enviar_codigo_de_rastreamento)) checked @endif id="enviar_codigo_de_rastreamento"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_codigo_de_rastreamento">
                                        Enviar código de rastreamento
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações aos clientes contendo o código de rastreamento de suas encomendas ou entregas.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Enviar mensagem de aviso "Saiu para Entrega" -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_mensagem_de_aviso_saiu_para_entrega"
                                    type="checkbox" @if (old('enviar_mensagem_de_aviso_saiu_para_entrega', $dataConfigCharge->enviar_mensagem_de_aviso_saiu_para_entrega)) checked @endif
                                    id="enviar_mensagem_de_aviso_saiu_para_entrega"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_mensagem_de_aviso_saiu_para_entrega">
                                        Enviar mensagem de aviso "Saiu para Entrega"
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação informando ao destinatário que a mercadoria ou pedido saiu para entrega.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Enviar mensagem de confirmação de entrega -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_mensagem_de_confirmacao_de_entrega"
                                    type="checkbox" @if (old('enviar_mensagem_de_confirmacao_de_entrega', $dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega)) checked @endif
                                    id="enviar_mensagem_de_confirmacao_de_entrega"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_mensagem_de_confirmacao_de_entrega">
                                        Enviar mensagem de confirmação de entrega
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação aos clientes confirmando que a mercadoria foi entregue com sucesso.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Enviar mensagem de aviso de destinatário ausente -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input "
                                    name="enviar_mensagem_de_aviso_de_destinatario_ausente" type="checkbox"
                                    @if (old(
                                            'enviar_mensagem_de_aviso_de_destinatario_ausente',
                                            $dataConfigCharge->enviar_mensagem_de_aviso_de_destinatario_ausente)) checked @endif
                                    id="enviar_mensagem_de_aviso_de_destinatario_ausente"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_mensagem_de_aviso_de_destinatario_ausente">
                                        Enviar mensagem de aviso de destinatário ausente
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação informando ao destinatário ou remetente que o destinatário da entrega estava ausente no momento da tentativa de entrega.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Enviar mensagem de localização atual e próxima cidade da mercadoria -->
                        <div class="col-12 col-lg-12">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input "
                                    name="enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria"
                                    type="checkbox" @if (old(
                                            'enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria',
                                            $dataConfigCharge->enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria)) checked @endif
                                    id="enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria">
                                        Enviar mensagem de localização atual e próxima cidade da mercadoria
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações aos clientes com informações sobre a localização atual da mercadoria em trânsito.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Tipo de cliente -->
                <div class="tab-pane" id="tipo-cliente-item" role="tabpanel" aria-labelledby="tipo-cliente-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-1 gy-4">
                        <!-- Enviar notificações para CNPJ -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_notificacoes_para_cnpj" type="checkbox"
                                    @if (old('enviar_notificacoes_para_cnpj', $dataConfigCharge->enviar_notificacoes_para_cnpj)) checked @endif id="enviar_notificacoes_para_cnpj"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_notificacoes_para_cnpj">
                                        Enviar notificações para CNPJ
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações para clientes com cadastros do tipo CNPJ.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <!-- Enviar notificações para CPF -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_notificacoes_para_cpf" type="checkbox"
                                    @if (old('enviar_notificacoes_para_cpf', $dataConfigCharge->enviar_notificacoes_para_cpf)) checked @endif id="enviar_notificacoes_para_cpf"
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3">
                                    <label for="enviar_notificacoes_para_cpf">
                                        Enviar notificações para CPF
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações para clientes com cadastros do tipo CPF.">
                                        <svg class="svg-icon"
                                            style=" margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Opções de envio -->
                <div class="tab-pane" id="op-envio-item" role="tabpanel" aria-labelledby="op-envio-tab">
                    <div class="pt-4 mb-2"></div>

                    <div class="mt-0">
                        <div class="alert alert-light text-dark d-flex align-items-center gap-2 fs-4" role="alert" style="background: #fff6e2">
                            <div class="pt-1">
                                {{-- <i class="ti ti-info-circle fs-4"></i> --}}
                            </div>

                            <div class="">
                                Fazemos o rastreio de encomendas enviadas pelos CORREIOS.
                                <div class="mt-2">
                                    Ao utilizar dados importados, no campo transportadora, colocar CORREIOS.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-1 gy-4">
                        <!-- Usar dados importados  -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="usar_dados_importados" type="checkbox"
                                    id="usar_dados_importados" @if (old('usar_dados_importados', $dataConfigCharge->usar_dados_importados)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="usar_dados_importados">
                                        Usar dados importados
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Permite o uso de dados importados, como planilhas nos formatos CSV ou XLSX, dentro do sistema de notificações.">
                                        <svg class="svg-icon"
                                            style="margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <!-- Usar dados da integração  -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="usar_dados_da_integracao" type="checkbox"
                                    id="usar_dados_da_integracao" @if (old('usar_dados_da_integracao', $dataConfigCharge->usar_dados_da_integracao)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="usar_dados_da_integracao">
                                        Usar dados da integração
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Utiliza dados sincronizados do ERP diretamente no sistema de notificações.">
                                        <svg class="svg-icon"
                                            style="margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <!-- Enviar mensagem sobre não receber mais notificações -->
                        <div class="col-12 col-lg-6">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input "
                                    name="enviar_mensagem_sobre_nao_receber_mais_notificacoes" type="checkbox"
                                    id="enviar_mensagem_sobre_nao_receber_mais_notificacoes"
                                    style="width: 43px; height: 22px;"
                                    @if (old(
                                            'enviar_mensagem_sobre_nao_receber_mais_notificacoes',
                                            $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes)) checked @endif />
                                <label class="form-check-label fs-4 fw-semibold ms-3"
                                    for="enviar_mensagem_sobre_nao_receber_mais_notificacoes">
                                    Enviar mensagem sobre não receber mais notificações
                                    <span class="d-inline-block align-middle" tabindex="0" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação aos clientes perguntando se desejam receber as mensagens do sistema (o uso reduz as denúncias de clientes e bloqueios).">
                                        <svg class="svg-icon"
                                            style="margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                            viewBox="0 0 1024 1024" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                            <path
                                                d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                            <path
                                                d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- Salvar -->
        <div class="mt-4  ">
            <hr>
            <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                @if ($showBtnAtualizar)
                    <button type="submit" onclick="abrirTabErro()" class="btn btn-primary  px-5 fs-5" @if(auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false) disabled @endif>
                        <div class="px-lg-5">Salvar</div>
                    </button>
                @else
                    <button type="submit" onclick="abrirTabErro()" class="btn btn-primary  px-5 fs-5" @if(auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false) disabled @endif>
                        <div class="px-lg-5">Atualizar</div>
                    </button>
                @endif
                <a href="{{ route('dashboard') }}" class="btn btn-light  px-5 fs-5 text-primary">
                    <div class="px-lg-5">Cancelar</div>
                </a>
            </div>
        </div>
        @include('pages.config.system.rastreamento._modal_imported_data', compact('dataConfigCharge'))
        @include('pages.config.system.rastreamento._modal_cancel_notif', compact('dataConfigCharge'))
        @include(
            'pages.config.system.rastreamento._modal_msg_cod_rastreamento',
            compact('dataConfigCharge'))
        @include('pages.config.system.rastreamento._modal_msg_loc_atual', compact('dataConfigCharge'))
        @include('pages.config.system.rastreamento._modal_msg_saiu_entregar', compact('dataConfigCharge'))
        @include(
            'pages.config.system.rastreamento._modal_msg_rastreio_cinfirm',
            compact('dataConfigCharge'))
        @include(
            'pages.config.system.rastreamento._modal_msg_rastreio_ausente',
            compact('dataConfigCharge'))

    </form>
</div>



<!-- Axios CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
    integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script></script>
