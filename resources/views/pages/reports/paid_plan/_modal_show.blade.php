<style>
    /* #modal-show .modal-dialog {
        min-width: 95vw
    }

    @media (min-width: 1400px) {
        #modal-show .modal-dialog {
            min-width: 78vw
        }
    } */
</style>
<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-show" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Plano pago
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-2">


                <div class="row gy-2 gy-md-4 mt-0">
                    <!-- Cliente -->
                    <div class="mb-3 col-12 col-sm-6 col-md-5 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Cliente:</strong></div>
                            <div class="fs-5" id="data_cliente"></div>
                        </div>
                    </div>
                    <!-- Módulo -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Módulo:</strong></div>
                            <div class="fs-5" id="data_modulo"></div>
                        </div>
                    </div>
                    <!-- Plano -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Plano:</strong></div>
                            <div class="fs-5" id="data_plano"></div>
                        </div>
                    </div>
                    <!-- Valor Plano -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Valor Plano:</strong></div>
                            <div class="fs-5" id="data_valor_plano"></div>
                        </div>
                    </div>
                    <!-- Valor Pago -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Valor Pago:</strong></div>
                            <div class="fs-5" id="data_valor_pago"></div>
                        </div>
                    </div>
                    <!-- Cupom -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Cupom:</strong></div>
                            <div class="fs-5" id="data_cupom"></div>
                        </div>
                    </div>
                    <!-- Valor Cupom -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Valor Cupom:</strong></div>
                            <div class="fs-5" id="data_valor_cupom"></div>
                        </div>
                    </div>
                    <!-- Data Compra -->
                    <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Data Compra:</strong></div>
                            <div class="fs-5" id="data_data_compra"></div>
                        </div>
                    </div>
                    <!-- Data Troca Plano -->
                    <div class="mb-3 col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Data Troca Plano:</strong></div>
                            <div class="fs-5" id="data_data_troca_plano"></div>
                        </div>
                    </div>
                    <!-- Data Cancelamento -->
                    <div class="mb-3 col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="border-bottom pb-1">
                            <div class="fs-6"><strong>Data Cancelamento:</strong></div>
                            <div class="fs-5" id="data_data_cancelamento"></div>
                        </div>
                    </div>

                </div>


                {{-- <div class="table-responsive mt-4">
                    <table class="table table-hover table-striped table-hover  ">
                        <thead>
                            <tr class="border-0">
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
                                        Cupom
                                    </div>
                                </th>
                                <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                        Valor Cupom
                                    </div>
                                </th>
                                <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                        Data Compra
                                    </div>
                                </th>
                                <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                        Data Troca Plano
                                    </div>
                                </th>
                                <th scope="" class="py-0 border-0 pb-2 px-0 text-truncate">
                                    <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                        Data Cancelamento.
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            @foreach ($subscriptions as $item)
                                <tr class="align-items-center ">
                                    <td class="border-0 py-2 col-md-2 ">
                                        <div class=" fw-semibold px-1 pt-2  text-truncate">
                                            {{ Str::limit($item->user->nome_usuario, 30) }}
                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2  text-truncate">
                                            {{ $item->plan->modulo->titulo }}
                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2  ">
                                            {{ ucfirst($item->plan->nome) }}
                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            {{ number_format($item->plan->valor, 2, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            @if (!is_null($item->coupon))
                                                @php
                                                    // se desconto for em valor
                                                    $valorDescontoCupom = 0;
                                                    if (!is_null($item->coupon->value)):
                                                        $valorDescontoCupom = $item->coupon->value; // se deconto for em porcentagem
                                                    else:
                                                        $porcentagemCalculada =
                                                            ($item->coupon->percent / 100) * $item->plan->valor;
                                                        $valorDescontoCupom = $porcentagemCalculada;
                                                    endif;

                                                    if ($valorDescontoCupom < 0) {
                                                        $valorDescontoCupom = 0;
                                                    }

                                                    $valorTotal = $item->plan->valor - $valorDescontoCupom;
                                                @endphp

                                                {{ number_format($valorTotal, 2, ',', '.') }}
                                            @else
                                                {{ number_format($item->plan->valor, 2, ',', '.') }}
                                            @endif

                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            {{ is_null($item->coupon) ? '-' : $item->coupon->code }}
                                        </div>
                                    </td>
                                    <td class="border-0 py-2 ">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            @if (is_null($item->coupon))
                                                -
                                            @else
                                                @if (is_null($item->coupon->value))
                                                    {{ $item->coupon->percent }}%
                                                @else
                                                    {{ number_format($item->coupon->value, 2, ',', '.') }}
                                                @endif
                                            @endif
                                        </div>
                                    </td>

                                    <td class=" border-0 py-2">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            {{ $item->created_at->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class=" border-0 py-2">
                                        <div class=" fw-semibold px-1 pt-2 ">
                                            {{ is_null($item->data_upgrade) ? '-' : date('d/m/Y', $item->data_upgrade) }}
                                        </div>
                                    </td>
                                    <td class=" border-0 py-2">
                                        <div class=" fw-semibold px-1 pt-2  ">
                                            {{ is_null($item->cancel) ? '-' : date('d/m/Y', $item->cancel) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}

                <div class="mt-4">
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">
                        <button data-bs-dismiss="modal" aria-label="Close" type="button"
                            class="btn btn-light  px-4 fs-3 text-primary">
                            <div class="px-lg-4">Voltar</div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
