@extends('layouts.basic')
@section('title', 'Usuários')
@section('head')
    <!-- scripts necessários para a lib select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>
    <!-- / scripts necessários para a lib select2 -->
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Usuários</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Usuários</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">

            @hasanyrole('usuario_princ')


                @if ($totalUserCadastrei < $totalUserLimite)
                    @can('cad-user-secund')
                        <div class="mb-2 text-end mt-2">
                            <div class="alert alert-warning d-inline-block px-3 py-2" role="alert">
                                <i class="ti ti-info-circle me-1"></i>
                                Sua conta possui
                                <strong>
                                    {{ $totalUserCadastrei }}
                                </strong>
                                usuário(s) cadastrados, e você pode adicionar até
                                <strong>{{ $totalUserLimite }}</strong> usuário(s).

                                {{-- @if ($totalUserComprados < 10)
                                <a href="{{ route('usuarios.comprar') }}" class="btn btn-orange btn-sm ms-md-2 fs-3 px-3">
                                    Liberar mais usuários
                                </a>
                            @endif --}}


                            </div>
                        </div>
                    @endcan
                @else
                    @can('cad-user-secund')
                        <div class="mb-2 text-end mt-2">
                            <div class="alert alert-warning mt-2 text-center " role="alert">
                                <div class="fs-4">
                                    Você atingiu o limite de <strong> {{ $totalUserLimite }}</strong>
                                    {{ $totalUserLimite == 1 ? 'usuário para sua conta!' : 'usuários para sua conta!' }}
                                </div>
                                <a class=" btn btn-orange mt-2 px-4   " href="{{ route('usuarios.comprar') }}">
                                    Liberar mais usuários
                                </a>
                            </div>
                        </div>
                    @endcan
                @endif
            @endhasanyrole


            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <x-alerts.delete title="Deletar Usuário" desc="Você tem certeza de que deseja deletar este registro?" />



                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($usuarios->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="fs-4">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @canany(['cad-user-secund', 'cad-user'])
                            <div class="">
                                @if ($totalUserCadastrei < $totalUserLimite)
                                    <a class="btn btn-primary w-100  px-5" href="{{ route('usuario.novo') }}">
                                        <div class="px-lg-4 fs-4">Novo Usuário</div>
                                    </a>
                                @else
                                    @hasanyrole('super_admin|admin')
                                        <a class="btn btn-primary w-100  px-5" href="{{ route('usuario.novo') }}">
                                            <div class="px-lg-4 fs-4">Novo Usuário</div>
                                        </a>
                                    @endhasanyrole
                                @endif
                            </div>
                        @endcanany
                    </div>

                    @if ($usuarios->count() == 0)
                        <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                            Não existem usuário(s) cadastrado(s).
                        </div>
                    @else
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover table-striped table-hover  ">
                                <thead>
                                    <tr class="border-0 text-center">
                                        <th scope="" class="p-0 border-0 pb-2 pe-3">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                Nome / Razão Social
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                Whatsapp
                                            </div>
                                        </th>
                                        @hasanyrole('super_admin|admin')
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Cadastrado por
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Nível
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate ">
                                                    Plano
                                                </div>
                                            </th>
                                        @endhasanyrole
                                        <th scope="col " class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate ">
                                                Permissões
                                            </div>
                                        </th>
                                        <th scope="col " class="py-0 border-0 pb-2 px-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                <div class="">Ações</div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">

                                    @foreach ($usuarios as $usuario)
                                        @php
                                            if ($usuario->hasRole('super_admin')) {
                                                continue;
                                            }
                                        @endphp
                                        <tr class="align-items-center ">
                                            <td class="border-0 py-2 col-md-2 ">
                                                <div class=" fw-semibold px-1 pt-2  text-truncate pe-3">
                                                    @if ($usuario->tipo_usuario == null or $usuario->tipo_usuario == 'PF')
                                                        {{ $usuario->nome_usuario }}
                                                    @endif
                                                    @if ($usuario->tipo_usuario == 'PJ')
                                                        {{ $usuario->razao_social }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                    {{ fmtNumCelular($usuario->whatsapp) }}
                                                </div>
                                            </td>
                                            @hasanyrole('super_admin|admin')
                                                <td class=" border-0 py-2 text-center">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 ">
                                                        <div class="" style="padding-right: 4px">
                                                            @if ($usuario->cadastrado_por)
                                                                {{ $usuario->cadastradoPor[0]['nome_usuario'] }}
                                                            @else
                                                                -
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2 text-truncate">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        @if ($usuario->hasRole('usuario_princ'))
                                                            Usuário Princ.
                                                        @endif
                                                        @if ($usuario->hasRole('usuario_sec'))
                                                            Usuário Sec.
                                                        @endif
                                                        @if ($usuario->hasRole('admin'))
                                                            Admin
                                                        @endif
                                                        @if ($usuario->hasRole('afiliado'))
                                                            Afiliado
                                                        @endif
                                                    </div>
                                                </td>
                                                {{-- {{dd(\App\Models\User::get(['cpf', 'cnpj', 'tipo_usuario'])->toArray())}} --}}

                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        @if ($usuario->subscription())
                                                            {{ $usuario->subscription()->plan->modulo->titulo }} -
                                                            {{ ucfirst($usuario->subscription()->plan->nome) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                            @endhasanyrole
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                    @if ($usuario->nivel_id == 2)
                                                        {{ count($usuario->getPermissionNames()) }} /
                                                        @php
                                                            $tot = \Spatie\Permission\Models\Permission::where(
                                                                'level_id',
                                                                'like',
                                                                '%2%',
                                                            )->count();
                                                            if ($usuario->hasRole('usuario_sec')) {
                                                                $tot -= 7;
                                                            }
                                                        @endphp
                                                        {{ $tot }}
                                                    @endif
                                                    @if ($usuario->nivel_id == 1)
                                                        {{ count($usuario->getAllPermissions()) }} /
                                                        {{ \Spatie\Permission\Models\Permission::where('level_id', 'like', '%1%')->count() }}
                                                    @endif
                                                    @if ($usuario->nivel_id == 3)
                                                        {{ count($usuario->getAllPermissions()) }} /
                                                        {{ \Spatie\Permission\Models\Permission::where('level_id', 'like', '%3%')->count() }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class=" border-0 py-2">
                                                <div class=" fw-semibold px-1 pt-2 ">

                                                    <div class="d-flex justify-content-center gap-2">

                                                        @if ($usuario->id != auth()->user()->id)
                                                            @can('ver-permissoes')
                                                                <a href="{{ route('permissions.edit', $usuario->id) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Permissões" class="btn fs-7 text-dark p-0">
                                                                    <i class="ti ti-shield-check fs-7"></i>
                                                                </a>
                                                            @endcan

                                                            <a href="{{ route('usuario.visualizar', $usuario->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                                <i class="ti ti-eye fs-7"></i>
                                                            </a>

                                                            {{-- <a href="{{ route('usuario.editar', ['id' => $usuario->id]) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Editar" class="btn fs-7 text-primary p-0">
                                                                <i class="ti ti-edit fs-7"></i>
                                                            </a> --}}
                                                            @can('deletar-user')
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Deletar"
                                                                    class="btn fs-7 text-orange p-0"
                                                                    onclick="serUrlDelete(`{{ route('usuario.deletar', $usuario->id) }}`)">
                                                                    <i class="ti ti-trash fs-7"></i>
                                                                </button>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="mt-3">
                        {{ $usuarios->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal filtro --}}
    @include('pages.users._modal_filter')

@endsection
@section('scripts')
@endsection
