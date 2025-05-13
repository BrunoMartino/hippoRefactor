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
                <a href="{{ route('config.sistema.connect-whatsapp', 1) }}"
                    class="btn btn-primary fs-5 fw-semibold  @if (auth()->user()->hasPermissionTo('edit-modulo-cobrancas') == false) disabled @endif"
                    style="min-width: 250px">
                    WhatsApp
                </a>
            </div>

            @if (!$getConfigModuleExist || $getConfigModuleExist->modulo_id == 1)
                <div class="">
                    <a href="{{ route('config.sistema.bling', 1) }}"
                        class="btn btn-primary fs-5 fw-semibold  @if (auth()->user()->hasPermissionTo('edit-modulo-cobrancas') == false) disabled @endif"
                        style="min-width: 250px">
                        Bling
                    </a>
                </div>
            @endif

        </div>
    </div>
    <form action="{{ route('config.sistema.charges.store') }}" method="post" id="form-main">
        @csrf
        <div class="pt-4">

            <div class="mb-2 mt-3 fs-5">Configurações do módulo:</div>


            <!-- Nav tabs -->
            <ul class="nav nav-tabs gap-3 " id="myTab" role="tablist">
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
                    <button class="nav-link rounded-pill px-3 px-xxl-4" id="tipo-envio-boleto-tab" data-bs-toggle="tab"
                        data-bs-target="#tipo-envio-boleto-item" type="button" role="tab"
                        aria-controls="tipo-envio-boleto-item" aria-selected="false">
                        <div class="px-0 px-xl-2">Tipo de envio do boleto</div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3 px-xxl-4" id="op-envio-tab" data-bs-toggle="tab"
                        data-bs-target="#op-envio-item" type="button" role="tab" aria-controls="op-envio-item"
                        aria-selected="false">
                        <div class="px-0 px-xl-2">Opções de envio</div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3 px-xxl-4" id="form-paga-tab" data-bs-toggle="tab"
                        data-bs-target="#form-paga-item" type="button" role="tab" aria-controls="form-paga-item"
                        aria-selected="false">
                        <div class="px-0 px-xl-2">Formas de pagamento</div>
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tipos de envio -->
                <div class="tab-pane active" id="tipo-envio-item" role="tabpanel" aria-labelledby="tipo-envio-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-1 gy-0 gy-lg-4">

                        <div class="col-lg-6">
                            <!-- Enviar notificação de fatura vencendo -->
                            <div class="col-12 mb-4 ">
                                <div class="form-check form-switch d-flex">
                                    <input class="form-check-input " name="enviar_notificacao_de_fatura_vencendo"
                                        type="checkbox" id="enviar_notificacao_de_fatura_vencendo"
                                        @if (old('enviar_notificacao_de_fatura_vencendo', $dataConfigCharge->enviar_notificacao_de_fatura_vencendo)) checked @endif
                                        style="width: 43px; height: 22px;" />
                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                        for="enviar_notificacao_de_fatura_vencendo">
                                        Enviar notificação de fatura a vencer
                                        <span class="d-inline-block align-middle" tabindex="-1"
                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Envia uma notificação aos clientes alguns dias antes da data de vencimento de suas faturas/cobranças, alertando-os sobre a proximidade do prazo de pagamento.">
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

                                <div class="ps-1 d-flex gap-4 flex-wrap">
                                    <div class=" mb-1 pt-2">
                                        Quantidade de envios:
                                        <div class="d-flex gap-1 pt-1">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantidade_de_envios_antecipados"
                                                id="quantidade_de_envios_antecipados"
                                                value="{{ old('quantidade_de_envios_antecipados', $dataConfigCharge->quantidade_de_envios_antecipados) }}"
                                                placeholder="" @if ($dataConfigCharge->enviar_notificacao_de_fatura_vencendo) required @endif
                                                style="max-width: 80px" />

                                            <div class="" style="margin-top: -5px">
                                                <span class="d-inline-block align-middle" tabindex="-1"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Refere-se à quantidade de vezes que a fatura/cobrança será enviada antes do vencimento.">
                                                    <svg class="svg-icon"
                                                        style="margin-left: 0px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
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
                                            </div>

                                        </div>
                                    </div>
                                    <div class="pt-2 mb-1">
                                        Intervalo de dias:
                                        <div class="d-flex gap-1 pt-1">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantidade_de_dias_de_intervalo_do_envio_vencimento"
                                                id="quantidade_de_dias_de_intervalo_do_envio_vencimento"
                                                value="{{ old('quantidade_de_dias_de_intervalo_do_envio_vencimento', $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencimento) }}"
                                                placeholder="" @if ($dataConfigCharge->enviar_notificacao_de_fatura_vencendo) required @endif
                                                style="max-width: 80px" />

                                            <div class="" style="margin-top: -5px">
                                                <span class="d-inline-block align-middle" tabindex="-1"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Refere-se à diferença de dias entre cada envio (se inserir 3 dias, a notificação é enviada a cada 3 dias).">
                                                    <svg class="svg-icon"
                                                        style="margin-left: 0px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
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
                                            </div>

                                        </div>

                                    </div>
                                    <div class="pt-2  mb-1">
                                        Dias antes do vencimento:
                                        <div class="d-flex gap-1 pt-1">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantidade_de_dias_antes_do_vencimento"
                                                id="quantidade_de_dias_antes_do_vencimento"
                                                value="{{ old('quantidade_de_dias_antes_do_vencimento', $dataConfigCharge->quantidade_de_dias_antes_do_vencimento) }}"
                                                placeholder="" @if ($dataConfigCharge->enviar_notificacao_de_fatura_vencendo) required @endif
                                                style="max-width: 80px" />

                                            <div class="" style="margin-top: -5px">
                                                <span class="d-inline-block align-middle" tabindex="-1"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Refere-se a data do primeiro envio da fatura/cobrança antes do vencimento.">
                                                    <svg class="svg-icon"
                                                        style="margin-left: 0px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
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
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- Enviar notificação de fatura no vencimento -->
                            <div class="col-12 col-lg-12 mb-4">
                                <div class="form-check form-switch d-flex">
                                    <input class="form-check-input " name="enviar_notificacao_de_fatura_no_vencimento"
                                        type="checkbox" id="enviar_notificacao_de_fatura_no_vencimento"
                                        @if (old('enviar_notificacao_de_fatura_no_vencimento', $dataConfigCharge->enviar_notificacao_de_fatura_no_vencimento)) checked @endif
                                        style="width: 43px; height: 22px;" />
                                    <label class="form-check-label fs-4 fw-semibold ms-3">
                                        <label for="enviar_notificacao_de_fatura_no_vencimento">
                                            Enviar notificação de fatura no vencimento
                                        </label>
                                        <span class="d-inline-block align-middle" tabindex="-1"
                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Envia uma notificação aos clientes no dia em que suas faturas/cobranças vencem, lembrando-os da necessidade de realizar o pagamento.">
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
                        <div class="col-lg-6">
                            <!-- Enviar notificação de fatura vencida -->
                            <div class="col-12 col-lg-12 mb-4">
                                <div class="form-check form-switch d-flex">
                                    <input class="form-check-input " name="enviar_notificacao_de_fatura_vencida"
                                        type="checkbox" id="enviar_notificacao_de_fatura_vencida"
                                        @if (old('enviar_notificacao_de_fatura_vencida', $dataConfigCharge->enviar_notificacao_de_fatura_vencida)) checked @endif
                                        style="width: 43px; height: 22px;" />
                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                        <label for="enviar_notificacao_de_fatura_vencida">
                                            Enviar notificação após vencimento da fatura
                                        </label>
                                        <span class="d-inline-block align-middle" tabindex="-1"
                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Envia uma notificação aos clientes logo após a data de vencimento de suas faturas/cobranças, informando sobre o atraso no pagamento.">
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

                                <div class="ps-1 d-flex gap-3 flex-wrap">
                                    <div class="pt-2 mb-1">
                                        Quantidade de envios:

                                        <div class="d-flex gap-1 pt-1">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantidade_de_envios_apos_vencimento"
                                                id="quantidade_de_envios_apos_vencimento"
                                                value="{{ old('quantidade_de_envios_apos_vencimento', $dataConfigCharge->quantidade_de_envios_apos_vencimento) }}"
                                                placeholder="" @if ($dataConfigCharge->enviar_notificacao_de_fatura_vencida) required @endif
                                                style="max-width: 80px" />

                                            <div class="" style="margin-top: -5px">
                                                <span class="d-inline-block align-middle" tabindex="-1"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Refere-se à quantidade de vezes que a fatura/cobrança será enviada.">
                                                    <svg class="svg-icon"
                                                        style="margin-left: 0px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
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
                                            </div>

                                        </div>

                                    </div>
                                    <div class="pt-2 mb-1">
                                        Intervalo de dias:
                                        <div class="d-flex gap-1 pt-1">
                                            <input type="text" class="form-control form-control-sm"
                                                name="quantidade_de_dias_de_intervalo_do_envio_vencida"
                                                id="quantidade_de_dias_de_intervalo_do_envio_vencida"
                                                value="{{ old('quantidade_de_dias_de_intervalo_do_envio_vencida', $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencida) }}"
                                                placeholder="" @if ($dataConfigCharge->enviar_notificacao_de_fatura_vencida) required @endif
                                                style="max-width: 80px" />

                                            <div class="" style="margin-top: -5px">
                                                <span class="d-inline-block align-middle" tabindex="-1"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Refere-se à diferença de dias entre cada envio (se inserir 3 dias, a notificação é enviada a cada 3 dias).">
                                                    <svg class="svg-icon"
                                                        style="margin-left: 0px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
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
                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                            <!-- Enviar notificação de fatura emitida -->
                            <div class="col-12 col-lg-12 mb-4">
                                <div class="form-check form-switch d-flex">
                                    <input class="form-check-input " name="enviar_notificacao_de_fatura_emitida"
                                        type="checkbox" @if (old('enviar_notificacao_de_fatura_emitida', $dataConfigCharge->enviar_notificacao_de_fatura_emitida)) checked @endif
                                        id="enviar_notificacao_de_fatura_emitida"
                                        style="width: 43px; height: 22px;" />
                                    <label class="form-check-label fs-4 fw-semibold ms-3">
                                        <label for="enviar_notificacao_de_fatura_emitida">
                                            Enviar notificação de fatura emitida
                                        </label>
                                        <span class="d-inline-block align-middle" tabindex="-1"
                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="Envia automaticamente uma notificação aos clientes sempre que uma nova fatura/cobrança é emitida.">
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
                </div>
                <!-- Tipo de cliente -->
                <div class="tab-pane" id="tipo-cliente-item" role="tabpanel" aria-labelledby="tipo-cliente-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-2 gy-3 gy-lg-4">
                        <!-- Enviar notificações para CNPJ -->
                        <div class="col-12 col-lg-4">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_notificacoes_para_cnpj" type="checkbox"
                                    id="enviar_notificacoes_para_cnpj"
                                    @if (old('enviar_notificacoes_para_cnpj', $dataConfigCharge->enviar_notificacoes_para_cnpj)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="enviar_notificacoes_para_cnpj">
                                        Enviar notificações para CNPJ
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações para clientes com cadastros do tipo CNPJ.">
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
                        <!-- Enviar notificações para CPF -->
                        <div class="col-12 col-lg-8">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_notificacoes_para_cpf" type="checkbox"
                                    id="enviar_notificacoes_para_cpf"
                                    @if (old('enviar_notificacoes_para_cpf', $dataConfigCharge->enviar_notificacoes_para_cpf)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="enviar_notificacoes_para_cpf">
                                        Enviar notificações para CPF
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia notificações para clientes com cadastros do tipo CPF.">
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
                <!-- Tipo de envio do boleto -->
                <div class="tab-pane" id="tipo-envio-boleto-item" role="tabpanel"
                    aria-labelledby="tipo-envio-boleto-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-2 gy-3 gy-lg-4">
                        <!-- Enviar link do boleto -->
                        <div class="col-12 col-lg-4">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_link_do_boleto" type="checkbox"
                                    id="enviar_link_do_boleto" @if (old('enviar_link_do_boleto', $dataConfigCharge->enviar_link_do_boleto)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="enviar_link_do_boleto">
                                        Enviar link do boleto
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação aos clientes contendo um link direto para acessar o boleto.">
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
                        <!-- Enviar PDF do boleto -->
                        <div class="col-12 col-lg-8">
                            <div class="form-check form-switch d-flex">
                                <input class="form-check-input " name="enviar_pdf_do_boleto" type="checkbox"
                                    id="enviar_pdf_do_boleto" @if (old('enviar_pdf_do_boleto', $dataConfigCharge->enviar_pdf_do_boleto)) checked @endif
                                    style="width: 43px; height: 22px;" />
                                <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                    <label for="enviar_pdf_do_boleto">
                                        Enviar PDF do boleto
                                    </label>
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Envia uma notificação aos clientes contendo um anexo em PDF do boleto.">
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
                <!-- Forma de pagamento -->
                <div class="tab-pane" id="form-paga-item" role="tabpanel" aria-labelledby="form-paga-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3">
                        <div class="px-2">
                            <div class="alert alert-light text-dark mx-1 fs-4" role="alert">
                                <i class="ti ti-info-circle me-1"></i>
                                Todas as cobranças que forem importadas serão enviadas.
                            </div>
                            <div class="alert alert-warning align-items-center gap-1 mx-1" role="alert"
                                id="aviso-form-pg" style="display: none">
                                <i class="ti ti-info-circle me-1 fs-4"></i>
                                Selecione pelo menos uma opção.
                            </div>
                        </div>


                        <div class="mb-3 fs-5 col-12 ">
                            Bling - Enviar notificações de:
                            <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                data-bs-trigger="hover focus" data-bs-content="Deverá selecionar uma ou mais forma(s) de pagamento, cadastradas no Bling, para que seja(m) enviada(s) as notificações.">
                                <svg class="svg-icon"
                                    style="margin-left: 2px; margin-bottom: 5px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                    viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                    <path
                                        d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                    <path
                                        d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                </svg>
                            </span>
                        </div>

                        @php
                            $formPg = \App\Models\FormasPagamento::where('user_id', user_princ()->id)->get();
                        @endphp

                        @foreach ($formPg as $key => $item)
                            <div class="col-12 col-lg-4 mb-3 mb-lg-4">
                                <div class="form-check form-switch d-flex">
                                    @php
                                        $checkPgBoleto = false;
                                        if (is_array($dataConfigCharge->formas_pagamento)) {
                                            if (in_array($item->idBling, $dataConfigCharge->formas_pagamento)) {
                                                $checkPgBoleto = true;
                                            }
                                        }

                                        if (is_array(old('formas_pagamento'))) {
                                            $checkPgBoleto = false;
                                            if (in_array($item->idBling, old('formas_pagamento'))) {
                                                $checkPgBoleto = true;
                                            }
                                        }
                                    @endphp
                                    <input class="form-check-input item-form-pg " onchange="changeItemPg(this)"
                                        value="{{ $item->idBling }}" name="formas_pagamento[]" type="checkbox"
                                        id="form-pg-{{ $key }}"
                                        @if ($checkPgBoleto) checked @endif
                                        style="width: 43px; height: 22px;" />
                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="">
                                        <label for="form-pg-{{ $key }}">
                                            {{ $item->descricao }}
                                        </label>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Opções de envio -->
                <div class="tab-pane" id="op-envio-item" role="tabpanel" aria-labelledby="op-envio-tab">
                    <div class="pt-4 mb-2"></div>
                    <!-- Opções -->
                    <div class="row mb-3 pb-3 pt-3 gy-3 gy-lg-4">

                        <!-- Usar dados importados  -->
                        <div class="col-12 col-lg-7 col-xl-7 col-xxl-6">
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
                        <div class="col-12 col-lg-5 col-xl-5 col-xxl-6">
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
                        <!-- Enviar para faturas com vencimento a partir de  -->
                        <div class="col-12 col-lg-7 col-xl-7 col-xxl-6">
                            <div class=" d-flex">
                                <input class="form-check-input visually-hidden" tabindex="-1"
                                    name="enviar_para_faturas_com_vencimento_a_partir_de" type="checkbox"
                                    id="enviar_para_faturas_com_vencimento_a_partir_de" checked
                                    style="width: 43px; height: 22px;" {{-- @if (old('enviar_para_faturas_com_vencimento_a_partir_de', $dataConfigCharge->enviar_para_faturas_com_vencimento_a_partir_de)) checked @endif --}}
                                    onchange="dateSendSalesToggleRequired();validateSendCheck2(this,this.checked)" />
                                <label class="form-check-label fs-4 fw-semibold ms-0" for="">
                                    <div class="d-flex gap-2 text-truncate align-items-center">
                                        <div class="fs-5">
                                            <label for="enviar_para_faturas_com_vencimento_a_partir_de"
                                                class="fw-normsal fs-5">
                                                Enviar para faturas com vencimento a partir de:
                                            </label>
                                        </div>
                                        <div class="position-relative">
                                            <input type="date" class="form-control form-control-sm text-center  "
                                                name="data_inicial" id="data_inicial"
                                                value="{{ old('data_inicial', $dataConfigCharge->data_inicial) }}"
                                                min="{{ date('Y-m-d', strtotime(' - 365 days')) }}"
                                                style="max-width: 105px; ">
                                        </div>
                                        <div class="">
                                            <span class="d-inline-block align-middle" tabindex="-1"
                                                data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                data-bs-content="Configura o sistema para enviar notificações automáticas para faturas com vencimento a partir da data inserida. É possível selecionar uma data com no máximo 365 dias a partir de hoje.">
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
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <!-- As notificações de cobrança serão enviadas todos os dias úteis as -->
                        <div class="col-12 d-none">
                            <div class="d-flex gap-2 text-truncate align-items-center fs-5">
                                <label for="enviar_todos_os_dias_as" class="fw-semibold fs-5">
                                    As notificações de cobrança serão enviadas todos os dias úteis as
                                </label>
                                <div class="position-relative">
                                    <select class="form-select form-select-sm pe-3"
                                        name="enviar_todos_os_dias_as_hora" id="todo-dia-hora"
                                        style="min-width:65px; background-position: center right 5px; margin-top: 0px ">
                                        @for ($i = 7; $i <= 19; $i++)
                                            @php
                                                $hora = ($i < 10 ? "0$i" : $i) . ':00';
                                            @endphp
                                            <option value="{{ $hora }}"
                                                @if ($hora == $dataConfigCharge->enviar_todos_os_dias_as_hora) selected @endif>
                                                {{ $hora }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="fw-semibold">
                                    horas
                                    <span class="d-inline-block align-middle" tabindex="-1" data-bs-toggle="popover"
                                        data-bs-trigger="hover focus"
                                        data-bs-content="Configura o sistema para enviar notificações automaticamente todos os dias no horário inserido.">
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
                                </div>
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
                    <button type="submit" onclick="abrirTabErro()" class="btn btn-primary  px-5 fs-5"
                        @if (auth()->user()->hasPermissionTo('edit-modulo-cobrancas') == false) disabled @endif>
                        <div class="px-lg-5">Salvar</div>
                    </button>
                @else
                    <button type="submit" onclick="abrirTabErro()" class="btn btn-primary  px-5 fs-5"
                        @if (auth()->user()->hasPermissionTo('edit-modulo-cobrancas') == false) disabled @endif>
                        <div class="px-lg-5">Atualizar</div>
                    </button>
                @endif
                <a href="{{ route('dashboard') }}" class="btn btn-light  px-5 fs-5 text-primary">
                    <div class="px-lg-5">Cancelar</div>
                </a>
            </div>
        </div>
        @include('pages.config.system.charges._modal_imported_data', compact('dataConfigCharge'))

    </form>
</div>


<!-- Axios CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
    integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function abrirTabErro() {
        // Enviar notificação de fatura a vencer
        if (document.getElementById('enviar_notificacao_de_fatura_vencendo').checked) {
            let el1 = document.getElementById('quantidade_de_envios_antecipados').value
            let el2 = document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento').value
            let el3 = document.getElementById('quantidade_de_dias_antes_do_vencimento').value
            if (el1 == '' || el2 == '' || el3 == '') {
                document.getElementById('tipo-envio-tab').click();
            }
        }
        // Enviar notificação de após vencimento da fatura
        if (document.getElementById('enviar_notificacao_de_fatura_vencida').checked) {
            let el1 = document.getElementById('quantidade_de_envios_apos_vencimento').value
            let el2 = document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida').value
            if (el1 == '' || el2 == '') {
                document.getElementById('tipo-envio-tab').click();
            }
            // Enviar para faturas com vencimento a partir de
            if (document.getElementById('enviar_para_faturas_com_vencimento_a_partir_de').checked) {
                let el1 = document.getElementById('data_inicial').value
                if (el1 == '') {
                    document.getElementById('op-envio-tab').click();
                }
            }
        }

        /*  */
        if (document.getElementById('data_inicial').value == '') {
            document.getElementById('op-envio-tab').click();
        }


    }


    /* Permitir uma ou duas opções em 'tipo envio boleto' */
    document.getElementById('enviar_link_do_boleto').onchange = function() {
        if (this.checked == false) {
            document.getElementById('enviar_pdf_do_boleto').checked = true
        }
    }
    document.getElementById('enviar_pdf_do_boleto').onchange = function() {
        if (this.checked == false) {
            document.getElementById('enviar_link_do_boleto').checked = true
        }
    }

    /* Permitir no mínimo uma opção em form pg */
    function changeItemPg(el) {

        document.getElementById('aviso-form-pg').style.display = 'none';

        setTimeout(() => {
            let index = 0
            for (let i in document.querySelectorAll('.item-form-pg')) {
                if (document.querySelectorAll('.item-form-pg')[i].checked == true)
                    index++
            }

            if (index == 0) {
                el.checked = true
            }
        }, 10);

    }


    // onsubit form
    document.getElementById('form-main').addEventListener('submit', function(event) {

        /*  */
        var checkboxes = document.querySelectorAll('input[name="formas_pagamento[]"]');

        // Verifica se pelo menos uma checkbox está marcada
        var isChecked = Array.prototype.slice.call(checkboxes).some(function(checkbox) {
            return checkbox.checked;
        });

        // Se nenhuma checkbox estiver marcada, impedir o envio do formulário
        if (!isChecked) {
            event.preventDefault();
            document.getElementById('form-paga-tab').click();
            document.getElementById('aviso-form-pg').style.display = 'flex';
        }



    });

    //
    document.getElementById('data_inicial').addEventListener('invalid', function(event) {
        document.getElementById('op-envio-tab').click()
    });
</script>
