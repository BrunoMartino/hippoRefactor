@extends('layouts.basic')
@section('title', 'Rendimento Afiliado')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Rendimento Afiliado</h4>
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
        {{-- TODO: verificar se os dados estão certos --}}
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />
                    <div class="row">
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Afiliado:
                            <div class="text-dark fs-6 border-bottom">
                                @if (isset($affiliate->affiliate->user->nome_usuario))
                                    {{ Str::limit($affiliate->affiliate->user->nome_usuario, 30) }}
                                @else
                                    Deletado
                                @endif
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Cliente:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->nome_usuario }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Módulo:
                            <div class="text-dark fs-6 border-bottom">
                                @if ($affiliate->user && $affiliate->user->plano)
                                    {{ $affiliate->user->plano->modulo->titulo }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Plano:
                            <div class="text-dark fs-6 border-bottom">
                                @if ($affiliate->user && $affiliate->user->plano)
                                    {{ ucfirst($affiliate->user->plano->nome) }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Data de venda:
                            <div class="text-dark fs-6 border-bottom">
                                @if ($affiliate->user && $affiliate->user->subscription())
                                    {{ $affiliate->user->subscription()->updated_at->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-4 mb-3 ">
                            Comissão:
                            <div class="text-dark fs-6 border-bottom">
                                @php
                                    $valor = 0;
                                    if ($affiliate->user && $affiliate->user->plano) {
                                        $valor =
                                            $affiliate->user->plano->valor * ($affiliate->affiliate->comission / 100);
                                    }
                                @endphp
                                R$ {{ number_format($valor, 2, ',', '.') }}
                            </div>
                        </div>
                        <div class="fs-7 text-primary col-12 col-lg-5 mb-3">
                            E-mail:
                            <div class="text-dark fs-6 border-bottom">
                                {{ $affiliate->user->email }}
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
                        
                    </div>
                    <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-5 mt-3">
                        <a href="{{ route('affiliates.income') }}" class="btn btn-primary  px-5 fs-5 ">
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
