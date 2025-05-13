<div class="modal fade" id="modal-filtro" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
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
                <form action="{{ route('config.import.rm.imported-data') }}" method="get" id="form-filtro">
                    <ul class="mx-3" style="list-style:circle ">
                        <!-- Nome-->
                        <li class="">
                            <label class="fs-5 fw-semibold">Nome:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2">
                                    <select id="g" class=" select-nome  form-control custom-select2"
                                        name="g" style="width: 100%; height: 36px">
                                        <option value=""></option>
                                        @foreach (\App\Models\ImportedOrderGroup::where('user_id', user_princ()->id)->where('module_id', 3)->get(['id','name']) as $item)
                                            <option value="{{ $item->id }}"
                                                @if (request()->get('g') == $item->id) selected @endif>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>

                        <!-- Data Importação -->
                        <li class="">
                            <label class="fs-5 fw-semibold">Data Importação:</label>
                            <div class="mt-2 mb-2">
                                <div class="mb-2 d-flex gap-3">
                                    <div class="w-100">
                                        <label for="">Mín</label>
                                        <input type="date" class="form-control" name="dt_min"
                                            id="" value="{{ request()->get('dt_min') }}"
                                            placeholder="" />
                                    </div>
                                    <div class="w-100">
                                        <label for="">Máx</label>
                                        <input type="date" class="form-control" name="dt_max"
                                            id="" value="{{ request()->get('dt_max') }}"
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

</script>
