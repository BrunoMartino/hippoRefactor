@extends('layouts.basic')
@section('title', 'Financeiro')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Conta usuário</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('config.user-account.current-plan') }}">Conta usuário</a>
                            </li>
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
                    <!--  -->
                    <div class="">
                        <!--  -->
                        <div class="">
                            <div class="">
                                <h2 class="fw-semibold mb-3 pb-2 fs-7">Relatório de pagamento</h2>
                                @if ($faturas->total() == 0)
                                    <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                        Sem registros.
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-hover  ">
                                            <thead>
                                                <tr class="border-0 text-center">
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
                                                            Valor
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                            Data emissão
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                            Data pagamento
                                                        </div>
                                                    </th>
                                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                        <div
                                                            class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                            Status
                                                        </div>
                                                    </th>
                                                    <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                        <div
                                                            class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                            Ação
                                                        </div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="">
                                                @foreach ($faturas as $key => $fatura)
                                                    <tr class="align-items-center ">
                                                        <td class="border-0 py-2 col-md-2 ">
                                                            <div
                                                                class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                                {{ $fatura->plan->modulo->titulo }}
                                                            </div>
                                                        </td>
                                                        <td class=" border-0 py-2">
                                                            <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                                {{ ucfirst($fatura->plan->nome) }}
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                                <div class="" style="padding-right: 4px">
                                                                    {{ convertStringNumber($fatura->total_value) }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                                <div class="" style="padding-right: 4px">
                                                                    {{ convertStringDate($fatura->created_at) }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 ">
                                                            <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                                <div class="" style="padding-right: 4px">
                                                                    {{ $fatura->date_payment == '' ? '-' : convertStringDate($fatura->date_payment) }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-2 px-3 pt-2 pe-3 text-center">
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
                                                        <td class="border-0 py-2 px-3 pt-2 ">
                                                            <div class="d-flex justify-content-center gap-2">
                                                                <a href="{{ route('config.user-account.financial.show', $fatura->invoice_id) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Visualizar"
                                                                    class="btn fs-7 text-secondary p-0">
                                                                    <i class="ti ti-eye fs-7"></i>
                                                                </a>
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
