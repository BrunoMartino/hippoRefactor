@extends('layouts.basic')
@section('title', 'Permissões')
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
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('permissions.index') }}">Permissões</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Editar Permissões</li>
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


                    @php
                        $userLogged = \App\Models\User::find(auth()->user()->id);
                        $blockEdit = false;
                        // Para usuário admin, ele pode editar apenas se usuários foi cadastrado por ele
                        if ($userLogged->hasRole('admin') && $user->cadastrado_por != $userLogged->id) {
                            $blockEdit = true;
                        }

                        // usuário principal pode editar apenas a permissões dos usuários q ele cadastrou
                        if ($userLogged->hasRole('usuario_princ') && $user->cadastrado_por != $userLogged->id) {
                            $blockEdit = true;
                        }

                        // usuario não pode editar permissoes dele mesmo
                        if ($user->id == auth()->user()->id) {
                            $blockEdit = true;
                        }
                    @endphp

                    @if ($blockEdit)
                        <div class="alert alert-light text-dark fs-4 mb-4" role="alert" style="background: #fff5df !important">
                            <i class="ti ti-info-circle fs-4"></i>
                            Você não pode alterar as permissões deste usuário porque ele não foi cadastrado por você.
                        </div>
                    @endif

                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="all-permissions">
                        <form action="{{ route('permissions.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            @foreach ($permissionsGroup as $key => $permissions)
                                @php
                                    if ($key == 'Usuários' && auth()->user()->nivel_id == 2) {
                                        continue;
                                    }
                                    if (auth()->user()->nivel_id == 2 && $key == 'Permissões') {
                                        continue;
                                    }

                                    if ($user->hasRole('usuario_sec') && $key == 'Permissões') {
                                        continue;
                                    }
                                    if ($user->hasRole('usuario_sec') && $key == 'Usuários') {
                                        continue;
                                    }
                                @endphp
                                <div class="pt-1 grupo-inputs grupo-{{ Str::slug($key) }}" id="grupo-{{ Str::slug($key) }}">
                                    <div class="fw-semibold fs-7">
                                        <div class="form-check form-switch d-flex">
                                            <input class="form-check-input " name="" value="" type="checkbox"
                                                onchange="checkAllOptioins(`grupo-{{ Str::slug($key) }}`)"
                                                id="checkbox-group-{{ Str::slug($key) }}"
                                                style="width: 43px; height: 22px; margin-top: 8px" />
                                            <label class="form-check-label fs-7 fw-semibold ms-3"
                                                for="checkbox-group-{{ Str::slug($key) }}">
                                                {{ $key }}
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Opções -->
                                    <div class="row mb-3 pb-3 pt-3 gy-4">
                                        @foreach ($permissions as $keyPermission => $permission)
                                            <!-- Enviar somente PJ -->
                                            <div class="col-12 col-lg-6">
                                                <div class="form-check form-switch d-flex">
                                                    <input class="form-check-input " name="permissions[]"
                                                        value="{{ $permission->name }}" type="checkbox"
                                                        onchange="initCheckAllSelectes()"
                                                        id="permission-{{ $keyPermission }}-{{ $permission }}"
                                                        style="width: 43px; height: 22px;"
                                                        @if ($user->hasPermissionTo($permission->name)) checked @endif />
                                                    <label class="form-check-label fs-4 fw-semibold ms-3"
                                                        for="permission-{{ $keyPermission }}-{{ $permission }}">
                                                        {{ $permission->description }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-3"></div>
                            <hr>

                            <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">

                                <button type="submit" class="btn btn-primary  px-5 fs-5" id="salvar">
                                    <div class="px-lg-5">Salvar</div>
                                </button>
                                <a href="{{ route('usuarios') }}" class="btn btn-light  px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Cancelar</div>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function checkAllOptioins(classNameGroup) {
            let els = document.querySelectorAll(`.${classNameGroup} input`)

            if (els[0].checked) {
                els.forEach(element => {
                    element.checked = true
                });
            } else {
                els.forEach(element => {
                    element.checked = false
                });
            }
        }

        function initCheckAllSelectes() {
            let groups = document.querySelectorAll(`.grupo-inputs`)
            let idsGroups = []

            groups.forEach(elementGroup => {
                // element.checked = true

                let els = document.querySelectorAll(`.${elementGroup.id} input`)
                let int = 0
                els.forEach((element, key) => {
                    if (key > 0 && element.checked == false)
                        int++;
                });

                if (int > 0)
                    document.querySelectorAll(`.${elementGroup.id} input`)[0].checked = false;
                else
                    document.querySelectorAll(`.${elementGroup.id} input`)[0].checked = true;

            });
        }

        initCheckAllSelectes()
    </script>

    <script>
        function start() {
            document.addEventListener("DOMContentLoaded", function() {
                // Seleciona todos os checkboxes dentro do container com a classe "all-permissions"
                const checkboxes = document.querySelectorAll(".all-permissions input[type='checkbox']");

                // Seleciona o botão com o ID "salvar"
                const salvarButton = document.getElementById("salvar");

                // Desabilita todos os checkboxes
                checkboxes.forEach(checkbox => {
                    checkbox.disabled = true;
                });

                // Desabilita o botão "salvar"
                if (salvarButton) {
                    salvarButton.disabled = true;
                }
            });
        }
    </script>

    @cannot('edit-permissoes')
        <script>
            start()
        </script>
    @endcannot

    @if ($blockEdit)
        <script>
            start()
        </script>
    @endif
@endsection
