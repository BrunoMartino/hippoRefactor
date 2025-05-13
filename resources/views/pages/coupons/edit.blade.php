@extends('layouts.basic')
@section('title', 'Editar Cupom')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Editar Cupom</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('coupons.index') }}">Cupons de
                                    desconto</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Editar Cupom</li>
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
                    <!-- form -->
                    <form action="{{ route('coupons.update', $coupon->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row gy-4">
                            <div class="col-12 col-lg-12">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="" value="{{ old('name', $coupon->name) }}"
                                    required />
                                @error('name')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-12">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    rows="5" required>{{ old('description', $coupon->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="code" class="form-label">Código</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" id="code" placeholder="" value="{{ old('code', $coupon->code) }}"
                                    maxlength="20" required />
                                @error('code')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="expiration_date" class="form-label">Validade</label>
                                <input type="date" class="form-control @error('expiration_date') is-invalid @enderror"
                                    name="expiration_date" id="expiration_date" placeholder=""
                                    value="{{ old('expiration_date', date('Y-m-d', strtotime($coupon->expiration_date))) }}"
                                    required />
                                @error('expiration_date')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="qtd_total" class="form-label">Qtd. total de cupons</label>
                                <input type="text" class="form-control @error('qtd_total') is-invalid @enderror"
                                    name="qtd_total" id="qtd_total" placeholder="0"
                                    value="{{ old('qtd_total', $coupon->qtd_total) }}" required />
                                @error('qtd_total')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="qtd_uso" class="form-label">Qtd. de uso por cliente</label>
                                <input type="text" class="form-control @error('qtd_uso') is-invalid @enderror"
                                    name="qtd_uso" id="qtd_uso" placeholder="0"
                                    value="{{ old('qtd_uso', $coupon->qtd_uso) }}" required />
                                @error('qtd_uso')
                                    <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="value" class="form-label">Desconto</label>
                                <div class="d-flex gap-2 justify-content-between align-items-center">
                                    <div class="">
                                        <input type="text" class="form-control @error('value') is-invalid @enderror"
                                            name="value" id="value" placeholder="0,00"
                                            value="{{ old('value', is_null($coupon->value) ? '' : number_format($coupon->value, 2, ',', '.')) }}"
                                            required />
                                        @error('value')
                                            <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="">
                                        ou
                                    </div>
                                    <div class="">
                                        <input type="text" class="form-control @error('percent') is-invalid @enderror"
                                            name="percent" id="percent" placeholder="%"
                                            value="{{ old('percent', $coupon->percent) }}" required />
                                        @error('percent')
                                            <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Recorrência / Duração -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="situation" class="form-label">Recorrência</label>
                                <div class="btns-check-custom">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input type="radio" class="btn-check" name="occurrence" value="sim"
                                            id="ocor-sim" autocomplete="off"
                                            @if (old('occurrence', $coupon->occurrence) == 'sim') checked @endif>
                                        <label class="btn btn-outline-primary" for="ocor-sim">Sim</label>
                                        <input type="radio" class="btn-check" name="occurrence" value="nao"
                                            id="ocor-nao" autocomplete="off"
                                            @if (old('occurrence', $coupon->occurrence) == 'nao') checked @endif>
                                        <label class="btn btn-outline-primary btn-check-orange" for="ocor-nao"
                                            style="">
                                            Nao
                                        </label>
                                    </div>
                                </div>
                                @error('occurrence')
                                    <div class="small text-danger fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                            <!-- Duração Recorrência -->
                            <div class="col-12 col-md-6 col-lg-3">
                                <label for="rec_duration" class="form-label">Duração Recorrência</label>

                                <div class="d-flex gap-2 align-items-center">
                                    <div class="">
                                        <input type="text"
                                            class="form-control @error('rec_duration') is-invalid @enderror"
                                            name="rec_duration" id="rec_duration" placeholder=""
                                            value="{{ old('rec_duration', $coupon->rec_duration) }}" />
                                        @error('rec_duration')
                                            <div class="invalid-feedback fw-semibold"> {{ $message }} </div>
                                        @enderror
                                    </div>
                                    <div class="" style="min-width: 47px" id="text-mes-recorrencia">
                                        (meses)
                                    </div>
                                </div>
                            </div>
                            <!-- situação -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 ">
                                <label for="situation" class="form-label">Situação</label>
                                <div class="btns-check-custom">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <input type="radio" class="btn-check" name="situation" value="ativo"
                                            id="success-outlined" autocomplete="off"
                                            @if (old('situation', $coupon->situation) == 'ativo') checked @endif>
                                        <label class="btn btn-outline-primary" for="success-outlined">Ativo</label>
                                        <input type="radio" class="btn-check" name="situation" value="desativado"
                                            id="danger-outlined" autocomplete="off"
                                            @if (old('situation', $coupon->situation) == 'desativado') checked @endif>
                                        <label class="btn btn-outline-primary btn-check-orange" for="danger-outlined"
                                            style="">
                                            Inativo
                                        </label>
                                    </div>
                                </div>
                                @error('situation')
                                    <div class="small text-danger fw-semibold"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Atualizar</div>
                            </button>
                            <a href="{{ route('coupons.index') }}" class="btn btn-light  px-5 fs-5 text-primary">
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
    <!-- imask -->
    <script src="https://unpkg.com/imask"></script>
    <script>
        IMask(
            document.getElementById('value'), {
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
            document.getElementById('percent'), {
                mask: '000'
            }
        );

        IMask(
            document.getElementById('qtd_total'), {
                mask: '000000000'
            }
        );
        IMask(
            document.getElementById('qtd_uso'), {
                mask: '000000000'
            }
        );

        function enableInputsDiscount() {
            if (document.getElementById('percent').value != '') {
                document.getElementById('value').value = ''
                document.getElementById('value').disabled = true
            } else {
                document.getElementById('value').disabled = false
            }

            if (document.getElementById('value').value != '') {
                document.getElementById('percent').value = ''
                document.getElementById('percent').disabled = true
            } else {
                document.getElementById('percent').disabled = false
            }
        }

        document.getElementById('percent').oninput = function() {
            enableInputsDiscount()
        }
        document.getElementById('value').oninput = function() {
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

        /* Duraçaõ Recorrência */
        document.getElementById('rec_duration').onkeyup = function() {
            if (document.getElementById('rec_duration').value == 1) {
                document.getElementById('text-mes-recorrencia').innerHTML = '(mês)'
            } else {
                document.getElementById('text-mes-recorrencia').innerHTML = '(meses)'
            }
        }
    </script>
@endsection
