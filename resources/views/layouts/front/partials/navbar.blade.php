<nav class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" alt="HippoNotify" width="160">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
               <div class=""></div>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body pt-0">

                <ul class="navbar-nav justify-content-end flex-grow-1  gap-md-3 text-center text-md-start">
                    <li class="nav-item dropdown mb-1 mb-md-0">
                        <a class="nav-link" href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex gap-1 align-items-center justify-content-center justify-content-md-start">
                                Demos
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown mb-1 mb-md-0">
                        <a class="nav-link " href="#" id="dropdownId" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <div class="d-flex gap-1 align-items-center justify-content-center justify-content-md-start">
                                Pages
                                <i class="ti ti-chevron-down"></i>
                            </div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">Action 1</a>
                            <a class="dropdown-item" href="#">Action 2</a>
                        </div>
                    </li>
                    <li class="nav-item mb-1 mb-md-0">
                        <a class="nav-link" href="#">Documentation</a>
                    </li>
                    <li class="nav-item mb-2 mb-md-0">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                    @guest
                        <li class="nav-item ms-lg-2 mb-1 mb-md-0 " style="padding-top: 3px">
                            <a class="btn btn-primary btn-login px-3 py-1" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                    @auth
                        <li class="nav-item dropdown mb-1 mb-md-0">
                            <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                                    <div class="user-profile-img">
                                        <div class=""
                                            style="width: 35px; height: 35px; background: url({{ asset(auth()->user()->url_foto_perfil) }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%; margin-top: -3px">
                                        </div>

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
                                                    <img src="{{ asset('assets/images/svgs/icon-account.svg') }}" alt=""
                                                        width="24" height="24" />
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 fs-3 fw-semibold lh-base">Meu Perfil</h6>
                                                    <span class="fs-2 d-block text-body-secondary">Configurações da
                                                        conta</span>
                                                </div>
                                            </a>
                                            <a href="{{ route('dashboard') }}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                                <span
                                                    class="d-flex align-items-center justify-content-center text-bg-light rounded-1 p-6">
                                                    {{-- <img src="{{ asset('assets/images/svgs/icon-account.svg') }}"
                                                alt="" width="24" height="24" /> --}}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="#5d87ff" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M12 13m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                        <path d="M13.45 11.55l2.05 -2.05" />
                                                        <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                                                    </svg>
                                                </span>
                                                <div class="w-75 d-inline-block v-middle ps-3">
                                                    <h6 class="mb-1 fs-3 fw-semibold lh-base">Dashboard</h6>
                                                    <span class="fs-2 d-block text-body-secondary">Ver atividades</span>
                                                </div>
                                            </a>
                                        </div>
                                    @endcan
                                    <div class="d-grid py-4 px-7 pt-8">
                                        <a href="{{ route('sair') }}" class="btn btn-outline-primary">Sair</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </div>
</nav>
