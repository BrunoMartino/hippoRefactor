@extends('layouts.basic')
@section('title', 'Grupo de Dados Importados')
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
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Dados Importados - Faturamento</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Configurações</li>
                            <li class="breadcrumb-item" aria-current="page">Grupo de Dados Importados</li>
                            <li class="breadcrumb-item" aria-current="page">Faturamento</li>
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
                    <x-alerts.delete title="Deletar Grupo" desc="Você tem certeza de que deseja deletar este grupo?" />

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">

                        <div class="">
                            @if (session('edit_sending_message_id'))
                                <a href="{{ route('config.import.ft.imported-data.back-edit-config-msg') }}"
                                    class="btn btn-orange  w-100  px-3 fs-4">
                                    <div class="">Retornar para configuração de envio</div>
                                </a>
                            @else
                                @if ($data->count() > 0 || request()->query())
                                    <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                        data-bs-target="#modal-filtro">
                                        <div class="fs-4">Filtrar</div>
                                    </button>
                                @endif
                            @endif
                        </div>
                        @can('criar-import-faturamento')
                            <div class="">
                                <a href="{{ route('config.import.ft.index') }}" class="btn btn-primary  px-4">
                                    <div class="px-lg-4 fs-4">
                                        Importar Dados
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>

                    @if ($data->total() == 0)
                        <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                            Não existem registros de dados importados.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-hover  ">
                                <thead>
                                    <tr class="border-0 text-center">
                                        <th scope="" class="p-0 border-0 pb-2 pe-3">
                                            <div class="p-3 border rounded-2 fw-semibold text-truncate fs-4 text-primary  ">
                                                Descrição (nome do grupo)
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Data Importação
                                            </div>
                                        </th>
                                        <th scope="col " class="py-0 border-0 pb-2 px-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                Ações
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($data as $item)
                                        <tr class="align-items-center ">
                                            <td class="border-0 py-2 col-md-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                    <div class="" style="padding-right: 3px">
                                                        {{ $item->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $item->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 px-3 pt-2 ">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('config.import.ft.imported-data.show', $item->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar"
                                                        class="btn fs-7 text-secondary p-0">
                                                        <i class="ti ti-eye fs-7"></i>
                                                    </a>
                                                    @can('deletar-import-faturamento')
                                                        <button type="button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Deletar" class="btn fs-7 text-danger p-0"
                                                            onclick="serUrlDelete(`{{ route('config.import.ft.destroy', $item->id) }}`)">
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
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <form action="#" method="post" id="form-deletar">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger my-2">
                Deletar
            </button>
        </form>
    </div>

    @include('pages.config.import.faturamento._modal_filter')

@endsection
@section('scripts')
@endsection
