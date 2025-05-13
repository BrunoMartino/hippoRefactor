@extends('layouts.basic')
@section('title', 'Permissões')
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
                    <h4 class="fw-semibold mb-8">Permissões</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Permissões</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="mb-4">
                        @if ($users->count() > 0 || request()->query())
                            <button type="button" class="btn btn-orange  px-5" data-bs-toggle="modal"
                                data-bs-target="#modal-filtro">
                                <div class="">Filtrar</div>
                            </button>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-hover  ">
                            <thead>
                                <tr class="border-0 text-center">
                                    <th scope="" class="p-0 border-0 pb-2 pe-3">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            Nome
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            E-mail
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            Permissões
                                        </div>
                                    </th>
                                    @if (auth()->user()->nivel_id == 1)
                                        <th scope="" class="py-0 border-0 pb-2 ps-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Nível
                                            </div>
                                        </th>
                                    @endif
                                    <th scope="col " class="py-0 border-0 pb-2 px-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                            Ação
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @foreach ($users as $key => $user)
                                    @php
                                        if ($user->hasRole('super_admin')) {
                                            continue;
                                        }
                                    @endphp
                                    <tr class="align-items-center ">
                                        <td class="border-0 py-2 col-md-2 ">
                                            <div class=" fw-semibold px-1 pt-2  text-truncate">
                                                {{ $user->nome_usuario }}
                                            </div>
                                        </td>
                                        <td class="border-0 py-2 ">
                                            <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                {{ $user->email }}
                                            </div>
                                        </td>
                                        <td class="border-0 py-2 ">
                                            <div class=" fw-semibold  pt-2 text-center pe-3 ">
                                                @if ($user->nivel_id == 2)
                                                    {{ count($user->getPermissionNames()) }} /
                                                    @php
                                                        $tot = \Spatie\Permission\Models\Permission::where(
                                                            'level_id',
                                                            'like',
                                                            '%2%',
                                                        )->count();
                                                        if ($user->hasRole('usuario_sec')) {
                                                            $tot -= 7;
                                                        }
                                                    @endphp
                                                    {{ $tot }}
                                                @endif
                                                @if ($user->nivel_id == 1)
                                                    {{ count($user->getAllPermissions()) }} /
                                                    {{ \Spatie\Permission\Models\Permission::where('level_id', 'like', '%1%')->count() }}
                                                @endif
                                                @if ($user->nivel_id == 3)
                                                    {{ count($user->getAllPermissions()) }} /
                                                    {{ \Spatie\Permission\Models\Permission::where('level_id', 'like', '%3%')->count() }}
                                                @endif
                                            </div>
                                        </td>
                                        @if (auth()->user()->nivel_id == 1)
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                    @if ($user->hasRole('admin'))
                                                        Admin
                                                    @endif
                                                    @if ($user->hasRole('usuario_princ'))
                                                        Usuário Princ
                                                    @endif
                                                    @if ($user->hasRole('usuario_sec'))
                                                        Usuário Sec
                                                    @endif
                                                    @if ($user->hasRole('afiliado'))
                                                        Afiliado
                                                    @endif
                                                </div>
                                            </td>
                                        @endif

                                        <td class="border-0 py-2 px-3 pt-2 ">
                                            <div class="d-flex justify-content-center gap-2">
                                                @can('edit-permissoes')
                                                    {{-- <a name="" id="" class="btn btn-primary btn-sm"
                                                        href="{{ route('permissions.edit', $user->id) }}" role="button">
                                                        Editar Permissões
                                                    </a> --}}
                                                    <a href="{{ route('permissions.edit', $user->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Editar Permissões" class="btn fs-7 text-primary p-0">
                                                        <i class="ti ti-edit fs-7"></i>
                                                    </a>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($users->count() == 0)
                        <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                            Não existem usuário(s) cadastrado(s).
                        </div>
                    @endif

                    <div class="mt-4">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.permissions._modal_filter')
@endsection
