@extends('layouts.basic')
@section('title', 'Comprar Usuários')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Comprar Usuários</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('usuarios') }}">Usuários</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Comprar Usuários</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success/>
                    <x-alerts.error/>
                    <x-alerts.warning/>
                    
                    <div class="text-center fs-5 mb-5 pt-3">
                        @if ($totalComprado >= 10)
                            Você atingiu o limite de compra de <strong>10</strong> usuários.
                        @else
                            Você pode comprar até o limite de <strong>10</strong> usuários e já comprou um total de
                            <strong>{{ $totalComprado }}</strong>.
                        @endif
                    </div>
                    <form action="{{ route('usuarios.comprar.salvar-total') }}" method="post">
                        @csrf
                        <div class="mx-auto text-center" style="max-width: 600px">
                            <label for="total" class="form-label fs-9">
                                <span id="total-selecionado"></span> / {{ 10 - $totalComprado }}
                            </label>
                            <input type="range" class="form-range" value="1" name="t" id="total"
                                max="{{ 10 - $totalComprado }}" min="1"
                                @if ($totalComprado >= 10) disabled @endif required>
                        </div>
                        <div class="text-center mt-5 pb-4 mb-2">
                            <div class="d-flex flex-column justify-content-center flex-sm-row gap-3 gap-sm-4 ">
                                <button type="submit" class="btn btn-primary  px-5 fs-4"
                                    @if ($totalComprado >= 10) disabled @endif>
                                    <div class="px-lg-5">Comprar</div>
                                </button>
                                <a href="{{ route('usuarios') }}" class="btn btn-light  px-5 fs-4 text-primary">
                                    <div class="px-lg-5">Cancelar</div>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function setNumTotal() {
            let num = document.getElementById('total').value
            document.getElementById('total-selecionado').innerHTML = num
        }
        document.getElementById('total').oninput = function() {
            setNumTotal()
        }
        setNumTotal()
    </script>
@endsection
