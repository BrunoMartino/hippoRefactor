@extends('layouts.basic')
@section('title', 'Relatório Remarketing')
@section('style')
    <style>
        @media (min-width: 992px) {
            .col-relat {
                min-width: 310px;
            }
        }
    </style>
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
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="d-flex flex-column  flex-lg-row gap-2 align-items-lg-center">
                <div class="col-lg-4 ">
                    <h4 class="fw-semibold mb-8">Relatório Remarketing</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.crud.index') }}">Mensagens</a>
                            </li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Relatório Remarketing</li>
                        </ol>
                    </nav>
                </div>

                <div class="w-100 ">
                    <div class="d-flex gap-3 flex-column flex-lg-row flex-wrap flex-lg-nowrap justify-content-center">
                        <div class="" style="margin-bottom: -25px">
                            <x-user-main.reports.messages-sent :total="$totalMessagesSent"/>
                        </div>
                        <div class="" style="margin-bottom: -25px">
                            <x-user-main.reports.messages-remaining :total="$totalMessagesRemaining"/>
                        </div>

                    </div>
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
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($reports->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        <div class="">
                            <div class="dropdown">
                                <a href="{{ route('messages.rm-report.export-excel') }}?{{ request()->getQueryString() }}"
                                    class="btn btn-primary px-3 fs-4">
                                    <i class="ti ti-download fs-4 me-1"></i>
                                    Exportar para Excel
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="">
                        @if ($reports->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem registros de envio.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Cliente
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Tipo Mensagem
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Envio
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Situação
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Visualizado
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 px-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($reports as $report)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        @if ($report->nome_cliente)
                                                            {{ $report->nome_cliente }}
                                                        @else
                                                            <span class="text-danger">Deletada</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                        <div class="pe-1">
                                                            {{ $report->message->type }}
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center text-truncate pe-3">
                                                        <div class="pe-1">
                                                            {{ date('d/m/Y H:i', strtotime($report->data_envio)) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        <div class="pe-1">
                                                            @switch($report->situacao)
                                                                @case('entregue')
                                                                    <span class="bg-primary badge w-100 rounded-pill"
                                                                        style="max-width: 120px; background: #0853FC !important; border-color: #0853FC !important">
                                                                        Entregue
                                                                    </span>
                                                                @break

                                                                @case('nao_entregue')
                                                                    <span class="bg-orange badge w-100 rounded-pill"
                                                                        style="max-width: 120px; background: var(--bs-orange) !important; border-color: var(--bs-orange) !important">
                                                                        Não entregue
                                                                    </span>
                                                                @break

                                                                @case('visualizado')
                                                                    <span ty class="bg-success badge w-100 rounded-pill"
                                                                        style="max-width: 120px;background: #37bb37; border-color: #37bb37">
                                                                        Visualizado
                                                                    </span>
                                                                @break
                                                            @endswitch
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                        @if (is_null($report->data_visualizado))
                                                            -
                                                        @else
                                                            {{ date('d/m/Y H:i', strtotime($report->data_visualizado)) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-1 pb-1  ">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{ route('messages.rm-report.show', $report->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $reports->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal filtro --}}
    @include('pages.messages.reports.remarketing._modal_filter')
@endsection
