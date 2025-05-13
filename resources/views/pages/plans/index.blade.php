@extends('layouts.basic')
@section('title', 'Planos')
@section('head')
    <!-- scripts necessários para a lib select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>
    <!-- / scripts necessários para a lib select2 -->
    <style>
        .select2-dropdown select2-dropdown--below+div {
            height: 400px;
        }
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Planos</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Planos</li>
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
                            @if ($planos->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                    </div>
                    @if ($planos->count() == 0)
                        <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                            Não existem planos cadastrados.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-hover  ">
                                <thead>
                                    <tr class="border-0 text-center">
                                        <th scope="" class="p-0 border-0 pb-2 pe-3">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Modulo
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Nome
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Limite Msgs.
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Valor
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Usuários
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Instâncias
                                            </div>
                                        </th>

                                        <th scope="" class=" py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Custo Excedente
                                            </div>
                                        </th>
                                        @can('edit-planos')
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Ação
                                                </div>
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($planos as $key => $plano)
                                        <tr class="align-items-center ">
                                            <td class="border-0 py-2 col-md-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                    {{ $plano->modulo->titulo }}
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ ucfirst($plano->nome) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3  ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ number_format($plano->limite_mensagens, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ number_format($plano->valor, 2, ',', '.') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $plano->qtd_usuarios }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $plano->qtd_instancias }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ number_format($plano->custo_excedente, 3, ',', '.') }}
                                                    </div>
                                                </div>
                                            </td>
                                            @can('edit-planos')
                                                <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('plans.edit', $plano->id) }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Editar"
                                                            class="btn fs-7 text-secondary p-0">
                                                            <i class="ti ti-edit fs-7"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="mt-4">
                        {{ $planos->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.plans._modal_filter')
@endsection
@section('scripts')
@endsection
