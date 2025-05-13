<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-danger"
                    {{-- #13deb9 --}} style="background: transparent !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-eye" style="color: #324d67">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                </div>
                <div class="ms-3 align-self-center">
                    <h4 class="mb-0 fs-5">Mensagens visualizadas</h4>
                    <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                    <h2 class="fs-7 mb-0 "><strong>{{ $total }}</strong></h2>
                </div>
            </div>
        </div>
    </div>
</div>
