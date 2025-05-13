<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Registros
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <div class="modal-body p-lg-4 pt-lg-3">

                <!-- Filtros -->
                <form action="{{ route('reports.free.plan') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Cliente -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Cliente:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="cliente" class=" select-cliente  form-control custom-select2"
                                        name="cliente" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::role('usuario_princ')->where('plano_id', 4)->orderBy('nome_usuario')->get(['nome_usuario', 'id']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('cliente') == $item->id) selected @endif>
                                                {{ $item->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- CPF/CNPJ -->
                        <li class="">
                            <label class="fs-5 fw-semibold">CPF/CNPJ:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj"
                                        value="{{ request()->get('cpf_cnpj') }}" placeholder="" />
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

                        <!-- Data Cadastro -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Cadastro:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_cadastro_min" id=""
                                            value="{{ request()->get('dt_cadastro_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_cadastro_max" id=""
                                            value="{{ request()->get('dt_cadastro_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Data Up -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Upgrade:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_up_min" id=""
                                            value="{{ request()->get('dt_up_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_up_max" id=""
                                            value="{{ request()->get('dt_up_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data Cancelamento -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Cancelamento:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_cancel_min"
                                            id="" value="{{ request()->get('dt_cancel_min') }}"
                                            placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_cancel_max"
                                            id="" value="{{ request()->get('dt_cancel_max') }}"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Data Expiração -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Expiração:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_exp_min" id=""
                                            value="{{ request()->get('dt_exp_min') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_exp_max" id=""
                                            value="{{ request()->get('dt_exp_max') }}" placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Qtd. mensagens restantes -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Qtd. mensagens restantes:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-2 align-items-center">
                                    <div class="">
                                        <input type="text" class="form-control" name="qtd_min" id="qtd_msgs-min"
                                            value="{{ request()->get('qtd_min') }}" placeholder="Mínima"
                                            style="max-width: 100px" />
                                    </div>
                                    <div class="px-2 " style="border-bottom: 1px solid rgb(211, 217, 229)">
                                    </div>
                                    <div class="">
                                        <input type="text" class="form-control" name="qtd_max" id="qtd_msgs-max"
                                            value="{{ request()->get('qtd_max') }}" placeholder="Máxima"
                                            style="max-width: 100px" />
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
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro')">
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
        dropdownParent: $('#modal-filtro'),
        // placeholder: 'Selecione uma opção',  // Texto do placeholder
        placeholder: '', // Texto do placeholder
        "language": "pt-BR",
        allowClear: true
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
</script>
