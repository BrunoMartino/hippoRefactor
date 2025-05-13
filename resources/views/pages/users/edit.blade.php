@extends('layouts.basic')
@section('title', 'Editar Usuário')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">{{ $titulo }}</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('usuarios') }}">Usuários</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">{{ $titulo }}</li>
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
                    
                    <form method="POST" action="{{ route('usuario.update', $usuario->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <div class="">
                                    <label class="form-label" for="foto_perfil">Foto de perfil</label>
                                    <input type="file" class="form-control visually-hidden " id="foto_perfil"
                                        accept="image/png,image/jpeg,image/jpg" name="foto_perfil"
                                        onchange="onFileChange()">
                                </div>
                                <div class="position-relative">
                                    <img src="{{ $usuario->url_foto_perfil }}" class="rounded-3" alt=""
                                        width="200" id="img-perfil">
                                    <button type="button"
                                        class="btn btn-light bg-white shadow border p-0 d-flex rounded-circle align-items-center justify-content-center"
                                        style="position: absolute; top: -5px; left: 170px; width: 40px; height: 40px"
                                        onclick="document.getElementById('foto_perfil').click()">
                                        <i class="ti ti-edit h4 m-auto"></i>
                                    </button>
                                </div>
                                @error('foto_perfil')
                                    <div class="text-danger small fw-semibold">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-lg-5">
                                <label class="form-label" for="nome">Nome<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nome_usuario') is-invalid @enderror"
                                    id="nome_usuario" name="nome_usuario"
                                    value="{{ old('nome_usuario', $usuario->nome_usuario) }}" required>
                                @error('nome_usuario')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="email">E-mail<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="whatsapp">Whatsapp<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                    id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $usuario->whatsapp) }}"
                                    required>
                                @error('whatsapp')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label class="form-label" for="cidade">Cidade<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror"
                                    id="cidade" name="cidade" value="{{ old('cidade', $usuario->cidade) }}" required>
                                @error('cidade')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label" for="estado">UF<span class="text-danger">*</span></label>
                                <select class="form-select @error('estado') is-invalid @enderror" name="estado"
                                    id="estado" required>
                                    <option value="">Selecione </option>
                                    <option value="AL" @if (old('estado', $usuario->estado) == 'AL') selected @endif>Alagoas - AL
                                    </option>
                                    <option value="AC" @if (old('estado', $usuario->estado) == 'AC') selected @endif>Acre - AC
                                    </option>
                                    <option value="AP" @if (old('estado', $usuario->estado) == 'AP') selected @endif>Amapá - AP
                                    </option>
                                    <option value="AM" @if (old('estado', $usuario->estado) == 'AM') selected @endif>Amazonas - AM
                                    </option>
                                    <option value="BA" @if (old('estado', $usuario->estado) == 'BA') selected @endif>Bahia - BA
                                    </option>
                                    <option value="CE" @if (old('estado', $usuario->estado) == 'CE') selected @endif>Ceará - CE
                                    </option>
                                    <option value="DF" @if (old('estado', $usuario->estado) == 'DF') selected @endif>Distrito
                                        Federal - DF</option>
                                    <option value="ES" @if (old('estado', $usuario->estado) == 'ES') selected @endif>Espírito Santo
                                        - ES</option>
                                    <option value="GO" @if (old('estado', $usuario->estado) == 'GO') selected @endif>Goiás - GO
                                    </option>
                                    <option value="MA" @if (old('estado', $usuario->estado) == 'MA') selected @endif>Maranhão - MA
                                    </option>
                                    <option value="MT" @if (old('estado', $usuario->estado) == 'MT') selected @endif>Mato Grosso
                                        - MT</option>
                                    <option value="MS" @if (old('estado', $usuario->estado) == 'MS') selected @endif>Mato Grosso
                                        do Sul - MS</option>
                                    <option value="MG" @if (old('estado', $usuario->estado) == 'MG') selected @endif>Minas Gerais
                                        - MG</option>
                                    <option value="PA" @if (old('estado', $usuario->estado) == 'PA') selected @endif>Pará - PA
                                    </option>
                                    <option value="PB" @if (old('estado', $usuario->estado) == 'PB') selected @endif>Paraíba - PB
                                    </option>
                                    <option value="PR" @if (old('estado', $usuario->estado) == 'PR') selected @endif>Paraná - PR
                                    </option>
                                    <option value="PE" @if (old('estado', $usuario->estado) == 'PE') selected @endif>Pernambuco -
                                        PE</option>
                                    <option value="PI" @if (old('estado', $usuario->estado) == 'PI') selected @endif>Piauí - PI
                                    </option>
                                    <option value="RJ" @if (old('estado', $usuario->estado) == 'RJ') selected @endif>Rio de
                                        Janeiro - RJ</option>
                                    <option value="RN" @if (old('estado', $usuario->estado) == 'RN') selected @endif>Rio Grande
                                        do Norte - RN</option>
                                    <option value="RS" @if (old('estado', $usuario->estado) == 'RS') selected @endif>Rio Grande
                                        do Sul - RS</option>
                                    <option value="RO" @if (old('estado', $usuario->estado) == 'RO') selected @endif>Rondônia -
                                        RO</option>
                                    <option value="RR" @if (old('estado', $usuario->estado) == 'RR') selected @endif>Roraima - RR
                                    </option>
                                    <option value="SC" @if (old('estado', $usuario->estado) == 'SC') selected @endif>Santa
                                        Catarina - SC</option>
                                    <option value="SP" @if (old('estado', $usuario->estado) == 'SP') selected @endif>São Paulo -
                                        SP</option>
                                    <option value="SE" @if (old('estado', $usuario->estado) == 'SE') selected @endif>Sergipe - SE
                                    </option>
                                    <option value="TO" @if (old('estado', $usuario->estado) == 'TO') selected @endif>Tocantins -
                                        TO</option>
                                    <option value="EX" @if (old('estado', $usuario->estado) == 'EX') selected @endif>Estrangeiro
                                    </option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
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
@endsection
@section('scripts')
    <script>
        function onFileChange() {
            let e = document.getElementById('foto_perfil')
            let files = e.files || e.dataTransfer.files;
            if (!files.length) {
                return
            }
            createImage(files[0])
        }

        function createImage(file) {
            let reader = new FileReader()
            reader.onload = (e) => {
                document.getElementById('img-perfil').src = e.target.result
            }
            reader.readAsDataURL(file)
        }
    </script>
    <!-- Imask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
    <script>
        const whats = IMask(document.getElementById('whatsapp'), {
            mask: [{
                    mask: '(00) 00000-0000'
                },
                // {
                //     mask: '00000000000000000000'
                // }
            ]
        });
    </script>
@endsection
