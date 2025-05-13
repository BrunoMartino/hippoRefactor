@extends('layouts.basic')
@section('title', 'Mensagens')
@section('style')
@endsection
@section('head')
    <!-- scripts necessários para a lib select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>
    <!-- / scripts necessários para a lib select2 -->
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2" id="msgs">
        <div class="card-body px-4 py-3">
            <div class="d-flex flex-column  flex-lg-row gap-2 align-items-lg-center">
                <div class=" ">
                    <h4 class="fw-semibold mb-8">Mensagens</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Mensagens</li>
                        </ol>
                    </nav>
                </div>

                {{-- <div class="w-100">
                    <div class="d-flex gap-3 flex-column flex-lg-row flex-wrap justify-content-center">
                        <div class="" style="margin-bottom: -25px">
                            <x-user-main.messages.messages-sent />
                        </div>
                        <x-user-main.messages.messages-remaining />

                    </div>
                </div> --}}
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
                    <x-alerts.delete title="Deletar Mensagem"
                        desc="Você tem certeza de que deseja deletar esta mensagem?" />

                    @if ($showNotConfigSend)
                        <!-- sem config envio -->
                        <div class="alert alert-warning alert-dismissible fade show text-center px-3 " role="alert"
                            id="alert-sem-config-envio">
                            <strong class="fs-5">
                                Configurar Envio
                            </strong>
                            <div class="fs-4">
                                Existe(m) mensagem(ns) sem configurações de envio, as mesmas estão destacadas de vermelho no
                                relatório. 
                                <div class="">
                                    Para configurar, clique no ícone de engrenagem da mensagem correspondente.
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="document.getElementById('alert-sem-config-envio').style.display='none';"
                                    aria-label="Close">
                                    OK
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- cobrança -->
                    <div class="alert alert-warning alert-dismissible fade show text-center px-3 " role="alert"
                        id="alert-config-cobranca" style="display: none">
                        <strong class="fs-5">Configurar Envio</strong>
                        <div class="fs-4">
                            As configurações de mensagens de cobrança são feitas em <span class="fw-semibold">Sistema > <a href="{{ route('config.sistema.charges.index') }}"
                                    class="text-decoration-underline text-dark fw-semibold">Cobranças</a></span>.
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary btn-sm"
                                onclick="document.getElementById('alert-config-cobranca').style.display='none';"
                                aria-label="Close">
                                OK
                            </button>
                        </div>
                    </div>
                    <!-- faturamento -->
                    <div class="alert alert-warning alert-dismissible fade show text-center px-3 " role="alert"
                        id="alert-config-ft" style="display: none">
                        <strong class="fs-5">Configurar Envio</strong>
                        <div class="fs-4">
                            As configurações de mensagens de faturamento são feitas em <span
                                class="fw-semibold">Configurações
                                > Sistema > <a href="{{ route('config.sistema.faturamento.index') }}"
                                    class="text-decoration-underline text-dark fw-semibold">Faturamento</a></span>.
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary btn-sm"
                                onclick="document.getElementById('alert-config-ft').style.display='none';"
                                aria-label="Close">
                                OK
                            </button>
                        </div>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($messages->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-mensagens')
                            <div class="">

                                @if (userHasModule(3) || userHasModule(1) || userHasModule(2) || userHasModule(4))
                                    <a href="{{ route('messages.crud.new') }}" class="btn btn-primary btn-lg px-4">
                                        Nova mensagem
                                    </a>
                                @endif


                                {{-- @if (userHasModule(3))
                                    <!-- Remarketing -->
                                    <a href="{{ route('messages.crud.create') }}" class="btn btn-primary btn-lg px-4">
                                        Nova mensagem
                                    </a>
                                @elseif (userHasModule(1))
                                    <!-- Cobranças -->
                                    <a href="{{ route('messages.charges.create-generated') }}"
                                        class="btn btn-primary btn-lg px-4">
                                        Nova mensagem
                                    </a>
                                @elseif (userHasModule(2))
                                    <!-- Faturamento -->
                                    <a href="{{ route('messages.faturamento.recebido') }}" class="btn btn-primary btn-lg px-4">
                                        Nova mensagem
                                    </a>
                                @endif --}}

                            </div>
                        @endcan

                    </div>


                    <div class="">
                        @if ($messages->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem registros de mensagens.
                            </div>
                        @else
                            <div class="table-responsive mt-4 ">
                                <table class="table table-hover table-striped ">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th scope="col" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary ">
                                                    Nome
                                                </div>
                                            </th>
                                            <th scope="col" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary ">
                                                    Tipo
                                                </div>
                                            </th>
                                            <th scope="col" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary ">
                                                    Descrição
                                                </div>
                                            </th>
                                            <th scope="col" class="p-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border text-center rounded-2 fw-semibold fs-4 text-primary ">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($messages as $message)
                                            @php
                                                $semConfigEnvio = false;
                                                if (
                                                    $message->type == 'PESQUISA SATISFAÇÃO' ||
                                                    $message->type == 'ANIVERSÁRIO' ||
                                                    $message->type == 'AGRADECIMENTO'
                                                ) {
                                                    if (is_null($message->sending_setting)) {
                                                        $semConfigEnvio = true;
                                                    }
                                                }
                                            @endphp
                                            <tr class="{{ $semConfigEnvio ? 'tr-sem-config' : '' }}">
                                                <td class="border-0 py-2 align-middle text-truncate pe-3">
                                                    <div class="ps-1">{{ $message->name }}</div>
                                                </td>
                                                <td class="border-0 px-4 py-2 align-middle ps-3 text-center">
                                                    <div class="ps-1">{{ $message->type }}</div>
                                                </td>
                                                <td class="border-0 px-4 py-2 align-middle ps-3 text-center">
                                                    <div class="ps-1">
                                                        @if ($message->type == 'PESQUISA SATISFAÇÃO')
                                                            {{ isset($message->satisfaction_survey['pergunta_inicial']['pergunta']) ? Str::limit($message->satisfaction_survey['pergunta_inicial']['pergunta'], 60) : '' }}
                                                        @else
                                                            {{ Str::limit($message->description, 60) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 p-0 py-2">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        @can('ver-mensagens')
                                                            <a href="{{ route('messages.crud.show', $message->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </a>
                                                        @endcan
                                                        @if (userHasModule($message->module_id))
                                                            @if (
                                                                $message->type == 'FATURAMENTO - PEDIDO RECEBIDO' ||
                                                                    $message->type == 'FATURAMENTO - PEDIDO EM ANDAMENTO' ||
                                                                    $message->type == 'FATURAMENTO - PEDIDO ATENDIDO' ||
                                                                    $message->type == 'FATURAMENTO - PEDIDO VERIFICADO' ||
                                                                    $message->type == 'FATURAMENTO - PEDIDO EM SEPARAÇÃO')
                                                                <a href="#msgs" data-bs-toggle="tooltip"
                                                                    onclick="document.getElementById('alert-config-ft').style.display='block';"
                                                                    title="Configurar envio" class="btn fs-7 p-0">
                                                                    <i class="ti ti-settings fs-7"></i>
                                                                </a>
                                                            @else
                                                                @if ($message->module_id == 1)
                                                                    <a href="#msgs" data-bs-toggle="tooltip"
                                                                        data-bs-placement="top"
                                                                        onclick="document.getElementById('alert-config-cobranca').style.display='block';"
                                                                        title="Configurar envio" class="btn fs-7 p-0">
                                                                        <i class="ti ti-settings fs-7"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('messages.sending-settings.config', $message->id) }}"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        title="Configurar envio" class="btn fs-7 p-0">
                                                                        <i class="ti ti-settings fs-7"></i>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        @endif
                                                        {{-- <a type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Enviar" class="btn fs-7 text-success p-0">
                                                        <i class="ti ti-send fs-7"></i>
                                                    </a> --}}
                                                        @can('edit-mensagens')
                                                            @if (userHasModule($message->module_id))
                                                                @switch($message->type)
                                                                    @case('PESQUISA SATISFAÇÃO')
                                                                        <a href="{{ route('messages.crud.edit-satisfaction', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @case('COBRANÇA GERADA')
                                                                        <a href="{{ route('messages.charges.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @case('COBRANÇA VENCENDO')
                                                                        <a href="{{ route('messages.charges.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @case('COBRANÇA VENCIMENTO')
                                                                        <a href="{{ route('messages.charges.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @case('COBRANÇA VENCIDA')
                                                                        <a href="{{ route('messages.charges.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @case('FATURAMENTO - PEDIDO RECEBIDO')
                                                                    @case('FATURAMENTO - PEDIDO EM ANDAMENTO')

                                                                    @case('FATURAMENTO - PEDIDO ATENDIDO')
                                                                    @case('FATURAMENTO - PEDIDO VERIFICADO')

                                                                    @case('FATURAMENTO - PEDIDO EM SEPARAÇÃO')
                                                                        <a href="{{ route('messages.faturamento.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                    @break

                                                                    @default
                                                                        <a href="{{ route('messages.crud.edit', $message->id) }}"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="Editar" class="btn fs-7 text-primary p-0">
                                                                            <i class="ti ti-edit fs-7"></i>
                                                                        </a>
                                                                @endswitch
                                                            @endif
                                                        @endcan
                                                        @can('deletar-mensagens')
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Deletar"
                                                                class="btn fs-7 text-danger p-0"
                                                                onclick="serUrlDelete(`{{ route('messages.crud.destroy', $message->id) }}`)">
                                                                <i class="ti ti-trash fs-7"></i>
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $messages->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="al-deletar-alert" tabindex="-1" aria-labelledby="vertical-center-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <div class="text-center text-danger">
                        <i class="ti ti-alert-octagon fs-7"></i>
                        <form action="#" method="post" id="modal-deletar">
                            @csrf
                            @method('DELETE')
                            <h4 class="mt-2">Deletar Mensagem</h4>
                            <p class="mt-3">
                                Você tem certeza de que deseja deletar esta mensagem?
                            </p>
                            <button type="submit" class="btn btn-danger my-2">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    {{-- Modal filtro --}}
    @include('pages.messages.messages._modal_filter')

@endsection
@section('scripts')
@endsection
