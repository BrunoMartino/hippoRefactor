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
                <form action="{{ route('descontos-mensais.index') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Cliente -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Cliente:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="cliente" class=" select-cliente  form-control custom-select2"
                                        name="cliente" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::role('usuario_princ')->orderBy('nome_usuario')->get(['nome_usuario', 'id']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('cliente') == $item->id) selected @endif>
                                                {{ $item->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- CPF ou CNPJ -->
                        <li class="">
                            <label class="fs-5 fw-semibold">CPF ou CNPJ:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="cpf_cnpj" class=" select-cpf-cnpj  form-control custom-select2"
                                        name="cpf_cnpj" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::get(['cpf', 'cnpj', 'tipo_usuario']) as $item)
                                            @if ($item->cpf != null)
                                                <option value="{{ $item->cpf }}"
                                                    @if (request()->get('cpf_cnpj') == $item->cpf) selected @endif>
                                                    {{ formatarCPF($item->cpf) }} / CPF
                                                </option>
                                            @endif
                                            @if ($item->cnpj != null)
                                                <option value="{{ $item->cnpj }}"
                                                    @if (request()->get('cpf_cnpj') == $item->cnpj) selected @endif>
                                                    {{ formatarCNPJ($item->cnpj) }} / CNPJ
                                                </option>
                                            @endif
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
                        <!-- Tipo -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Tipo de Desconto:</label>
                            <div class="mb-2 mt-2 ">
                                <div class="">
                                    <div class="">
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="t1" type="checkbox"
                                                value="valor" id="t1" style="width: 30px; height: 16px;"
                                                onchange="changeSitCheckbox(this)"
                                                @if ('valor' == request()->get('t1')) checked @endif />
                                            <label class="form-check-label ms-1" for="t1">
                                                Valor
                                            </label>
                                        </div>
                                        <div class="form-check form-switch form-check-inline">
                                            <input class="form-check-input " name="t2" type="checkbox"
                                                value="percentual" id="t2" style="width: 30px; height: 16px;"
                                                onchange="changeSitCheckbox(this)"
                                                @if ('percentual' == request()->get('t2')) checked @endif />
                                            <label class="form-check-label ms-1" for="t2">
                                                Percentual
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2 d-flex gap-3">
                                            <div class="w-100">
                                                <input type="text" class="form-control" name="valor_min"
                                                    id="valor_min" value="{{ request()->get('valor_min') }}"
                                                    placeholder="Mín" disabled />
                                            </div>
                                            <div class="w-100">
                                                <input type="text" class="form-control" name="valor_max"
                                                    id="valor_max" value="{{ request()->get('valor_max') }}"
                                                    placeholder="Máx" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data Ínicio -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Ínicio:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="month" class="form-control" name="dt_inicio_min"
                                            id="" value="{{ request()->get('dt_inicio_min') }}"
                                            placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="month" class="form-control" name="dt_inicio_max"
                                            id="" value="{{ request()->get('dt_inicio_max') }}"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data Termino -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Termino:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="month" class="form-control" name="dt_termino_min"
                                            id="" value="{{ request()->get('dt_termino_min') }}"
                                            placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="month" class="form-control" name="dt_termino_max"
                                            id="" value="{{ request()->get('dt_termino_max') }}"
                                            placeholder="" />
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
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro');document.getElementById('t1').checked=false;document.getElementById('t2').checked=false;">
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
    // cpf cnpj
    $('#modal-filtro .select-cpf-cnpj').select2({
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
        document.getElementById('cpf_cnpj'), {
            mask: '00000000000000'
        }
    );
    IMask(
        document.getElementById('valor_min'), {
            mask: '000000000000'
        }
    );
    IMask(
        document.getElementById('valor_max'), {
            mask: '000000000000'
        }
    );

    /* tipo de desconto */
    document.getElementById('t1').onchange = function() {
        setTimeout(() => {
            if (document.getElementById('t1').checked) {
                document.getElementById('t2').checked = false
                document.getElementById('valor_min').disabled = false
                document.getElementById('valor_max').disabled = false
            } else {
                document.getElementById('valor_min').disabled = true
                document.getElementById('valor_max').disabled = true
            }
        }, 100);
    }
    document.getElementById('t2').onchange = function() {
        setTimeout(() => {
            if (document.getElementById('t2').checked) {
                document.getElementById('t1').checked = false
                document.getElementById('valor_min').disabled = false
                document.getElementById('valor_max').disabled = false
            } else {
                document.getElementById('valor_min').disabled = true
                document.getElementById('valor_max').disabled = true
            }
        }, 100);
    }

    if (document.getElementById('t1').checked || document.getElementById('t2').checked) {
        document.getElementById('valor_min').disabled = false
        document.getElementById('valor_max').disabled = false
    }
</script>
