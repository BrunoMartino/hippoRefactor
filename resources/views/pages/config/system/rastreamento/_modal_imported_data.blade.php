<div class="modal fade" id="modal-imported-data" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Dados Importados
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelImportedData()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">

                    <div class="fs-6 fw-semibold">
                        Selecione um ou mais grupos de dados
                    </div>

                    @php
                        $grupoDataImport = \App\Models\ImportedOrderGroup::where('user_id', user_princ()->id)
                            ->where('module_id', 4)
                            ->latest()
                            ->get();
                    @endphp
                    @if ($grupoDataImport->count() == 0)
                        <div class="alert alert-warning mt-3 mb-4" role="alert">
                            Você precisa importar dados e criar um grupo de importação.
                            <div class="mt-1">
                                <a class="btn btn-orange btn-sm" href="{{ route('config.import.rt.index') }}">
                                    Importar Dados
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="row mt-4 mb-5">
                            @php
                                $checkItemGroupAll = false;
                                if (is_array($dataConfigCharge->usar_dados_importados_import)) {
                                    if (empty($dataConfigCharge->usar_dados_importados_import)) {
                                        $checkItemGroupAll = true;
                                    }
                                }

                                if(!empty(old('groups_import')) && is_null(old('groups_import_all'))){
                                    $checkItemGroupAll = false;
                                }

                            @endphp
                            <div class="col-12 col-lg-12 mb-2 @if ($grupoDataImport->count() == 1) d-none @endif;">
                                <div class="form-check form-switch d-flex align-items-center">
                                    <input class="form-check-input " name="groups_import_all" type="checkbox"
                                        id="group-todos" style="width: 38px; height: 18px;"
                                        @if ($checkItemGroupAll) checked @endif />
                                    <label class="form-check-label fs-4 fw-semibold ms-3" for="group-todos">
                                        TODOS
                                    </label>

                                </div>
                            </div>
                            @foreach ($grupoDataImport as $item)
                                @php
                                    $checkItemGroup = false;

                                    if (is_array(old('groups_import', $dataConfigCharge->usar_dados_importados_import))) {
                                        if (in_array($item->id, old('groups_import', $dataConfigCharge->usar_dados_importados_import))) {
                                            $checkItemGroup = true;
                                        }
                                        if(is_null(old('groups_import'))){
                                            if (empty($dataConfigCharge->usar_dados_importados_import)) {
                                                $checkItemGroup = true;
                                            }
                                        }
                                    }

                                @endphp
                                <div class="col-12 col-lg-12 mb-2">
                                    <div class="form-check form-switch d-flex align-items-center">
                                        <input class="form-check-input check-imported-groups " name="groups_import[]"
                                            type="checkbox" id="group-{{ $item->id }}" value="{{ $item->id }}"
                                            style="width: 38px; height: 18px;" {{ $checkItemGroup ? 'checked' : '' }}
                                            onchange="changeGroupImport()" />
                                        <label class="form-check-label fs-4 fw-semibold ms-3"
                                            for="group-{{ $item->id }}">
                                            {{ $item->name }} - {{ $item->created_at->format('d/m/Y') }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-2">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">

                            @if ($grupoDataImport->count() > 0)
                                <button type="button" class="btn btn-primary  px-2 fs-3" onclick="saveImportedData()";>
                                    <div class="px-lg-5">Salvar</div>
                                </button>
                            @endif

                            <button onclick="cancelImportedData()" type="button"
                                class="btn btn-light  px-4 fs-3 text-primary">
                                <div class="px-lg-4">Cancelar</div>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
