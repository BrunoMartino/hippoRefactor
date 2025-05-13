@extends('layouts.basic')
@section('title', 'Editar Desconto')
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
                    <h4 class="fw-semibold mb-8">Editar Desconto</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('coupons.index') }}">Cupons de
                                    desconto</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Editar Desconto</li>
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
                    <!-- form -->
                    <form action="{{ route('descontos-mensais.update', $md->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <!-- cliente -->
                            <div class="col-12 col-lg-4">
                                <label for="cliente" class="form-label">Cliente</label>
                                <div class="">
                                    <select id="cliente" class=" select-cliente  form-control custom-select2"
                                        name="user_id" style="width: 100%; height: 36px" required>
                                        @if (old('user_id', $md->user_id))
                                            <option value="{{ old('user_id', $md->user_id) }}"
                                                data-select2-id="{{ old('user_id', $md->user_id) }}">
                                                @php
                                                    $us = \App\Models\User::find(old('user_id', $md->user_id));
                                                @endphp
                                                @if ($us)
                                                    {{ $us->nome_usuario }}
                                                @endif
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('user_id')
                                    <div class="small fw-semibold text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- modulo -->
                            <div class="col-12 col-lg-4">
                                <label for="modulo" class="form-label">Módulo</label>
                                <div class="">
                                    <select id="modulo" class=" select-modulo  form-control custom-select2"
                                        name="modulo_id" style="width: 100%; height: 36px" required>
                                        @if (old('modulo_id', $md->modulo_id))
                                            <option value="{{ old('modulo_id', $md->modulo_id) }}"
                                                data-select2-id="{{ old('modulo_id', $md->modulo_id) }}">
                                                @php
                                                    $modu = \App\Models\Modulo::find(old('modulo_id', $md->modulo_id));
                                                @endphp
                                                @if ($modu)
                                                    {{ $modu->titulo }}
                                                @endif
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('modulo_id')
                                    <div class="small fw-semibold text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- plano -->
                            <div class="col-12 col-lg-4">
                                <label for="plano" class="form-label">Plano</label>
                                <div class="">
                                    <select id="plano" class=" select-plano   form-control custom-select2"
                                        name="plano_id" style="width: 100%; height: 36px" required>
                                        @if (old('plano_id', $md->plano->id))
                                            <option value="{{ old('plano_id', $md->plano->id) }}"
                                                data-select2-id="{{ old('plano_id', $md->plano->id) }}">
                                                @php
                                                    $pla = \App\Models\Plano::find(old('plano_id', $md->plano->id));
                                                @endphp
                                                @if ($pla)
                                                    {{ ucfirst($pla->nome) }}
                                                @endif
                                            </option>
                                        @endif
                                    </select>
                                </div>
                                @error('plano_id')
                                    <div class="small fw-semibold text-danger"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- Desconto -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <label for="valor" class="form-label">Desconto</label>
                                <div class="d-flex gap-2 justify-content-between align-items-center">
                                    <div class="">
                                        <input type="text" class="form-control @error('valor') is-invalid @enderror"
                                            name="valor" id="valor" placeholder="0,00"
                                            value="{{ old('valor', number_format($md->valor, 2, ',', '.')) }}" required />
                                        @error('valor')
                                            <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class=""> ou </div>
                                    <div class="">
                                        <input type="text"
                                            class="form-control @error('porcentagem') is-invalid @enderror"
                                            name="porcentagem" id="porcentagem" placeholder="%"
                                            value="{{ old('porcentagem', $md->porcentagem) }}" required />
                                        @error('porcentagem')
                                            <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Data Ínicio -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <label for="dt_inicio" class="form-label">Data Ínicio</label>
                                <input type="month" class="form-control @error('dt_inicio') is-invalid @enderror"
                                    name="dt_inicio" id="dt_inicio" placeholder=""
                                    value="{{ old('dt_inicio', date('Y-m', strtotime($md->dt_inicio))) }}" required />
                                @error('dt_inicio')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- Data Termino -->
                            <div class="col-12 col-md-6 col-lg-4">
                                <label for="dt_termino" class="form-label">Data Termino</label>
                                <input type="month" class="form-control @error('dt_termino') is-invalid @enderror"
                                    name="dt_termino" id="dt_termino" placeholder=""
                                    value="{{ old('dt_termino', date('Y-m', strtotime($md->dt_termino))) }}" required />
                                @error('dt_termino')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Salvar</div>
                            </button>
                            <a href="{{ route('descontos-mensais.index') }}"
                                class="btn btn-light  px-5 fs-5 text-primary">
                                <div class="px-lg-5">Cancelar</div>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        // cliente
        $('.select-cliente').select2({
            placeholder: 'Busque o cliente',
            "language": "pt-BR",
            ajax: {
                url: `{{ route('descontos-mensais.clientes') }}`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data)
                    dataLivros = data // populando o array
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nome_usuario,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true,
            }
        });

        // modulo
        $('.select-modulo').select2({
            placeholder: 'Busque o módulo',
            "language": "pt-BR",
            ajax: {
                url: `{{ route('descontos-mensais.modulos') }}`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data)
                    dataLivros = data // populando o array
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.titulo,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // plano
        $('.select-plano').select2({
            placeholder: 'Busque o plano',
            "language": "pt-BR",
            ajax: {
                url: `{{ route('descontos-mensais.planos') }}`,
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log(data)
                    dataLivros = data // populando o array
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nome.charAt(0).toUpperCase() + item.nome.slice(1),
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
@section('scripts')
    <!-- imask -->
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('valor'), {
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
            document.getElementById('porcentagem'), {
                mask: '000'
            }
        );

        function enableInputsDiscount() {
            if (document.getElementById('porcentagem').value != '') {
                document.getElementById('valor').value = ''
                document.getElementById('valor').disabled = true
            } else {
                document.getElementById('valor').disabled = false
            }

            if (document.getElementById('valor').value != '') {
                document.getElementById('porcentagem').value = ''
                document.getElementById('porcentagem').disabled = true
            } else {
                document.getElementById('porcentagem').disabled = false
            }
        }

        document.getElementById('porcentagem').oninput = function() {
            enableInputsDiscount()
        }
        document.getElementById('valor').oninput = function() {
            enableInputsDiscount()
        }
        enableInputsDiscount()

        /* Obrigar campo duração recorrencia casa seja sim a ocorrencia */
        function readonlyInputDuration() {
            let ocorrenciaSim = document.getElementById('ocor-sim')
            if (ocorrenciaSim.checked) {
                document.getElementById('rec_duration').disabled = false
                document.getElementById('rec_duration').required = true
            } else {
                document.getElementById('rec_duration').disabled = true
                document.getElementById('rec_duration').required = false
            }
        }
        document.getElementById('ocor-sim').onchange = function() {
            readonlyInputDuration()
        }
        document.getElementById('ocor-nao').onchange = function() {
            readonlyInputDuration()
        }
        readonlyInputDuration()
    </script>
@endsection
