@extends('layouts.basic')
@section('title', 'Perfil do Usuário')
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
                            <li class="breadcrumb-item" aria-current="page">{{ $titulo }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12 pt-2">

            <x-alerts.success />
            <x-alerts.error />
            <x-alerts.warning />

            <form method="POST" action="{{ route('profile.update') }}" autocomplete="off" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <!-- Mudar foto -->
                @if (!is_null($usuario->cnpj) || !is_null($usuario->cpf))
                    <div class="card shadow overflow-hidden">
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-12 mb-3">
                                    <h2 class="h4">Mudar perfil</h2>
                                    <p class="card-subtitle mb-0">Mude sua foto de perfil aqui</p>
                                </div>
                                <div class="align-items-center text-center col-12 mb-3">
                                    <div class="position-relative">
                                        <div class="mx-auto img-thumbnail" id="img-perfil"
                                            style="width: 200px; height: 200px; background: url({{ $usuario->url_foto_perfil }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%">
                                        </div>
                                        <div class="p-4 text-center">
                                            <div class="button-group">
                                                <input type="file" class="form-control visually-hidden"
                                                    id="profile-photo" accept="image/png,image/jpeg,image/jpg"
                                                    name="foto_perfil" onchange="onFileChange()">
                                                <button type="button" class="btn btn-primary  px-3 fs-3 mb-1 me-1"
                                                    onclick="document.getElementById('profile-photo').click()">
                                                    <div class="px-lg-1">{{ is_null($usuario->foto_perfil) ? 'Enviar Foto' : 'Editar Foto' }}</div>
                                                </button>

                                                {{-- <button type="button" class="btn mb-1 me-1 btn-orange"
                                                    onclick="clearImageInput()">
                                                    Reiniciar
                                                </button> --}}
                                                <p class="mt-3">Permitido JPG, JPEG e PNG. Tamanho Máximo de 500kb</p>

                                                @error('foto_perfil')
                                                    <div class="text-danger fw-semibold">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Dados Pessoal -->
                <div class="card shadow overflow-hidden">
                    <div class="card-body">

                        <div class="row">
                            <div class="mb-3 col-sm-12 col-sm-6 col-md-3">
                                <div class="">
                                    <label for="tipo_usuario" class="form-label">Tipo de conta</label>
                                    <select class="form-select @error('tipo_usuario') is-invalid @enderror"
                                        name="tipo_usuario" id="tipo_usuario"
                                        @if (!is_null($usuario->cpf) || !is_null($usuario->cnpj)) disabled @endif>
                                        <option value="PF" @if (old('tipo_usuario', $usuario->tipo_usuario) == 'PF') selected @endif>Pessoa
                                            Física</option>
                                        <option value="PJ" @if (old('tipo_usuario', $usuario->tipo_usuario) == 'PJ') selected @endif>Pessoa
                                            Jurídica</option>
                                    </select>
                                    @error('tipo_usuario')
                                        <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12"></div>
                            <div class="mb-3 col-sm-12 col-md-6" id="col-nome">
                                <label class="form-label" for="nome">Nome<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nome_usuario') is-invalid @enderror"
                                    id="nome_usuario" name="nome_usuario"
                                    value="{{ old('nome_usuario', $usuario->nome_usuario) }}" disabled required>
                                @error('nome_usuario')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="email">E-mail<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $usuario->email) }}" disabled
                                    required>
                                @error('email')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6 " id="col-razao-social" style="display: none">
                                <label class="form-label" for="nome">Razão Social<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('razao_social') is-invalid @enderror"
                                    id="razao_social" name="razao_social"
                                    value="{{ old('razao_social', $usuario->razao_social) }}"
                                    @if (!is_null($usuario->razao_social)) disabled @endif required>
                                @error('razao_social')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6" id="col-cnpj" style="display: none">
                                <label class="form-label" for="cnpj">CNPJ<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" class="form-control @error('cnpj') is-invalid @enderror"
                                        id="cnpj" name="cnpj" value="{{ old('cnpj', $usuario->cnpj) }}" required
                                        data-validation-required-message="This field is required"
                                        @if (!is_null($usuario->cnpj)) disabled @endif
                                        placeholder="00.000.000/0000-00">
                                    @error('cnpj')
                                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6" id="col-cpf">
                                <label class="form-label" for="cpf">CPF<span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="text" class="form-control @error('cpf') is-invalid @enderror"
                                        id="cpf" name="cpf" value="{{ old('cpf', $usuario->cpf) }}" required
                                        data-validation-required-message="This field is required"
                                        @if (!is_null($usuario->cpf)) disabled @endif placeholder="000.000.000-00">
                                    @error('cpf')
                                        <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="whatsapp">Whatsapp<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                    id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $usuario->whatsapp) }}"
                                    placeholder="(99) 99999-9999" required>
                                @error('whatsapp')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="endereco">Endereço<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('endereco') is-invalid @enderror"
                                    value="{{ old('endereco', $usuario->endereco) }}" id="endereco" name="endereco"
                                    required data-validation-required-message="This field is required">
                                @error('endereco')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="cidade">Cidade<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror"
                                    id="cidade" name="cidade" value="{{ old('cidade', $usuario->cidade) }}"
                                    required>
                                @error('cidade')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="bairro">Bairro / Setor<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('bairro') is-invalid @enderror"
                                    id="bairro" value="{{ old('bairro', $usuario->bairro) }}" name="bairro" required
                                    data-validation-required-message="This field is required">
                                @error('bairro')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-sm-12 col-md-6">
                                <label class="form-label" for="estado">UF<span class="text-danger">*</span></label>
                                <select class="form-select @error('estado') is-invalid @enderror" name="estado"
                                    id="estado" required>
                                    <option value="">Selecione</option>
                                    <option value="AL" @if (old('estado', $usuario->estado) == 'AL') selected @endif>Alagoas - AL
                                    </option>
                                    <option value="AC" @if (old('estado', $usuario->estado) == 'AC') selected @endif>Acre - AC
                                    </option>
                                    <option value="AP" @if (old('estado', $usuario->estado) == 'AP') selected @endif>Amapá - AP
                                    </option>
                                    <option value="AM" @if (old('estado', $usuario->estado) == 'AM') selected @endif>Amazonas -
                                        AM
                                    </option>
                                    <option value="BA" @if (old('estado', $usuario->estado) == 'BA') selected @endif>Bahia - BA
                                    </option>
                                    <option value="CE" @if (old('estado', $usuario->estado) == 'CE') selected @endif>Ceará - CE
                                    </option>
                                    <option value="DF" @if (old('estado', $usuario->estado) == 'DF') selected @endif>Distrito
                                        Federal - DF</option>
                                    <option value="ES" @if (old('estado', $usuario->estado) == 'ES') selected @endif>Espírito
                                        Santo - ES</option>
                                    <option value="GO" @if (old('estado', $usuario->estado) == 'GO') selected @endif>Goiás - GO
                                    </option>
                                    <option value="MA" @if (old('estado', $usuario->estado) == 'MA') selected @endif>Maranhão -
                                        MA</option>
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
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 mt-4">
                            @if (!is_null($usuario->cnpj) || !is_null($usuario->cpf))
                                <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-4 mt-3">
                                    <button type="submit" class="btn btn-primary  px-5 fs-4">
                                        <div class="px-lg-5">Atualizar</div>
                                    </button>
                                    <a href="{{ route('dashboard') }}" class="btn btn-light  px-5 fs-4 text-primary">
                                        <div class="px-lg-5">Cancelar</div>
                                    </a>
                                </div>
                            @else
                                <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                                    <button type="submit" class="btn btn-primary  px-5 fs-4">
                                        <div class="px-lg-5">Salvar</div>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
            @if (!is_null($usuario->cnpj) || !is_null($usuario->cpf))
                <!-- Redefinir senha -->
                <div class="card shadow overflow-hidden">
                    <div class="card-body">
                        <div class="col-sm-12 col-md-12 mb-3">
                            <h2 class="h4">Redefinir senha</h2>
                            <p class="card-subtitle mb-0">Esqueceu sua senha? clique no botão abaixo para alterar</p>
                        </div>
                        <div class="col-md-6">
                            <form method="post" action="{{ route('logout.profile.page') }}" id="changePassword">
                                @csrf
                                <button type="submit" class="btn btn-orange mb-1 me-1  px-5 fs-4">
                                    <div class="px-lg-3">Alterar senha</div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function onFileChange() {
            let e = document.getElementById('profile-photo')
            let files = e.files || e.dataTransfer.files;
            console.log(files)
            if (!files.length) {
                return
            }
            createImage(files[0])
        }

        function createImage(file) {
            let reader = new FileReader()
            reader.onload = (e) => {
                // alert(e.target.result)
                document.getElementById('img-perfil').style.backgroundImage = 'url(' + e.target.result + ')'
            }
            reader.readAsDataURL(file)
        }

        function clearImageInput() {
            document.getElementById('profile-photo').value = '';
            let imgEmpty = "{{ asset('assets/images/profile/perfil-vazio.png') }}";
            document.getElementById('img-perfil').style.backgroundImage = "url(" + imgEmpty + ")";
        }

        function cancelChanges() {
            location.reload();
        }

        /* Alterar campos caso PF ou PJ */
        function toggleInputs() {
            let elRazao = document.getElementById('col-razao-social')
            let elNome = document.getElementById('col-nome')
            let elCpf = document.getElementById('col-cpf')
            let elCnpj = document.getElementById('col-cnpj')

            let inputCpf = document.getElementById('cpf')
            // let inputNome = document.getElementById('nome_usuario')
            let inputRazao = document.getElementById('razao_social')
            let inputCnpj = document.getElementById('cnpj')

            let elTipo = document.getElementById('tipo_usuario')

            if (elTipo.value == 'PF') {
                // alert('pf')
                elRazao.style.display = 'none'
                elCnpj.style.display = 'none'
                // elNome.style.display = 'block'
                elCpf.style.display = 'block'

                inputRazao.required = false
                inputCnpj.required = false
                // inputNome.required = true
                inputCpf.required = true



            } else {
                elRazao.style.display = 'block'
                elCnpj.style.display = 'block'
                // elNome.style.display = 'none'
                elCpf.style.display = 'none'

                inputRazao.required = true
                inputCnpj.required = true
                // inputNome.required = false
                inputCpf.required = false
            }

        }
        toggleInputs()
        document.getElementById('tipo_usuario').onchange = function() {
            toggleInputs()
        }
    </script>

    <!-- Imask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
    <script>
        const cpf = IMask(document.getElementById('cpf'), {
            mask: '000.000.000-00'
        });

        const cnpj = IMask(document.getElementById('cnpj'), {
            mask: '00.000.000/0000-00'
        });

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
