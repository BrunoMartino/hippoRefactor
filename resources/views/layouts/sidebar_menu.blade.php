<nav class="sidebar-nav scroll-sidebar mt-4" data-simplebar>
    <ul id="sidebarnav">
        <li class="sidebar-item">
            <a class="sidebar-link hover-mini-menu-expand" href="{{ route('dashboard') }}" aria-expanded="false">
                <span>
                    <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>

        @canany(['ver-user-cadast', 'ver-todos-users'])

            @php
                // Verificar se usuário princ só tem plano gratuito, ai não pode visualizar usuáros
                $showLink = true;

                if (
                    isset(user_princ()->subscriptionAll) &&
                    count(user_princ()->subscriptionAll) > 0 &&
                    !user_princ()
                        ->subscriptionAll()
                        ->where('status', 'ativo')
                        ->whereHas('plan', function ($query) {
                            $query->where('valor', '>', 0);
                        })
                        ->exists()
                ) {
                    $showLink = false;
                }
            @endphp
            @if ($showLink)
                <li class="sidebar-item">
                    <a class="sidebar-link hover-mini-menu-expand @if (Route::is('usuarios.*') || Route::is('usuario.*')) active @endif"
                        href="{{ route('usuarios') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Usuários</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('usuarios.*') || Route::is('usuario.*') || Route::is('permissions.*')) active @endif"
                        href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                        <span class="d-flex">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Usuários</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level @if (Route::is('usuarios.*') || Route::is('usuario.*') || Route::is('permissions.*')) in @endif">
                        <li class="sidebar-item">
                            <a href="{{ route('usuarios') }}"
                                class="sidebar-link @if (Route::is('usuarios.*') || Route::is('usuario.*')) active @endif">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu"> Usuários</span>
                            </a>
                        </li>
                        @can('ver-permissoes')
                            <li class="sidebar-item">
                                <a href="{{ route('permissions.index') }}"
                                    class="sidebar-link @if (Route::is('permissions.*')) active @endif"">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Permissões</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li> --}}
            @endif
        @endcanany


        @can('ver-logs-acesso')
            <li class="sidebar-item">
                <a class="sidebar-link hover-mini-menu-expand" href="{{ route('logs.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-file-delta"></i>
                    </span>
                    <span class="hide-menu">Logs</span>
                </a>
            </li>
        @endcan

        @hasanyrole('usuario_princ|usuario_sec')
            @canany(['ver-config-conta', 'ver-mensagens', 'ver-modulo-remarketing', 'ver-modulo-faturamento',
                'ver-modulo-cobrancas', 'ver-modulo-rastreamento', 'ver-import-remarketing', 'ver-import-cobrancas',
                'ver-import-faturamento', 'ver-import-rastreamento'])
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('config.*') || Route::is('messages.crud*')) active @endif"
                        href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                        <span class="d-flex">
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Configurações</span>
                    </a>

                    <ul aria-expanded="false" class="collapse first-level @if (Route::is('config.*') || Route::is('messages.crud*')) in @endif">

                        @canany(['ver-modulo-remarketing', 'ver-modulo-faturamento', 'ver-modulo-cobrancas',
                            'ver-modulo-rastreamento'])
                            @if (userHasModule(1) || userHasModule(2) || userHasModule(3) || userHasModule(4))
                                <li class="sidebar-item menu-level-2">
                                    <a class="sidebar-link has-arrow @if (Route::is('config.sistema.*')) active @endif"
                                        href="javascript:void(0)" aria-expanded="false">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Sistema</span>
                                    </a>
                                    <ul aria-expanded="false"
                                        class="collapse three-level @if (Route::is('config.sistema.*')) in @endif">
                                        @if (userHasModule(1))
                                            @can('ver-modulo-cobrancas')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.sistema.charges.index') }}"
                                                        class="sidebar-link @if (Route::is('config.sistema.charges.*')) active @endif ">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                                        </div>
                                                        <span class="hide-menu">Cobranças</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(2))
                                            @can('ver-modulo-faturamento')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.sistema.faturamento.index') }}"
                                                        class="sidebar-link @if (Route::is('config.sistema.faturamento.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Faturamento</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(4))
                                            @can('ver-modulo-rastreamento')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.sistema.rastreamento.index') }}"
                                                        class="sidebar-link @if (Route::is('config.sistema.rastreamento.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Rastreamento</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(3))
                                            @can('ver-modulo-remarketing')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.sistema.remarketing.index') }}"
                                                        class="sidebar-link @if (Route::is('config.sistema.remarketing.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Remarketing</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endcanany
                        @can('ver-mensagens')
                            <!-- Mensagens -->
                            <li class="sidebar-item menu-level-2">
                                <a class="sidebar-link  @if (Route::is('messages.crud*')) active @endif"
                                    href="{{ route('messages.crud.index') }}" aria-expanded="false">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Mensagens</span>
                                </a>
                            </li>
                        @endcan
                        @can('ver-config-conta')
                            @if (user_princ()->beta_user == false)
                                <!-- Conta -->
                                <li class="sidebar-item menu-level-2">
                                    <a class="sidebar-link has-arrow @if (Route::is('config.user-account.*')) active @endif"
                                        href="javascript:void(0)" aria-expanded="false">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Conta</span>
                                    </a>
                                    <ul aria-expanded="false"
                                        class="collapse three-level @if (Route::is('config.user-account.*')) in @endif">
                                        <!-- Plano atual -->
                                        <li class="sidebar-item">
                                            <a href="{{ route('config.user-account.current-plan') }}"
                                                class="sidebar-link @if (Route::is('config.user-account.current-plan*')) active @endif ">
                                                <div class="round-16 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                                </div>
                                                <span class="hide-menu">Plano atual</span>
                                            </a>
                                        </li>
                                        <!-- Financeiro -->
                                        <li class="sidebar-item">
                                            <a href="{{ route('config.user-account.financial') }}"
                                                class="sidebar-link @if (Route::is('config.user-account.financial*')) active @endif ">
                                                <div class="round-16 d-flex align-items-center justify-content-center">
                                                    <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                                </div>
                                                <span class="hide-menu">Financeiro</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endcan
                        @canany(['ver-import-remarketing', 'ver-import-cobrancas', 'ver-import-faturamento',
                            'ver-import-rastreamento'])
                            <!-- Dados importados -->
                            @if (userHasModule(1) || userHasModule(2) || userHasModule(3) || userHasModule(4))
                                <li class="sidebar-item menu-level-2">
                                    <a class="sidebar-link has-arrow @if (Route::is('config.import.*')) active @endif"
                                        href="javascript:void(0)" aria-expanded="false">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Dados importados</span>
                                    </a>
                                    <ul aria-expanded="false"
                                        class="collapse three-level @if (Route::is('config.import.*')) in @endif">
                                        @if (userHasModule(1))
                                            @can('ver-import-cobrancas')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.import.cb.imported-data') }}"
                                                        class="sidebar-link @if (Route::is('config.import.cb.*')) active @endif ">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle" style="opacity: 1 !important"></i>
                                                        </div>
                                                        <span class="hide-menu">Cobranças</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(2))
                                            @can('ver-import-faturamento')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.import.ft.imported-data') }}"
                                                        class="sidebar-link @if (Route::is('config.import.ft.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Faturamento</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(4))
                                            @can('ver-import-rastreamento')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.import.rt.imported-data') }}"
                                                        class="sidebar-link @if (Route::is('config.import.rt.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Rastreamento</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                        @if (userHasModule(3))
                                            @can('ver-import-remarketing')
                                                <li class="sidebar-item">
                                                    <a href="{{ route('config.import.rm.imported-data') }}"
                                                        class="sidebar-link @if (Route::is('config.import.rm.*')) active @endif">
                                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                                            <i class="ti ti-circle"></i>
                                                        </div>
                                                        <span class="hide-menu">Remarketing</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        @endcanany


                    </ul>
                </li>
            @endcanany


            @hasanyrole('usuario_princ|usuario_sec')
                @can('ver-relat-notif')
                    @if (userHasModule(1) || userHasModule(2) || userHasModule(3) || userHasModule(4))
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('messages.rm-report*') ||
                                    Route::is('messages.charge-report*') ||
                                    Route::is('messages.ft-report*') ||
                                    Route::is('messages.rt-report*')) active @endif"
                                href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                                <span class="d-flex">
                                    <i class="ti ti-report"></i>
                                </span>
                                <span class="hide-menu">Relatórios</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level @if (Route::is('messages.rm-report*') ||
                                    Route::is('messages.charge-report*') ||
                                    Route::is('messages.ft-report*') ||
                                    Route::is('messages.rt-report*')) in @endif">

                                @if (userHasModule(1))
                                    <li class="sidebar-item">
                                        <a href="{{ route('messages.charge-report.index') }}"
                                            class="sidebar-link @if (Route::is('messages.charge-report.*')) active @endif">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Cobranças</span>
                                        </a>
                                    </li>
                                @endif
                                @if (userHasModule(2))
                                    <li class="sidebar-item">
                                        <a href="{{ route('messages.ft-report.index') }}"
                                            class="sidebar-link @if (Route::is('messages.ft-report.*')) active @endif">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Faturamento</span>
                                        </a>
                                    </li>
                                @endif
                                @if (userHasModule(4))
                                    <li class="sidebar-item">
                                        <a href="{{ route('messages.rt-report.index') }}"
                                            class="sidebar-link @if (Route::is('messages.rt-report.*')) active @endif">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Rastreamento</span>
                                        </a>
                                    </li>
                                @endif
                                @if (userHasModule(3))
                                    <li class="sidebar-item">
                                        <a href="{{ route('messages.rm-report.index') }}"
                                            class="sidebar-link @if (Route::is('messages.rm-report.*')) active @endif">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Remarketing</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endcan
            @endhasanyrole
        @endhasanyrole


        @hasanyrole('super_admin|admin')
            @canany(['ver-cupons', 'ver-desc-mensais'])
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('coupons.*') || Route::is('descontos-mensais.*')) active @endif"
                        href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                        <span class="d-flex">
                            <i class="ti ti-discount"></i>
                        </span>
                        <span class="hide-menu">Descontos</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level @if (Route::is('coupons.*') || Route::is('descontos-mensais.*')) in @endif">
                        @can('ver-cupons')
                            <li class="sidebar-item">
                                <a href="{{ route('coupons.index') }}"
                                    class="sidebar-link @if (Route::is('coupons.*')) active @endif">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Cupons de desconto</span>
                                </a>
                            </li>
                        @endcan
                        @can('ver-desc-mensais')
                            <li class="sidebar-item">
                                <a href="{{ route('descontos-mensais.index') }}"
                                    class="sidebar-link @if (Route::is('descontos-mensais.*')) active @endif"">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Descontos mensais</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
        @endhasanyrole

        @can('ver-afiliados')
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('affiliates.*')) active @endif"
                    href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                    <span class="d-flex">
                        <i class="ti ti-affiliate"></i>
                    </span>
                    <span class="hide-menu">Afiliados</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level @if (Route::is('affiliates.*')) in @endif">
                    <li class="sidebar-item">
                        <a href="{{ route('affiliates.crud.index') }}"
                            class="sidebar-link @if (Route::is('affiliates.crud.*')) active @endif">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Afiliados</span>
                        </a>
                    </li>
                    @hasanyrole('super_admin|admin')
                        @can('ver-rend-afiliados-adm')
                            <li class="sidebar-item">
                                <a href="{{ route('affiliates.income') }}" class="sidebar-link">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Rendimentos</span>
                                </a>
                            </li>
                        @endcan
                    @endhasanyrole
                    {{-- <li class="sidebar-item">
                        <a href="{{ route('affiliates.links.index') }}" class="sidebar-link">
                            <div class="round-16 d-flex align-items-center justify-content-center">
                                <i class="ti ti-circle"></i>
                            </div>
                            <span class="hide-menu">Links</span>
                        </a>
                    </li> --}}
                    {{-- <li class="sidebar-item">
                        @can('ver-rend-afiliados-admin')
                            <a href="{{ route('affiliates-admin.index') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Rend. Afiliados</span>
                            </a>
                        @endcan
                    </li> --}}
                </ul>
            </li>
        @endcan

        @hasanyrole('afiliado')
            @can('ver-rend-afiliados')
                <li class="sidebar-item">
                    <a class="sidebar-link hover-mini-menu-expand  @if (Route::is('rend.afiliados.*')) active @endif"
                        href="{{ route('rend.afiliados.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-moneybag"></i>
                        </span>
                        <span class="hide-menu">Rend. Afiliados</span>
                    </a>
                </li>
            @endcan
        @endhasanyrole

        @canany(['ver-relat-financ', 'ver-relat-plano', 'ver-relat-mensagens-env', 'ver-relat-afiliados'])
            <li class="sidebar-item">

                <a class="sidebar-link has-arrow hover-mini-menu-expand @if (Route::is('reports.*')) active @endif"
                    href="javascript:void(0)" aria-expanded="false" onclick="setSidebarFull()">
                    <span class="d-flex">
                        <i class="ti ti-file-analytics"></i>
                    </span>
                    <span class="hide-menu">Relatórios</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level @if (Route::is('reports.*')) in @endif">
                    @can('ver-relat-financ')
                        <li class="sidebar-item">
                            <a href="{{ route('reports.financial') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Financeiro</span>
                            </a>
                        </li>
                    @endcan
                    @can('ver-relat-plano')
                        <li class="sidebar-item">
                            <a href="{{ route('reports.free.plan') }}"
                                class="sidebar-link @if (Route::is('reports.free.plan')) active @endif ">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Plano gratuito</span>
                            </a>
                        </li>
                    @endcan
                    @can('ver-relat-plano-pago')
                        <li class="sidebar-item">
                            <a href="{{ route('reports.paid.plan') }}"
                                class="sidebar-link @if (Route::is('reports.paid.plan')) active @endif ">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Plano pago</span>
                            </a>
                        </li>
                    @endcan
                    @can('ver-relat-mensagens-env')
                        <li class="sidebar-item">
                            <a href="{{ route('reports.sended.messages') }}" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Mensagens enviadas</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        @can('ver-planos')
            <li class="sidebar-item">
                <a class="sidebar-link hover-mini-menu-expand @if (Route::is('plans.*')) active @endif"
                    href="{{ route('planos') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-replace"></i>
                    </span>
                    <span class="hide-menu">Planos</span>
                </a>
            </li>
        @endcan


        @hasanyrole('usuario_sec_xxxx')
        @else
            <li class="sidebar-item">
                <a class="sidebar-link hover-mini-menu-expand @if (Route::is('sugestoes.*')) active @endif"
                    href="{{ route('sugestoes.index') }}" aria-expanded="false">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-settings-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12.483 20.935c-.862 .239 -1.898 -.178 -2.158 -1.252a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.08 .262 1.496 1.308 1.247 2.173" />
                            <path d="M16 19h6" />
                            <path d="M19 16v6" />
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        </svg>
                    </span>
                    <span class="hide-menu">Sugestões</span>
                </a>
            </li>
        @endhasanyrole
        @hasanyrole('usuario_princ|usuario_sec')
            <li class="sidebar-item">
                <a class="sidebar-link hover-mini-menu-expand" target="_blank"
                    href="{{ route('central.ajuda.introducao') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-help"></i>
                    </span>
                    <span class="hide-menu">Central de Ajuda</span>
                </a>
            </li>
        @endhasanyrole
        {{-- @can('ver-permissoes')
            <li class="sidebar-item">
                <a class="sidebar-link hover-mini-menu-expand @if (Route::is('permissions.*')) active @endif"
                    href="{{ route('permissions.index') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-checkup-list"></i>
                    </span>
                    <span class="hide-menu">Permissões</span>
                </a>
            </li>
        @endcan --}}


    </ul>
</nav>
