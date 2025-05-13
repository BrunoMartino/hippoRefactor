<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Rendimentos Afiliados
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('affiliates.income') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Afiliado -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Afiliado:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="afiliado" class=" select-afiliado  form-control custom-select2"
                                        name="afiliado" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        {{-- $item->affiliate->user->nome_usuario --}}

                                        @php
                                            $foo = [];
                                        @endphp
                                        @foreach (\App\Models\AffiliateReferral::get() as $item)
                                            @php
                                                if (in_array($item->affiliate->user->id, $foo)) {
                                                    continue;
                                                }
                                            @endphp
                                            <option value="{{ $item->affiliate->user->id }}"
                                                @if (request()->get('afiliado') == $item->affiliate->user->id) selected @endif>
                                                {{ $item->affiliate->user->nome_usuario }}
                                            </option>
                                            @php
                                                $foo[] = $item->affiliate->user->id;
                                            @endphp
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
                                        @php
                                            $plansList = \App\Models\Plano::pluck('nome')->toArray() ?? [];
                                            $plansList = array_unique($plansList);
                                        @endphp
                                        @foreach ($plansList as $item)
                                            <option value="{{ $item }}"
                                                @if (request()->get('plano') == $item) selected @endif>
                                                {{ ucfirst($item) }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Data de venda -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data de venda:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Início</label>
                                        <input type="date" class="form-control" name="dt_venda_ini" id=""
                                            value="{{ request()->get('dt_venda_ini') }}" placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Fim</label>
                                        <input type="date" class="form-control" name="dt_venda_fim" id=""
                                            value="{{ request()->get('dt_venda_fim') }}" placeholder="" />
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
                        <button type="button" class="btn btn-light text-primary px-5 "
                            onclick="resetarFiltro('form-filtro')">
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
<!-- imask -->
<script src="https://unpkg.com/imask"></script>
<script>
    // afiliado
    $('#modal-filtro .select-afiliado').select2({
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
</script>
