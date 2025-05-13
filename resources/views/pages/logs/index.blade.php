@extends('layouts.basic')
@section('title', 'Logs')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Logs</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Logs</li>
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
                <div class="card-body p-4">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                    <span>Log de usuários</span>
                                </a>
                            </li>
                            @hasanyrole('super_admin')
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                        <span>Log de erros</span>
                                    </a>
                                </li>
                            @endhasanyrole
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="pt-4">
                                    <div class="table-responsive" style="max-height: 100vh">
                                        <table class="table  table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Mensagem</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logAcoes as $log)
                                                    <tr class="">
                                                        <td scope="row" class="text-truncate">
                                                            {{ $log['datetime'] }}
                                                        </td>
                                                        <td>{{ $log['message'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel">
                                <div class="pt-4">
                                    <div class="table-responsive" style="max-height: 100vh">
                                        <table class="table  table-striped table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Data</th>
                                                    <th scope="col">Erro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($logErros as $log)
                                                    <tr class="">
                                                        <td scope="row ">
                                                            <div class="text-truncate">
                                                                {{ $log['date'] }}
                                                            </div>
                                                        </td>
                                                        <td>{{ $log['message'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
