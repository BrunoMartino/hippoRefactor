@extends('layouts.basic')
@section('title', 'Dados de Afiliado')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Dados de Afiliado</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('affiliates.crud.index') }}">Afiliados</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Dados de Afiliado</li>
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
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="row">
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Nome:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->nome_usuario }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-5 mb-3">
                            E-mail:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->email }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-3 mb-3">
                            Comissão:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->comission }}%
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3">
                            Endereço:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->endereco }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-3 mb-3">
                            Cidade:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->cidade }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-3 mb-3">
                            Uf:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->estado }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3">
                            Whatsapp:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->whatsapp }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-8 mb-3">
                            Link:
                            <div class="text-dark fs-6 border-bottom">
                                <a href="https://hipponotify.com.br?ref={{ $affiliate->ref_id }}" class="text-info" target="_blank">
                                    https://hipponotify.com.br?ref={{ $affiliate->ref_id }}
                                </a>
                                <button type="button" class="btn btn-none btn-sm p-0 px-1 " data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Copiar" onclick="copyLink()">
                                    <i class="ti ti-copy fs-6"></i>
                                </button>
                                <input type="text" id="link-copiar" class="visually-hidden"
                                    value="https://hipponotify.com.br?ref={{ $affiliate->ref_id }}">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('affiliates.crud.index') }}" class="btn btn-primary  px-5 fs-5 ">
                            <div class="px-lg-5">Voltar</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function copyLink() {
            // Seleciona o elemento de input
            var inputText = document.getElementById("link-copiar");
            // Seleciona o texto dentro do input
            inputText.select();
            // Copia o texto selecionado
            document.execCommand("copy");

            toastSuccess("Link de afiliado copiado");
        }
    </script>
@endsection
