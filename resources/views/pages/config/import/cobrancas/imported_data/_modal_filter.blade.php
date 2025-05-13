<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Dados Importados
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->

                @php
                    $data= $dataGroup->imported_billings;
                @endphp
                <form action="{{ route('config.import.cb.imported-data.show', $dataGroup->id) }}" method="get" id="form-filtro">

                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <ul class="ps-3" style="list-style:circle ">
                                <!-- Nome-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Nome:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="n" class=" select-nome  form-control custom-select2"
                                                name="n" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (request()->get('n') == $item->id) selected @endif>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                              
                                <!-- Nº do Pedido-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Nº do Pedido:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select class=" select-n-pedido  form-control custom-select2"
                                                name="n_pedido" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->order_number }}"
                                                        @if (request()->get('n_pedido') == $item->order_number) selected @endif>
                                                        {{ $item->order_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <!-- Nº Nota Fiscal-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Nº Nota Fiscal:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select class=" select-n-nf  form-control custom-select2" name="n_nf"
                                                style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->nf_number }}"
                                                        @if (request()->get('n_nf') == $item->nf_number) selected @endif>
                                                        {{ $item->nf_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <!-- WhatsApp-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">WhatsApp:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select class=" select-whatsapp  form-control custom-select2"
                                                name="whatsapp" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->whatsapp }}"
                                                        @if (request()->get('whatsapp') == $item->whatsapp) selected @endif>
                                                        {{ fmtNumCelular($item->whatsapp) }}
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
                                            <div class="d-flex gap-0 flex-wrap flex-column ">
                                                <div class="form-check form-switch  mb-1">
                                                    <input class="form-check-input " name="t" type="checkbox"
                                                        value="todos" id="t" style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckbox(this)"
                                                        @if ('todos' == request()->get('t')) checked @endif
                                                        @if (is_null(request()->get('t1')) && is_null(request()->get('t2'))) checked @endif />
                                                    <label class="form-check-label ms-1" for="t">
                                                        Todos
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch  mb-1">
                                                    <input class="form-check-input " name="t1" type="checkbox"
                                                        value="pf" id="t1" style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckbox(this)"
                                                        @if ('pf' == request()->get('t1')) checked @endif />
                                                    <label class="form-check-label ms-1" for="t1">
                                                        Pessoa Física
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch  mb-1 ">
                                                    <input class="form-check-input " name="t2" type="checkbox"
                                                        value="pj" id="t2" style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckbox(this)"
                                                        @if (request()->get('t2') == 'pj') checked @endif />
                                                    <label class="form-check-label ms-1" for="t2">
                                                        Pessoa Jurídica
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-6 pe-3">
                            <ul class="ps-3" style="list-style:circle ">
                                <!-- Data de nascimento -->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Data de nascimento:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2 d-flex gap-3">
                                            <div class="w-100">
                                                <label for="">Mín</label>
                                                <input type="date" class="form-control" name="dt_nasc_min"
                                                    id="" value="{{ request()->get('dt_nasc_min') }}"
                                                    placeholder="" />
                                            </div>
                                            <div class="w-100">
                                                <label for="">Máx</label>
                                                <input type="date" class="form-control" name="dt_nasc_max"
                                                    id="" value="{{ request()->get('dt_nasc_max') }}"
                                                    placeholder="" />
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- Contrato-->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Contrato:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select class=" select-contrato  form-control custom-select2"
                                                name="contrato" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->contract }}"
                                                        @if (request()->get('contrato') == $item->contract) selected @endif>
                                                        {{ $item->contract }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                {{-- <!-- Vencimento -->
                                <li class="">
                                    <label class="fs-5 fw-semibold">Vencimento:</label>
                                    <div class="mt-2 mb-2">
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
                                </li> --}}
                                <!-- UF -->
                                <li class="">
                                    <label class="fs-5 fw-semibold">UF:</label>
                                    <div class="mt-2 mb-2">
                                        <div class="mb-2">
                                            <select id="uf" class=" select-uf  form-control custom-select2"
                                                name="uf" style="width: 100%; height: 36px">
                                                <option value=""></option>
                                                <option value="AL"
                                                    @if (old('uf', request()->get('uf')) == 'AL') selected @endif>
                                                    Alagoas
                                                    - AL</option>
                                                <option value="AC"
                                                    @if (old('uf', request()->get('uf')) == 'AC') selected @endif>Acre
                                                    -
                                                    AC</option>
                                                <option value="AP"
                                                    @if (old('uf', request()->get('uf')) == 'AP') selected @endif>Amapá
                                                    -
                                                    AP</option>
                                                <option value="AM"
                                                    @if (old('uf', request()->get('uf')) == 'AM') selected @endif>
                                                    Amazonas - AM</option>
                                                <option value="BA"
                                                    @if (old('uf', request()->get('uf')) == 'BA') selected @endif>
                                                    Bahia
                                                    -
                                                    BA</option>
                                                <option value="CE"
                                                    @if (old('uf', request()->get('uf')) == 'CE') selected @endif>
                                                    Ceará
                                                    -
                                                    CE</option>
                                                <option value="DF"
                                                    @if (old('uf', request()->get('uf')) == 'DF') selected @endif>
                                                    Distrito Federal - DF</option>
                                                <option value="ES"
                                                    @if (old('uf', request()->get('uf')) == 'ES') selected @endif>
                                                    Espírito Santo - ES</option>
                                                <option value="GO"
                                                    @if (old('uf', request()->get('uf')) == 'GO') selected @endif>
                                                    Goiás
                                                    - GO</option>
                                                <option value="MA"
                                                    @if (old('uf', request()->get('uf')) == 'MA') selected @endif>
                                                    Maranhão - MA</option>
                                                <option value="MT"
                                                    @if (old('uf', request()->get('uf')) == 'MT') selected @endif>Mato
                                                    Grosso - MT</option>
                                                <option value="MS"
                                                    @if (old('uf', request()->get('uf')) == 'MS') selected @endif>Mato
                                                    Grosso do Sul - MS</option>
                                                <option value="MG"
                                                    @if (old('uf', request()->get('uf')) == 'MG') selected @endif>
                                                    Minas
                                                    Gerais - MG</option>
                                                <option value="PA"
                                                    @if (old('uf', request()->get('uf')) == 'PA') selected @endif>Pará
                                                    - PA</option>
                                                <option value="PB"
                                                    @if (old('uf', request()->get('uf')) == 'PB') selected @endif>
                                                    Paraíba - PB</option>
                                                <option value="PR"
                                                    @if (old('uf', request()->get('uf')) == 'PR') selected @endif>
                                                    Paraná - PR</option>
                                                <option value="PE"
                                                    @if (old('uf', request()->get('uf')) == 'PE') selected @endif>
                                                    Pernambuco - PE</option>
                                                <option value="PI"
                                                    @if (old('uf', request()->get('uf')) == 'PI') selected @endif>
                                                    Piauí
                                                    - PI</option>
                                                <option value="RJ"
                                                    @if (old('uf', request()->get('uf')) == 'RJ') selected @endif>Rio
                                                    de Janeiro - RJ</option>
                                                <option value="RN"
                                                    @if (old('uf', request()->get('uf')) == 'RN') selected @endif>Rio
                                                    Grande do Norte - RN</option>
                                                <option value="RS"
                                                    @if (old('uf', request()->get('uf')) == 'RS') selected @endif>Rio
                                                    Grande do Sul - RS</option>
                                                <option value="RO"
                                                    @if (old('uf', request()->get('uf')) == 'RO') selected @endif>
                                                    Rondônia - RO</option>
                                                <option value="RR"
                                                    @if (old('uf', request()->get('uf')) == 'RR') selected @endif>
                                                    Roraima - RR</option>
                                                <option value="SC"
                                                    @if (old('uf', request()->get('uf')) == 'SC') selected @endif>
                                                    Santa
                                                    Catarina - SC</option>
                                                <option value="SP"
                                                    @if (old('uf', request()->get('uf')) == 'SP') selected @endif>São
                                                    Paulo - SP</option>
                                                <option value="SE"
                                                    @if (old('uf', request()->get('uf')) == 'SE') selected @endif>
                                                    Sergipe - SE</option>
                                                <option value="TO"
                                                    @if (old('uf', request()->get('uf')) == 'TO') selected @endif>
                                                    Tocantins - TO</option>
                                                <option value="EX"
                                                    @if (old('uf', request()->get('uf')) == 'EX') selected @endif>
                                                    Estrangeiro</option>
                                            </select>
                                        </div>
                                    </div>
                                </li>
                                <!-- Gênero -->
                                <li class="">
                                    <div class="fs-5 fw-semibold">Gênero</div>
                                    <div class="mt-2 mb-2">

                                        <div class="">
                                            <div class="d-flex gap-0 flex-wrap flex-column">
                                                <div class="form-check form-switch  mb-1">
                                                    <input class="form-check-input " name="g" type="checkbox"
                                                        value="todos" id="g"
                                                        style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckboxGender(this)"
                                                        @if ('todos' == request()->get('g')) checked @endif
                                                        @if (is_null(request()->get('g1')) && is_null(request()->get('g2'))) checked @endif />
                                                    <label class="form-check-label ms-1" for="g">
                                                        Todos
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch  mb-1">
                                                    <input class="form-check-input " name="g1" type="checkbox"
                                                        value="m" id="g1"
                                                        style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckboxGender(this)"
                                                        @if ('m' == request()->get('g1')) checked @endif />
                                                    <label class="form-check-label ms-1" for="g1">
                                                        Masculino
                                                    </label>
                                                </div>
                                                <div class="form-check form-switch  mb-1 ">
                                                    <input class="form-check-input " name="g2" type="checkbox"
                                                        value="f" id="g2"
                                                        style="width: 30px; height: 16px;"
                                                        onchange="changeTypeCheckboxGender(this)"
                                                        @if (request()->get('g2') == 'f') checked @endif />
                                                    <label class="form-check-label ms-1" for="g2">
                                                        Feminino
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                   
                    <div class="text-center d-flex mt-4 pt-2 flex-column flex-md-row gap-2 justify-content-center">
                        <button type="submit" class="btn btn-primary px-5 ">
                            <div class="px-lg-4 fw-semibold">
                                Filtrar
                            </div>
                        </button>
                        <button type="button" class="btn btn-light text-primary px-5 " onclick="resetarFiltro('form-filtro');document.getElementById('t').checked=false;document.getElementById('t').click();document.getElementById('g').checked=false;document.getElementById('g').click()">
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
    $('#modal-filtro .select-n-pedido').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-n-nf').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-whatsapp').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    $('#modal-filtro .select-contrato').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });

    // uf
    $('#modal-filtro .select-uf').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    })


    function changeTypeCheckbox(el) {
        let elCheck = el.checked
        document.getElementById('t').checked = false
        document.getElementById('t1').checked = false
        document.getElementById('t2').checked = false

        el.checked = elCheck
    }

    function changeTypeCheckboxGender(el) {
        let elCheck = el.checked
        document.getElementById('g').checked = false
        document.getElementById('g1').checked = false
        document.getElementById('g2').checked = false

        el.checked = elCheck
    }
</script>
