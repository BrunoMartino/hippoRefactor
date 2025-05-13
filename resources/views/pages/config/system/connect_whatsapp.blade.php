@extends('layouts.basic')
@section('title', 'Conectar WhatsApp')
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Configurações</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">Configurações</li>
                            <li class="breadcrumb-item">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Conectar WhatsApp</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>


    @if (isset($configOutroModulo) && $configOutroModulo->count() >= 1 && is_null(session('gerar_qrcode_conexao_whatsapp')))
        <!-- exibir módulos já existentes -->
        <div class="row">

            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">


                        <div class="alert alert-light text-dark" role="alert">
                            @if ($configOutroModulo->count() == 1)
                                <div class="pb-2">
                                    <div class="modal-title  fs-6 mb-3" id="">

                                        @if (session('usar_conexao_outro_modulo'))
                                            Não foi possível utilizar a conexão do outro módulo!
                                        @else
                                            Já existe uma conexão ativa para o módulo <span
                                                class="fw-semibold">{{ $configOutroModulo->first()->modulo->titulo }}</span>,
                                            você
                                            deseja
                                            utilizar a mesma conexão?
                                        @endif
                                    </div>
                                    <form action="{{ route('config.sistema.connect-whatsapp.usar') }}" method="post">
                                        @csrf

                                        <input name="config[]" type="checkbox" class="visually-hidden"
                                            value="{{ $configOutroModulo->first()->id }}" checked />

                                        <div class="">
                                            @if (session('usar_conexao_outro_modulo'))
                                                <a href="{{ route('config.sistema.fazer-conexao', $modulo->id) }}" class="btn btn-primary mx-1 px-4">
                                                    OK
                                                </a>
                                            @else
                                                <button type="submit" class="btn btn-primary mx-1 px-4">
                                                    Sim
                                                </button>
                                                <a href="{{ route('config.sistema.fazer-conexao', $modulo->id) }}" class="btn btn-orange mx-1 px-4">
                                                    Não
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class=" pb-2">
                                    <div class="fs-6 mb-0" id="">
                                        @if (session('usar_conexao_outro_modulo'))
                                            Não foi possível utilizar a conexão do módulo selecionado!
                                        @else
                                            Já existe conexões ativas para outros módulos, deseja utilizar alguma
                                            delas?
                                        @endif
                                    </div>
                                    <form action="{{ route('config.sistema.connect-whatsapp.usar') }}" method="post">
                                        @csrf

                                        @if (is_null(session('usar_conexao_outro_modulo')))
                                            <div class="mb-3 pt-2">
                                                @foreach ($configOutroModulo->get() as $key => $item)
                                                    <div class="" style="">
                                                        <div class="form-check form-switch d-flex">
                                                            <input class="form-check-input  config-checkbox" name="config[]"
                                                                type="checkbox" value="{{ $item->id }}"
                                                                id="config{{ $key }}"
                                                                onchange="setConfigSelecionada(this)"
                                                                style="width: 34px; height: 18px; margin-top: 3px"
                                                                @if ($key == 0) checked @endif />
                                                            <label class="form-check-label fs-4 fw-semibold ms-2">
                                                                <label for="config{{ $key }}">
                                                                    {{ $item->modulo->titulo }}
                                                                </label>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class=" pt-2">
                                            @if (session('usar_conexao_outro_modulo'))
                                                <a href="{{ route('config.sistema.fazer-conexao', $modulo->id) }}" class="btn btn-primary mx-1" >
                                                    OK
                                                </a>
                                            @else
                                                <button type="submit" class="btn btn-primary mx-1">
                                                    Sim
                                                </button>
                                                <a href="{{ route('config.sistema.fazer-conexao', $modulo->id) }}" class="btn btn-orange mx-1">
                                                    Não
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- exibir qr code -->
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <x-alerts.success />
                        <x-alerts.error />
                        <x-alerts.warning />
                        <x-alerts.delete title="Trocar número"
                            desc="Os dados da conexão serão perdidos, deseja continuar? <br> Lembre-se de que, se você tiver selecionado a mesma conexão para outros módulos, elas também serão perdidas." />

                        @php
                            $routeModulo = route('dashboard');
                            if ($modulo->nome == 'cobrancas') {
                                $routeModulo = route('config.sistema.charges.index');
                            }
                            if ($modulo->nome == 'remarketing') {
                                $routeModulo = route('config.sistema.remarketing.index');
                            }
                            if ($modulo->nome == 'rastreamento') {
                                $routeModulo = route('config.sistema.rastreamento.index');
                            }
                            if ($modulo->nome == 'faturamento') {
                                $routeModulo = route('config.sistema.faturamento.index');
                            }
                            if(session('confg_msg_id')) {
                                $routeModulo = route('messages.sending-settings.config', session('confg_msg_id'));
                            }
                            if(session('url_criar_msg')) {
                                $routeModulo = session('url_criar_msg');
                            }
                        @endphp
                        {{-- coloquei esse mesmo if em baixo em section 'scripts' --}}
                        @if (!isset($connected))
                            <div class=" py-5 text-center position-relative pb-3">
                                <img src="{{ $qrcodeBase64->qrcode }}" alt="" width="250" height="250"
                                    class="rounded-4 shadow-lg bg-white p-3" id="qr-code" style="z-index: 2">
                                <div id="load-qr-code"
                                    class="load-qr-code opacity-50 spinner-border text-primary spinner-border-sm"
                                    role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                            <div class="text-center fs-3 mb-3">
                                Caso não seja possível conectar, atualize o QRCode.
                            </div>

                            <div class="text-center mb-5 fs-5">
                                Aguardando uma conexão...
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4  mb-4 justify-content-center">
                                {{-- <a href="{{ route('config.sistema.connect-whatsapp') }}"> --}}
                                <button type="button" class="btn btn-primary  px-5 fs-5" onclick="setQrCode()">
                                    <div class="px-lg-3">Atualizar QR Code</div>
                                </button>
                                {{-- </a> --}}
                                <a href="{{ $routeModulo }}" class="btn btn-light px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Voltar</div>
                                </a>
                            </div>
                        @else
                            <div class="text-center">
                                <!-- Pagamento efetivado -->
                                <div class="d-flex mt-4 mb-4 justify-content-center">
                                    <div
                                        class="pagament-efetivado rounded-3 bg-primary text-white px-5 py-5 fs-7 text-center">
                                        <div class="px-4">
                                            <div class="mb-3  ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-circle-check-filled"
                                                    width="55" height="55" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z"
                                                        stroke-width="0" fill="currentColor" />
                                                </svg>
                                            </div>
                                            Conexão estabelecida

                                            <div class=" fs-6 fw-semibold mt-2">
                                                {{-- se tiver mais de 11 número retorna o original com '+' no começo --}}
                                                {{ formatarTelefoneBr($whatsapp) }}
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                @if ($statusSessionCon == null || $statusSessionCon == false)
                                    <div class="d-flex pb-4 flex-column flex-sm-row gap-3 gap-sm-4 pt-3 justify-content-center"
                                        id="div-trocar">
                                        <form action="{{ route('config.change.whatsapp') }}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-primary px-5 fs-5"
                                                onclick="serUrlDelete(`{{ route('config.change.whatsapp') }}`)">
                                                <div class="px-lg-3">Trocar número</div>
                                            </button>
                                        </form>
                                        <a href="{{ $routeModulo }}" class="btn btn-light  px-4 fs-5 text-primary">
                                            <div class="px-lg-2">
                                                <div class="px-lg-5">Voltar</div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('scripts')


    @if (isset($configOutroModulo) && $configOutroModulo->count() >= 1 && is_null(session('gerar_qrcode_conexao_whatsapp')))
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.8/axios.min.js"
            integrity="sha512-PJa3oQSLWRB7wHZ7GQ/g+qyv6r4mbuhmiDb8BjSFZ8NZ2a42oTtAq5n0ucWAwcQDlikAtkub+tPVCw4np27WCg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>



        @if (!isset($connected))
            <!-- Gerar qrcode e verificar se está conectado a cada 10seg -->
            <script>
                // var setIntQrCode = setInterval(() => {
                //     setQrCode()
                // }, 10000);

                // function startIntervalQrCode() {
                //     setIntQrCode = setInterval(() => {
                //         setQrCode()
                //     }, 10000);
                // }
            </script>
            <!-- Recarregar QR Code -->
            <script>
                function setQrCode() {
                    let baseUrl = "{{ route('config.reload.qrcode') }}"
                    axios.get(baseUrl)
                        .then(res => {
                            document.getElementById('qr-code').src = res.data
                            document.getElementById('load-qr-code').style.display = 'none'
                            document.getElementById('qr-code').style.opacity = '1'
                        })
                        .catch(err => {
                            console.log(err);
                            document.getElementById('load-qr-code').style.display = 'none'
                            document.getElementById('qr-code').style.opacity = '1'
                        })
                }

                // verificar status de conexão
                setInterval(() => {
                    let baseUrl = "{{ route('config.status-conexao') }}"
                    axios.get(baseUrl)
                        .then(res => {

                            console.log(res.data);

                            if (res.data == 'conectado')
                                window.location.reload();
                        })
                        .catch(err => {
                            console.log(err);
                        })
                }, 5000);
            </script>
        @else
            <!-- verificar se está desconectado a cada 5seg -->
            <script>
                setInterval(() => {
                    let baseUrl = "{{ route('config.status-conexao') }}"
                    axios.get(baseUrl)
                        .then(res => {

                            console.log(res.data);

                            if (res.data == 'nao_conectado')
                                window.location.reload();
                        })
                        .catch(err => {
                            console.log(err);
                        })
                }, 5000);
            </script>
            @if ($statusSessionCon)
                <script>
                    setTimeout(() => {
                        window.location.href = "{{ route('dashboard') }}"
                    }, 5000);
                </script>
            @endif

        @endif
    @endif

    <script>
        function setConfigSelecionada(el) {
            let elChecked = el.checked
            for (let i in document.querySelectorAll('.config-checkbox')) {
                document.querySelectorAll('.config-checkbox')[i].checked = false
            }

            setTimeout(() => {
                el.checked = elChecked

                let int = 0
                for (let i in document.querySelectorAll('.config-checkbox')) {
                    if (document.querySelectorAll('.config-checkbox')[i].checked) {
                        int++
                    }
                }

                if (int == 0) {
                    el.checked = true
                }
            }, 10);


        }
    </script>

@endsection
