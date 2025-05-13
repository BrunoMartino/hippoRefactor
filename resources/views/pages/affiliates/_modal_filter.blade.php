<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Afiliados
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('affiliates.crud.index') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Nome-->
                        <li class="">
                            <label class="fs-5 fw-semibold">Nome:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="nome" class=" select-nome  form-control custom-select2"
                                        name="nome" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::where('nivel_id', 3)->get(['nome_usuario', 'id']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('nome') == $item->id) selected @endif>
                                                {{ $item->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- Whatsapp-->
                        <li class="">
                            <label class="fs-5 fw-semibold">Whatsapp:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="whatsapp" class=" select-whatsapp  form-control custom-select2"
                                        name="whatsapp" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::where('nivel_id', 3)->get(['whatsapp', 'id']) as $item)
                                            <option value="{{ $item->whatsapp }}"
                                                @if (request()->get('whatsapp') == $item->whatsapp) selected @endif>
                                                {{ fmtNumCelular($item->whatsapp) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- E-mail-->
                        <li class="">
                            <label class="fs-5 fw-semibold">E-mail:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="email" class=" select-email  form-control custom-select2"
                                        name="email" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::where('nivel_id', 3)->get(['email', 'id']) as $item)
                                            <option value="{{ $item->email }}"
                                                @if (request()->get('email') == $item->email) selected @endif>
                                                {{ $item->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- link -->
                        <li class="">
                            <label class="fs-5 fw-semibold mb-0 pb-0 lh-sm">Link: </label>
                            <div class="mt-1 mb-2">
                                <div class="mb-2">
                                    <input type="text" class="form-control" name="cod" id=""
                                        value="{{ request()->get('cod') }}" placeholder="*Apenas o código do link" />
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
    // nome
    $('#modal-filtro .select-nome').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // email
    $('#modal-filtro .select-email').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
    // whatsapp
    $('#modal-filtro .select-whatsapp').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    });
</script>
<!-- Mascaras de inputs -->
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
</script>
