@extends('layouts.front.app')
@section('title', 'Lorem ipsum')
@section('content')

    <!-- Topo -->
    <section>
        <div class="container mt-5 pt-2 pt-lg-5">
            <div class="pt-lg-5" style="max-width: 800px">
                <div class="fw-semibold fs-6 d-flex gap-2 lp-legend-top">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                            stroke="#0853fc" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-rocket">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M4 13a8 8 0 0 1 7 7a6 6 0 0 0 3 -5a9 9 0 0 0 6 -8a3 3 0 0 0 -3 -3a9 9 0 0 0 -8 6a6 6 0 0 0 -5 3" />
                            <path d="M7 14a6 6 0 0 0 -3 6a6 6 0 0 0 6 -3" />
                            <path d="M15 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                        </svg>
                    </div>
                    <div class="">
                        Ipsum dolor sit amet consectetur.
                    </div>
                </div>
                <div class="mt-3  ">
                    <h1 class="fw-600 text-blue-dark display-4 h1-header">
                        Lorem ipsum dolor sit amet <div class="text-primary"> Augue nunc in laoreet pharetra </div> Et a
                        gravisgda diame
                    </h1>
                    <p class="fs-7 fw-semibold mt-3 pt-3 p-header">
                        Lorem ipsum dolor sit amet consectetur. Quam egestas aliquet dolor fames, vitae posuere sociis
                        semper.
                    </p>
                    <div class="mt-5 pt-3 d-flex gap-2 gap-lg-4 flex-column flex-md-row">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-1 px-5 py-3 me-md-2 ">
                                <div class="px-lg-4 fs-6">
                                    Login
                                </div>
                            </a>
                            <button type="button" class="btn btn-outline-primary btn-live-pre btn-lg rounded-1 px-5 py-3">
                                <div class=" fs-6">
                                    Live Preview
                                </div>
                            </button>
                        @endguest
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg rounded-1 px-5 py-3 me-2 ">
                                <div class="px-lg-4 fs-6">
                                    Dashboard
                                </div>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- info -->
    <section>
        <div class="mt-md-5 qtd">
            <div class="py-md-5 pb-3">
                <div class="container my-5 pt-4 pt-md-5 pb-3 pb-md-5">
                    <div class="bg-primary  pt-5 pb-4 pt-lg-4 px-4 px-md-5  rounded-3  text-white my-5">
                        <div class="row align-items-center">
                            <div class="col-12  col-xl-6">
                                <div class="text-center text-xl-start">
                                    @foreach ([1, 2, 3, 4, 5] as $item)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="#ffc107"
                                            class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                        </svg>
                                    @endforeach
                                </div>
                                <h2 class="text-white fs-11 fw-600">
                                    <div class="text-center text-xl-start">
                                        Lorem ipsum consectetur. <br>
                                        Gravida facilisi ut eget:
                                    </div>
                                </h2>
                            </div>
                            <div class="col-12  col-xl-6 py-3">
                                <div class="row gy-4 justify-content-center">
                                    <!--  -->
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center gap-4  justify-content-center">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width=".4"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-transform">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M3 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                    <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                                                    <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
                                                    <path d="M15 18a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </div>
                                            <div class="text-center fs-7 lh-sm ">
                                                <div class="fw-semibold">+ 10 mil</div>
                                                <div class="fw-normal">
                                                    Lorem ipsum
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center gap-4  justify-content-center">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width=".4"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                    <path
                                                        d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                </svg>
                                            </div>
                                            <div class="text-center fs-7 lh-sm ">
                                                <div class="fw-semibold">+ 30 mil</div>
                                                <div class="fw-normal">
                                                    Lorem ipsum
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center gap-4  justify-content-center">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width=".4"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-certificate">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path d="M5 8v-3a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2h-5" />
                                                    <path d="M6 14m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                    <path d="M4.5 17l-1.5 5l3 -1.5l3 1.5l-1.5 -5" />
                                                </svg>
                                            </div>
                                            <div class="text-center fs-7 lh-sm ">
                                                <div class="fw-semibold">+ 10 mil</div>
                                                <div class="fw-normal">
                                                    Lorem ipsum
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex align-items-center gap-4  justify-content-center">
                                            <div class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                                                    stroke-width=".4" stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-affiliate">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275" />
                                                    <path d="M11.683 12.317l5.759 -5.759" />
                                                    <path d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                                                    <path d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                                                    <path d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0" />
                                                    <path d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0" />
                                                </svg>
                                            </div>
                                            <div class="text-center fs-7 lh-sm ">
                                                <div class="fw-semibold">+ 10 mil</div>
                                                <div class="fw-normal">
                                                    Lorem ipsum
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Por que escolher a ? -->
    <section>
        <div class="bg-square-1 por-que-escolher">
            <div class="bg-square-2">
                <div class="container">
                    <div class="py-md-5 text-center">
                        <h2 class=" fs-10 fw-600 text-blue-dark">Por que escolher a <span
                                class="text-primary">Hippo</span>?
                        </h2>
                        <div class="row gx-md-5 gy-3 justify-content-between mt-3 mt-md-5 pt-4">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card" style="box-shadow: 0 0 1em #ccc">
                                    <div class="card-body p-4 px-lg-5">
                                        <img src="{{ asset('assets/images/teste/teste.png') }}" alt=""
                                            width="100">
                                        <h3 class="fw-600">Lorem ipsum dolors.</h3>
                                        <p class="fs-5">
                                            Lorem ipsum dolor sit amet
                                            consectetur. Ac venenatis eu
                                            arcu volutpat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card" style="box-shadow: 0 0 1em #ccc">
                                    <div class="card-body p-4 px-lg-5">
                                        <img src="{{ asset('assets/images/teste/teste.png') }}" alt=""
                                            width="100">
                                        <h3 class="fw-600">Lorem ipsum dolors.</h3>
                                        <p class="fs-5">
                                            Lorem ipsum dolor sit amet
                                            consectetur. Ac venenatis eu
                                            arcu volutpat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card" style="box-shadow: 0 0 1em #ccc">
                                    <div class="card-body p-4 px-lg-5">
                                        <img src="{{ asset('assets/images/teste/teste.png') }}" alt=""
                                            width="100">
                                        <h3 class="fw-600">Lorem ipsum dolors.</h3>
                                        <p class="fs-5">
                                            Lorem ipsum dolor sit amet
                                            consectetur. Ac venenatis eu
                                            arcu volutpat.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  -->
    <section>
        <div class="container my-5  py-md-5 lista-oq-ter">
            <div class="py-4">
                <div class="bg-light rounded-3 py-5 px-4 px-lg-5 p-lg-5">
                    <div class="row gy-5 align-items-center gx-md-5 justify-content-between">
                        <div class="col-12 col-xl-5">
                            <h2 class=" fs-10 fw-600 text-primary text-center">
                                Augue nunc in Laoreet pharetra!
                            </h2>
                            <ul class="list-unstyled fs-7 mt-5">
                                <li class="my-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="">
                                            <div class="bg-orange rounded-1 d-inline-block text-white fw-bold d-flex"
                                                style="padding: 5px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </div>
                                        Ac venenatis eu arcu volutpat.
                                    </div>
                                </li>
                                <li class="my-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="">
                                            <div class="bg-orange rounded-1 d-inline-block text-white fw-bold d-flex"
                                                style="padding: 5px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </div>
                                        Nunc lectus elit nec feugiat nec a integer
                                    </div>
                                </li>
                                <li class="my-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="">
                                            <div class="bg-orange rounded-1 d-inline-block text-white fw-bold d-flex"
                                                style="padding: 5px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </div>
                                        Commodo ullamcorper netus + 500
                                    </div>
                                </li>
                                <li class="my-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="">
                                            <div class="bg-orange rounded-1 d-inline-block text-white fw-bold d-flex"
                                                style="padding: 5px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M5 12l5 5l10 -10" />
                                                </svg>
                                            </div>
                                        </div>
                                        Venenatis eu arcu volutpat.
                                    </div>
                                </li>
                            </ul>
                            <div class="mt-5 text-center">
                                <a href="#" class="btn btn-primary btn-lg rounded-1 px-5 py-3 me-2 ">
                                    <div class="px-lg-4 fs-6">
                                        Experimentar Grátis
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <img src="{{ asset('assets/images/teste/bg-pc.png') }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container py-5">
            <div class="py-md-5 ">
                <h2 class="text-center mx-auto fs-10 fw-600 text-blue-dark" style="max-width: 800px">
                    Lorem ipsum dolor sit amet consectetur sodales quis eu felis aliquam
                </h2>
                <div class="mt-4 pt-2">
                    <div class="owl-carousel owl-theme">
                        @foreach ([3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3] as $key => $item)
                            <!--  -->
                            <div class="item">
                                <div class="">
                                    <div class="p-3 p-md-4">
                                        <div class="card" style="box-shadow: 0 0 1em #ccc">
                                            <div class="card-body p-4 ">
                                                <div class="d-flex justify-content-between ga-3 mb-3">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="">
                                                            <img src="{{ asset('assets/images/teste/user-1.jpg') }}"
                                                                class="rounded-circle" alt=""
                                                                style="width: 40px; height: 40px">
                                                        </div>
                                                        <div class="">
                                                            <h3 class="fs-3 fw-600 pb-0 mb-0">Lorem ipsum </h3>
                                                            <div class="fs-2">Fipsum avaibility</div>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        @foreach ([1, 2, 3, 4, 5] as $item)
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="17" viewBox="0 0 24 24" fill="#ffc107"
                                                                class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path
                                                                    d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                                                            </svg>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <p class="fs-4 lh-sm">
                                                    Lorem ipsum dolor sit amet conse.
                                                    Ullamcorper est fames tortor mi accumsan
                                                    justo. Pellentesque in at eget nulla ut
                                                    lorem nibh aliquam.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="mt-5 pt-4">
            <div class="bg-primary mt-md-5 ">
                <div class="container pt-5 pb-4 ">
                    <div class="row align-items-center gx-md-5 justify-content-between gy-5">
                        <div class="col-12 col-lg-6 col-xl-5 pb-3">
                            <h2 class="text-center text-lg-start mx-auto fs-11 fw-600 text-white"
                                style="max-width: 800px">
                                Lorem ipsum dolor sit amet consectetur elit lectus elit ultrices amet
                            </h2>
                            <div
                                class="mt-5 pt-3 d-flex gap-3 flex-column flex-md-row justify-content-center justify-content-lg-start">
                                <a href="{{ route('login') }}"
                                    class="btn btn-light text-primary btn-lg rounded-1 px-5 py-3 me-md-2 ">
                                    <div class="px-lg-4 fs-6">
                                        Login
                                    </div>
                                </a>
                                <a href="{{ route('usuario.registro') }}"
                                    class="btn btn-outline-light btn-live-pre btn-lg rounded-1 px-5 py-3">
                                    <div class=" fs-6">
                                        Register
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5 col-xl-4">
                            <img src="{{ asset('assets/images/teste/bg-pc-2.png') }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Remarketing -->
    <section>
        <div class="my-5 py-3 py-md-4" >
            <div class="choose-plan my-md-5 py-md-5 pb-4 pb-md-5" id="planos">
                <!--  -->
                <nav>
                    <div class="container pt-4 pt-3 pt-lg-4 mt-4 mb-3">
                        <div class="row align-items-center g-4 g-lg-4 justify-content-center ">
                            <div class="col-12 pt-4 pt-lg-0  col-xl-12 text-center  ">
                                <div class="mx-auto d-inline-block text-uppercase text-primary fs-9 border px-5 border-1 fw-bolder py-2 rounded-pill border-primary"
                                    style="">
                                    <div class="px-lg-3">
                                        Remarketing
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-12 order-2  pt-lg-2">
                                <div class="d-flex gap-2 flex-wrap  btns-navbar justify-content-center ">
                                    <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                        <div class="px-4">Cobrança</div>
                                    </a>
                                    <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                        <div class="px-4">Ratreio</div>
                                    </a>
                                    <a href="" class="btn btn-outline-primary px-4  rounded-pill fs-4 fw-semibold">
                                        <div class="px-4">Faturamento</div>
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </nav>

                <div class="container">
                    <div class=" mt-2">
                        <div class="text-center pt-4">
                            @if ($planTest != null)
                                <form action="{{ route('usuario.salvar-plano', $planTest->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $planTest->id }}" name="plano_id">
                                    <a href="{{ route('usuario.salvar-plano', $planTest->id) }}"
                                        class="btn btn-primary text-white rounded-pill px-5 py-2 fs-7 d-inline-block mx-auto text-center">
                                        <div class="px-lg-5">
                                            <div class="px-lg-5">
                                                <div class="">
                                                    Teste grátis por 7 dias
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </form>
                            @endif
                        </div>
                        <div class="text-center fs-7 mb-md-3 pb-md-0 pt-3 pt-md-4 pt-3">
                            <div class="pt-md-2 pb-3 pb-lg-0">
                                Selecione seu plano:
                            </div>
                        </div>
                        <!-- Planos -->
                        <div class="row gy-4 justify-content-center pb-4 gx-md-5  ">
                            @foreach ($planos as $key => $plan)
                                <div class="col-12 col-md-6 col-lg-4 col-xl-3 px-lg-4 ">
                                    <div class=" overflow-hidden position-relative  rounded-1 p-4 bg-white"
                                        style="box-shadow: 2px 2px .8em #ccc">
                                        <div class="icon-plan"
                                            style="background-color: {{ $plan->color }}; background-image: url({{ asset($plan->icon) }}); z-index: 1">
                                        </div>
                                        <div class="position-relative" style="z-index: 2">
                                            <div class="fs-8 fw-semibold " style="color: {{ $plan->color }}">
                                                {{ ucfirst($plan->nome) }}
                                            </div>
                                            <ul class="mt-2">
                                                <li class="d-flex align-items-center gap-2 my-1">
                                                    <i class="ti ti-check fs-8"></i>
                                                    <div class="fw-semibold">
                                                        {{ $plan->qtd_usuarios }}
                                                        {{ $plan->qtd_usuarios > 1 ? 'Usuários' : 'Usuário' }}
                                                    </div>
                                                </li>
                                                {{-- <li class="d-flex align-items-center gap-2 my-1">
                                                    <i class="ti ti-check fs-8"></i>
                                                    <div class="fw-semibold">
                                                        {{ $plan->qtd_instancias }}
                                                        {{ $plan->qtd_instancias > 1 ? 'Instâncias' : 'Instância' }}
                                                    </div>
                                                </li> --}}
                                                <li class="d-flex align-items-center gap-2 my-1">
                                                    <i class="ti ti-check fs-8"></i>
                                                    <div class="fw-semibold">
                                                        {{ number_format($plan->limite_mensagens, 0, ',', '.') }}
                                                        Mensagens
                                                    </div>
                                                </li>
                                                <li class="d-flex align-items-center gap-2 my-1">
                                                    <i class="ti ti-check fs-8"></i>
                                                    <div class="fw-semibold">
                                                        {{ number_format($plan->custo_excedente, 3, ',', '.') }}
                                                        por mensagem excedente</div>
                                                </li>
                                            </ul>
                                            <div class="fs-8 d-flex justify-content-center pt-2 fw-semibold">
                                                <div class="fs-2 d-inline-block " style="padding-top: 3px">R$</div>
                                                <div class="d-inline-block">
                                                    {{ number_format($plan->valor, 2, ',', '.') }}/ Mês
                                                </div>
                                            </div>
                                            <div class="pt-4 pb-3">
                                                <form action="{{ route('usuario.salvar-plano', $plan->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" id="plano-{{ $key }}"
                                                        value="{{ $plan->id }}" name="plano_id">
                                                    <a href="{{ route('usuario.salvar-plano', $plan->id) }}"
                                                        class="btn-submit-plan btn w-100 fs-5 text-white"
                                                        style="background-color: {{ $plan->color }}; border-color: {{ $plan->color }}">
                                                        Selecionar
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container mb-5 secao-perguntas">
            <div class=" ">
                <h2 class="text-center mx-auto fs-10 fw-600 text-blue-dark" style="max-width: 800px">
                    Frequently asked questions
                </h2>
                <p class="text-center fs-6">
                    Lorem ipsum dolor sit amet consectetur. Quam egestas aliquet dolor fames
                </p>
                <div class="mx-auto mt-4 pt-3" style="max-width: 900px">
                    <div class="accordion rounded-2" id="accordionQuestions" style="box-shadow: 0px 0px .8em #ccc">
                        <!--  -->
                        <div class="accordion-item" style="border-color: #ddd">
                            <h3 class="accordion-header " id="quest-1">
                                <button class="accordion-button shadow-none fs-5 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-quest-1" aria-expanded="false"
                                    aria-controls="collapse-quest-1">
                                    Morbi mauris faucibus donec amet habitasse ?
                                </button>
                            </h3>
                            <div id="collapse-quest-1" class="accordion-collapse collapse" aria-labelledby="quest-1"
                                data-bs-parent="#accordionQuestions">
                                <div class="accordion-body">
                                    It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style
                                    each element. These classes control the overall
                                    appearance, as well as the showing and hiding via
                                    CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's
                                    also worth noting that just about any HTML can go
                                    within the
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="accordion-item" style="border-color: #ddd">
                            <h3 class="accordion-header " id="quest-2">
                                <button class="accordion-button shadow-none fs-5 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-quest-2" aria-expanded="false"
                                    aria-controls="collapse-quest-2">
                                    Nunc sapien laoreet aliquam nisl enim nunc interdum ?
                                </button>
                            </h3>
                            <div id="collapse-quest-2" class="accordion-collapse collapse" aria-labelledby="quest-2"
                                data-bs-parent="#accordionQuestions">
                                <div class="accordion-body">
                                    It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style
                                    each element. These classes control the overall
                                    appearance, as well as the showing and hiding via
                                    CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's
                                    also worth noting that just about any HTML can go
                                    within the
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="accordion-item" style="border-color: #ddd">
                            <h3 class="accordion-header " id="quest-3">
                                <button class="accordion-button shadow-none fs-5 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-quest-3" aria-expanded="false"
                                    aria-controls="collapse-quest-3">
                                    Ullamcorper faucibus placerat vitae volutpat interdum quis bibendum ?
                                </button>
                            </h3>
                            <div id="collapse-quest-3" class="accordion-collapse collapse" aria-labelledby="quest-3"
                                data-bs-parent="#accordionQuestions">
                                <div class="accordion-body">
                                    It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style
                                    each element. These classes control the overall
                                    appearance, as well as the showing and hiding via
                                    CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's
                                    also worth noting that just about any HTML can go
                                    within the
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="accordion-item" style="border-color: #ddd">
                            <h3 class="accordion-header " id="quest-4">
                                <button class="accordion-button shadow-none fs-5 fw-semibold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapse-quest-4" aria-expanded="false"
                                    aria-controls="collapse-quest-4">
                                    Morbi mauris faucibus donec amet habitasse ?
                                </button>
                            </h3>
                            <div id="collapse-quest-4" class="accordion-collapse collapse" aria-labelledby="quest-4"
                                data-bs-parent="#accordionQuestions">
                                <div class="accordion-body">
                                    It is hidden by default, until the collapse plugin
                                    adds the appropriate classes that we use to style
                                    each element. These classes control the overall
                                    appearance, as well as the showing and hiding via
                                    CSS transitions. You can modify any of this with
                                    custom CSS or overriding our default variables. It's
                                    also worth noting that just about any HTML can go
                                    within the
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="py-md-5"></div>
        <div class="pt-5 mt-md-4"></div>
        <div class="bg-primary pt-4">
            <div class="container py-5 text-center text-white">
                <div class="d-flex mb-4 justify-content-center">
                    <div class="">
                        <img src="{{ asset('assets/images/teste/user-1.jpg') }}" class="rounded-circle img-user-footer"
                            alt="">
                    </div>
                    <div class="">
                        <img src="{{ asset('assets/images/teste/user-1.jpg') }}" class="rounded-circle img-user-footer"
                            alt="">
                    </div>
                    <div class="">
                        <img src="{{ asset('assets/images/teste/user-1.jpg') }}" class="rounded-circle img-user-footer"
                            alt="">
                    </div>
                </div>
                <h2 class="text-white fs-9 fw-semibold">Still have questions </h2>
                <p class="mt-3  fs-6">
                    Lorem ipsum dolor sit amet consectetur. Quam egestas aliquet dolor fames.
                </p>
                <div class="mt-4 pt-3">
                    <a href="#" class="btn btn-light text-primary btn-lg rounded-1 px-4 py-3 ">
                        <div class="fs-6 px-lg-2">
                            Chat with us
                        </div>
                    </a>
                </div>
            </div>
            <div class="py-4"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            dots: true,
            margin: 20,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },
                900: {
                    items: 2
                },
                1300: {
                    items: 3
                }
            }
        })
    </script>
@endsection
