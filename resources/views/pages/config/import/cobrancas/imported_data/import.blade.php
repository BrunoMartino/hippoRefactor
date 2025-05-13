@extends('layouts.basic')
@section('title', 'Importar Dados')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Importar Dados - Cobranças</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Importar Dados - Cobranças</li>
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
                <div class="card-body" id="content-01">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="fs-6 mb-1 ">
                        Selecione um arquivo <span class="fw-semibold">XLSX</span> ou <span class="fw-semibold">CSV</span>
                        para importar
                    </div>
                    <!-- info -->
                    <div class="alert alert-light text-dark px-2 py-1 mb-2 small mt-1 d-inline-block" role="alert"
                        style="background: #fff6e2">
                        <i class="ti ti-info-circle me-1"></i>
                        Os links que forem adicionados nos campos, devem ser links que permitam o download.
                    </div>
                    <div class="mb-1">
                        Modelos de arquivos:
                        <a href="{{ asset('assets/files/modelo-cobrancas-xlsx.xlsx') }}" class="btn btn-sm btn-light py-0"
                            download>
                            <i class="ti ti-download"></i>
                            MODELO-COBRANCAS-XLSX
                        </a> e
                        <a href="{{ asset('assets/files/modelo-cobrancas-csv.csv') }}" class="btn btn-sm btn-light py-0"
                            download>
                            <i class="ti ti-download"></i>
                            MODELO-COBRANCAS-CSV
                        </a>.
                    </div>
                    <form action="{{ route('config.import.cb.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="arquivo" class="form-label"></label>
                            <input type="file" class="form-control @error('arquivo') is-invalid @enderror" name="arquivo"
                                id="arquivo" placeholder="" accept=".xlsx, .csv" required />
                            @error('arquivo')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="mb-1 fs-4">
                                Nome do grupo
                                <span class="d-inline-block align-middle" tabindex="0" data-bs-toggle="popover"
                                    data-bs-trigger="hover focus"
                                    data-bs-content="Nome do grupo é a identificação que deseja dar aos dados que serão importados no arquivo selecionado acima.">
                                    <svg class="svg-icon"
                                        style="margin-left: 3px; margin-bottom: 3px; width: 1em;height: 1em;vertical-align: middle;fill: #FF621D;overflow: hidden;"
                                        viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M512 85.333333a426.666667 426.666667 0 1 0 426.666667 426.666667A426.666667 426.666667 0 0 0 512 85.333333z m0 768a341.333333 341.333333 0 1 1 341.333333-341.333333 341.333333 341.333333 0 0 1-341.333333 341.333333z" />
                                        <path
                                            d="M512 256a149.333333 149.333333 0 0 0-149.333333 149.333333 42.666667 42.666667 0 0 0 85.333333 0A64 64 0 1 1 512 469.333333a42.666667 42.666667 0 0 0-42.666667 42.666667v85.333333a42.666667 42.666667 0 0 0 85.333334 0v-49.493333A148.906667 148.906667 0 0 0 512 256z" />
                                        <path
                                            d="M512 725.333333m-42.666667 0a42.666667 42.666667 0 1 0 85.333334 0 42.666667 42.666667 0 1 0-85.333334 0Z" />
                                    </svg>
                                </span>
                            </div>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" id="" required />
                            @error('name')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mt-4 pt-4">
                            <button type="submit" class="btn btn-primary px-5">
                                <div class="px-4">Importar</div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if (auth()->user()->hasPermissionTo('criar-import-cobrancas') == false)
        <script>
            const inputs = (document.querySelector('#content-01')).querySelectorAll('input');

            // Desabilita cada input encontrado
            inputs.forEach(input => {
                input.disabled = true;
            });
        </script>
    @endif
@endsection
