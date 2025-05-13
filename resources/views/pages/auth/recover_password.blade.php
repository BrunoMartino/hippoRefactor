@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden  min-vh-100 w-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-4">
                    <div class="card mb-0 shadow">
                        <div class="card-body pt-5">
                            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img text-center d-block mb-4 w-100">
                                <img src="{{ asset('assets/images/logos/logo-hippo.png') }}" class="dark-logo"
                                    alt="Logo-Dark" />
                                <img src="{{ asset('assets/images/logos/hippo-dark.png') }}" class="light-logo"
                                    alt="Logo-light" />
                            </a>
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h4 fw-bolder">Criar nova senha</h1>
                                <div class="mt-3 h6 fw-bolder">
                                    Informe o e-mail cadastrado para redefinir sua senha.
                                </div>
                            </div>


                            @if (session('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            
                            @if (session('error'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if (count($errors->all()) > 0)
                                <div class="alert alert-danger " role="alert" id='msg-invalid-pass'>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('recuperar.senha') }}" class="mt-3">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Seu e-mail</label>
                                    <input type="email" class="form-control @error('error') is-invalid @enderror"
                                        placeholder="exemplo@exemplo.com" value="{{old('email')}}" name="email" id="email" autofocus required>
                                    @error('error')
                                        <div class="text-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-3 rounded-2 ">Enviar</button>
                                <a href="{{ route('login') }}" class="btn btn-light text-primary w-100 py-8  ">Voltar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
