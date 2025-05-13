<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Usuários
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <!-- Filtros -->
                <form action="{{ route('permissions.index') }}" method="get">
                    <ul class="mx-3 pt-2" style="list-style:circle ">
                        <!-- nome -->
                        <li class="">
                            <label class="fs-5 fw-semibold" for="nome">Nome:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="nome" class=" select-nome  form-control custom-select2"
                                        name="nome" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::orderBy('nome_usuario')->get() as $item)
                                            @php
                                                if ($item->hasRole('super_admin') || $item->id == auth()->user()->id) {
                                                    continue;
                                                }
                                                if (
                                                    auth()->user()->hasRole('usuario_princ') &&
                                                    $item->cadastrado_por != auth()->user()->id
                                                ) {
                                                    continue;
                                                }
                                            @endphp
                                            <option value="{{ $item->nome_usuario }}"
                                                @if (request()->get('nome') == $item->nome_usuario) selected @endif>
                                                {{ $item->nome_usuario }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                        <!-- E-mail -->
                        <li class="">
                            <label class="fs-5 fw-semibold">E-mail:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="email" class=" select-email  form-control custom-select2"
                                        name="email" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\User::orderBy('email')->get() as $item)
                                            @php
                                                if ($item->hasRole('super_admin') || $item->id == auth()->user()->id) {
                                                    continue;
                                                }
                                                if (
                                                    auth()->user()->hasRole('usuario_princ') &&
                                                    $item->cadastrado_por != auth()->user()->id
                                                ) {
                                                    continue;
                                                }
                                            @endphp
                                            <option value="{{ $item->email }}"
                                                @if (request()->get('email') == $item->email) selected @endif>
                                                {{ $item->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="" id="h-separador"></div>
                    <div class="text-center pt-3">
                        <button type="submit" class="btn btn-primary px-5 mt-4">
                            <div class="px-lg-4 fw-semibold">
                                Filtrar
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
    $('.select-nome').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro .modal-body'),
        "language": "pt-BR",
    });
    // email
    $('.select-email').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro .modal-body'),
        "language": "pt-BR",
    });

    setInterval(() => {
        if (document.getElementById('select2-nome-results')) {
            document.getElementById('h-separador').style.height = '110px'
        } else {
            // document.getElementById('h-separador').style.height='0px'
        }

        if (document.getElementById('select2-email-results')) {
            document.getElementById('h-separador').style.height = '150px'
        } else {
            // document.getElementById('h-separador').style.height='0px'
        }
    }, 400);
    setInterval(() => {
        if (document.getElementById('select2-nome-results') || document.getElementById(
            'select2-email-results')) {} else {
            document.getElementById('h-separador').style.height = '0px'
        }

    }, 100);
</script>
