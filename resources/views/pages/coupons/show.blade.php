@extends('layouts.basic')
@section('title', 'Visualizar Cupom')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Cupom</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('coupons.index') }}">Cupons de
                                    desconto</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Cupom</li>
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
                    <div class="row gy-3">
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-2">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Cupom:</strong></div>
                                <div class="fs-5">{{ $coupon->code }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Nome:</strong></div>
                                <div class="fs-5">{{ $coupon->name }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-7">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Descrição:</strong></div>
                                <div class="fs-5">{{ $coupon->description }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Qtd. total de cupons:</strong></div>
                                <div class="fs-5">{{ $coupon->qtd_total }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-9">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Qtd. de uso por cliente:</strong></div>
                                <div class="fs-5">{{ $coupon->qtd_uso }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Desconto:</strong></div>
                                <div class="fs-5">
                                    @if (is_null($coupon->value))
                                        Percentual:
                                    @else
                                        Valor:
                                    @endif

                                    @if (is_null($coupon->value))
                                        {{ $coupon->percent }}%
                                    @else
                                        R$ {{ number_format($coupon->value, 2, ',', '.') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Validade:</strong></div>
                                <div class="fs-5">{{ date('d/m/Y', strtotime($coupon->expiration_date)) }}</div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 col-sm-6 col-md-4 col-lg-5">
                            <div class="border-bottom pb-1">
                                <div class="fs-6"><strong>Recorrência:</strong></div>
                                <div class="fs-5">
                                    @if ($coupon->occurrence == 'sim')
                                        {{ $coupon->rec_duration }} {{$coupon->rec_duration == 1 ? 'Mês' : 'Meses'}}
                                    @else
                                        Não
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 col-12 ">
                            <div class="border-bottom pb-2">
                                <div class="fs-6 mb-1"><strong>Situação:</strong></div>
                                <div class="fs-5">
                                    @if ($coupon->situation == 'ativo')
                                        <span class="badge rounded-pill text-white bg-primary py-2 px-4 fs-4">Ativo</span>
                                    @else
                                        <span
                                            class="badge rounded-pill text-white badge-orange py-2 px-4 fs-4">Inativo</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('coupons.index') }}" class="btn btn-primary  px-5 fs-5">
                            <div class="px-lg-5">Voltar</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
    </script>
@endsection
