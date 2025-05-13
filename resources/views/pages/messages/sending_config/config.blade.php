@extends('layouts.basic')
@section('title', 'Configuração de envio')
@section('style')
    <style>
        .form-select.is-invalid {
            background-image: var(--bs-form-select-bg-img);
        }

        /* form .fs-4 {
                font-size: 14px !important
            } */
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Configuração de envio</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.crud.index') }}">Mensagens</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Configuração de envio</li>
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
                <div class="card-body px-3 px-md-4">
                    <div class="px-0 px-md-1">
                        <x-alerts.success />
                        <x-alerts.warning />

                        <!-- sem config envio -->
                        <div class="alert alert-warning alert-dismissible fade show text-center px-3 " role="alert"
                            id="alert-ob-opcoes" style="display: none">
                            <div class="fs-4">
                                É obrigatório selecionar uma opção entre: <span class="fw-semibold">
                                    "Enviar automático às 9h todos os dias"</span>, <span class="fw-semibold"> "Enviar todos
                                    os
                                    dias às"</span> ou <span class="fw-semibold"> "Data específica"</span>.
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="document.getElementById('alert-ob-opcoes').style.display='none';"
                                    aria-label="Close">
                                    OK
                                </button>
                            </div>
                        </div>

                        @if ($errors->any())
                            {{-- {{dd(old('groups_import', $dataSettings->use_imported_data_import))}} --}}
                            <div class="alert alert-danger pb-0">
                                <ul class="">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('whatsapp_nao_configurado'))
                            <div class="alert alert-danger text-centers" role="alert">
                                <div class="fs-4">
                                    Para realizar as notificações é preciso integrar o whatsapp no módulo Remarketing.
                                </div>
                                <a href="{{ route('messages.sending-settings.redi-whatsapp', $message->id) }}"
                                    class="btn btn-primary mt-2 fs-4">
                                    Configurar Whatsapp
                                </a>
                            </div>
                        @endif

                        @if ($message->type == 'PESQUISA SATISFAÇÃO')
                            <div class="alert alert-light text-dark fs-4" role="alert"
                                style="background: #fff5df !important">
                                <i class="ti ti-info-circle me-1"></i>
                                Este tipo de mensagem só será enviada para dados importados, escolha o grupo na opção
                                abaixo.
                            </div>
                        @else
                            @if ($showMsgIntegrationThisUsed == false && $usedIntegrationInOthers)
                                <div class="alert alert-light text-dark fs-4" role="alert"
                                    style="background: #fff5df !important">
                                    <i class="ti ti-info-circle me-1"></i>
                                    Uma mensagem do tipo <span class="fw-semibold">{{ $message->type }}</span> já está
                                    utilizando os dados da
                                    integração.
                                    Agora, a opção de <span class="fw-semibold">dados importados</span> é obrigatória para
                                    esse
                                    tipo de mensagem.
                                </div>
                            @endif
                        @endif

                        <form action="{{ route('messages.sending-settings.store', $message->id) }}" method="post"
                            target="" id="form" enctype="multipart/form-data">
                            @csrf
                            {{-- 3: modulo remarketing --}}
                            <input type="hidden" name="module_id" value="3">
                            <div class="row">
                                <!-- Nome -->
                                <div class="mb-3 col-12 col-lg-9">
                                    <label for="name" class="form-label">Nome da Mensagem</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                        value="{{ $dataSettings->name }}" name="name" id="name" placeholder=""
                                        required readonly disabled />
                                </div>
                                <div class="mb-3 col-12 col-lg-3">
                                    <label for="type" class="form-label">Tipo</label>
                                    <select class="form-select" id="type" disabled>
                                        <option value="{{ $message->type }}" selected>
                                            {{ $message->type }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- Opções -->
                            <div class="row mb-3 pb-3 pt-3 gy-4">
                                <!-- Enviar mensagem sobre não receber mais notificações -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input " name="message_no_receiving_notifications"
                                            type="checkbox" id="message_no_receiving_notifications"
                                            style="width: 43px; height: 22px;"
                                            @if (old('message_no_receiving_notifications', $dataSettings->message_no_receiving_notifications)) checked @endif />
                                        <label class="form-check-label fs-4 fw-semibold ms-3"
                                            for="message_no_receiving_notifications">
                                            Enviar mensagem sobre não receber mais notificações
                                            <span class="d-inline-block align-middle" tabindex="0"
                                                data-bs-toggle="popover" data-bs-trigger="hover focus"
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
                                @if ($message->type == 'AGRADECIMENTO')
                                    <!-- Enviar mensagem para pesquisa de satisfação -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="send_message_for_satisfaction_survey"
                                                type="checkbox" id="send_message_for_satisfaction_survey"
                                                style="width: 43px; height: 22px;"
                                                @if (old('send_message_for_satisfaction_survey', $dataSettings->send_message_for_satisfaction_survey)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3"
                                                for="send_message_for_satisfaction_survey">
                                                Enviar mensagem para pesquisa de satisfação
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
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
                                @endif
                                @if ($message->type != 'ANIVERSÁRIO')
                                    <!-- Enviar notificações somente para clientes com NF-e emitida -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="only_customers_nf" type="checkbox"
                                                id="only_customers_nf" style="width: 43px; height: 22px;"
                                                @if (old('only_customers_nf', $dataSettings->only_customers_nf)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="only_customers_nf">
                                                Enviar notificações somente para clientes com NF-e emitida
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Notificações serão enviadas apenas para vendas que possuírem Nota Fiscal Eletrônica emitida.">
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
                                @endif
                                <!-- Enviar automático às 9h todos os dias  -->

                                {{-- ocultar por enquanto --}}
                                <div class="col-12 col-lg-6 d-none">
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input " name="automatic_send_at_9am_every_day"
                                            onchange="validateSendCheck(this,this.checked)" type="checkbox"
                                            id="automatic_send_at_9am_every_day" style="width: 43px; height: 22px;"
                                            @if (old('automatic_send_at_9am_every_day', $dataSettings->automatic_send_at_9am_every_day)) checked @endif />
                                        <label class="form-check-label fs-4 fw-semibold ms-3"
                                            for="automatic_send_at_9am_every_day">
                                            Enviar automático às 9h todos os dias
                                            <span class="d-inline-block align-middle" tabindex="0"
                                                data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                data-bs-content="O envio das notificações será realizado automaticamente todos os dias às 9h.">
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


                                @if ($message->type != 'ANIVERSÁRIO')
                                    <!-- Enviar somente PJ -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="send_to_pj" type="checkbox"
                                                id="send_to_pj" style="width: 43px; height: 22px;"
                                                @if (old('send_to_pj', $dataSettings->send_to_pj)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="send_to_pj">
                                                Enviar PJ
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Notificações destinadas exclusivamente a cadastros de Pessoa Jurídica (CNPJ).">
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

                                    <!-- Enviar somente PF -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="send_to_pf" type="checkbox"
                                                id="send_to_pf" style="width: 43px; height: 22px;"
                                                @if (old('send_to_pf', $dataSettings->send_to_pf)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="send_to_pf">
                                                Enviar PF
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Notificações destinadas exclusivamente a cadastros de Pessoa Física (CPF).">
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
                                @endif


                                {{-- @if ($message->type != 'PESQUISA SATISFAÇÃO') --}}
                                <!-- Usar dados da integração  -->
                                <div
                                    class="col-12 col-lg-6 @if ($showMsgIntegrationThisUsed == false && $usedIntegrationInOthers) visually-hidden @endif @if ($message->type == 'PESQUISA SATISFAÇÃO') visually-hidden @endif ">
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input " name="use_integration_data" type="checkbox"
                                            id="use_integration_data" style="width: 43px; height: 22px;"
                                            @if (old('use_integration_data', $dataSettings->use_integration_data)) checked @endif />
                                        <label class="form-check-label fs-4 fw-semibold ms-3" for="use_integration_data">
                                            Usar dados da integração
                                            <span class="d-inline-block align-middle" tabindex="0"
                                                data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                data-bs-content="Utilização de dados provenientes do sistema integrado - Bling.">
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
                                {{-- @endif --}}
                                <!-- Usar dados importados  -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input " name="use_imported_data" type="checkbox"
                                            id="use_imported_data" style="width: 43px; height: 22px;"
                                            @if (old('use_imported_data', $dataSettings->use_imported_data)) checked @endif
                                            @if ($message->type == 'PESQUISA SATISFAÇÃO' || ($showMsgIntegrationThisUsed == false && $usedIntegrationInOthers)) required @endif />
                                        <label class="form-check-label fs-4 fw-semibold ms-3" for="use_imported_data">
                                            Usar dados importados
                                            <span class="d-inline-block align-middle" tabindex="0"
                                                data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                data-bs-content="Utilização de dados carregados manualmente via planilhas ou arquivos.">
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
                                @if ($message->type != 'ANIVERSÁRIO')
                                    <!-- Enviar somente para novas vendas  -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="send_only_for_new_sales"
                                                type="checkbox" id="send_only_for_new_sales"
                                                style="width: 43px; height: 22px;"
                                                onchange="validateSendCheck2(this,this.checked)"
                                                @if (old('send_only_for_new_sales', $dataSettings->send_only_for_new_sales)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3"
                                                for="send_only_for_new_sales">
                                                Enviar somente para novas vendas
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Notificações serão enviadas apenas para vendas registradas após a ativação do envio automático.">
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
                                @endif
                                @if ($message->type != 'ANIVERSÁRIO')
                                    <!-- Enviar para vendas a  partir  -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="send_to_sales_from" type="checkbox"
                                                id="send_to_sales_from" style="width: 43px; height: 22px;"
                                                onchange="dateSendSalesToggleRequired();validateSendCheck2(this,this.checked)"
                                                @if (old('send_to_sales_from', $dataSettings->send_to_sales_from)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="send_to_sales_from"
                                                style="margin-top: -3px">
                                                <div
                                                    class="d-flex gap-0 gap-md-2 flex-wrap text-truncate align-items-center">
                                                    <div class="">
                                                        Enviar para vendas a partir de:
                                                    </div>
                                                    <div class="position-relative mb-1 mb-md-0">
                                                        <input type="date"
                                                            class="form-control form-control-sm text-center  "
                                                            name="send_to_sales_from_date" id="send_to_sales_from_date"
                                                            value="{{ old('send_to_sales_from_date', $dataSettings->send_to_sales_from_date) }}"
                                                            min="{{ date('Y-m-d', strtotime(' - 60 days')) }}"
                                                            style="max-width: 105px; ">
                                                    </div>
                                                    <div class="">
                                                        <span class="d-inline-block align-middle" tabindex="0"
                                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                            data-bs-content="Permite definir uma data a partir da qual as vendas serão consideradas para envio de notificações.">
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
                                                <div class="text-muted fs-2 fw-normal"
                                                    style="margin-bottom: -20px; margin-top: -3px">
                                                    É possível selecionar datas até 60 dias retroativos.
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <!-- Todos os dias -->
                                <div class="d-none">
                                    <div class="col-12 col-lg-6 " id="col-todo-dias">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="every_day_at_specific_time"
                                                type="checkbox" id="every_day_at_specific_time"
                                                style="width: 43px; height: 22px;"
                                                onchange="hourToggleRequired();validateSendCheck(this,this.checked)"
                                                @if (old('every_day_at_specific_time', $dataSettings->every_day_at_specific_time)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3"
                                                for="every_day_at_specific_time">
                                                <div class="d-flex gap-2 text-truncate">
                                                    Enviar todos os dias às <div class="position-relative">
                                                        <select class="form-select form-select-sm pe-3"
                                                            name="every_day_at_specific_time_value" id="todo-dia-hora"
                                                            style="min-width:65px; background-position: center right 5px; margin-top: 0px ">
                                                            @for ($i = 7; $i <= 19; $i++)
                                                                @php
                                                                    $hora = ($i < 10 ? "0$i" : $i) . ':00';
                                                                @endphp
                                                                <option value="{{ $hora }}"
                                                                    @if ($hora == old('every_day_at_specific_time_value', $dataSettings->every_day_at_specific_time_value)) selected @endif>
                                                                    {{ $hora }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="">
                                                        horas
                                                        <span class="d-inline-block align-middle" tabindex="0"
                                                            data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                            data-bs-content="Permite configurar o horário diário de envio automático das notificações.">
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
                                </div>
                                <!-- Data específica -->
                                <div class="col-12 col-lg-6 d-none" id="col-dt-especifica">
                                    <div class="form-check form-switch d-flex">
                                        <input class="form-check-input " name="specific_date" type="checkbox"
                                            id="specific_date" style="width: 43px; height: 22px;"
                                            onchange="dateHourToggleRequired();validateSendCheck(this,this.checked)"
                                            @if (old('specific_date', $dataSettings->specific_date)) checked @endif />
                                        <label class="form-check-label fs-4 fw-semibold ms-3" for="specific_date">
                                            <div class="d-flex flex-wrap gap-2 text-truncate ">
                                                Data específica
                                                <div class="position-relative">
                                                    <input type="date"
                                                        class="form-control form-control-sm text-center input-date-remove-icon "
                                                        name="specific_date_value_date" id="dt-especifica-data"
                                                        value="{{ old('specific_date_value_date', $dataSettings->specific_date_value_date) }}"
                                                        min="{{ date('Y-m-d', strtotime('+ 1 days')) }}"
                                                        style="max-width: 95px; ">
                                                </div>
                                                {{-- ocultar  por enquanto --}}
                                                {{-- às --}}
                                                <div class="position-relative d-none">
                                                    <select class="form-select form-select-sm pe-3"
                                                        name="specific_date_value_time" id="dt-especifica-hora"
                                                        style="min-width:65px; background-position: center right 5px; margin-top: 0px ">
                                                        @for ($i = 7; $i <= 19; $i++)
                                                            @php
                                                                $hora = ($i < 10 ? "0$i" : $i) . ':00';
                                                            @endphp
                                                            <option value="{{ $hora }}"
                                                                @if ($hora == old('specific_date_value_time', $dataSettings->specific_date_value_time)) selected @endif>
                                                                {{ $hora }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                {{-- ocultar por enquanto --}}
                                                <div class="d-none">
                                                    horas
                                                    <span class="d-inline-block align-middle" tabindex="0"
                                                        data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                        data-bs-content="Configuração de uma data exata para o envio único de notificações.">
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

                                @if ($message->type == 'ANIVERSÁRIO' || $message->type == 'AGRADECIMENTO')
                                    <!-- Enviar imagem junto com a mensagem. (tam. max. 500kb) -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="image" type="checkbox"
                                                id="image" style="width: 43px; height: 22px;"
                                                @if (old('image', $dataSettings->image)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="image">
                                                Enviar imagem junto com a mensagem. (tam. max. 500kb)
                                                <span class="d-inline-block align-middle" tabindex="0"
                                                    data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                    data-bs-content="Habilita o envio de uma imagem junto com a mensagem, respeitando o limite de 500kb.">
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
                                @endif

                                @if ($message->type != 'PESQUISA SATISFAÇÃO')
                                    <!-- Enviar mensagem após -->
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="qtd_dias_apos_entrega" type="checkbox"
                                                id="qtd_dias_apos_entrega" style="width: 43px; height: 22px;"
                                                onchange="checkAposDias()"
                                                @if (old('qtd_dias_apos_entrega', $dataSettings->qtd_dias_apos_entrega)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3"
                                                for="qtd_dias_apos_entrega">
                                                <div class="d-flex flex-wrap gap-2 text-truncate ">
                                                    Enviar mensagem após
                                                    <style>
                                                        .form-control-number[type='number'] {
                                                            -moz-appearance: textfield;
                                                        }

                                                        .form-control-number::-webkit-outer-spin-button,
                                                        .form-control-number::-webkit-inner-spin-button {
                                                            -webkit-appearance: none;
                                                        }
                                                    </style>
                                                    <div class="position-relative">

                                                        <input type="number"
                                                            class="form-control form-control-sm form-control-number text-center input-date-remove-icon "
                                                            placeholder="" name="qtd_dias_apos_entrega_valor"
                                                            id="qtd_dias_apos_entrega_valor"
                                                            value="{{ old('qtd_dias_apos_entrega_valor', $dataSettings->qtd_dias_apos_entrega_valor) }}"
                                                            min="1"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            style="max-width: 50px; ">
                                                    </div>
                                                    dia(s) da entrega do pedido.
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                @if ($message->type == 'AGRADECIMENTO')
                                    <!-- Enviar mensagem de agradecimento após  -->
                                    <div class="col-12 col-lg-6" id="">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="qtd_dias_nao_rast" type="checkbox"
                                                id="qtd_dias_nao_rast" style="width: 43px; height: 22px;"
                                                onchange="checkAgraAposDias()"
                                                @if (old('qtd_dias_nao_rast', $dataSettings->qtd_dias_nao_rast)) checked @endif />
                                            <label class="form-check-label fs-4 fw-semibold ms-3" for="qtd_dias_nao_rast"
                                                style="margin-top: -3px">
                                                <div class="d-flex flex-wrap gap-0 gap-md-2  align-items-center ">
                                                    Enviar mensagem de agradecimento após
                                                    <style>
                                                        .form-control-number[type='number'] {
                                                            -moz-appearance: textfield;
                                                        }

                                                        .form-control-number::-webkit-outer-spin-button,
                                                        .form-control-number::-webkit-inner-spin-button {
                                                            -webkit-appearance: none;
                                                        }
                                                    </style>
                                                    <div class="position-relative mb-1 mb-md-0">

                                                        <input type="number"
                                                            class="form-control form-control-sm form-control-number text-center input-date-remove-icon "
                                                            placeholder="" name="qtd_dias_nao_rast_valor"
                                                            id="qtd_dias_nao_rast_valor"
                                                            value="{{ old('qtd_dias_nao_rast_valor', $dataSettings->qtd_dias_nao_rast_valor) }}"
                                                            min="1"
                                                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                            style="max-width: 50px; ">
                                                    </div>
                                                    <span class="ms-1 ms-md-0"> dias.*</span>
                                                </div>

                                                <div class=" text-muted fs-2 fw-normal"
                                                    style="margin-bottom: -20px; margin-top: -3px">
                                                    <strong style="color: #FF621D">*Para pedidos não rastreáveis via
                                                        Correios.</strong>
                                                </div>

                                            </label>

                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 mt-3">
                                <button type="submit" class="btn btn-primary  px-5 fs-5"
                                    onclick="document.getElementById('form').action = '{{ route('messages.sending-settings.store', $message->id) }}';">
                                    <div class="px-lg-5">
                                        {{ is_null($message->sending_setting) ? 'Salvar' : 'Atualizar' }}
                                    </div>
                                </button>
                                @if (session('url_prev_msg') && session('url_prev_msg') != url()->full())
                                    <a href="{{ session('url_prev_msg') }}"
                                        class="btn btn-light  px-5 fs-5 text-primary">
                                        <div class="px-lg-5">Cancelar</div>
                                    </a>
                                @else
                                    <a href="{{ route('messages.crud.index') }}"
                                        class="btn btn-light  px-5 fs-5 text-primary">
                                        <div class="px-lg-5">Cancelar</div>
                                    </a>
                                @endif

                            </div>
                            @include(
                                'pages.messages.sending_config._modal_cancel_notif',
                                compact('dataSettings'))
                            @include(
                                'pages.messages.sending_config._modal_satisfaction_survey',
                                compact('dataSettings', 'msgsSatisfactionSurveyAnexo', 'message'))

                            @include(
                                'pages.messages.sending_config._modal_imported_data',
                                compact('grupoDataImport', 'dataSettings', 'message'))

                            @include(
                                'pages.messages.sending_config._modal_image',
                                compact('dataSettings', 'message'))
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('pages.messages.sending_config._modal_show_anexo_satisfaction_survey')

@endsection
@section('scripts')
    <script>
        function toggleSendOptions() {
            if (true) {
                document.getElementById('col-dt-especifica').className = 'col-12 col-lg-6'
                document.getElementById('col-todo-dias').className = 'col-12 col-lg-6'
            } else {
                document.getElementById('col-dt-especifica').className = 'col-12 col-lg-6 d-none'
                document.getElementById('col-todo-dias').className = 'col-12 col-lg-6 d-none'
                document.getElementById('specific_date').checked = false
                document.getElementById('every_day_at_specific_time').checked = false
            }
        }
        toggleSendOptions()

        function hourToggleRequired() {
            let el = document.getElementById('every_day_at_specific_time')
            if (el.checked)
                document.getElementById('todo-dia-hora').required = true
            else
                document.getElementById('todo-dia-hora').required = false
        }
        hourToggleRequired()

        function dateHourToggleRequired() {
            let el = document.getElementById('specific_date')
            if (el.checked) {
                document.getElementById('dt-especifica-data').required = true
                document.getElementById('dt-especifica-hora').required = true
            } else {
                document.getElementById('dt-especifica-data').required = false
                document.getElementById('dt-especifica-hora').required = false
            }

        }
        dateHourToggleRequired()

        function dateSendSalesToggleRequired() {
            let el = document.getElementById('send_to_sales_from')
            if (el.checked) {
                document.getElementById('send_to_sales_from_date').required = true
            } else {
                document.getElementById('send_to_sales_from_date').required = false
            }

        }
        dateSendSalesToggleRequired()


        /* Validar quais checkbox de envio está selecionado */
        function validateSendCheck(elChange, bool) {
            document.getElementById('automatic_send_at_9am_every_day').checked = false
            document.getElementById('every_day_at_specific_time').checked = false
            document.getElementById('specific_date').checked = false
            if (bool) {
                document.getElementById(elChange.id).checked = true
            }

            dateSendSalesToggleRequired()
            dateHourToggleRequired()
            hourToggleRequired()
        }

        /* Validar quais checkbox de envio está selecionado 2 */
        function validateSendCheck2(elChange, bool) {
            document.getElementById('send_to_sales_from').checked = false
            document.getElementById('send_only_for_new_sales').checked = false
            if (bool) {
                document.getElementById(elChange.id).checked = true
            }

            dateSendSalesToggleRequired()
            dateHourToggleRequired()
            hourToggleRequired()
            checkAposDias()
        }
    </script>

    <script>
        document.getElementById('send_to_pj').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('send_to_pj').checked == false) {
                    document.getElementById('send_to_pf').checked = true
                }
            }, 100);
        }
        document.getElementById('send_to_pf').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('send_to_pf').checked == false) {
                    document.getElementById('send_to_pj').checked = true
                }
            }, 100);
        }
    </script>
    <script>
        // document.getElementById("form").addEventListener("submit", function(event) {

        //     let use_imported_data = document.getElementById('use_imported_data')
        //     let use_integration_data = document.getElementById('use_integration_data')

        //     if (send_to_pf.checked == false && send_to_pj.checked == false) {

        //         event.preventDefault()
        //         Swal.fire({
        //             title: "Aviso!",
        //             html: "Você precisa selecionar <code>Enviar PJ</code> ou <code>Enviar PF</code>.",
        //             icon: "warning",
        //         });

        //     }
        // })

        document.getElementById('use_imported_data').onchange = function() {

            // exibir modal se for selecionado
            if (document.getElementById('use_imported_data').checked) {
                modalImportedData.show();
            }

            setTimeout(() => {
                if (document.getElementById('use_imported_data').checked == false) {
                    document.getElementById('use_integration_data').checked = true
                }
            }, 100);
        }
        document.getElementById('use_integration_data').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('use_integration_data').checked == false) {
                    document.getElementById('use_imported_data').checked = true
                    modalImportedData.show();
                }
            }, 100);
        }



        /* Modal msg não receber notificações */
        const modalMsgNotify = new bootstrap.Modal(document.getElementById("modal-notify"));

        document.getElementById('message_no_receiving_notifications').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('message_no_receiving_notifications').checked) {
                    modalMsgNotify.show()
                }
            }, 100);
        }

        function cancelMsgNotify() {
            document.getElementById('msg-not-insert').value =
                `{{ str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataSettings->message_no_receiving_notifications_text) }}`;
            document.getElementById('msg-not').value =
                `{{ str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataSettings->message_no_receiving_notifications_text) }}`;

            modalMsgNotify.hide()
        }

        function updateMsgNotify() {
            document.getElementById('msg-not').value = document.getElementById('msg-not-insert').value
            modalMsgNotify.hide()
        }

        /* Modal pesquisa satisfação */
        const modalSatisfactionSurvey = new bootstrap.Modal(document.getElementById("modal-satisfaction-survey"));

        document.getElementById('send_message_for_satisfaction_survey').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('send_message_for_satisfaction_survey').checked) {
                    modalSatisfactionSurvey.show()
                }
            }, 100);
        }

        function cancelAnexoSatisfactionSurvey() {
            document.getElementById('anexo').value = "{{ $dataSettings->send_message_for_satisfaction_survey_id_message }}"
        }
    </script>

    @if (session('anexo_message_id'))
        <script>
            document.getElementById('send_message_for_satisfaction_survey').checked = true
            modalSatisfactionSurvey.show()
        </script>
    @endif

    <script>
        /* Limitar 'data especifica' se for selecionado o dia atual e hora menor q hora hora do dia atual */
        document.getElementById("form").addEventListener("submit", function(event) {



            if (document.getElementById("form").action ==
                "{{ route('messages.sending-settings.redir-import-data', $message->id) }}") {} else {
                if (document.getElementById('specific_date').checked == false &&
                    document.getElementById('automatic_send_at_9am_every_day').checked == false &&
                    document.getElementById('every_day_at_specific_time').checked == false) {

                    // ocultar por enquanto
                    // event.preventDefault()
                    // document.getElementById('alert-ob-opcoes').style.display = 'block'
                }
            }


            if (document.getElementById('specific_date').checked) {
                let data = document.getElementById('dt-especifica-data').value
                let hora = document.getElementById('dt-especifica-hora').value
            }

        })

        document.getElementById('dt-especifica-hora').addEventListener('change', function() {
            document.getElementById('dt-especifica-hora').setCustomValidity('');
            document.getElementById('dt-especifica-hora').classList.remove('is-invalid')
        });
        document.getElementById('specific_date').addEventListener('change', function() {
            document.getElementById('dt-especifica-hora').setCustomValidity('');
            document.getElementById('dt-especifica-hora').classList.remove('is-invalid')
        });


        function dataHoraNoPassado(dataHora) {
            // Convertendo a data e hora para o formato de objeto Date
            let dataHoraFormatada = new Date(dataHora);

            // Obtendo a data e hora atuais
            let dataHoraAtual = new Date();

            // Verificando se a data e hora fornecida estão no passado
            if (dataHoraFormatada < dataHoraAtual) {
                return true; // Está no passado
            } else {
                return false; // Não está no passado
            }
        }
    </script>

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const modalShowAnexo = new bootstrap.Modal(document.getElementById("modal-show-anexo"));
        // modalShowAnexo.show()
    </script>


    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
        integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        /* Exibir dados em modal show anexo pesquisa satisfaçao */
        function showAnexo() {

            let select = document.getElementById('anexo')
            getAnexoSatisfactionSurvey(select.value)
            modalShowAnexo.show()
        }

        function getAnexoSatisfactionSurvey(id) {
            let url = "{{ route('messages.crud.json-psa') }}/?id=" + id;
            axios.get(url)
                .then(res => {
                    document.getElementById('msg_nome').value = res.data.msg_nome
                    document.getElementById('pergunta_inicial').value = res.data.pergunta_inicial.pergunta
                    document.getElementById('pergunta_inicial_op')
                        .innerHTML = getHtmlOpcoesArray(res.data.pergunta_inicial.opcoes)

                    document.getElementById('caso_nao_perg_inicial-msg').value = res.data.caso_nao_perg_inicial.msg

                    document.getElementById('pergunta1').value = res.data.pergunta1.pergunta
                    document.getElementById('pergunta1_op')
                        .innerHTML = getHtmlOpcoesArray(res.data.pergunta1.opcoes)

                    document.getElementById('pergunta2').value = res.data.pergunta2.pergunta
                    document.getElementById('pergunta2_op')
                        .innerHTML = getHtmlOpcoesArray(res.data.pergunta2.opcoes)

                    document.getElementById('pergunta3').value = res.data.pergunta3.pergunta
                    document.getElementById('pergunta3_op')
                        .innerHTML = getHtmlOpcoesArray(res.data.pergunta3.opcoes)

                    document.getElementById('agradecimento').value = res.data.agradecimento.msg
                    document.getElementById('pergunta4').value = res.data.pergunta4.pergunta
                    document.getElementById('caso_resp_perg4').value = res.data.caso_resp_perg4.msg
                })
                .catch(err => {
                    console.log(err);
                })
        }

        function getHtmlOpcoesArray(array) {
            let html = '';
            // Filtrando as chaves numéricas
            const chavesNumericas = Object.keys(array).filter(chave => !isNaN(chave));
            // Obtendo os valores associados às chaves numéricas
            const valoresNumericos = chavesNumericas.map(chave => array[chave]);

            let index = 1;
            for (let i in valoresNumericos) {
                html += `<div> ${index} - ${valoresNumericos[i]}</div>`
                index++;
            }
            return html;
        }
    </script>


    <!-- Importar dados -->
    <script>
        const modalImportedData = new bootstrap.Modal(document.getElementById("modal-imported-data"));
        const modalImage = new bootstrap.Modal(document.getElementById("modal-image"));
        // modalImportedData.show()

        function saveImportedData() {
            let itens = document.querySelectorAll('.check-imported-groups')
            let checkeds = 0;
            for (let i in itens) {
                if (itens[i].checked)
                    checkeds++;
            }

            if (checkeds == 0) {
                Swal.fire({
                    title: "Aviso!",
                    text: "Você precisa selecionar pelo menos uma opção antes de salvar!",
                    icon: "warning",
                });
            } else {
                modalImportedData.hide()
            }
        }

        function cancelImportedData() {
            modalImportedData.hide()
            document.getElementById('use_imported_data').checked = false;
            document.getElementById('use_integration_data').checked = true;
        }

        if (document.getElementById('group-todos'))
            document.getElementById('group-todos').onchange = function() {
                let itens = document.querySelectorAll('.check-imported-groups')
                if (document.getElementById('group-todos').checked) {
                    for (let i in itens) {
                        itens[i].checked = true
                    }
                }
                if (document.getElementById('group-todos').checked == false) {
                    for (let i in itens) {
                        itens[i].checked = false
                    }
                }
            }

        function changeGroupImport() {
            // document.getElementById('group-todos').checked = false

            let itens = document.querySelectorAll('.check-imported-groups')
            let noChecks = 0
            for (let i in itens) {
                if (itens[i].checked == false)
                    noChecks++
            }
            if (noChecks > 0) {
                document.getElementById('group-todos').checked = false
            } else {
                document.getElementById('group-todos').checked = true
            }
        }

        /* image */
        if (document.getElementById('image'))
            document.getElementById('image').onchange = function() {

                // exibir modal se for selecionado
                if (document.getElementById('image').checked) {
                    modalImage.show();
                }
            }

        function closeModalImg() {
            modalImage.hide();
        }

        function onFileChange() {
            let e = document.getElementById('input-img')
            let files = e.files || e.dataTransfer.files;
            if (!files.length) {
                return
            }
            createImage(files[0])
        }

        function createImage(file) {
            let reader = new FileReader()
            reader.onload = (e) => {
                document.getElementById('img-elemento').src = e.target.result
            }
            reader.readAsDataURL(file)
        }
        if (document.getElementById('input-img'))
            document.getElementById('input-img').onchange = () => {
                onFileChange()
            }

        function resetFileImg() {
            document.getElementById("input-img").value = ''
            document.getElementById('img-elemento').src =
                `{{ asset($dataSettings->image ? 'storage/mensagem/' . $dataSettings->image : 'assets/images/examples/default-image.png') }}`
            setTimeout(() => {
                closeModalImg()
            }, 500);
        }

        //
        function checkAposDias() {
            // qtd_dias_apos_entrega
            if (document.getElementById('qtd_dias_apos_entrega').checked) {
                document.getElementById('qtd_dias_apos_entrega_valor').required = true
            } else {
                document.getElementById('qtd_dias_apos_entrega_valor').required = false
            }
        }
        if (document.getElementById('qtd_dias_apos_entrega_valor'))
            document.getElementById('qtd_dias_apos_entrega_valor').onblur = function() {
                let value = this.value
                if (value === '0') {}
            }

        function checkAgraAposDias() {
            // qtd_dias_apos_entrega
            if (document.getElementById('qtd_dias_nao_rast').checked) {
                document.getElementById('qtd_dias_nao_rast_valor').required = true
            } else {
                document.getElementById('qtd_dias_nao_rast_valor').required = false
            }
        }
        if (document.getElementById('qtd_dias_nao_rast_valor'))
            document.getElementById('qtd_dias_nao_rast_valor').onblur = function() {
                let value = this.value
                if (value === '0') {}
            }
    </script>

    @error('image_file')
        <script>
            modalImage.show();
        </script>
    @enderror

    @if (session('show_modal_imported_data'))
        <script>
            modalImportedData.show()
        </script>
    @endif

    @if ($message->type == 'PESQUISA SATISFAÇÃO')
        <script>
            document.getElementById('use_imported_data').onclick = function() {
                modalImportedData.show()
            }
            setInterval(() => {
                document.getElementById('use_imported_data').checked = true
                document.getElementById('use_integration_data').checked = false
            }, 100);
        </script>
    @endif


    @if ($message->type == 'PESQUISA SATISFAÇÃO')
    @else
        @if ($showMsgIntegrationThisUsed == false && $usedIntegrationInOthers)
            <script>
                setInterval(() => {
                    document.getElementById('use_integration_data').checked = false
                }, 100);
            </script>
        @endif
    @endif

@endsection
