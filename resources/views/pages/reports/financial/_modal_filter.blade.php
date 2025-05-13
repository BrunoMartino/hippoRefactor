<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Financeiro
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-2">
                <!-- Filtros -->
                <form action="{{ route('reports.financial') }}" method="get" id="form-filtro">
                    <ul class="mx-3 pt-3" style="list-style:circle ">
                        <!-- Cliente -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Cliente:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="cliente" class=" select-cliente  form-control custom-select2"
                                        name="cliente" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\Invoice::get()->groupBy('user_id') as $item)
                                            <option value="{{ $item[0]->user->id }}"
                                                @if (request()->get('cliente') == $item[0]->user->id) selected @endif>
                                                {{ $item[0]->user->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Módulo -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Módulo:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="modulo" class=" select-modulo  form-control custom-select2"
                                        name="modulo" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\Modulo::all() as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('modulo') == $item->id) selected @endif>{{ $item->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Plano -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Plano:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="plano" class=" select-plano   form-control custom-select2"
                                        name="plano" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\Plano::all() as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('plano') == $item->id) selected @endif>
                                                {{ ucfirst($item->nome) }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Valor -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Valor:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3 ">
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="valor_min" id="valor_min"
                                            value="{{ request()->get('valor_min') }}" placeholder="Mín" />
                                    </div>
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="valor_max" id="valor_max"
                                            value="{{ request()->get('valor_max') }}" placeholder="Máx" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data compra -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data compra:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_compra_min" id=""
                                            value="{{ request()->get('dt_compra_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_compra_max" id=""
                                            value="{{ request()->get('dt_compra_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data pagamento -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data pagamento:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_paga_min" id=""
                                            value="{{ request()->get('dt_paga_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_paga_max" id=""
                                            value="{{ request()->get('dt_paga_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="">
                            <div class="fs-5 fw-semibold">Status</div>
                            <div class="mt-2 mb-2">

                                <div class="">
                                    <div class="d-flex flex-wrap gap-2 gap-md-3  ">

                                        <div class="form-check form-switch   ">
                                            <input class="form-check-input " name="s" type="checkbox"
                                                value="todos" id="t-todos" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if ('todos' == request()->get('s')) checked @endif
                                                @if (request()->get('s1') == '' &&
                                                        request()->get('s2') == '' &&
                                                        request()->get('s3') == '' &&
                                                        request()->get('s4') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="t-todos">
                                                Todos
                                            </label>
                                        </div>
                                        <div class="form-check form-switch    ">
                                            <input class="form-check-input " name="s1" type="checkbox"
                                                value="waitingPayment" id="tipo-ag"
                                                style="width: 30px; height: 16px;" onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('s1') == 'waitingPayment') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-ag">
                                                Gerado
                                            </label>
                                        </div>
                                        <div class="form-check form-switch    ">
                                            <input class="form-check-input " name="s2" type="checkbox"
                                                value="overdue" id="tipo-an" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('s2') == 'overdue') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-an">
                                                Aberto
                                            </label>
                                        </div>
                                        <div class="form-check form-switch    ">
                                            <input class="form-check-input " name="s3" type="checkbox"
                                                value="paid" id="tipo-pes" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('s3') == 'paid') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-pes">
                                                Pago
                                            </label>
                                        </div>
                                        <div class="form-check form-switch    ">
                                            <input class="form-check-input " name="s4" type="checkbox"
                                                value="processing" id="tipo-pro" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('s4') == 'processing') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-pro">
                                                Processando
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </li>

                    </ul>
                    <div class="text-center d-flex mt-4 pt-2 flex-column flex-md-row gap-2 justify-content-center">
                        <button type="submit" class="btn btn-primary px-5 ">
                            <div class="px-lg-4 fw-semibold">
                                Filtrar
                            </div>
                        </button>
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro');document.getElementById('t-todos').checked=false;document.getElementById('t-todos').click()">
                            <div class="px-lg-2 fw-semibold">
                                Limpar Filtro
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // cliente
    $('#modal-filtro .select-cliente').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });

    // modulo
    $('#modal-filtro .select-modulo').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // plano
    $('#modal-filtro .select-plano').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
</script>
<!-- imask -->
<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById('valor_min'), {
            mask: [{
                    mask: ''
                },
                {
                    mask: 'num',
                    lazy: false,
                    blocks: {
                        num: {
                            mask: Number,
                            scale: 2,
                            thousandsSeparator: '.',
                            padFractionalZeros: true,
                            radix: ',',
                            mapToRadix: ['.'],
                        }
                    }
                }
            ]
        }
    );

    IMask(
        document.getElementById('valor_max'), {
            mask: [{
                    mask: ''
                },
                {
                    mask: 'num',
                    lazy: false,
                    blocks: {
                        num: {
                            mask: Number,
                            scale: 2,
                            thousandsSeparator: '.',
                            padFractionalZeros: true,
                            radix: ',',
                            mapToRadix: ['.'],
                        }
                    }
                }
            ]
        }
    );

    // ativar/desativar checkboxs de recorrencia
    function changeTypeCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked

            let todos = document.getElementById('t-todos');
            let ag = document.getElementById('tipo-ag');
            let an = document.getElementById('tipo-an');
            let pes = document.getElementById('tipo-pes');
            let pro = document.getElementById('tipo-pro');


            if (ag.checked || an.checked || pes.checked ||  pro.checked) {
                todos.checked = false

                target.checked = itemCheckBool
            }

            if (ag.checked && an.checked && pes.checked && pro.checked) {
                todos.checked = true
                ag.checked = false
                an.checked = false
                pes.checked = false
                pro.checked = false
            }

            if (todos.checked) {
                ag.checked = false
                an.checked = false
                pes.checked = false
                pro.checked = false
            }

        }, 10);
    }
</script>
