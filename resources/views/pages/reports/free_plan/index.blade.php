@extends('layouts.basic')
@section('title', 'Relatórios - Plano gratuito')
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
                    <h4 class="fw-semibold mb-8">Relatórios - Plano gratuito</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Relatórios</li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Plano gratuito</li>
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
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            {{-- @if ($freePlan->count() > 0 || request()->query()) --}}
                            <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                data-bs-target="#modal-filtro">
                                <div class="fs-4">Filtrar</div>
                            </button>
                            {{-- @endif --}}
                        </div>
                    </div>

                    <div class="">
                        @if ($freePlan->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existe assinatura com plano gratuito.
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
                                            {{-- <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Plano
                                                </div>
                                            </th> --}}
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Cadastro
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Upgrade
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Cancelado
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Expirar
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Msgs. Rest.
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 px-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Dias Rest.
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($freePlan as $item)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        {{ Str::limit($item->user->nome_usuario, 25) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                        {{ $item->plan->modulo->titulo }}
                                                    </div>
                                                </td>
                                                {{-- <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3  ">
                                                        {{ $item->plan->nome }}
                                                    </div>
                                                </td> --}}
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        {{ $item->created_at->format('d/m/Y') }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ is_null($item->data_upgrade) ? '-' : date('d/m/Y', strtotime($item->data_upgrade)) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ is_null($item->data_cancel) ? '-' : date('d/m/Y', strtotime($item->data_cancel)) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                        {{ date('d/m/Y', strtotime($item->expiration_date)) }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        <div class="" style="padding-right: 4px">
                                                            @if (isset($item->user->controlQuantMessage->mensagens_restantes))
                                                                {{ $item->user->controlQuantMessage->mensagens_restantes }}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2 pe-3 text-center">
                                                    <div
                                                        class=" fw-semibold px-1 pt-2 @if ($item->days_expire == 'Expirado') text-orange @endif ">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ $item->days_expire }}
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
                            {{ $freePlan->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.reports.free_plan._modal_filter')
@endsection
