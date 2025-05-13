<nav class="sidebar-nav scroll-sidebar mt-4" data-simplebar>
    <ul id="sidebarnav">

        {{-- ícones: https://tabler.io/icons --}}


            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.introducao')) active @endif"
                    href="{{ route('central.ajuda.introducao') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Introducao</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.registro')) active @endif"
                    href="{{ route('central.ajuda.registro') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Registro</span>
                </a>
            </li>
        @auth
            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.dashboard')) active @endif"
                    href="{{ route('central.ajuda.dashboard') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.menu.superior')) active @endif"
                    href="{{ route('central.ajuda.menu.superior') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Menu superior</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.usuarios')) active @endif"
                    href="{{ route('central.ajuda.usuarios') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Usuários</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow hover-mini-menu-expand" href="javascript:void(0)" aria-expanded="false"
                    onclick="setSidebarFull()">
                    {{-- <span class="d-flex">
                    <i class="ti ti-settings"></i>
                </span> --}}
                    <span class="hide-menu">Configurações</span>
                </a>

                <ul aria-expanded="false" class="collapse first-level">

                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link has-arrow @if (Route::is('config.user-account.*')) active @endif"
                            href="javascript:void(0)" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Conta</span>
                        </a>
                        <ul aria-expanded="false" class="collapse three-level">
                            <!-- Plano atual -->
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.conta.plano.atual') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.conta.plano.atual')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Plano atual</span>
                                </a>
                            </li>
                            <!-- Financeiro -->
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.conta.financeiro') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.conta.financeiro')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Financeiro</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link has-arrow @if (Route::is('central.ajuda.config.sistema.*')) active @endif"
                            href="javascript:void(0)" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Sistema</span>
                        </a>
                        <ul aria-expanded="false" class="collapse three-level">
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.sistema.cobrancas') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.sistema.cobrancas')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Cobranças</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.sistema.faturamento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.sistema.faturamento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Faturamento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.sistema.rastreamento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.sistema.rastreamento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Rastreamento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.sistema.remarketing') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.sistema.remarketing')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Remarketing</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link has-arrow @if (Route::is('central.ajuda.config.mensagens.*')) active @endif"
                            href="javascript:void(0)" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Mensagens</span>
                        </a>
                        <ul aria-expanded="false" class="collapse three-level">
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.apresentacao') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.apresentacao')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Apresentação</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.agradecimento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.agradecimento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Agradecimento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.aniversario') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.aniversario')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Aniversário</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.pesquisa.satisfacao') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.pesquisa.satisfacao')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Pesquisa Satisfação</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.cobrancas') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.cobrancas')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Cobranças</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.faturamento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.faturamento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Faturamento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.mensagens.relatorio') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.mensagens.relatorio')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Relatório</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link has-arrow @if (Route::is('central.ajuda.config.dados.importados.*')) active @endif"
                            href="javascript:void(0)" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Dados Importados</span>
                        </a>
                        <ul aria-expanded="false" class="collapse three-level">
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.dados.importados.apresentacao') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.dados.importados.apresentacao')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Apresentação</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.dados.importados.cobrancas') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.dados.importados.cobrancas')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Cobranças</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.dados.importados.faturamento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.dados.importados.faturamento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Faturamento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.dados.importados.rastreamento') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.dados.importados.rastreamento')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Rastreamento</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{ route('central.ajuda.config.dados.importados.remarketing') }}"
                                    class="sidebar-link @if (Route::is('central.ajuda.config.dados.importados.remarketing')) active @endif ">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                    </div>
                                    <span class="hide-menu">Remarketing</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--  --}}
                </ul>

            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow hover-mini-menu-expand" href="javascript:void(0)" aria-expanded="false"
                    onclick="setSidebarFull()">
                    {{-- <span class="d-flex">
                    <i class="ti ti-settings"></i>
                </span> --}}
                    <span class="hide-menu">Relatórios</span>
                </a>

                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link  @if (Route::is('central.ajuda.relat.apresentacao')) active @endif"
                            href="{{ route('central.ajuda.relat.apresentacao') }}" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Apresentação</span>
                        </a>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link  @if (Route::is('central.ajuda.relat.cobrancas')) active @endif"
                            href="{{ route('central.ajuda.relat.cobrancas') }}" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Cobranças</span>
                        </a>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link  @if (Route::is('central.ajuda.relat.faturamento')) active @endif"
                            href="{{ route('central.ajuda.relat.faturamento') }}" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Faturamento</span>
                        </a>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link  @if (Route::is('central.ajuda.relat.rastreamento')) active @endif"
                            href="{{ route('central.ajuda.relat.rastreamento') }}" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Rastreamento</span>
                        </a>
                    </li>
                    <li class="sidebar-item menu-level-2">
                        <a class="sidebar-link  @if (Route::is('central.ajuda.relat.remarketing')) active @endif"
                            href="{{ route('central.ajuda.relat.remarketing') }}" aria-expanded="false">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Remarketing</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link @if (Route::is('central.ajuda.sugestoes')) active @endif"
                    href="{{ route('central.ajuda.sugestoes') }}" aria-expanded="false">
                    {{-- <span>
                    <i class="ti ti-analyze"></i>
                </span> --}}
                    <span class="hide-menu">Sugestões</span>
                </a>
            </li>
        @endauth
    </ul>
</nav>
