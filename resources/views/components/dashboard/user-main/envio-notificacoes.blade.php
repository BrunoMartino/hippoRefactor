<div class=" mb-sm-0 w-100">
    <div class="d-flex gap-3  justify-content-between text-white">
        <div class="">
            <h5 class="card-title fw-semibold text-white fs-8">
                <strong>Bem-vindo,
                    @php
                        $n = explode(' ', auth()->user()->nome_usuario)[0];
                        if (isset(explode(' ', auth()->user()->nome_usuario)[1])) {
                            $n .= ' ' . explode(' ', auth()->user()->nome_usuario)[1];
                        }
                    @endphp
                    {{-- {{ auth()->user()->nome_usuario }} --}}
                    {{ $n }}
                </strong>
            </h5>
        </div>
        <div class="position-relative ">
            <button type="button" class="btn btn-none border-0 d-flex px-1 py-0 fs-7" title="Filtrar"
                onclick="document.getElementById('drop-filtro-notific').style.display='block';">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none"
                    stroke="white" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 10a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M6 4v4" />
                    <path d="M6 12v8" />
                    <path d="M10 16a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M12 4v10" />
                    <path d="M12 18v2" />
                    <path d="M16 7a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                    <path d="M18 4v1" />
                    <path d="M18 9v11" />
                </svg>
            </button>

            <div class="dropdown-filter" id="drop-filtro-notific" style="display: none">
                <div class="dropdown-filter-body primary">
                    <button type="button" class="btn btn-non p-0 border-0 position-absolute fs-5 text-light"
                        onclick="document.getElementById('drop-filtro-notific').style.display='none';" title="Fechar"
                        style="right: 8px; top: 5px">
                        <i class="ti ti-x"></i>
                    </button>

                    <div class="">
                        <!-- ini -->
                        <div class="mb-3">
                            <label for="input-envio-notific-ini" class=" mb-1">
                                Data Inicial:
                            </label>
                            <input id="input-envio-notific-ini" class="form-control   w-100" type="date">
                        </div>

                        <div class="">
                            <label for="input-envio-notific-fin" class=" mb-1">
                                Data Final:
                            </label>
                            <input id="input-envio-notific-fin" class="form-control  w-100" type="date">
                        </div>

                        <div class="text-center mt-3">
                            <button id="btn-filtro-envio-notific" type="button" class="btn btn-orange btn-sm px-3">
                                Aplicar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--  -->
    <div class="mt-xxl-4 pt-2">
        <div class="lh-sm">
            <div class="text-orange fs-13"><strong id="envio-notificacoes-total-hoje">0</strong></div>
            <div class="fs-5">Notificações enviadas hoje.</div>
        </div>
    </div>
    <div class="mt-3">
        <div class="lh-sm">
            <div class="text-orange fs-13">
                <strong id="envio-notificacoes-total">0</strong>
            </div>
            <div class="fs-5" id="envio-notificacoes-text">Notificações enviadas nos últimos: 30 dias.</div>
        </div>
    </div>
</div>
