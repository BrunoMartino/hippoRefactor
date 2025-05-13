<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Cupons
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('coupons.index') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Nome-->
                        <li class="">
                            <label class="fs-5 fw-semibold">Cupom:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="nome" class=" select-nome  form-control custom-select2"
                                        name="nome" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\DiscountCoupon::get(['code', 'id']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('nome') == $item->id) selected @endif>
                                                {{ $item->code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Desconto -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Desconto:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="">
                                            <input type="text" class="form-control" name="valor" id="value"
                                                placeholder="0,00" value="{{ request()->get('valor') }}"
                                                style="max-width: 140px" />
                                        </div>
                                        <div class=""> ou </div>
                                        <div class="">
                                            <input type="text" class="form-control" name="porc" id="percent"
                                                placeholder="%" value="{{ request()->get('porc') }}"
                                                style="max-width: 120px" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- <!-- Código -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Código:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="cod" id=""
                                        value="{{ request()->get('cod') }}" placeholder="" />
                                </div>
                            </div>
                        </li> --}}
                        <!-- Validade -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Validade:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_val_min" id=""
                                            value="{{ request()->get('dt_val_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_val_max" id=""
                                            value="{{ request()->get('dt_val_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Situação -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Situação:</label>
                            <div class="mb-2 mt-2 ">
                                <div class="">
                                    <div class="">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="t" type="checkbox"
                                                value="1" id="todos" style="width: 30px; height: 16px;"
                                                onchange="changeSitCheckbox(this)"
                                                @if ('1' == request()->get('t')) checked @endif
                                                @if (request()->get('s1') == '' && request()->get('s2') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="todos">
                                                Todos
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="s1" type="checkbox"
                                                value="ativo" id="s1" style="width: 30px; height: 16px;"
                                                onchange="changeSitCheckbox(this)"
                                                @if ('ativo' == request()->get('s1')) checked @endif />
                                            <label class="form-check-label ms-1" for="s1">
                                                Ativo
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="s2" type="checkbox"
                                                value="desativado" id="s2" style="width: 30px; height: 16px;"
                                                onchange="changeSitCheckbox(this)"
                                                @if ('desativado' == request()->get('s2')) checked @endif />
                                            <label class="form-check-label ms-1" for="s2">
                                                Inativo
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Recorrência -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Recorrência:</label>
                            <div class="mb-3 mt-2 mb-2">
                                <div class="">
                                    <div class="">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="re" type="checkbox"
                                                value="todos" id="re-todos" style="width: 30px; height: 16px;"
                                                onchange="changeRecCheckbox(this)"
                                                @if ('todos' == request()->get('re')) checked @endif
                                                @if (request()->get('re1') == '' && request()->get('re2') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="re-todos">
                                                Todos
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="re1" type="checkbox"
                                                value="sim" id="re1" style="width: 30px; height: 16px;"
                                                onchange="changeRecCheckbox(this)"
                                                @if ('sim' == request()->get('re1')) checked @endif />
                                            <label class="form-check-label ms-1" for="re1">
                                                Sim
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="re2" type="checkbox"
                                                value="nao" id="re2" style="width: 30px; height: 16px;"
                                                onchange="changeRecCheckbox(this)"
                                                @if ('nao' == request()->get('re2')) checked @endif />
                                            <label class="form-check-label ms-1" for="re2">
                                                Não
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Utilizados -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Utilizados:</label>
                            <div class="mb-3 mt-2 mb-2">
                                <div class="">
                                    <div class="">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="ut" type="checkbox"
                                                value="todos" id="ut-todos" style="width: 30px; height: 16px;"
                                                onchange="changeUtiCheckbox(this)"
                                                @if ('todos' == request()->get('ut')) checked @endif
                                                @if (request()->get('ut1') == '' && request()->get('ut2') == '') checked @endif />
                                            <label class="form-check-label ms-1" for="ut-todos">
                                                Todos
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="ut1" type="checkbox"
                                                value="utilizados" id="ut1" style="width: 30px; height: 16px;"
                                                onchange="changeUtiCheckbox(this)"
                                                @if ('utilizados' == request()->get('ut1')) checked @endif />
                                            <label class="form-check-label ms-1" for="ut1">
                                                Utilizados
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="ut2" type="checkbox"
                                                value="nao_utilizados" id="ut2" style="width: 30px; height: 16px;"
                                                onchange="changeUtiCheckbox(this)"
                                                @if ('nao_utilizados' == request()->get('ut2')) checked @endif />
                                            <label class="form-check-label ms-1" for="ut2">
                                                Não utilizados
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
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro');document.getElementById('todos').checked=false;document.getElementById('todos').click();document.getElementById('re-todos').checked=false;document.getElementById('re-todos').click(); document.getElementById('ut-todos').checked=false;document.getElementById('ut-todos').click(); document.getElementById('percent').disabled=false;document.getElementById('value').disabled=false">
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
</script>
<!-- imask -->
<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById('value'), {
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
        document.getElementById('percent'), {
            mask: '000'
        }
    );


    function enableInputsDiscount() {
        if (document.getElementById('percent').value != '') {
            document.getElementById('value').value = ''
            document.getElementById('value').disabled = true
        } else {
            document.getElementById('value').disabled = false
        }

        if (document.getElementById('value').value != '') {
            document.getElementById('percent').value = ''
            document.getElementById('percent').disabled = true
        } else {
            document.getElementById('percent').disabled = false
        }
    }

    document.getElementById('percent').oninput = function() {
        enableInputsDiscount()
    }
    document.getElementById('value').oninput = function() {
        enableInputsDiscount()
    }
    enableInputsDiscount()

    // ativar/desativar checkboxs de situação
    function changeSitCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked

            document.getElementById('todos').checked = false
            document.getElementById('s1').checked = false
            document.getElementById('s2').checked = false
            target.checked = itemCheckBool

        }, 10);
    }
    // ativar/desativar checkboxs de recorrencia
    function changeRecCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked

            document.getElementById('re-todos').checked = false
            document.getElementById('re1').checked = false
            document.getElementById('re2').checked = false
            target.checked = itemCheckBool

        }, 10);
    }

    // ativar/desativar checkboxs de utilizados
    function changeUtiCheckbox(target) {

        setTimeout(() => {
            let itemCheckBool = target.checked

            document.getElementById('ut-todos').checked = false
            document.getElementById('ut1').checked = false
            document.getElementById('ut2').checked = false
            target.checked = itemCheckBool

        }, 10);
    }
</script>
