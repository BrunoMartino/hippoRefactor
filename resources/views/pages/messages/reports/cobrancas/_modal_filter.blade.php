<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('messages.charge-report.index') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">

                        <div class="row ">
                            <div class="col-lg-6">
                                <!-- Nome-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Nome:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="nome" class=" select-nome  form-control custom-select2"
                                                name="nome" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($allReport as $item)
                                                    <option value="{{ $item->nome_cliente }}"
                                                        @if (request()->get('nome') == $item->nome_cliente) selected @endif>
                                                        {{ $item->nome_cliente }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Pedido:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">

                                            <select id="pedido" class=" select-pedido  form-control custom-select2"
                                                name="pedido" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($allReport as $item)
                                                    <option value="{{ $item->pedido }}"
                                                        @if (request()->get('pedido') == $item->pedido) selected @endif>
                                                        {{ $item->pedido }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Nota fiscal:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="nf" class=" select-nf  form-control custom-select2"
                                                name="nf" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($allReport as $item)
                                                    <option value="{{ $item->nota_fiscal }}"
                                                        @if (request()->get('nf') == $item->nota_fiscal) selected @endif>
                                                        {{ $item->nota_fiscal }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Contrato:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="contrato" class=" select-contrato  form-control custom-select2"
                                                name="contrato" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($allReport as $item)
                                                    <option value="{{ $item->contrato }}"
                                                        @if (request()->get('contrato') == $item->contrato) selected @endif>
                                                        {{ $item->contrato }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            

                            <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Situação:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="sit" class=" select-sit  form-control custom-select2"
                                                name="sit" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                <option value="todos"
                                                    @if (request()->get('sit') == 'todos') selected @endif>
                                                    Todos
                                                </option>
                                                <option value="entregue"
                                                    @if (request()->get('sit') == 'entregue') selected @endif>
                                                    Entregue
                                                </option>
                                                <option value="nao_entregue"
                                                    @if (request()->get('sit') == 'nao_entregue') selected @endif>
                                                    Não Entregue
                                                </option>
                                                <option value="visualizado"
                                                    @if (request()->get('sit') == 'visualizado') selected @endif>
                                                    Visualizado
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                            </div>
                             <!-- Vencimento -->
                             <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Vencimento:</label>
                                    <div class="mt-0 mb-2">
                                        <div class="mb-2 d-flex gap-3">
                                            <div class="w-100">
                                                <label for="">Mín</label>
                                                <input type="date" class="form-control" name="dt_venc_min"
                                                    id="" value="{{ request()->get('dt_venc_min') }}"
                                                    placeholder="" />
                                            </div>
                                            <div class="w-100">
                                                <label for="">Máx</label>
                                                <input type="date" class="form-control" name="dt_venc_max"
                                                    id="" value="{{ request()->get('dt_venc_max') }}"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>

                            <div class="col-12"></div>

                           
                            <div class="col-lg-6">
                                <!-- Data envio -->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Envio:</label>
                                    <div class="mt-0 mb-2">
                                        <div class="mb-2 d-flex gap-3">
                                            <div class="w-100">
                                                <label for="">Mín</label>
                                                <input type="date" class="form-control" name="dt_envio_min"
                                                    id="" value="{{ request()->get('dt_envio_min') }}"
                                                    placeholder="" />
                                            </div>
                                            <div class="w-100">
                                                <label for="">Máx</label>
                                                <input type="date" class="form-control" name="dt_envio_max"
                                                    id="" value="{{ request()->get('dt_envio_max') }}"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>
                            <!-- Visualização -->
                            <div class="col-lg-6">
                                <li class="">
                                    <label class="fs-5 fw-semibold">Visualização:</label>
                                    <div class="mt-0 mb-2">
                                        <div class="mb-2 d-flex gap-3">
                                            <div class="w-100">
                                                <label for="">Mín</label>
                                                <input type="date" class="form-control" name="dt_visu_min"
                                                    id="" value="{{ request()->get('dt_visu_min') }}"
                                                    placeholder="" />
                                            </div>
                                            <div class="w-100">
                                                <label for="">Máx</label>
                                                <input type="date" class="form-control" name="dt_visu_max"
                                                    id="" value="{{ request()->get('dt_visu_max') }}"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </div>

                        </div>
                        <li class="" style="max-width: 400px">
                            <div class="fs-5 fw-semibold">Tipo</div>
                            <div class="mt-2 mb-2">

                                <div class="">
                                    <div class="row ">
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-4  mb-1bg-danger">
                                            <input class="form-check-input " name="t" type="checkbox"
                                                value="todos" id="t-todos" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if ('todos' == request()->get('t')) checked @endif
                                                @if (request()->get('t1') == '' && request()->get('t2') == '' && request()->get('t3') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="t-todos">
                                                TODOS
                                            </label>
                                        </div>
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-4  mb-1">
                                            <input class="form-check-input " name="t1" type="checkbox"
                                                value="ag" id="tipo-ag" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('t1') == 'ag') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-ag">
                                                Gerada
                                            </label>
                                        </div>
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-4  mb-1">
                                            <input class="form-check-input " name="t2" type="checkbox"
                                                value="an" id="tipo-an" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('t2') == 'an') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-an">
                                                Vencendo
                                            </label>
                                        </div>
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-4  mb-1 ">
                                            <input class="form-check-input " name="t3" type="checkbox"
                                                value="pes" id="tipo-pes" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('t3') == 'pes') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-pes">
                                                Vencimento
                                            </label>
                                        </div>
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-4  mb-1 ">
                                            <input class="form-check-input " name="t4" type="checkbox"
                                                value="t4" id="tipo-t4" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if (request()->get('t4') == 't4') checked @endif />
                                            <label class="form-check-label ms-1" for="tipo-t4">
                                                Vencido
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
    // nome
    $('#modal-filtro .select-nome').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-pedido').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-nf').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-contrato').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-sit').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // ativar/desativar checkboxs de recorrencia
    function changeTypeCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked

            let todos = document.getElementById('t-todos');
            let ag = document.getElementById('tipo-ag');
            let an = document.getElementById('tipo-an');
            let pes = document.getElementById('tipo-pes');
            let t4 = document.getElementById('tipo-t4');


            if (ag.checked || an.checked || pes.checked || t4) {
                todos.checked = false

                target.checked = itemCheckBool
            }

            if (ag.checked && an.checked && pes.checked && t4.checked) {
                todos.checked = true
                ag.checked = false
                an.checked = false
                pes.checked = false
                t4.checked = false
            }

            if (todos.checked) {
                ag.checked = false
                an.checked = false
                pes.checked = false
                t4.checked = false
            }

            // document.getElementById('t-todos').checked = false
            // document.getElementById('tipo-ag').checked = false
            // document.getElementById('tipo-an').checked = false
            // document.getElementById('tipo-pes').checked = false
            // target.checked = itemCheckBool

        }, 10);
    }
</script>
