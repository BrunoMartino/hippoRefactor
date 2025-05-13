@extends('layouts.basic')
@section('title', 'Sugestões')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Sugestões</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Sugestões</li>
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
                    <x-alerts.delete title="Deletar Sugestão"
                        desc="Você tem certeza de que deseja deletar este registro?" />

                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-4">

                        <div class="lh-1">
                            <h1 class="h3  fw-semibold ">Ajude-nos a melhorar! Compartilhe suas sugestões abaixo.</h1>
                            <p class="fs-4 ">
                                Este não é um canal para dúvidas, se precisa de ajuda, fale conosco no suporte.
                            </p>
                        </div>

                        {{-- <div class="">
                            @if (session('edit_sending_message_id'))
                                <a href="{{ route('config.import.cb.imported-data.back-edit-config-msg') }}"
                                    class="btn btn-orange  w-100  px-3 fs-4">
                                    <div class="">Retornar para configuração de envio</div>
                                </a>
                            @else
                                @if ($data->count() > 0 || request()->query())
                                    <button type="button" class="btn btn-orange w-100  px-5" data-bs-toggle="modal"
                                        data-bs-target="#modal-filtro">
                                        <div class="fs-4">Filtrar</div>
                                    </button>
                                @endif
                            @endif
                        </div> --}}
                        <div class="ms-auto">
                            <a href="{{ route('sugestoes.create') }}" class="btn btn-primary  px-4 ">
                                <div class="px-lg-4 fs-4">
                                    Nova Sugestão
                                </div>
                            </a>
                        </div>
                    </div>

                    @if ($improvements->total() == 0)
                        <div class="alert alert-warning text-center fs-7 fw-light" role="alert">
                            Não há registros de sugestões.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-hover  ">
                                <thead>
                                    <tr class="border-0 text-center">
                                        <th scope="" class="p-0 border-0 pb-2 pe-3">
                                            <div class="p-3 border rounded-2 fw-semibold text-truncate fs-4 text-primary  ">
                                                Texto
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Autor
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Data
                                            </div>
                                        </th>
                                        <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                                Votos
                                            </div>
                                        </th>
                                        <th scope="col " class="py-0 border-0 pb-2 px-0">
                                            <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                                Ações
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    @foreach ($improvements as $item)
                                        <tr class="align-items-center ">
                                            <td class="border-0 py-2 col-md-2 " style="min-width: 500px">
                                                <div class=" fw-semibold px-1 pt-2  pe-3 text-start">
                                                    <div class="" style="padding-right: 3px, ">
                                                        {{ Str::limit($item->text, 120) }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 " style="min-width: 200px">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $item->user->nome_usuario }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $item->created_at->format('d/m/Y') }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 ">
                                                <div class=" fw-semibold px-1 pt-2 pe-3 text-center ">
                                                    <div class="" style="padding-right: 4px">
                                                        {{ $item->votes_suggestion->count() }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="border-0 py-2 px-3 pt-2 ">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('sugestoes.show', $item->id) }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Visualizar"
                                                        class="btn fs-7 text-secondary p-0">
                                                        <i class="ti ti-eye fs-7"></i>
                                                    </a>
                                                    @if ($item->user_id == auth()->user()->id)
                                                        <a href="{{ route('sugestoes.edit', $item->id) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"
                                                            class="btn fs-7 text-primary p-0">
                                                            <i class="ti ti-edit fs-7"></i>
                                                        </a>
                                                        @if ($item->improvement_answers->count() == 0)
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Deletar"
                                                                class="btn fs-7 text-danger p-0"
                                                                onclick="serUrlDelete(`{{ route('sugestoes.destroy', $item->id) }}`)">
                                                                <i class="ti ti-trash fs-7"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                    {{-- Super admin pode deletar qualquer sugestão --}}
                                                    @if (auth()->user()->hasRole('super_admin') && $item->user_id != auth()->user()->id)
                                                        @if ($item->improvement_answers->count() == 0)
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Deletar"
                                                                class="btn fs-7 text-danger p-0"
                                                                onclick="serUrlDelete(`{{ route('sugestoes.destroy', $item->id) }}`)">
                                                                <i class="ti ti-trash fs-7"></i>
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="mt-4">
                        {{ $improvements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <form action="#" method="post" id="form-deletar">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger my-2">
                Deletar
            </button>
        </form>
    </div>

    {{-- @include('pages.config.import.cobrancas._modal_filter') --}}

@endsection
@section('scripts')
@endsection
