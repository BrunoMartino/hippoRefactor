<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
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
                <form action="{{ route('reports.sended.messages') }}" method="get" id="form-filtro">
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
                        <!-- Data cadastro -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data cadastro:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_cad_min"
                                            id="" value="{{ request()->get('dt_cad_min') }}"
                                            placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_cad_max"
                                            id="" value="{{ request()->get('dt_cad_max') }}"
                                            placeholder="" />
                                    </div>
                                </div>
                            </div>
                        </li>

                        <!-- Qtd. msgs enviadas -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Qtd. msgs enviadas:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_enviadas_min" id="qtd_enviadas_min"
                                        value="{{ request()->get('qtd_enviadas_min') }}" placeholder="Mín" />
                                    </div>
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_enviadas_max" id="qtd_enviadas_max"
                                        value="{{ request()->get('qtd_enviadas_max') }}" placeholder="Máx" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Qtd. msgs restantes -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Qtd. msgs restantes:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_rest_min" id="qtd_rest_min"
                                        value="{{ request()->get('qtd_rest_min') }}" placeholder="Mín" />
                                    </div>
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_rest_max" id="qtd_rest_max"
                                        value="{{ request()->get('qtd_rest_max') }}" placeholder="Máx" />
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Qtd. msgs visualizadas -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Qtd. msgs visualizadas:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_visu_min" id="qtd_visu_min"
                                        value="{{ request()->get('qtd_visu_min') }}" placeholder="Mín" />
                                    </div>
                                    <div class="w-100">
                                        <input type="text" class="form-control" name="qtd_visu_max" id="qtd_visu_max"
                                        value="{{ request()->get('qtd_visu_max') }}" placeholder="Máx" />
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
     // cpf cnpj
     $('#modal-filtro .select-cpf-cnpj').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
</script>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById('qtd_enviadas_min'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_enviadas_max'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_rest_min'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_rest_max'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_visu_min'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_visu_max'), {
            mask: '0000000000000'
        }
    );
</script>
