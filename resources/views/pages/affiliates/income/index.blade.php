@extends('layouts.basic')
@section('title', 'Relatórios - Rendimentos Afiliados')
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
            <div class="d-flex gap-2 align-items-center">
                <div class="">
                    <h4 class="fw-semibold mb-8">Rendimentos Afiliados</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Relatórios</li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Rendimentos Afiliados</li>
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

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($incomes->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange  w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="">Filtrar</div>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="">
                        @if ($incomes->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Sem registros.
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Afiliado
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Cliente
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Módulo
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Plano
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Data venda
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                                    Status da conta
                                                </div>
                                            </th>
                                            {{-- <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-center  ">
                                                    Comissão
                                                </div>
                                            </th> --}}
                                            <th scope="col " class="py-0 border-0 pb-2 px-0">
                                                <div
                                                    class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                    Comissão
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($incomes as $item)
                                            <tr class="align-items-center ">
                                                <td class="border-0 py-2 col-md-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate "
                                                        @if ($item->affiliate->deleted_at) style="color: red" @endif>
                                                        @if (isset($item->affiliate->user->nome_usuario))
                                                            {{ Str::limit($item->affiliate->user->nome_usuario, 30) }}
                                                        @else
                                                            Deletado
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate"
                                                        @if ($item->user->deleted_at) style="color: red" @endif>
                                                        @if ($item->user)
                                                            {{ Str::limit($item->user->nome_usuario, 30) }}
                                                        @else
                                                            Deletado
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                        @if ($item->user && $item->user->plano)
                                                            {{ $item->user->plano->modulo->titulo }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-3 ">
                                                        @if ($item->user && $item->user->plano)
                                                            {{ ucfirst($item->user->plano->nome) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                        {{-- TODO: --}}
                                                        {{-- data de quando o status da conta foi ativado --}}
                                                        {{-- mudar a logina caso tenha q colocar status de pagamento aqui --}}
                                                        {{-- talvez pegar essa data de outro lugar --}}
                                                        @if (isset($item->user->plano))
                                                            @php
                                                                $sub = \App\Models\Subscription::where(
                                                                    'user_id',
                                                                    $item->user->id,
                                                                )
                                                                    ->where('plan_id', $item->user->plano->id)
                                                                    ->first();
                                                            @endphp

                                                            @if ($sub)
                                                                {{ $sub->updated_at->format('d/m/Y') }}
                                                            @else
                                                                -
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="border-0 py-2 ">
                                                    <div class=" fw-semibold px-1 pt-2  text-truncate text-center pe-3">
                                                        {{-- TODO: --}}
                                                        {{-- data de quando o status da conta foi ativado --}}
                                                        {{-- mudar a logina caso tenha q colocar status de pagamento aqui --}}

                                                        @if (isset($item->user->plano))
                                                            @php
                                                                $subAtivo = \App\Models\Subscription::where(
                                                                    'user_id',
                                                                    $item->user->id,
                                                                )
                                                                    ->where('plan_id', $item->user->plano->id)
                                                                    ->where('status', 'ativo')
                                                                    ->exists();
                                                            @endphp

                                                            @if ($item->user->deleted_at)
                                                                <span class="badge bg-danger">Deletado</span>
                                                            @else
                                                                @if ($subAtivo)
                                                                    <span class="badge bg-success">Ativo</span>
                                                                @else
                                                                    <span class="badge bg-warning">Inativo</span>
                                                                @endif
                                                            @endif
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class=" border-0 py-2">
                                                    <div class=" fw-semibold px-1 pt-2 text-center pe-1">
                                                        @php
                                                            $valor = 0;
                                                            if ($item->user && $item->user->plano) {
                                                                $valor =
                                                                    $item->user->plano->valor *
                                                                    ($item->affiliate->comission / 100);
                                                            }
                                                        @endphp
                                                        {{ number_format($valor, 2, ',', '.') }}
                                                    </div>
                                                </td>
                                                {{-- <td class="border-0 py-2 px-3 pt-2 ">
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a href="{{ route('affiliates.income.show', $item->id) }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Visualizar" class="btn fs-7 text-primary p-0">
                                                            <i class="ti ti-eye fs-7"></i>
                                                        </a>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif


                        <div class="mt-4">
                            {{ $incomes->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal filtro -->
    @include('pages.affiliates.income._modal_filter')
@endsection
