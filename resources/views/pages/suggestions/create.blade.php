@extends('layouts.basic')
@section('title', 'Nova Sugestão')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Nova Sugestão</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('sugestoes.index') }}">Sugestões</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Nova Sugestão</li>
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


                    <form action="{{ route('sugestoes.store') }}" method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="text" class="form-label">Texto da sugestão:</label>
                            <textarea class="form-control fs-5 @error('text') is-invalid @enderror" name="text" id="text" rows="8" required 
                            placeholder="Ex: Gostaria que fosse adicionado tal recurso ao sistema, tenho dificuldade..."
                                maxlength="1500">{{ old('text') }}</textarea>
                            @error('text')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                            <div class="small text-end">
                                Máximo 1500 caracteres.
                            </div>
                        </div>



                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-3 mt-3">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Publicar</div>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
