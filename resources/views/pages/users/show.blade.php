@extends('layouts.basic')
@section('title', 'Visualizar Usuário')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Usuário</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('usuarios') }}">Usuários</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Usuário</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    
                    <div class="mx-auto img-thumbnail" id="img-perfil"
                        style="width: 200px; height: 200px; background: url({{ $user->url_foto_perfil }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%">
                    </div>
                    <div class="text-center">
                        <div class="fs-9">
                            {{ $user->nome_usuario }}
                        </div>
                        <div class="fs-5">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="row mt-4 gy-4 @hasanyrole('usuario_princ') justify-content-center @endhasanyrole">
                        @hasanyrole('super_admin|admin')
                            <div class="col-12 col-md-6 col-lg-3 fs-4 mb-3 ">
                                <div class="">
                                    <strong>Tipo de usuário:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    {{ $user->tipo_usuario ?? '--' }}
                                </div>
                            </div>
                            @if ($user->tipo_usuario == 'PJ')
                                <div class="col-12 col-md-6 col-lg-3 fs-4 mb-3 ">
                                    <div class="">
                                        <strong>Razão Social:</strong>
                                    </div>
                                    <div class="border-bottom pb-1">
                                        {{ $user->razao_social ?? '----' }}
                                    </div>
                                </div>
                            @endif
                            @if ($user->tipo_usuario == 'PJ')
                                <div class="col-12 col-md-6 col-lg-3 fs-4 mb-3 ">
                                    <div class="">
                                        <strong>CNPJ:</strong>
                                    </div>
                                    <div class="border-bottom pb-1">
                                        {{ $user->cnpj ?? '----' }}
                                    </div>
                                </div>
                            @else
                                <div class="col-12 col-md-6 col-lg-3 fs-4 mb-3 ">
                                    <div class="">
                                        <strong>CPF:</strong>
                                    </div>
                                    <div class="border-bottom pb-1">
                                        {{ $user->cnpj ?? '----' }}
                                    </div>
                                </div>
                            @endif
                        @endhasanyrole
                        <div class="col-12 col-md-6 col-lg-3 fs-4 mb-3 ">
                            <div class="">
                                <strong>Whatsapp:</strong>
                            </div>
                            <div class="border-bottom pb-1">
                                {{ $user->whatsapp ?? '----' }}
                            </div>
                        </div>
                        @hasanyrole('super_admin|admin')
                            <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                                <div class="">
                                    <strong>Endereço:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    {{ $user->endereco ?? '----' }}
                                </div>
                            </div>
                        @endhasanyrole
                        <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                            <div class="">
                                <strong>Cidade:</strong>
                            </div>
                            <div class="border-bottom pb-1">
                                {{ $user->cidade ?? '----' }}
                            </div>
                        </div>
                        <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                            <div class="">
                                <strong>UF:</strong>
                            </div>
                            <div class="border-bottom pb-1">
                                @if (old('estado', $user->estado) == 'AL')
                                    AL - Alagoas
                                @endif
                                @if (old('estado', $user->estado) == 'AC')
                                    AC - Acre
                                @endif
                                @if (old('estado', $user->estado) == 'AP')
                                    AP - Amapá
                                @endif
                                @if (old('estado', $user->estado) == 'AM')
                                    AM - Amazonas
                                @endif
                                @if (old('estado', $user->estado) == 'BA')
                                    BA - Bahia
                                @endif
                                @if (old('estado', $user->estado) == 'CE')
                                    CE - Ceará
                                @endif
                                @if (old('estado', $user->estado) == 'DF')
                                    DF - Distrito Federal
                                @endif
                                @if (old('estado', $user->estado) == 'ES')
                                    ES - Espírito Santo
                                @endif
                                @if (old('estado', $user->estado) == 'GO')
                                    GO - Goiás
                                @endif
                                @if (old('estado', $user->estado) == 'MA')
                                    MA - Maranhão
                                @endif
                                @if (old('estado', $user->estado) == 'MT')
                                    MT - Mato Grosso
                                @endif
                                @if (old('estado', $user->estado) == 'MS')
                                    MS - Mato Grosso do Sul
                                @endif
                                @if (old('estado', $user->estado) == 'MG')
                                    MG - Minas Gerais
                                @endif
                                @if (old('estado', $user->estado) == 'PA')
                                    PA - Pará
                                @endif
                                @if (old('estado', $user->estado) == 'PB')
                                    PB - Paraíba
                                @endif
                                @if (old('estado', $user->estado) == 'PR')
                                    PR - Paraná
                                @endif
                                @if (old('estado', $user->estado) == 'PE')
                                    PE - Pernambuco
                                @endif
                                @if (old('estado', $user->estado) == 'PI')
                                    PI - Piauí
                                @endif
                                @if (old('estado', $user->estado) == 'RJ')
                                    RJ - Rio de Janeiro
                                @endif
                                @if (old('estado', $user->estado) == 'RN')
                                    RN - Rio Grande do Norte
                                @endif
                                @if (old('estado', $user->estado) == 'RS')
                                    RS - Rio Grande do Sul
                                @endif
                                @if (old('estado', $user->estado) == 'RO')
                                    RO - Rondônia
                                @endif
                                @if (old('estado', $user->estado) == 'RR')
                                    RR - Roraima
                                @endif
                                @if (old('estado', $user->estado) == 'SC')
                                    SC - Santa Catarina
                                @endif
                                @if (old('estado', $user->estado) == 'SP')
                                    SP - São Paulo
                                @endif
                                @if (old('estado', $user->estado) == 'SE')
                                    SE - Sergipe
                                @endif
                                @if (old('estado', $user->estado) == 'TO')
                                    TO - Tocantins
                                @endif
                                @if (old('estado', $user->estado) == 'EX')
                                    ro - Estrang
                                @endif
                            </div>
                        </div>

                        <!--  -->
                        @hasanyrole('super_admin|admin')
                            <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                                <div class="">
                                    <strong>Cadastrado Por:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    @if ($user->cadastrado_por)
                                        {{ $user->cadastradoPor[0]['nome_usuario'] }}
                                    @else
                                        ---
                                    @endif
                                </div>
                            </div>
                            <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                                <div class="">
                                    <strong>Nível:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    @if ($user->hasRole('usuario_princ'))
                                        Usuário Princ.
                                    @endif
                                    @if ($user->hasRole('usuario_sec'))
                                        Usuário Sec.
                                    @endif
                                    @if ($user->hasRole('admin'))
                                        Admin
                                    @endif
                                    @if ($user->hasRole('afiliado'))
                                        Afiliado
                                    @endif
                                </div>
                            </div>
                            <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                                <div class="">
                                    <strong>Plano:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    @if ($user->plano)
                                        {{ ucfirst($user->plano->nome) }}
                                    @else
                                        ----
                                    @endif
                                </div>
                            </div>
                            <div class="col-12  col-md-6 col-lg-3 fs-4 mb-3">
                                <div class="">
                                    <strong>Modulo:</strong>
                                </div>
                                <div class="border-bottom pb-1">
                                    @if ($user->plano)
                                        {{ $user->plano->modulo->titulo }}
                                    @else
                                        ----
                                    @endif
                                </div>
                            </div>
                        @endhasanyrole
                    </div>
                    <div class="d-flex flex-column justify-content-start mb-4 flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('usuarios') }}" class="btn btn-primary  px-5 fs-5">
                            <div class="px-lg-5">Voltar</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
