@extends('layouts.basic')
@section('title', 'Descontos mensais')
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
                    <h4 class="fw-semibold mb-8">Descontos mensais</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Descontos mensais</li>
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
                    <x-alerts.delete title="Deletar Desconto"
                        desc="Você tem certeza de que deseja deletar este registro?" />

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($discounts->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange  w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-desc-mensais')
                            <div class="">
                                <a href="{{ route('descontos-mensais.create') }}" class="btn btn-primary  px-4"
                                    data-bs-toggle="tooltip" data-bs-placement="top" onclick="showFinancialModal()">
                                    <div class="px-lg-4 fs-4">
                                        Novo desconto
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="">
                        @if ($discounts->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem registros de descontos.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Cliente
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Módulo
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center ">
                                                    Plano
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Tipo
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Valor
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Ínicio
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Término
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($discounts as $discount)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        {{ Str::limit($discount->user->nome_usuario, 30) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                        {{ $discount->modulo->titulo }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-2 pe-3 text-center ">
                                                        {{ ucfirst($discount->plano->nome) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-2 text-center pe-3 ">
                                                        @if (is_null($discount->valor))
                                                            Percentual
                                                        @else
                                                            Valor
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 j">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        @if (is_null($discount->valor))
                                                            {{ $discount->porcentagem }}%
                                                        @else
                                                            {{ number_format($discount->valor, 2, ',', '.') }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        {{ date('m/Y', strtotime($discount->dt_inicio)) }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        {{ date('m/Y', strtotime($discount->dt_termino)) }}
                                                    </div>
                                                </td>

                                                <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        @can('ver-desc-mensais')
                                                            <a href="{{ route('descontos-mensais.show', $discount->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </a>
                                                        @endcan

                                                        @can('edit-desc-mensais')
                                                            <a href="{{ route('descontos-mensais.edit', $discount->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"
                                                                class="btn fs-7 text-primary p-0">
                                                                <i class="ti ti-edit fs-7"></i>
                                                            </a>
                                                        @endcan
                                                        @can('deletar-desc-mensais')
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Deletar"
                                                                class="btn fs-7 text-orange p-0"
                                                                onclick="serUrlDelete(`{{ route('descontos-mensais.destroy', $discount->id) }}`)">
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
                            {{ $discounts->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal deletar cupom -->
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
                            <h4 class="mt-2">Deletar Cupom</h4>
                            <p class="mt-3">
                                Você tem certeza de que deseja deletar este registro?
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
    <form action="" method="post" id="form-situacao">
        @method('PUT')
        @csrf
    </form>
    <!-- modal filtro -->
    @include('pages.monthly_discounts._modal_filter')
@endsection
@section('scripts')
    <script>
        function showAlertDelete(url) {
            Swal.fire({
                title: "Deletar Desconto",
                text: "Você tem certeza de que deseja deletar este registro? ",
                icon: "warning",
                showDenyButton: true,
                showCancelButton: true,
                showConfirmButton: false,
                denyButtonText: `Deletar`,
                cancelButtonText: `Cancelar`,
                focusConfirm: false,
                preDeny: () => {
                    document.getElementById('modal-deletar').action = url
                    document.getElementById('modal-deletar').submit()
                }
            });
        }
    </script>
@endsection
