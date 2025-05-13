@extends('layouts.auth.basic_auth')
@section('content')
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
        <div class="position-relative z-index-5">
            <div class="row gx-0">
                <div class="col-xl-7 col-xxl-7 bg-white position-relative">
                    <div class="auth-col-left-orange">
                        <div class="d-none d-xl-flex align-items-center justify-content-center auth-col-left-blue">
                            <img src="{{ asset('assets/images/logos/hippo-2.png') }}" alt="" class="img-fluid"
                                width="700">
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-xxl-5">
                    <div
                        class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4 px-xxl-5">
                        <div class="col-12 col-lg-11 mx-auto">





                            <div class='fs-7 alert alert-danger p-lg-4   lh-sm text-center ' style="color: #f44949">
                                <div class="py-lg-2">
                                    <div class="text-center mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="33px" viewBox="0 -960 960 960"
                                            width="33px" fill="#f44949">
                                            <path
                                                d="M450-290h60v-230h-60v230Zm30-298.46q13.73 0 23.02-9.29t9.29-23.02q0-13.73-9.29-23.02-9.29-9.28-23.02-9.28t-23.02 9.28q-9.29 9.29-9.29 23.02t9.29 23.02q9.29 9.29 23.02 9.29Zm.07 488.46q-78.84 0-148.21-29.92t-120.68-81.21q-51.31-51.29-81.25-120.63Q100-401.1 100-479.93q0-78.84 29.92-148.21t81.21-120.68q51.29-51.31 120.63-81.25Q401.1-860 479.93-860q78.84 0 148.21 29.92t120.68 81.21q51.31 51.29 81.25 120.63Q860-558.9 860-480.07q0 78.84-29.92 148.21t-81.21 120.68q-51.29 51.31-120.63 81.25Q558.9-100 480.07-100Zm-.07-60q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                        </svg>
                                    </div>

                                    O sistema está temporariamente em manutenção para a implementação de melhorias e estará
                                    disponível novamente em breve.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
