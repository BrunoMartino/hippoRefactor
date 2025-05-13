@extends('layouts.basic')
@section('title', 'Cupons de desconto')
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
                    <h4 class="fw-semibold mb-8">Cupons de desconto</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Cupons de desconto</li>
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
                    <x-alerts.delete title="Deletar Cupom" desc="Você tem certeza de que deseja deletar este registro?" />
                    <x-alerts.disable title="Desativar Cupom" desc="Você tem certeza de que deseja desativar este cupom?" />
                    <x-alerts.active title="Ativar Cupom" desc="Você tem certeza de que deseja ativar este cupom?" />

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($coupons->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange  w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-cupons')
                            <div class="">
                                <a href="{{ route('coupons.create') }}" class="btn btn-primary  px-4" data-bs-toggle="tooltip"
                                    data-bs-placement="top" onclick="showFinancialModal()">
                                    <div class="px-lg-4 fs-4">
                                        Novo cupom
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="">
                        @if ($coupons->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem registros de cupons.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Cupom
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Tipo
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center ">
                                                    Desconto
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Validade
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Utilizados
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Recorrência
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Situação
                                                </div>
                                            </th>
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Ações
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($coupons as $coupon)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2  ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate pe-3 text-center">
                                                        {{ $coupon->code }}
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                        @if (is_null($coupon->value))
                                                            Percentual
                                                        @else
                                                            Valor
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 j">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3">
                                                        @if (is_null($coupon->value))
                                                            {{ $coupon->percent }}%
                                                        @else
                                                            {{ number_format($coupon->value, 2, ',', '.') }}
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center">
                                                        {{ date('d/m/Y', strtotime($coupon->expiration_date)) }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center me-sm-3 ">
                                                        {{ $coupon->used_coupons->count() }}/{{ $coupon->qtd_total - $coupon->used_coupons->count() }}
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center me-sm-3 ">
                                                        @if ($coupon->occurrence == 'sim')
                                                            {{ $coupon->rec_duration }}
                                                        @else
                                                            Não
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                        @if ($coupon->situation == 'ativo')
                                                            <span
                                                                class="badge rounded-pill text-white bg-primary px-3 mx-2">
                                                                <div class="px-1">Ativo</div>
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge rounded-pill text-white badge-orange px-3 mx-2">Inativo</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('coupons.show', $coupon->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                            <i class="ti ti-eye fs-7"></i>
                                                        </a>
                                                        @can('ativar-desativar-cupons')
                                                            @if ($coupon->situation == 'ativo')
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Desativar"
                                                                    class="btn fs-7 text-danger p-0"
                                                                    onclick="serUrlDisable(`{{ route('coupons.disable', $coupon->id) }}`)">
                                                                    <i class="ti ti-ban fs-7"></i>
                                                                </button>
                                                            @else
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Ativar"
                                                                    class="btn fs-7 text-success p-0"
                                                                    onclick="serUrlActive(`{{ route('coupons.activate', $coupon->id) }}`)">
                                                                    <i class="ti ti-check fs-7"></i>
                                                                </button>
                                                            @endif
                                                        @endcan
                                                        @can('edi-cupons')
                                                            {{-- <a href="{{ route('coupons.edit', $coupon->id) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Editar" class="btn fs-7 text-primary p-0">
                                                                <i class="ti ti-edit fs-7"></i>
                                                            </a> --}}
                                                        @endcan
                                                        @can('deletar-cupons')
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Deletar"
                                                                class="btn fs-7 text-orange p-0"
                                                                onclick="serUrlDelete(`{{ route('coupons.destroy', $coupon->id) }}`)">
                                                                <i class="ti ti-trash fs-7"></i>
                                                            </button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $coupons->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal deletar cupom -->
    <div class="modal fade" id="al-deletar-alert" tabindex="-1" aria-labelledby="vertical-center-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <div class="text-center text-danger">
                        <i class="ti ti-alert-octagon fs-7"></i>
                        <form action="#" method="post" id="modal-deletar">
                            @csrf
                            @method('DELETE')
                            <h4 class="mt-2">Deletar Cupom</h4>
                            <p class="mt-3">
                                Você tem certeza de que deseja deletar este registro?
                            </p>
                            <button type="submit" class="btn btn-danger my-2">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!-- modal filtro -->
    @include('pages.coupons._modal_filter')
@endsection
@section('scripts')
    <script></script>
@endsection
