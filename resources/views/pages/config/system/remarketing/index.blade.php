@extends('layouts.basic')
@section('title', 'Remarketing')
@section('style')
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">

            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Remarketing</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item text-muted">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Remarketing</li>
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


                    <!-- Remarketing -->
                    <div class="" id="">
                        <!-- integrações -->
                        <div class="mt-3">
                            <div class="mb-2 fs-5 ">Integrações:</div>
                            <!-- btns integrações -->
                            <div class="d-flex flex-column flex-md-row gap-3">
                                <div class="pe-lg-3">
                                    <a href="{{ route('config.sistema.connect-whatsapp', 3) }}"
                                        class="btn btn-primary fs-5 fw-semibold @if(auth()->user()->hasPermissionTo('edit-modulo-remarketing') == false) disabled @endif " style="min-width: 250px">
                                        WhatsApp
                                    </a>
                                </div>
                                @if (!$getConfigModuleExist || $getConfigModuleExist->modulo_id == 3)
                                    <div class="">
                                        <a href="{{ route('config.sistema.bling', 3) }}"
                                            class="btn btn-primary fs-5 fw-semibold @if(auth()->user()->hasPermissionTo('edit-modulo-remarketing') == false) disabled @endif " style="min-width: 250px">
                                            Bling
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4">
                            <!-- remarketing -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
