@extends('layouts.basic')
@section('title', 'Visualizar Sugestão')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Visualizar Sugestão</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('sugestoes.index') }}">Sugestões</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Visualizar Sugestão</li>
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
                    <x-alerts.delete title="Deletar Comentário"
                        desc="Você tem certeza de que deseja deletar o comentário?" />


                    <div class="mb-3 d-flex flex-column flex-md-row justify-content-between gap-2 ">
                        <div class="order-2 order-md-1">
                            <h2>{{ $improvement->user->nome_usuario }}</h2>
                            <div class=''>
                                <i class="ti ti-calendar-event"></i>
                                {{ $improvement->updated_at->format('d/m/Y') }}
                                @if ($improvement->updated_at != $improvement->created_at)
                                    <span class=""
                                        style="margin-left: 7px; font-size: 12.8px; font-weight: 700">(Editado)</span>
                                @endif
                            </div>
                        </div>

                        <div class="order-1 order-md-2 d-flex gap-2 align-items-center ">
                            <span class="fs-5">
                                @if ($improvement->votes_suggestion->count() == 1)
                                    <strong class="fs-5">{{ $improvement->votes_suggestion->count() }}</strong> Voto
                                @else
                                    <strong class="fs-5">{{ $improvement->votes_suggestion->count() }}</strong> Votos
                                @endif
                            </span>

                            @if ($improvement->votes_suggestion()->where('user_id', auth()->user()->id)->exists())
                                <form action="{{ route('sugestoes.remover-voto', $improvement->id) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="btn ms-2 btn-orange d-flex align-items-center gap-1  btn-sm rounded-3 px-3 fs-4">
                                        <i class="ti ti-heart-broken "></i>
                                        Remover Voto
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('sugestoes.votar', $improvement->id) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="btn ms-2 btn-primary  d-flex align-items-center gap-1 btn-sm rounded-3 px-3 fs-4 @if ($improvement->user_id == auth()->user()->id) disabled @endif">
                                        <i class="ti ti-heart "></i>
                                        Votar
                                    </button>
                                </form>
                            @endif

                        </div>
                    </div>


                    <p class=" fs-5">
                        {{ $improvement->text }}
                    </p>


                    {{-- @if ($improvement->user_id == auth()->user()->id)
                        <div class="mt-4">
                            <a href="{{ route('sugestoes.edit', $improvement->id) }}" class="btn btn-primary btn-sm">
                                Editar
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="serUrlDelete(`{{ route('sugestoes.destroy', $improvement->id) }}`)">
                                Deletar
                            </button>
                        </div>
                    @endif --}}

                    {{-- @if (auth()->user()->hasRole('super_admin') && $improvement->user_id != auth()->user()->id)
                        <div class="mt-4">
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="serUrlDelete(`{{ route('sugestoes.destroy', $improvement->id) }}`)">
                                Deletar
                            </button>
                        </div>
                    @endif --}}


                    <hr class="my-4 mb-4">
                    <div class="mb-3 pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-message">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M18 3a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-4.724l-4.762 2.857a1 1 0 0 1 -1.508 -.743l-.006 -.114v-2h-1a4 4 0 0 1 -3.995 -3.8l-.005 -.2v-8a4 4 0 0 1 4 -4zm-4 9h-6a1 1 0 0 0 0 2h6a1 1 0 0 0 0 -2m2 -4h-8a1 1 0 1 0 0 2h8a1 1 0 0 0 0 -2" />
                        </svg>
                        <span class="fs-4">({{ $improvement->improvement_answers->count() }}) comentários</span>
                    </div>

                    @foreach ($improvement->improvement_answers as $item)
                        <div class="mb-4">
                            <h3 class="h5 mb-1 pb-0">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-profile-img">
                                        <div class=""
                                            style="width: 23px; height: 23px; background: url({{ asset($item->user->url_foto_perfil) }}) no-repeat; background-position: center center; background-size: 100%; border-radius: 50%; background-size:cover;">
                                        </div>
                                    </div>
                                    {{ $item->user->nome_usuario }}
                                    @if (auth()->user()->id == $item->user_id)
                                        <div class="">
                                            <button type="button" class="btn btn-danger btn-sm px-2 py-0"
                                                onclick="serUrlDelete(`{{ route('sugestoes.comentorios.destroy', $item->id) }}`)">
                                                Deletar
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </h3>
                            <div class="small">
                                <i class="ti ti-calendar-event"></i> {{ $item->created_at->format('d/m/Y') }}
                            </div>
                            <p class="mt-2 mb-0 pb-0">
                                {{ $item->text }}
                            </p>

                        </div>
                        <hr>
                    @endforeach




                    <form action="{{ route('sugestoes.comentorios.store') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $improvement->id }}" name="suggestion_id">

                        <div class="mb-3 mt-4 pt-3">
                            <label for="text" class="form-label">Adicionar comentário:</label>
                            <textarea class="form-control fs-5 @error('text') is-invalid @enderror" name="text" id="text" rows="3"
                                required placeholder="" maxlength="1500">{{ old('text') }}</textarea>
                            @error('text')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Comentar</div>
                            </button>
                            <a href="{{ route('sugestoes.index') }}" class="btn btn-light  px-5 fs-5 text-primary">
                                <div class="px-lg-5">Voltar</div>
                            </a>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
