@extends('layouts.basic')
@section('title', 'Afiliados')
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
                    <h4 class="fw-semibold mb-8">Afiliados</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb flex-nowrap text-truncate">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item pe-3" aria-current="page">Afiliados</li>
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
                    <x-alerts.delete title="Deletar Afiliado"
                        desc="Você tem certeza de que deseja deletar este registro?" />

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">
                        <div class="">
                            @if ($affiliates->count() > 0 || request()->query())
                                <button type="button" class="btn btn-orange  w-100  px-5" data-bs-toggle="modal"
                                    data-bs-target="#modal-filtro">
                                    <div class="">Filtrar</div>
                                </button>
                            @endif
                        </div>
                        @can('criar-afiliados')
                            <div class="">
                                <a href="{{ route('affiliates.crud.create') }}" class="btn btn-primary  px-4">
                                    <div class="px-lg-4 fs-4">
                                        Novo afiliado
                                    </div>
                                </a>
                            </div>
                        @endcan
                    </div>
                    <div class="">
                        @if ($affiliates->count() == 0)
                            <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                                Não existem afiliado(s) cadastrado(s).
                            </div>
                        @else
                            <div class="table-responsive mt-4">
                                <table class="table table-hover table-striped table-hover  ">
                                    <thead>
                                        <tr class="border-0 text-center">
                                            <th scope="" class="p-0 border-0 pb-2 pe-3 ">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Nome
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 ">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Link
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0 ">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    E-mail
                                                </div>
                                            </th>
                                            <th scope="" class="py-0 border-0 pb-2 ps-0">
                                                <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                    Whatsapp
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
                                        @if (isset($affiliates) && !empty($affiliates))
                                            @foreach ($affiliates as $affiliate)
                                                <tr class="align-items-center">
                                                    <td class="border-0 py-2  ">
                                                        <div class=" fw-semibold px-1 pt-2  ">
                                                            {{ Str::limit($affiliate->user->nome_usuario, 16) }}
                                                        </div>
                                                    </td>
                                                    <td class="border-0 py-2  ">
                                                        <div class=" fw-semibold px-1 pt-2 text-truncate text-center pe-3 ">
                                                            {{-- {{ $affiliate->link->url }} --}}
                                                            <a href="{{ url('https://hipponotify.com.br/?ref=' . $affiliate->ref_id) }}"
                                                                class="text-info" target="_blank">
                                                                {{ '/?ref=' . $affiliate->ref_id }}
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="border-0 py-2  ">
                                                        <div class=" fw-semibold px-1 pt-2  ">
                                                            {{ $affiliate->user->email }}
                                                        </div>
                                                    </td>
                                                    <td class="border-0 py-2  ">
                                                        <div class=" fw-semibold px-1 pt-2 pe-3 text-center  ">
                                                            {{ fmtNumCelular($affiliate->user->whatsapp) }}
                                                        </div>
                                                    </td>
                                                    <td class="border-0 py-2 px-3 pt-2 ">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            @can('ver-afiliados')
                                                                <a href="{{ Route('affiliates.crud.show', $affiliate->id) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Visualizar" class="btn fs-7 text-secondary p-0">
                                                                    <i class="ti ti-eye fs-7"></i>
                                                                </a>
                                                            @endcan
                                                            @can('edit-afiliados')
                                                                <a href="{{ Route('affiliates.crud.edit', ['id' => $affiliate->id]) }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Editar" class="btn fs-7 text-primary p-0">
                                                                    <i class="ti ti-edit fs-7"></i>
                                                                </a>
                                                            @endcan
                                                            @can('deletar-afiliados')
                                                                <button type="button" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Deletar"
                                                                    class="btn fs-7 text-orange p-0"
                                                                    onclick="serUrlDelete(`{{ Route('affiliates.crud.delete', ['id' => $affiliate->id]) }}`)">
                                                                    <i class="ti ti-trash fs-7"></i>
                                                                </button>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <div class="mt-4">
                            {{ $affiliates->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertically centered modal -->
    <div class="modal fade" id="al-to-delete-alert" tabindex="-1" aria-labelledby="vertical-center-modal"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content modal-filled bg-light-danger">
                <div class="modal-body p-4">
                    <div class="text-center text-danger">
                        <i class="ti ti-alert-octagon fs-7"></i>
                        <form action="#" method="post" id="modal-deletar">
                            @csrf
                            @method('DELETE')
                            <h4 class="mt-2">Excluir Afiliado</h4>
                            <p class="mt-3">
                                Você tem certeza de que deseja excluir este afiliado?
                            </p>
                            <button type="submit" class="btn btn-danger my-2">
                                Excluir
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>

    <!-- modal filtro -->
    @include('pages.affiliates._modal_filter')

@endsection
@section('scripts')
@endsection
