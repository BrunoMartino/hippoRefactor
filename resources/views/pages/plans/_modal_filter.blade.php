<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Filtrar Planos
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <div class="modal-body p-lg-4 pt-lg-3" id="body-1">

                <!-- Filtros -->
                <form action="{{ route('planos') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">

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
                        <!-- Nome -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Nome:</label>
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

                                    <div class=""></div>

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
    // modulo
    $('#modal-filtro .select-modulo').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    })

    // plano
    $('#modal-filtro .select-plano').select2({
        placeholder: '',
        dropdownParent: $('#modal-filtro'),
        "language": "pt-BR",
    })
</script>

<script src="https://unpkg.com/imask"></script>
<script>
    IMask(
        document.getElementById('qtd_msgs-min'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_msgs-max'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_dias-min'), {
            mask: '0000000000000'
        }
    );
    IMask(
        document.getElementById('qtd_dias-max'), {
            mask: '0000000000000'
        }
    );
</script>
