@extends('layouts.basic')
@section('title', 'Faturas em Processamento')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">
                        @if ($faturas->total() > 1)
                            Faturas em processamento
                        @else
                            Fatura em processamento
                        @endif
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Financeiro</li>
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
                    <div class="">
                        <!--  -->
                        <div class="">
                            <div class="pt-4 mt-2">
                                <div class="mb-2 text-end mt-2">
                                    <div class="alert alert-warning mt-2 text-center " role="alert">
                                        <div class="fs-4">
                                            @if ($faturas->total() > 1)
                                                Existem faturas em que seus pagamentos ainda não foram compensados, após a
                                                aprovação do pagamento você poderá solicitar um novo plano.
                                            @else
                                                Existe fatura em que seu pagamento ainda não foi compensado, após a
                                                aprovação do pagamento você poderá solicitar um novo plano.
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if ($faturas->total() == 0)
                                    <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                        Sem registros.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-hover  ">
                                            <thead>
                                                <tr class="border-0">
                                                    <th scope="" class="p-0 border-0 pb-2 pe-3">
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
                                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                            Tipo
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                            Valor
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                            Data emissão
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div
                                                            class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                            Status
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                @foreach ($faturas as $key => $fatura)
                                                    <tr class="align-items-center ">
                                                        <td class="border-0 py-2 col-md-2 ">
                                                            <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                                {{ $fatura->plan->modulo->titulo }}
                                                            </div>
                                                        </td>
                                                        <td class=" border-0 py-2">
                                                            <div class=" fw-semibold px-1 pt-2 ">
                                                                {{ ucfirst($fatura->plan->nome) }}
                                                            </div>
                                                        </td>

                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 ">
                                                                {{ typeInvoice($fatura->type) }}
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 ">
                                                                {{ convertStringNumber($fatura->total_value) }}
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 ">
                                                                {{ convertStringDate($fatura->created_at) }}
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 px-3 pt-2">
                                                            <div class="text-center">
                                                                <div class=" fw-semibold px-1 py-1 pe-3">
                                                                    @if ($fatura->status == 'waitingPayment')
                                                                        <span
                                                                            class="bg-primary badge rounded-pill px-2 text-center"
                                                                            style="width: 90px"
                                                                            style="padding-top: 6px; padding-bottom: 6px">
                                                                            Gerado
                                                                        </span>
                                                                    @endif
                                                                    @if ($fatura->status == 'overdue')
                                                                        <span
                                                                            class="bg-orange-default badge rounded-pill px-2 text-center"
                                                                            style="width: 90px"
                                                                            style="padding-top: 6px; padding-bottom: 6px">
                                                                            Aberto
                                                                        </span>
                                                                    @endif
                                                                    @if ($fatura->status == 'paid')
                                                                        <span
                                                                            class="bg-success badge rounded-pill px-2 text-center"
                                                                            style="width: 90px"
                                                                            style="padding-top: 6px; padding-bottom: 6px">
                                                                            Pago
                                                                        </span>
                                                                    @endif
                                                                    @if ($fatura->status == 'processing')
                                                                        <span
                                                                            class="bg-warning badge rounded-pill px-2 text-bolder text-center"
                                                                            style="width: 90px"
                                                                            style="padding-top: 6px; padding-bottom: 6px">
                                                                            Processando
                                                                        </span>
                                                                    @endif
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
                                    {{ $faturas->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
