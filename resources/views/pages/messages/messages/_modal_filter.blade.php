<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Mensagens
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('messages.crud.index') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Nome-->
                        <li class="">
                            <label class="fs-5 fw-semibold">Nome:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="nome" class=" select-nome  form-control custom-select2"
                                        name="nome" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\Message::where('user_id', user_princ()->id)->where('type', '!=', 'PESQUISA SATISFAÇÃO ANEXO')->get(['name', 'id']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('nome') == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>

                        <li class="">
                            <div class="fs-5 fw-semibold">Tipo</div>
                            <div class="mt-2 mb-2">

                                <div class="">
                                    <div class="row ">
                                        <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1">
                                            <input class="form-check-input " name="t" type="checkbox"
                                                value="todos" id="t-todos" style="width: 30px; height: 16px;"
                                                onchange="changeTypeCheckbox(this)"
                                                @if ('todos' == request()->get('t')) checked @endif
                                                @if (request()->get('t1') == '' &&
                                                        request()->get('t2') == '' &&
                                                        request()->get('t3') == '' &&
                                                        request()->get('t4') == '' &&
                                                        request()->get('t5') == '' &&
                                                        request()->get('t6') == '' &&
                                                        request()->get('t7') == '' &&
                                                        request()->get('t8') == '' &&
                                                        request()->get('t9') == '' &&
                                                        request()->get('t10') == '' &&
                                                        request()->get('t11') == '' &&
                                                        request()->get('t12') == '' &&
                                                        request()->get('t13') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="t-todos">
                                                TODOS
                                            </label>
                                        </div>

                                        @if (userHasModule(3))
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg " name="t1"
                                                    type="checkbox" value="ag" id="tipo-ag"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t1') == 'ag') checked @endif />
                                                <label class="form-check-label ms-1" for="tipo-ag">
                                                    AGRADECIMENTO
                                                </label>
                                            </div>
                                            <div class="col-12"></div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t2"
                                                    type="checkbox" value="an" id="tipo-an"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t2') == 'an') checked @endif />
                                                <label class="form-check-label ms-1" for="tipo-an">
                                                    ANIVERSÁRIO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t3"
                                                    type="checkbox" value="pes" id="tipo-pes"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t3') == 'pes') checked @endif />
                                                <label class="form-check-label ms-1" for="tipo-pes">
                                                    PESQUISA SATISFAÇÃO
                                                </label>
                                            </div>
                                        @endif

                                        @if (userHasModule(1))
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t4"
                                                    type="checkbox" value="c_gerada" id="c_gerada"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t4') == 'c_gerada') checked @endif />
                                                <label class="form-check-label ms-1" for="c_gerada">
                                                    COBRANÇA GERADA
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t5"
                                                    type="checkbox" value="c_vencendo" id="c_vencendo"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t5') == 'c_vencendo') checked @endif />
                                                <label class="form-check-label ms-1" for="c_vencendo">
                                                    COBRANÇA VENCENDO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t6"
                                                    type="checkbox" value="c_vencimento" id="c_vencimento"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t6') == 'c_vencimento') checked @endif />
                                                <label class="form-check-label ms-1" for="c_vencimento">
                                                    COBRANÇA VENCIMENTO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t7"
                                                    type="checkbox" value="c_vencida" id="c_vencida"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t7') == 'c_vencida') checked @endif />
                                                <label class="form-check-label ms-1" for="c_vencida">
                                                    COBRANÇA VENCIDA
                                                </label>
                                            </div>
                                        @endif
                                        @if (userHasModule(2))
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t9"
                                                    type="checkbox" value="fpr" id="fpr"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t9') == 'fpr') checked @endif />
                                                <label class="form-check-label ms-1" for="fpr">
                                                    FATURAMENTO - PEDIDO RECEBIDO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t10"
                                                    type="checkbox" value="fpa" id="fpa"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t10') == 'fpa') checked @endif />
                                                <label class="form-check-label ms-1" for="fpa">
                                                    FATURAMENTO - PEDIDO EM ANDAMENTO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t11"
                                                    type="checkbox" value="fpat" id="fpat"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t11') == 'fpat') checked @endif />
                                                <label class="form-check-label ms-1" for="fpat">
                                                    FATURAMENTO - PEDIDO ATENDIDO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t12"
                                                    type="checkbox" value="fpv" id="fpv"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t12') == 'fpv') checked @endif />
                                                <label class="form-check-label ms-1" for="fpv">
                                                    FATURAMENTO - PEDIDO VERIFICADO
                                                </label>
                                            </div>
                                            <div class="form-check form-switch col-12 col-sm-6 col-md-6  mb-1 ">
                                                <input class="form-check-input checkbox-filtro-msg" name="t13"
                                                    type="checkbox" value="fps" id="fps"
                                                    style="width: 30px; height: 16px;"
                                                    onchange="changeTypeCheckbox(this)"
                                                    @if (request()->get('t13') == 'fps') checked @endif />
                                                <label class="form-check-label ms-1" for="fps">
                                                    FATURAMENTO - PEDIDO EM SEPARAÇÃO
                                                </label>
                                            </div>
                                        @endif

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
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro');document.getElementById('t-todos').click()">
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

    // ativar/desativar checkboxs de recorrencia
    function changeTypeCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked
            let todos = document.getElementById('t-todos');

            let countCheck = 0
            for (let i in document.querySelectorAll('.checkbox-filtro-msg')) {
                if (document.querySelectorAll('.checkbox-filtro-msg')[i].checked) {
                    countCheck++
                }
            }

            if (countCheck == 0) {
                todos.checked = true
                todos.focus()
            } else {
                if (document.querySelectorAll('.checkbox-filtro-msg').length == countCheck) {
                    todos.checked = true
                    todos.focus()
                    for (let i in document.querySelectorAll('.checkbox-filtro-msg')) {
                        document.querySelectorAll('.checkbox-filtro-msg')[i].checked = false
                    }
                } else {
                    if (target.id != 't-todos')
                        todos.checked = false
                }
            }

            if (todos.checked) {
                for (let i in document.querySelectorAll('.checkbox-filtro-msg')) {
                    document.querySelectorAll('.checkbox-filtro-msg')[i].checked = false
                }
            }


            if (document.querySelectorAll('.checkbox-filtro-msg').length == 1) {
                if (itemCheckBool) {
                    target.checked = true
                    todos.checked = false
                } else {
                    target.checked = true
                    todos.checked = false
                }
                if (document.querySelectorAll('.checkbox-filtro-msg')[0].checked == false)
                    todos.checked = true
            }
        }, 10);
    }
</script>
