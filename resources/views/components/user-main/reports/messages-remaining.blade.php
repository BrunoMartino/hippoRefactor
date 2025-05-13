<div>
    <div class="card">
        <div class="card-body py-3 px-4">
            <div class="d-flex flex-row">
                <div class="">
                    <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-danger"
                        style="background: var(--bs-orange) !important">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-message">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 9h8" />
                            <path d="M8 13h6" />
                            <path
                                d="M18 4a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-5l-5 3v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12z" />
                        </svg>
                    </div>
                </div>
                <div class="ms-3 align-self-center">
                    <h4 class="mb-0 fs-5">Mensagens Restantes</h4>
                    <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center ps-3">
                    <h2 class="fs-7 mb-0">{{ number_format($total, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
