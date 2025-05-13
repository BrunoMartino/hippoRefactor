@extends('layouts.basic')
@section('title', 'Dados Importados')
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
                    <h4 class="fw-semibold mb-8">Dados Importados - Cobranças</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Configurações</li>
                            <li class="breadcrumb-item" aria-current="page">Dados Importados - Cobranças</li>
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
                    <x-alerts.delete title="Deletar Dados" desc="Você tem certeza de que deseja deletar este registro?" />

                    <div class="">
                        <form action="#" method="post" class="" id="form-deletar2" style="display: none">
                            @csrf
                            @method('DELETE')

                            <div class="alert alert-warning text-center" role="alert">
                                <strong class="fs-5">Deletar Dados</strong>
                                <div class="fs-4">
                                    Você tem certeza de que deseja deletar este registro?
                                </div>
                                <div class="mt-2 d-flex gap-2 justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-deletar-regitro2">
                                        Ok
                                    </button>
                                    <button type="button" class="btn btn-light text-orange btn-sm px-3 "
                                        onclick="closeAlertDelete2()">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">

                        <div class="">
                            @if ($data->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-import-cobrancas')
                            <div class="">
                                <a href="{{ route('config.import.cb.index') }}" class="btn btn-primary  px-4">
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
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-start ">
                                                Nome
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                Tipo Cliente
                                            </div>
                                        </th>

                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                WhatsApp
                                            </div>
                                        </th>

                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                                Data de nascimento
                                            </div>
                                        </th>

                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                                Gênero
                                            </div>
                                        </th>
                                        @can('deletar-import-cobrancas')
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                                    UF
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Ação
                                                </div>
                                            </th>
                                        @else
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    UF
                                                </div>
                                            </th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($data as $item)
                                        <tr class="">
                                            <td class="border-0 py-2 col-md-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                    {{ $item->name }}
                                                </div>
                                            </td>
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                    <div class="" style="padding-right: 3px">
                                                        {{ $item->type }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                    <div class="" style="padding-right: 3px">
                                                        {{ fmtNumCelular($item->whatsapp) }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 3px">
                                                        @if ($item->birth_date)
                                                            {{ date('d/m/Y', strtotime($item->birth_date)) }}
                                                        @else
                                                            --
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 3px">
                                                        {{ $item->gender }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 3px">
                                                        {{ $item->uf }}
                                                    </div>
                                                </div>
                                            </td>
                                            @can('deletar-import-cobrancas')
                                                <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <button type="button" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Deletar"
                                                            class="btn fs-7 text-danger p-0"
                                                            onclick="serUrlDelete2('{{ route('config.import.cb.destroy-item') }}?id={{ $item->id }}')">
                                                            <i class="ti ti-trash fs-7"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="mt-2">
                            {{ $data->withQueryString()->links() }}
                        </div>
                    @endif

                    <div class="d-flex flex-column justify-content-start mb-4 flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('config.import.cb.imported-data') }}" class="btn btn-primary  px-5 fs-5">
                            <div class="px-lg-5">Voltar</div>
                        </a>
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

    {{-- Modal filtro --}}
    @include('pages.config.import.cobrancas.imported_data._modal_filter')

@endsection
@section('scripts')
@endsection
