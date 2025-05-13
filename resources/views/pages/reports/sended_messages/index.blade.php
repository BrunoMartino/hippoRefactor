@extends('layouts.basic')
@section('title', 'Relatórios - Mensagens enviadas')
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
            <div class="d-flex gap-2 align-items-center">
                <div class="">
                    <h4 class="fw-semibold mb-8">Relatórios - Mensagens enviadas</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Relatórios</li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Mensagens enviadas</li>
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
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="mb-4">
                        @if ($usersReport->count() > 0 || request()->query())
                            <button type="button" class="btn btn-orange  px-5" data-bs-toggle="modal"
                                data-bs-target="#modal-filtro">
                                <div class="">Filtrar</div>
                            </button>
                        @endif
                    </div>
                    <div class="">
                        @if ($usersReport->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não há registros de envio.
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
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Módulo
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Plano
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Data cadastro
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Msgs enviadas
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Msgs restantes
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Msgs visualizadas
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($usersReport as $item)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate pe-3">
                                                        {{ Str::limit($item->nome_usuario, 20) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                        @if ($item->subscription())
                                                            {{ $item->subscription()->plan->modulo->titulo }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                        @if ($item->subscription())
                                                            {{ ucfirst($item->subscription()->plan->nome) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                        {{ $item->created_at->format('d/m/Y') }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2  pe-3 text-center">
                                                        {{ number_format($item->controlQuantMessage->mensagens_enviadas, 0, ',', '.') }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2  pe-3 text-center">
                                                        <div class="" style="padding-right: 3px">
                                                            {{ number_format($item->controlQuantMessage->mensagens_restantes, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2  pe-3 text-center">
                                                        {{ number_format($item->messageReports->where('situacao', 'visualizado')->count(), 0, ',', '.') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $usersReport->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.reports.sended_messages._modal_filter')
@endsection
@section('scripts')
@endsection
