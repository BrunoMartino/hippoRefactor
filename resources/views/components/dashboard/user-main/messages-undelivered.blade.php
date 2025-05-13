<div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-row">
                <div class="round-40 rounded-circle text-white d-flex align-items-center justify-content-center text-bg-danger"
                    style="background: var(--bs-orange) !important">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-mail-x">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M13.5 19h-8.5a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" />
                        <path d="M3 7l9 6l9 -6" />
                        <path d="M22 22l-5 -5" />
                        <path d="M17 22l5 -5" />
                    </svg>
                </div>
                <div class="ms-3 align-self-center">
                    <h4 class="mb-0 fs-5">Mensagens não entregues</h4>
                    <span class="text-muted"></span>
                </div>
                <div class="ms-auto align-self-center">
                    <h2 class="fs-7 mb-0"><strong>{{ $total }}</strong></h2>
                </div>
            </div>
        </div>
    </div>
</div>
