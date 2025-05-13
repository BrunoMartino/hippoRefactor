<header class="topbar">
    <div class="with-vertical">
        <nav class="navbar navbar-expand-lg p-0">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>

            <div class="d-block d-lg-none">
                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" width="180" alt="" />
            </div>
            <a class="navbar-toggler nav-icon-hover p-0 border-0" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="p-2">
                    <i class="ti ti-dots fs-7"></i>
                </span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                        @hasanyrole('usuario_princ')
                            {{-- 1 -> plano premium --}}
                            {{-- @if (auth()->user()->subscription()->plan_id != 1 && auth()->user()->subscription()->status == 'ativo') --}}
                            @can('ver-config-conta')
                            @if (auth()->user()->beta_user == false)
                                <li class="nav-item dropdown pe-lg-4">
                                    <a class=" btn btn-orange btn-sm "
                                        href="{{ route('config.user-account.change-plan-adquirir') }}">
                                        Trocar / Adquirir plano
                                    </a>
                                </li>
                            @endif
                            @endcan
                            {{-- @endif --}}
                        @endhasanyrole
                        <li class="nav-item dropdown">
                            <button class="nav-link nav-icon-hover" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                <i class="icon ti ti-settings fs-6"></i>
                            </button>
                        </li>
                        @if (false)
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-bell-ringing"></i>
                                    <div class="notification bg-primary rounded-circle"></div>
                                </a>
                                <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="d-flex align-items-center justify-content-between py-3 px-7">
                                        <h5 class="mb-0 fs-5 fw-semibold">Notificações</h5>
                                        <span class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm">5
                                            novas</span>
                                    </div>
                                    <div class="message-body" data-simplebar>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="{{ asset('assets/images/profile/user-1.jpg') }}"
                                                    alt="user" class="rounded-circle" width="48"
                                                    height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">Roman Joined the Team!
                                                </h6>
                                                <span class="fs-2 d-block text-body-secondary">Congratulate
                                                    him</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="{{ asset('assets/images/profile/user-2.jpg') }}"
                                                    alt="user" class="rounded-circle" width="48"
                                                    height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">New message</h6>
                                                <span class="fs-2 d-block text-body-secondary">Salma sent you
                                                    new message</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="{{ asset('assets/images/profile/user-3.jpg') }}"
                                                    alt="user" class="rounded-circle" width="48"
                                                    height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">Bianca sent payment</h6>
                                                <span class="fs-2 d-block text-body-secondary">Check your
                                                    earnings</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../assets/images/profile/user-4.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">Jolly completed tasks
                                                </h6>
                                                <span class="fs-2 d-block text-body-secondary">Assign her new
                                                    tasks</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../assets/images/profile/user-5.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">John received payment
                                                </h6>
                                                <span class="fs-2 d-block text-body-secondary">$230 deducted
                                                    from account</span>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="py-6 px-7 d-flex align-items-center dropdown-item">
                                            <span class="me-3">
                                                <img src="../assets/images/profile/user-1.jpg" alt="user"
                                                    class="rounded-circle" width="48" height="48" />
                                            </span>
                                            <div class="w-75 d-inline-block v-middle">
                                                <h6 class="mb-1 fw-semibold lh-base">Roman Joined the Team!
                                                </h6>
                                                <span class="fs-2 d-block text-body-secondary">Congratulate
                                                    him</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="py-6 px-7 mb-1">
                                        <button class="btn btn-outline-primary w-100">See All
                                            Notifications</button>
                                    </div>

                                </div>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link pe-0" href="javascript:void(0)" id="drop1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex align-items-center">
                                    <div class="user-profile-img">
                                        <div class=""
                                            style="width: 35px; height: 35px; background: url({{ asset(auth()->user()->url_foto_perfil) }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%">
                                        </div>
                                        {{-- <img src="{{ asset(auth()->user()->url_foto_perfil) }}"
                                            class="rounded-circle" width="35" height="35" alt="" /> --}}
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                                aria-labelledby="drop1">
                                <div class="profile-dropdown position-relative" data-simplebar>
                                    {{-- <div class="py-3 px-7 pb-0">
                                        <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                    </div> --}}
                                    <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                        <div class=""
                                            style="width: 80px; height: 80px; background: url({{ asset(auth()->user()->url_foto_perfil) }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%">
                                        </div>

                                        <div class="ms-3">
                                            <h5 class="mb-1 fs-3">{{ auth()->user()->nome_usuario }}</h5>
                                            <span class="mb-1 d-block small">{{ auth()->user()->nivel->nome }}</span>
                                            <p class="mb-0 d-flex align-items-center gap-2">
                                                <i class="ti ti-mail fs-4"></i> {{ auth()->user()->email }}
                                            </p>
                                        </div>
                                    </div>
                                    @can('edit-perfil')
                                        <div class="message-body">
                                            {{-- <a href="../main/page-user-profile.html" --}}
                                            <a href="{{ route('profile.index') }}"
                                                class="py-8 px-7 mt-8 d-flex align-items-center">
                                                <span
                                                    class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                    <img src="{{ asset('assets/images/svgs/icon-account.svg') }}"
                                                        alt="" width="24" height="24" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 fs-3 fw-semibold lh-base">Meu Perfil</h6>
                                                    <span class="fs-2 d-block text-body-secondary">Configurações da
                                                        conta</span>
                                                </div>
                                            </a>
                                        </div>
                                        @hasanyrole('super_admin|admin')
                                        @else
                                            <div class="message-body">
                                                <a type="button" onclick="cancelAccount()"
                                                    class="py-8 px-7 mt-8 d-flex align-items-center">
                                                    <span
                                                        class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                        {{-- <img src="{{ asset('assets/images/svgs/icon-account.svg') }}"
                                                        alt="" width="24" height="24" /> --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="#fa896b"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-ban">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                                                            <path d="M5.7 5.7l12.6 12.6" />
                                                        </svg>
                                                    </span>
                                                    <div class="w-75 d-inline-block v-middle ps-3">
                                                        <h6 class="mb-1 fs-3 fw-semibold lh-base">Cancelar Conta</h6>
                                                        <span class="fs-2 d-block text-body-secondary">
                                                            {{-- Desative sua conta --}}
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        @endhasanyrole
                                    @endcan
                                    <div class="d-grid py-4 px-7 pt-8">
                                        <a href="{{ route('sair') }}" class="btn btn-outline-primary">Sair</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

</header>
