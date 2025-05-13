@extends('layouts.basic')
@section('title', 'Visualizar Mensagem')
@section('style')
    <style>
        .form-check-label {
            opacity: 1 !important;
            color: rgb(148, 151, 165)
        }

        .form-check-input {
            opacity: .7 !important;
        }
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Mensagens</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.crud.index') }}">Mensagens</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Mensagem</li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger pb-0">
                            <ul class="">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('messages.sending-settings.store', $message->id) }}" method="post"
                        target="" id="form">
                        @csrf
                        {{-- 3: modulo remarketing --}}
                        <input type="hidden" name="module_id" value="3">
                        <div class="row">
                            <!-- Nome -->
                            <div class="mb-3 col-12 col-lg-4">
                                <div class="fs-5 fw-semibold">
                                    Nome da Mensagem:
                                </div>
                                <div class="fs-5">
                                    {{-- {{dd($message, $dataSettings)}} --}}
                                    {{ $dataSettings->name }}
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-lg-5">
                                <!-- Tipo -->
                                <div class="fs-5 fw-semibold">
                                    Tipo:
                                </div>
                                <div class="fs-5">
                                    {{ $message->type }}
                                </div>
                            </div>
                        </div>
                        @if ($message->module_id == 1 || $message->module_id == 2)
                            <div class="row mb-3 pb-3 pt-3">

                                <div class="mb-2 col-12 col-lg-12">
                                    <!-- Tipo -->
                                    <div class="fs-5 fw-semibold">
                                        Descrição:
                                    </div>
                                </div>
                                <div class="px-2">
                                    <div class="border bg-light py-2 mx-1 px-2 rounded">
                                        <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $message->description }}</pre>
                                    </div>
                                </div>
                            </div>
                        @else
                            @if ($message->type == 'AGRADECIMENTO' || $message->type == 'ANIVERSÁRIO')
                                <div class="row mb-0 pb-0 pt-0">

                                    <div class="mb-2 col-12 col-lg-12">
                                        <!-- Tipo -->
                                        <div class="fs-5 fw-semibold">
                                            Descrição:
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <div class="border bg-light py-2 mx-1 px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $message->description }}</pre>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if ($message->type == 'PESQUISA SATISFAÇÃO')
                                <div class="mb-2 col-12 col-lg-12">
                                    <!-- Tipo -->
                                    <div class="fs-5 fw-semibold">
                                        Descrição:
                                    </div>
                                </div>
                                <div class="mb-4">

                                    <div class="mb-3">
                                        @php
                                            $perguntaInicial = isset(
                                                $message->satisfaction_survey['pergunta_inicial']['pergunta'],
                                            )
                                                ? $message->satisfaction_survey['pergunta_inicial']['pergunta']
                                                : '';
                                        @endphp

                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $perguntaInicial }}</pre>
                                        </div>

                                    </div>
                                    <div class="fw-semibold ps-3">
                                        <div id="opcoes-perguntaInicial">

                                            <div class=""> 1 - Claro </div>
                                            <div class=""> 2 - Não, obrigado! </div>

                                        </div>

                                    </div>
                                </div>

                                <!-- caso não -->
                                <div class="mb-4">
                                    <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                        <strong>CASO NÃO</strong>
                                    </div>

                                    <div class="mb-3">
                                        @php
                                            $resCasoNao = isset(
                                                $message->satisfaction_survey['caso_nao_perg_inicial']['msg'],
                                            )
                                                ? $message->satisfaction_survey['caso_nao_perg_inicial']['msg']
                                                : '';
                                        @endphp
                                        <label for="resCasoNao" class="form-label visually-hidden">Resposta caso não</label>
                                        <div class="border bg-light py-2  px-2 rounded mt-3">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $resCasoNao }}</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pergunta #1 -->
                                <div class="mb-4">
                                    <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                        <strong>CASO CLARO</strong>
                                    </div>

                                    <div class="mb-2">
                                        @php
                                            $pergunta1 = isset($message->satisfaction_survey['pergunta1']['pergunta'])
                                                ? $message->satisfaction_survey['pergunta1']['pergunta']
                                                : '';
                                        @endphp
                                        <label for="pergunta1" class="form-label">Pergunta #1</label>

                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $pergunta1 }}</pre>
                                        </div>

                                    </div>
                                    <div class="fw-semibold ps-3">
                                        <div class=" mb-2">
                                            Avalie de 1 a 5:
                                        </div>
                                        <div id="">
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                1. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][1]) ? $message->satisfaction_survey['pergunta1']['opcoes'][1] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                2. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][2]) ? $message->satisfaction_survey['pergunta1']['opcoes'][2] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                3. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][3]) ? $message->satisfaction_survey['pergunta1']['opcoes'][3] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                4. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][4]) ? $message->satisfaction_survey['pergunta1']['opcoes'][4] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                5. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][5]) ? $message->satisfaction_survey['pergunta1']['opcoes'][5] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pergunta #2 -->
                                <div class="mb-4">
                                    <div class="mb-2">
                                        @php
                                            $pergunta2 = isset($message->satisfaction_survey['pergunta2']['pergunta'])
                                                ? $message->satisfaction_survey['pergunta2']['pergunta']
                                                : '';
                                        @endphp
                                        <label for="pergunta2" class="form-label">Pergunta #2</label>
                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $pergunta2 }}</pre>
                                        </div>
                                    </div>
                                    <div class="fw-semibold ps-3">
                                        <div class=" mb-2">
                                            Avalie de 1 a 5:
                                        </div>
                                        <div id="">
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                1. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][1]) ? $message->satisfaction_survey['pergunta2']['opcoes'][1] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                2. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][2]) ? $message->satisfaction_survey['pergunta2']['opcoes'][2] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                3. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][3]) ? $message->satisfaction_survey['pergunta2']['opcoes'][3] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                4. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][4]) ? $message->satisfaction_survey['pergunta2']['opcoes'][4] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                5. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]"
                                                    value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][5]) ? $message->satisfaction_survey['pergunta2']['opcoes'][5] : '' }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pergunta #3 -->
                                <div class="mb-4">
                                    <div class="mb-2">
                                        @php
                                            $pergunta3 = isset($message->satisfaction_survey['pergunta3']['pergunta'])
                                                ? $message->satisfaction_survey['pergunta3']['pergunta']
                                                : '';
                                        @endphp
                                        <label for="pergunta3" class="form-label">Pergunta #3</label>
                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $pergunta3 }}</pre>
                                        </div>
                                    </div>
                                    <div class="fw-semibold ps-3">
                                        <div class=" mb-2">
                                            Avalie:
                                        </div>
                                        <div class="">1 - Sim</div>
                                        <div class="">2 - Não</div>
                                    </div>
                                </div>
                                <!-- Agradecimento -->
                                <div class="mb-4">
                                    <div class="mb-2">
                                        @php
                                            $agradecimento = isset(
                                                $message->satisfaction_survey['agradecimento']['msg'],
                                            )
                                                ? $message->satisfaction_survey['agradecimento']['msg']
                                                : '';
                                        @endphp
                                        <label for="agradecimento" class="form-label">Agradecimento</label>
                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $agradecimento }}</pre>
                                        </div>
                                    </div>
                                </div>
                                <!-- pergunta4 -->
                                <div class="mb-4">
                                    <div class="mb-2">
                                        @php
                                            $pergunta4 = isset($message->satisfaction_survey['pergunta4']['pergunta'])
                                                ? $message->satisfaction_survey['pergunta4']['pergunta']
                                                : '';
                                        @endphp
                                        <label for="pergunta4" class="form-label">Pergunta #4</label>
                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $pergunta4 }}</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- caso resp. pergunta 4 -->
                                <div class="mb-4">
                                    <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                        <strong>CASO RESPOSTA DA PERGUNTA #4</strong>
                                    </div>

                                    <div class="mb-3">
                                        @php
                                            $casoResp4 = isset($message->satisfaction_survey['caso_resp_perg4']['msg'])
                                                ? $message->satisfaction_survey['caso_resp_perg4']['msg']
                                                : '';
                                        @endphp
                                        <label for="casoResp4" class="form-label visually-hidden">CASO RESPOSTA DA
                                            PERGUNTA
                                            #4</label>
                                        <div class="border bg-light py-2  px-2 rounded">
                                            <pre class="fs-4" style="white-space: pre-wrap; word-wrap: break-word;">{{ $casoResp4 }}</pre>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- =================== --}}
                            <!-- Opções -->
                            <div class="row mb-3 pb-3 pt-0 options-rem">
                                <div class="mb-3 col-12 col-lg-12">
                                    <!-- Tipo -->
                                    <div class="fs-5 fw-semibold">
                                        Opções de envio:
                                    </div>

                                </div>

                                <!-- Enviar mensagem sobre não receber mais notificações -->
                                <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                                    data-bs-content="Permite configurar uma mensagem para realizar pesquisa de satisfação correspondente ao pedido ou transação em que será enviada a mensagem de agradecimento.">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                <div class="col-12 col-lg-6 mb-2 d-none">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                    class="col-12 col-lg-6 mb-2 @if ($showMsgIntegrationThisUsed == false && $usedIntegrationInOthers) visually-hidden @endif @if ($message->type == 'PESQUISA SATISFAÇÃO') visually-hidden @endif ">
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
                                <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-4">
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
                                                    style="margin-bottom: -20px; margin-top: -1px">
                                                    É possível selecionar datas até 60 dias retroativos.
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                <!-- Todos os dias -->
                                <div class="d-none">
                                    <div class="col-12 col-lg-6 mb-2 " id="col-todo-dias">
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
                                <div class="col-12 col-lg-6 mb-2 d-none" id="col-dt-especifica">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-2">
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
                                    <div class="col-12 col-lg-6 mb-2" id="">
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
                            {{-- =================== --}}

                        @endif


                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 mt-3">

                            @if (session('url_prev_msg') && session('url_prev_msg') != url()->full())
                                <a href="{{ session('url_prev_msg') }}" class="btn btn-light  px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Voltar</div>
                                </a>
                            @else
                                <a href="{{ route('messages.crud.index') }}" class="btn btn-primary  px-5 fs-5">
                                    <div class="px-lg-5">Voltar</div>
                                </a>
                            @endif


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.options-rem input, .options-rem select').forEach(element => {
                element.disabled = true;
            });
        });
    </script>

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
    </script>
@endsection
