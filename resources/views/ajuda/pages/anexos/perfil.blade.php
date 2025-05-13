@php
    session(['figura_base' => 31]);
@endphp
@extends('ajuda.layouts.basic')
@section('title', 'Perfil')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h2 class="fw-semibold m-8">Explicações sobre a página de Perfil</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-between mb-2">
                        <div class="lh-1">
                            <div class="h3 mt-4">
                                <p>A <a href="#figura31"><strong>figura
                                            31</strong></a> mostra a parte superior do sistema Hippo Notify, onde aqui nós
                                    chamamos para facilitar o entendimento de "Menu superior".</p>

                                <figure class="text-center scroll-offset" id="figura31">
                                    <img src="{{ asset('assets/images/manual/header/header.png') }}"
                                        class="img-fluid w-100 mt-4" alt="Menu superior">
                                    <figcaption class="mt-2 text-muted">Figura 31 - Menu superior
                                    </figcaption>
                                </figure>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
