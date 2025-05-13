@extends('layouts.basic')
@section('title', 'Relatórios - Financeiro')
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
                    <h4 class="fw-semibold mb-8">Relatórios - Financeiro</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Relatórios</li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Financeiro</li>
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
                            @if ($faturas->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange  w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-cupons')
                            {{-- <div class="">
                                <a href="#" class="btn btn-primary  px-4 w-100" data-bs-toggle="tooltip"
                                    data-bs-placement="top" onclick="showFinancialModal()">
                                    Detalhes do financeiro
                                </a>
                            </div> --}}
                        @endcan
                    </div>
                    <div class="">

                        @if ($faturas->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem registros financeiro.
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
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Valor
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Compra
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Pagamento
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Status
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($faturas as $fatura)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                        {{ Str::limit($fatura->user->nome_usuario, 20) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                        {{ $fatura->plan->modulo->titulo }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center  ">
                                                        {{ ucfirst($fatura->plan->nome) }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 text-truncate ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        {{ convertStringNumber($fatura->total_value) }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3  ">
                                                        {{ convertStringDate($fatura->created_at) }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                        @if (is_null($fatura->date_payment))
                                                            -
                                                        @else
                                                            {{ convertStringDate($fatura->date_payment) }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div
                                                        class=" fw-semibold px-1 py-2  d-flex gap-2 justify-content-center">
                                                        @if ($fatura->status == 'waitingPayment')
                                                            <span class="bg-primary badge rounded-pill px-2 text-center"
                                                                style="width: 100px"
                                                                style="padding-top: 6px; padding-bottom: 6px">
                                                                Gerado
                                                            </span>
                                                        @endif
                                                        @if ($fatura->status == 'overdue')
                                                            <span
                                                                class="bg-orange-default badge rounded-pill px-2 text-center"
                                                                style="width: 100px"
                                                                style="padding-top: 6px; padding-bottom: 6px">
                                                                Aberto
                                                            </span>
                                                        @endif
                                                        @if ($fatura->status == 'canceled')
                                                            <span
                                                                class=" badge rounded-pill px-2 text-center"
                                                                style="width: 100px; background: #e52d49"
                                                                style="padding-top: 6px; padding-bottom: 6px; ">
                                                                Cancelado
                                                            </span>
                                                        @endif
                                                        @if ($fatura->status == 'paid')
                                                            <span class="bg-primary badge rounded-pill px-2 text-center "
                                                                style="width: 100px"
                                                                style="padding-top: 6px; padding-bottom: 6px">
                                                                Pago
                                                            </span>
                                                        @endif
                                                        @if ($fatura->status == 'processing')
                                                            <span
                                                                class="bg-warning badge rounded-pill px-2 text-bolder text-center"
                                                                style="width: 100px"
                                                                style="padding-top: 6px; padding-bottom: 6px">
                                                                Processando
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $faturas->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vertically centered modal -->
    <div class="modal fade" id="al-details-financial" tabindex="-1" aria-labelledby="vertical-center-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-primary">
                <div class="modal-body p-4">
                    <div class="text-center text-primary">
                        <form id="modal-financial">
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total planos vendidos</h5>
                                <input class="form-control" type="text" value="1000" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total planos pagos</h5>
                                <input class="form-control" type="text" value="800" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <h5 class="mt-2">Total planos em aberto</h5>
                                <input class="form-control" type="text" value="200" disabled>
                            </div>
                            <button type="button" class="btn btn-primary my-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                Fechar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    @include('pages.reports.financial._modal_filter')
@endsection
@section('scripts')
    <script>
        function showFinancialModal() {
            let modal = new bootstrap.Modal(
                document.getElementById("al-details-financial")
            );
            modal.show()
        }
    </script>
@endsection
