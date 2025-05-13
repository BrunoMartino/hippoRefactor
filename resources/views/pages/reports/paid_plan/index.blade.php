@extends('layouts.basic')
@section('title', 'Relatórios - Plano pago')
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
                    <h4 class="fw-semibold mb-8">Relatórios - Plano pago</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Relatórios</li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Plano pago</li>
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
                            @if ($subscriptions->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="">
                        @if ($subscriptions->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem usuário(s) cadastrado(s).
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
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Valor Plano
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Valor Pago
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Data Compra
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 px-0 text-truncate">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($subscriptions as $item)
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
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-center pe-3">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ ucfirst($item->plan->nome) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ number_format($item->plan->valor, 2, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        <div class="" style="padding-right: 4px">
                                                            @if (!is_null($item->coupon))
                                                                @php
                                                                    // se desconto for em valor
                                                                    $valorDescontoCupom = 0;
                                                                    if (!is_null($item->coupon->value)):
                                                                        $valorDescontoCupom = $item->coupon->value; // se deconto for em porcentagem
                                                                    else:
                                                                        $porcentagemCalculada =
                                                                            ($item->coupon->percent / 100) *
                                                                            $item->plan->valor;
                                                                        $valorDescontoCupom = $porcentagemCalculada;
                                                                    endif;

                                                                    if ($valorDescontoCupom < 0) {
                                                                        $valorDescontoCupom = 0;
                                                                    }

                                                                    $valorTotal =
                                                                        $item->plan->valor - $valorDescontoCupom;
                                                                @endphp

                                                                {{ number_format($valorTotal, 2, ',', '.') }}
                                                            @else
                                                                {{ number_format($item->plan->valor, 2, ',', '.') }}
                                                            @endif

                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        <div class="" style="padding-right: 4px">
                                                            {{ $item->created_at->format('d/m/Y') }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center  ">
                                                        <span>
                                                            <a href="{{ route('reports.show-paid.plan', $item->id) }}" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Visualizar"
                                                                class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </a>
                                                            {{-- <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Visualizar"
                                                                onclick="showDataPaid(`{{ route('reports.paid.plan.json', $item->id) }}`)"
                                                                class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </button> --}}
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $subscriptions->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.reports.paid_plan._modal_filter')
    @include('pages.reports.paid_plan._modal_show')
@endsection
@section('scripts')
    <!-- Axios CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
        integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const modalShow = new bootstrap.Modal(document.getElementById("modal-show"), );

        function showDataPaid(route) {
            document.getElementById('data_cliente').innerHTML = '-'
            document.getElementById('data_modulo').innerHTML = '-'
            document.getElementById('data_plano').innerHTML = '-'
            document.getElementById('data_valor_plano').innerHTML = '-'
            document.getElementById('data_valor_pago').innerHTML = '-'
            document.getElementById('data_cupom').innerHTML = '-'
            document.getElementById('data_valor_cupom').innerHTML = '-'
            document.getElementById('data_data_compra').innerHTML = '-'
            document.getElementById('data_data_troca_plano').innerHTML = '-'
            document.getElementById('data_data_cancelamento').innerHTML = '-'

            modalShow.show()
            axios.get(route)
                .then(res => {
                    let data = res.data;
                    document.getElementById('data_cliente').innerHTML = data.cliente
                    document.getElementById('data_modulo').innerHTML = data.modulo
                    document.getElementById('data_plano').innerHTML = data.plano
                    document.getElementById('data_valor_plano').innerHTML = data.valor_plano
                    document.getElementById('data_valor_pago').innerHTML = data.valor_pago
                    document.getElementById('data_cupom').innerHTML = data.cupom
                    document.getElementById('data_valor_cupom').innerHTML = data.valor_cupom
                    document.getElementById('data_data_compra').innerHTML = data.data_compra
                    document.getElementById('data_data_troca_plano').innerHTML = data.data_troca_plano
                    document.getElementById('data_data_cancelamento').innerHTML = data.data_cancelamento
                })
                .catch(err => {
                    console.log(err);
                })
        }
    </script>
@endsection
