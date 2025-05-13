@extends('layouts.basic')
@section('title', 'Editar Plano')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Editar Plano</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('planos') }}">Planos</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Editar Plano</li>
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
                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    <form method="POST" action="{{ route('plans.update', $plano['id']) }}" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4 gy-2 mt-2">
                            <div class="col-lg-1 mb-3">
                                <label class="form-label" for="nome">Ícone</label>
                                <div class="">
                                    <label for="icon" type="button"
                                        class="btn btn-toggle-icon btn-primary position-relative  overflow-hidden border-0">
                                        <img src="{{ asset($plano->icon) }}" alt="" height="25" id="icon-img">
                                        <div class="position-absolute  d-flex align-items-center justify-content-center fs-7 "
                                            style="width: 100%; height: 100%; background: rgba(000,000,000,.8); left: 0; top: 0">
                                            <i class="ti ti-circle-plus"></i>
                                        </div>
                                    </label>
                                    <input type="file" name="icon" class="visually-hidden" id="icon"
                                        onchange="onFileChange()" accept="image/png,image/jpg,image/jpeg">
                                </div>
                            </div>
                            <div class="col-lg-2 mb-3">
                                <label class="form-label" for="color">Cor Principal</label>
                                <div class="p-1 border rounded-1">
                                    <div class="rounded-3 overflow-hidden " style="height: 30px">
                                        <input type="color"
                                            class="form-control p-0 border-0   @error('color')  is-invalid @enderror"
                                            id="color" name="color" value="{{ old('color', $plano['color']) }}"
                                            style="height: 41px; margin-top: -1px; margin-left: -1px; width: calc(100% + 2px)">
                                    </div>
                                </div>
                                @error('color')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="nome">Nome<span class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('nome') is-invalid @enderror"
                                    id="nome" name="nome" value="{{ old('nome', $plano['nome']) }}" readonly
                                    disabled>
                                @error('nome')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Módulo -->
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="modulo_id">Módulo<span class="text-danger">*</span></label>

                                <select class="form-select @error('modulo_id') is-invalid @enderror " name="modulo_id"
                                    id="modulo_id" disabled>
                                    @php
                                        $modulos = \App\Models\Modulo::get();
                                    @endphp
                                    @foreach ($modulos as $item)
                                        <option value="{{ $item->id }}"
                                            @if (old('modulo_id', $plano['modulo_id']) == $item->id) selected @endif>
                                            {{ ucfirst($item->titulo) }}
                                    @endforeach
                                </select>
                                @error('modulo_id')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="limite_mensagens">Limite de Mensagens<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control  @error('limite_mensagens') is-invalid @enderror"
                                    id="limite_mensagens" name="limite_mensagens"
                                    value="{{ old('limite_mensagens', $plano['limite_mensagens']) }}" required>
                                @error('limite_mensagens')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="valor_mensalidade">Valor da Mensalidade<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('valor') is-invalid @enderror"
                                    id="valor_mensalidade" name="valor"
                                    value="{{ old('valor', number_format($plano['valor'], 2, ',', '.')) }}" required>
                                @error('valor')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- </div>
                        <div class="row mb-4"> --}}
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="qtd_usuarios">Quantidade de Usuários<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('qtd_usuarios') is-invalid @enderror"
                                    id="qtd_usuarios" name="qtd_usuarios"
                                    value="{{ old('qtd_usuarios', $plano['qtd_usuarios']) }}" required>
                                @error('qtd_usuarios')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="instancias">Quantidade de Instâncias<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('qtd_instancias') is-invalid @enderror"
                                    id="instancias" name="qtd_instancias"
                                    value="{{ old('qtd_instancias', $plano['qtd_instancias']) }}" required>
                                @error('qtd_instancias')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 mb-3">
                                <label class="form-label" for="custo_excedente">Custo por Mensagem Excedente<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('custo_excedente') is-invalid @enderror"
                                    id="custo_excedente" name="custo_excedente"
                                    value="{{ old('custo_excedente', number_format($plano['custo_excedente'], 3, ',', '.')) }} }}"
                                    required @if ($plano['custo_excedente'] <= 0) disabled @endif>
                                @error('custo_excedente')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Salvar</div>
                            </button>
                            <a href="{{ route('planos') }}" class="btn btn-light  px-5 fs-5 text-primary">
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
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('valor_mensalidade'), {
                mask: [{
                        mask: ''
                    },
                    {
                        mask: 'num',
                        lazy: false,
                        blocks: {
                            num: {
                                mask: Number,
                                scale: 2,
                                thousandsSeparator: '.',
                                padFractionalZeros: true,
                                radix: ',',
                                mapToRadix: ['.'],
                            }
                        }
                    }
                ]
            }
        );

        IMask(
            document.getElementById('custo_excedente'), {
                mask: [{
                        mask: ''
                    },
                    {
                        mask: 'num',
                        lazy: false,
                        blocks: {
                            num: {
                                mask: Number,
                                scale: 3,
                                thousandsSeparator: '.',
                                padFractionalZeros: true,
                                radix: ',',
                                mapToRadix: ['.'],
                            }
                        }
                    }
                ]
            }
        );

        IMask(
            document.getElementById('limite_mensagens'), {
                mask: '00000000000'
            },
        );
        IMask(
            document.getElementById('qtd_usuarios'), {
                mask: '00000000000'
            },
        );
        IMask(
            document.getElementById('instancias'), {
                mask: '00000000000'
            },
        );
    </script>

    <script>
        function onFileChange() {
            let e = document.getElementById('icon')
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
                document.getElementById('icon-img').src = e.target.result
            }
            reader.readAsDataURL(file)
        }
    </script>
@endsection
