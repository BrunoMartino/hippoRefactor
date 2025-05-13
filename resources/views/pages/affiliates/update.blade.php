@extends('layouts.basic')
@section('title', 'Editar Afiliado')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Editar Afiliado</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('affiliates.crud.index') }}">Afiliados</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Editar Afiliado</li>
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
                    <form method="POST" action="{{ route('affiliates.crud.update', $affiliate->id) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="name">Nome<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" value="{{ old('name', $affiliate->user->nome_usuario) }}" name="name">
                                @error('name')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="email">E-mail<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" value="{{ old('email', $affiliate->user->email) }}" name="email">
                                @error('email')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 mb-3">
                                <label class="form-label" for="city">Cidade<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" value="{{ old('city', $affiliate->user->cidade) }}" name="city">
                                @error('city')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 col-lg-4">
                                <label class="form-label" for="address">Endereço<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" value="{{ old('address', $affiliate->user->endereco) }}" name="address">
                                @error('address')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 col-lg-4">
                                <label class="form-label" for="state">UF<span class="text-danger">*</span></label>
                                <select class="form-select @error('estado') is-invalid @enderror" name="state"
                                    id="state" required>
                                    <option value="">Selecione</option>
                                    <option value="AL" @if(old('state', $affiliate->user->estado) == 'AL') selected @endif>Alagoas - AL</option>
                                    <option value="AC" @if(old('state', $affiliate->user->estado) == 'AC') selected @endif>Acre - AC</option>
                                    <option value="AP" @if(old('state', $affiliate->user->estado) == 'AP') selected @endif>Amapá - AP</option>
                                    <option value="AM" @if(old('state', $affiliate->user->estado) == 'AM') selected @endif>Amazonas - AM</option>
                                    <option value="BA" @if(old('state', $affiliate->user->estado) == 'BA') selected @endif>Bahia - BA</option>
                                    <option value="CE" @if(old('state', $affiliate->user->estado) == 'CE') selected @endif>Ceará - CE</option>
                                    <option value="DF" @if(old('state', $affiliate->user->estado) == 'DF') selected @endif>Distrito Federal - DF</option>
                                    <option value="ES" @if(old('state', $affiliate->user->estado) == 'ES') selected @endif>Espírito Santo - ES</option>
                                    <option value="GO" @if(old('state', $affiliate->user->estado) == 'GO') selected @endif>Goiás - GO</option>
                                    <option value="MA" @if(old('state', $affiliate->user->estado) == 'MA') selected @endif>Maranhão - MA</option>
                                    <option value="MT" @if(old('state', $affiliate->user->estado) == 'MT') selected @endif>Mato Grosso - MT</option>
                                    <option value="MS" @if(old('state', $affiliate->user->estado) == 'MS') selected @endif>Mato Grosso do Sul - MS</option>
                                    <option value="MG" @if(old('state', $affiliate->user->estado) == 'MG') selected @endif>Minas Gerais - MG</option>
                                    <option value="PA" @if(old('state', $affiliate->user->estado) == 'PA') selected @endif>Pará - PA</option>
                                    <option value="PB" @if(old('state', $affiliate->user->estado) == 'PB') selected @endif>Paraíba - PB</option>
                                    <option value="PR" @if(old('state', $affiliate->user->estado) == 'PR') selected @endif>Paraná - PR</option>
                                    <option value="PE" @if(old('state', $affiliate->user->estado) == 'PE') selected @endif>Pernambuco - PE</option>
                                    <option value="PI" @if(old('state', $affiliate->user->estado) == 'PI') selected @endif>Piauí - PI</option>
                                    <option value="RJ" @if(old('state', $affiliate->user->estado) == 'RJ') selected @endif>Rio de Janeiro - RJ</option>
                                    <option value="RN" @if(old('state', $affiliate->user->estado) == 'RN') selected @endif>Rio Grande do Norte - RN</option>
                                    <option value="RS" @if(old('state', $affiliate->user->estado) == 'RS') selected @endif>Rio Grande do Sul - RS</option>
                                    <option value="RO" @if(old('state', $affiliate->user->estado) == 'RO') selected @endif>Rondônia - RO</option>
                                    <option value="RR" @if(old('state', $affiliate->user->estado) == 'RR') selected @endif>Roraima - RR</option>
                                    <option value="SC" @if(old('state', $affiliate->user->estado) == 'SC') selected @endif>Santa Catarina - SC</option>
                                    <option value="SP" @if(old('state', $affiliate->user->estado) == 'SP') selected @endif>São Paulo - SP</option>
                                    <option value="SE" @if(old('state', $affiliate->user->estado) == 'SE') selected @endif>Sergipe - SE</option>
                                    <option value="TO" @if(old('state', $affiliate->user->estado) == 'TO') selected @endif>Tocantins - TO</option>
                                    <option value="EX" @if(old('state', $affiliate->user->estado) == 'EX') selected @endif>Estrangeiro</option>
                                </select>
                                @error('state')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- comissão -->
                            <div class="col-md-6 mb-3 col-lg-3">
                                <label class="form-label" for="comission">Comissão (%)<span
                                        class="text-danger">*</span></label>
                                <input type="decimal" class="form-control @error('comission') is-invalid @enderror"
                                    id="comission" name="comission"
                                    value="{{ old('comission', $affiliate->comission) }}">
                                @error('comission')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- whatsapp -->
                            <div class="col-md-6 mb-3 col-lg-4">
                                <label class="form-label" for="whatsapp">Whatsapp<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                    id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $affiliate->user->whatsapp) }}">
                                @error('whatsapp')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Atualizar</div>
                            </button>
                            <a href="{{ route('affiliates.crud.index') }}" class="btn btn-light  px-5 fs-5 text-primary">
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
    <!-- Imask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
    <script>
        const whats = IMask(document.getElementById('whatsapp'), {
            mask: [{
                    mask: '(00) 00000-0000'
                },
                {
                    mask: '00000000000000000000'
                }
            ]
        });

        const comissao = IMask(
            document.getElementById('comission'), {
                mask: '000'
            }
        );
    </script>
@endsection
