@extends('layouts.basic')
@section('title', 'Novo usuário')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Novo Usuário</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Novo Usuário</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            @if ($boolUsuariosExcedidos)
                <div class="mb-2 text-end mt-2">
                    <div class="alert alert-warning mt-2 text-center " role="alert">
                        <div class="fs-4">
                            Você atingiu o limite de <strong> {{ $totalUserLimite }}</strong>
                            {{ $totalUserLimite == 1 ? 'usuário!' : 'usuários!' }}
                        </div>
                        <a class=" btn btn-orange mt-2 px-4   " href="{{ route('usuarios.comprar') }}">
                            Liberar mais usuários
                        </a>
                    </div>
                </div>
            @endif
            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />


                    @if (session('usuario_deletado'))
                        @php
                            $usuarioDeletado = session('usuario_deletado');
                        @endphp
                        <div class="alert alert-danger text-center fs-4" role="alert" id="restourar-email">
                            O usuário com o e-mail <strong>{{ $usuarioDeletado->email }}</strong> foi deletado. Deseja
                            restaurá-lo? Isso
                            enviará uma nova senha
                            para o e-mail.

                            <form action="{{ route('usuario.restourar', $usuarioDeletado->id) }}" method="post">
                                @csrf
                                <div class="mt-2 d-flex gap-2 justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-deletar-regitro">
                                        Sim
                                    </button>
                                    <button type="button" class="btn btn-light text-orange btn-sm px-3"
                                        onclick="document.getElementById('restourar-email').style.display='none';">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('usuario.salvar.novo') }}" autocomplete="off"
                        enctype="multipart/form-data" id="form">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <div class="">
                                    <label class="form-label" for="foto_perfil">Foto de perfil</label>
                                    <input type="file" class="form-control visually-hidden " id="foto_perfil"
                                        name="foto_perfil" onchange="onFileChange()"
                                        accept="image/png,image/jpeg,image/jpg">
                                </div>
                                <div class="position-relative">
                                    <img src="{{ asset('assets/images/profile/perfil-vazio.png') }}" class="rounded-3"
                                        alt="" width="200" id="img-perfil">
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
                                    id="nome_usuario" name="nome_usuario" value="{{ old('nome_usuario') }}" required>
                                @error('nome_usuario')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label class="form-label" for="email">E-mail<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="whatsapp">Whatsapp<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                    id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}"
                                    placeholder="(99) 99999-9999" required>
                                @error('whatsapp')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-6">
                                <label class="form-label" for="cidade">Cidade<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror"
                                    id="cidade" name="cidade" value="{{ old('cidade') }}" required>
                                @error('cidade')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label class="form-label" for="estado">UF<span class="text-danger">*</span></label>
                                <select class="form-select @error('estado') is-invalid @enderror" name="estado"
                                    id="estado" required>
                                    <option value="">Selecione </option>
                                    <option value="AL" @if (old('estado') == 'AL') selected @endif>Alagoas - AL
                                    </option>
                                    <option value="AC" @if (old('estado') == 'AC') selected @endif>Acre - AC
                                    </option>
                                    <option value="AP" @if (old('estado') == 'AP') selected @endif>Amapá - AP
                                    </option>
                                    <option value="AM" @if (old('estado') == 'AM') selected @endif>Amazonas - AM
                                    </option>
                                    <option value="BA" @if (old('estado') == 'BA') selected @endif>Bahia - BA
                                    </option>
                                    <option value="CE" @if (old('estado') == 'CE') selected @endif>Ceará - CE
                                    </option>
                                    <option value="DF" @if (old('estado') == 'DF') selected @endif>Distrito
                                        Federal - DF</option>
                                    <option value="ES" @if (old('estado') == 'ES') selected @endif>Espírito
                                        Santo - ES</option>
                                    <option value="GO" @if (old('estado') == 'GO') selected @endif>Goiás - GO
                                    </option>
                                    <option value="MA" @if (old('estado') == 'MA') selected @endif>Maranhão -
                                        MA
                                    </option>
                                    <option value="MT" @if (old('estado') == 'MT') selected @endif>Mato Grosso
                                        - MT</option>
                                    <option value="MS" @if (old('estado') == 'MS') selected @endif>Mato Grosso
                                        do Sul - MS</option>
                                    <option value="MG" @if (old('estado') == 'MG') selected @endif>Minas Gerais
                                        - MG</option>
                                    <option value="PA" @if (old('estado') == 'PA') selected @endif>Pará - PA
                                    </option>
                                    <option value="PB" @if (old('estado') == 'PB') selected @endif>Paraíba - PB
                                    </option>
                                    <option value="PR" @if (old('estado') == 'PR') selected @endif>Paraná - PR
                                    </option>
                                    <option value="PE" @if (old('estado') == 'PE') selected @endif>Pernambuco -
                                        PE</option>
                                    <option value="PI" @if (old('estado') == 'PI') selected @endif>Piauí - PI
                                    </option>
                                    <option value="RJ" @if (old('estado') == 'RJ') selected @endif>Rio de
                                        Janeiro - RJ</option>
                                    <option value="RN" @if (old('estado') == 'RN') selected @endif>Rio Grande
                                        do Norte - RN</option>
                                    <option value="RS" @if (old('estado') == 'RS') selected @endif>Rio Grande
                                        do Sul - RS</option>
                                    <option value="RO" @if (old('estado') == 'RO') selected @endif>Rondônia -
                                        RO</option>
                                    <option value="RR" @if (old('estado') == 'RR') selected @endif>Roraima - RR
                                    </option>
                                    <option value="SC" @if (old('estado') == 'SC') selected @endif>Santa
                                        Catarina - SC</option>
                                    <option value="SP" @if (old('estado') == 'SP') selected @endif>São Paulo -
                                        SP</option>
                                    <option value="SE" @if (old('estado') == 'SE') selected @endif>Sergipe - SE
                                    </option>
                                    <option value="TO" @if (old('estado') == 'TO') selected @endif>Tocantins -
                                        TO</option>
                                    <option value="EX" @if (old('estado') == 'EX') selected @endif>Estrangeiro
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

    @if ($boolUsuariosExcedidos)
        <!-- Desabilitar campos e botões de formulário -->
        <script>
            function desabilitarFormulario() {
                var formulario = document.getElementById('form');
                var elementos = formulario.elements;

                for (var i = 0; i < elementos.length; i++) {
                    elementos[i].disabled = true;
                }
            }
            desabilitarFormulario()
        </script>
    @endif
@endsection
