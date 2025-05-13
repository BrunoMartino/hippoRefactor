@extends('layouts.basic')
@section('title', 'Nova Mensagem')
@section('head')
    <!-- scripts necessários para a lib select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/i18n/pt-BR.js"></script>
    <!-- / scripts necessários para a lib select2 -->
@endsection
@section('style')
    <style>
        #editableDiv {
            overflow: auto;
            position: relative;
        }

        .drag-btn {
            margin: 5px;
            padding: 0px;
            background-color: transparent;
            border: 1px solid transparent;
            cursor: move !important
        }
    </style>
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Mensagens</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none"
                                    href="{{ route('messages.crud.index') }}">Mensagens</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Faturamento - Pedido</li>
                            <li class="breadcrumb-item" aria-current="page">Nova Mensagem</li>
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

                    @if ($whatsappConfig == false)
                        <div class="alert alert-danger text-centers" role="alert">
                            <div class="fs-4">
                                Para realizar as notificações é preciso integrar o whatsapp no módulo Faturamento.
                            </div>
                            <a href="{{ route('messages.faturamento.redi-config-whatsapp') }}"
                                class="btn btn-primary mt-2 fs-4">
                                Configurar Whatsapp
                            </a>
                        </div>
                    @endif

                    @if ($moduloConfigurado == false)
                        <div class="alert alert-danger text-centers" role="alert">
                            <div class="fs-4">
                                Para criar uma mensagem desse tipo, é necessário que o módulo de faturamento esteja
                                configurado
                                em: <span class="fw-semibold">Configurações > Sistema > Faturamento</span>.
                            </div>
                            <a href="{{ route('config.sistema.faturamento.index') }}" class="btn btn-primary mt-2 fs-4">
                                Configurar Módulo
                            </a>
                        </div>
                    @endif

                    @if ($msgExist)
                        <div class="alert alert-light text-dark fs-4 mb-4" role="alert"
                            style="background: #fff5df !important">
                            <i class="ti ti-info-circle fs-4"></i>
                            Já existe uma mensagem do tipo <i class="">FATURAMENTO - PEDIDO EM ANDAMENTO</i>, e você
                            só
                            pode ter
                            uma desse tipo. Se deseja editá-la,
                            <a href="{{ route('messages.faturamento.edit', $msgExist->id) }}" class="text-primary">
                                CLIQUE AQUI
                            </a>.
                        </div>
                    @endif


                    <form action="{{ route('messages.faturamento.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12 col-xl-5 col-xxl-5">
                                <label for="type" class="form-label">Tipo</label>

                                <div class="select2-tipo-mensagem">
                                    <div class="mb-2">
                                        <select id="type"
                                            class=" select-tipo @error('type') is-invalid @enderror form-control custom-select2"
                                            name="type" style="width: 100%; height: 45px">
                                            <option value=""></option>

                                            @if (userHasModule(3))
                                                <option value="AGRADECIMENTO">
                                                    AGRADECIMENTO</option>
                                                <option value="ANIVERSÁRIO">
                                                    ANIVERSÁRIO</option>
                                                <option value="PESQUISA SATISFAÇÃO">
                                                    PESQUISA SATISFAÇÃO</option>
                                            @endif
                                            @if (userHasModule(1))
                                                @if (existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_emitida'))
                                                    <option value="COBRANÇA GERADA">
                                                        COBRANÇA GERADA
                                                    </option>
                                                @endif
                                                @if (existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencendo'))
                                                    <option value="COBRANÇA VENCENDO">
                                                        COBRANÇA VENCENDO
                                                    </option>
                                                @endif
                                                @if (existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_no_vencimento'))
                                                    <option value="COBRANÇA VENCIMENTO">
                                                        COBRANÇA VENCIMENTO
                                                    </option>
                                                @endif
                                                @if (existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencida'))
                                                    <option value="COBRANÇA VENCIDA">
                                                        COBRANÇA VENCIDA
                                                    </option>
                                                @endif
                                            @endif
                                            @if (userHasModule(2))
                                                <option value="FATURAMENTO - PEDIDO RECEBIDO">
                                                    FATURAMENTO - PEDIDO RECEBIDO
                                                </option>
                                                <option value="FATURAMENTO - PEDIDO EM ANDAMENTO" selected>
                                                    FATURAMENTO - PEDIDO EM ANDAMENTO
                                                </option>
                                                <option value="FATURAMENTO - PEDIDO ATENDIDO">
                                                    FATURAMENTO - PEDIDO ATENDIDO
                                                </option>
                                                <option value="FATURAMENTO - PEDIDO EM SEPARAÇÃO">
                                                    FATURAMENTO - PEDIDO EM SEPARAÇÃO
                                                </option>
                                                <option value="FATURAMENTO - PEDIDO VERIFICADO">
                                                    FATURAMENTO - PEDIDO VERIFICADO
                                                </option>
                                            @endif


                                        </select>
                                    </div>
                                </div>
                                @error('type')
                                    <div class="text-danger small fw-semibold">{{ $message }}</div>
                                @enderror


                            </div>
                            <div class="mb-3 col-12 col-xl-7 col-xxl-7">
                                <label for="name" class="form-label">Nome da mensagem</label>
                                <input type="text" class="form-control fs-5 @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder=""
                                    value="{{ old('name', $msgExist ? $msgExist->name : '') }}"
                                    @if ($msgExist || $moduloConfigurado == false || $whatsappConfig == false) disabled @endif required />
                                @error('name')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            @php
                                $nC = 'nome-cliente';
                                $desc = "Olá {{ $nC }} 👋,

Seu pedido {{ pedido }} foi pago, aguardando emissão da nota fiscal. 📦✨

Estamos trabalhando para preparar seu pedido o mais rápido possível. Caso tenha alguma dúvida, estamos à disposição para ajudar 🤗.";

                                if ($msgExist) {
                                    $desc = $msgExist->description;
                                }
                            @endphp
                            <textarea class="form-control fs-5 @error('description') is-invalid @enderror" name="description" id="description"
                                rows="10" required @if ($msgExist || $moduloConfigurado == false || $whatsappConfig == false) disabled @endif>{{ old('description', $desc) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-wrap gap-1">
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ nome-" . "cliente }" @endphp}</button>
                            <button type="button" id="move-pedido" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">@{{ pedido }}</button>
                            <button type="button" id="move-nf" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ nota-" . "fiscal }" @endphp}</button>
                            <button type="button" id="move-nf" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ saudacao }" @endphp}</button>
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ link-"."xml }" @endphp}</button>
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ link-"."nf }" @endphp}</button>

                        </div>
                        <div class="alert mt-2 alert-warning d-inline-block p-2 py-1 mb-2" role="alert">
                            <div class="small">
                                Clique em algum dos itens acima e mova para o campo de descrição (Esses nomes virão da
                                integração ou dos dados importados).
                            </div>
                        </div>
                        <div class="alert alert-light text-dark mb-4" role="alert" style="">
                            Caso tenha selecionado as opções de enviar links, colocar o {@php echo "{ }" @endphp} correspondente,
                            ou seja, caso marcou para enviar link do XML, posicione {@php echo "{ link-"."xml }" @endphp} onde deseja que o
                            link seja enviado na mensagem. Da mesma forma com o link da nota fiscal caso tenha marcado a
                            opção.
                        </div>
                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 mt-4">
                            <button type="submit" class="btn btn-primary  px-5 fs-5"
                                @if ($msgExist || $moduloConfigurado == false || $whatsappConfig == false) disabled @endif>
                                <div class="px-lg-5">Salvar</div>
                            </button>
                            <a href="{{ route('messages.crud.index') }}" class="btn btn-light  px-5 fs-5 text-primary">
                                <div class="px-lg-5">Cancelar</div>
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        $('.select-tipo').select2({
            placeholder: 'Selecionar',
            language: 'pt-BR',
        })
    </script>
@endsection
@section('scripts')
    <script>
        function dragStart(event) {
            event.dataTransfer.setData("text/plain", event.target.innerText);
            document.getElementById('name').setAttribute('readonly', 'true')
            document.getElementById('description').onfocus()
        }

        function dragEnd(event) {
            document.getElementById('name').removeAttribute('readonly')
        }

        function dragOver(event) {
            event.preventDefault(); // Necessário para permitir o drop
            var cursor = document.getElementById("insertionCursor");
            cursor.style.display = "block"; // Mostra o cursor de inserção
            // Ajusta a posição do cursor de inserção
            cursor.style.left = event.clientX - event.target.getBoundingClientRect().left + "px";
            cursor.style.top = event.clientY - event.target.getBoundingClientRect().top - 10 + "px";
        }

        function dropText(event) {
            event.preventDefault();
            var cursor = document.getElementById("insertionCursor");
            cursor.style.display = "none"; // Esconde o cursor de inserção após soltar

            var text = event.dataTransfer.getData("text/plain");
            var selection = window.getSelection();
            var range = document.caretRangeFromPoint(event.clientX, event.clientY);
            if (!range) {
                range = document.createRange();
                range.setStart(selection.anchorNode, selection.anchorOffset);
            }
            selection.removeAllRanges();
            selection.addRange(range);
            document.execCommand("insertText", false, text);
        }

        function dragLeave(event) {
            // Esconde o cursor de inserção quando o arrasto sai do alvo
            document.getElementById("insertionCursor").style.display = "none";
        }

        /* ocultar opções caso o tipo seja ANIVERSÁRIO */
        function hiddenOptionsTypeBirt() {
            let select = document.getElementById('type')
            if (select.value == 'ANIVERSÁRIO') {
                document.getElementById('move-pedido').style.display = 'none'
                document.getElementById('move-nf').style.display = 'none'
                if (document.getElementById('move-dt-nasc'))
                    document.getElementById('move-dt-nasc').style.display = 'inline-block'
            } else {
                document.getElementById('move-pedido').style.display = 'inline-block'
                document.getElementById('move-nf').style.display = 'inline-block'
                if (document.getElementById('move-dt-nasc'))
                    document.getElementById('move-dt-nasc').style.display = 'none'
            }
        }
        document.getElementById('type').onchange = function() {
            if (this.value == 'PESQUISA SATISFAÇÃO')
                window.location.href = "{{ route('messages.crud.create-satisfaction') }}"

            if (this.value == 'COBRANÇA VENCENDO')
                window.location.href = "{{ route('messages.charges.create-expiring') }}"

            if (this.value == 'COBRANÇA VENCIMENTO')
                window.location.href = "{{ route('messages.charges.create-due-date') }}"

            if (this.value == 'COBRANÇA VENCIDA')
                window.location.href = "{{ route('messages.charges.create-overdue') }}"

            if (this.value == 'AGRADECIMENTO')
                window.location.href = "{{ route('messages.crud.create') }}"

            if (this.value == 'ANIVERSÁRIO')
                window.location.href = "{{ route('messages.crud.create-birthday') }}"

            if (this.value == 'COBRANÇA GERADA')
                window.location.href = "{{ route('messages.charges.create-generated') }}"

            if (this.value == 'FATURAMENTO - PEDIDO RECEBIDO')
                window.location.href = "{{ route('messages.faturamento.recebido') }}"

            if (this.value == 'FATURAMENTO - PEDIDO ATENDIDO')
                window.location.href = "{{ route('messages.faturamento.atendido') }}"

            if (this.value == 'FATURAMENTO - PEDIDO EM SEPARAÇÃO')
                window.location.href = "{{ route('messages.faturamento.separacao') }}"

            if (this.value == 'FATURAMENTO - PEDIDO VERIFICADO')
                window.location.href = "{{ route('messages.faturamento.verificado') }}"

            if (this.value == '')
                window.location.href = "{{ route('messages.crud.new') }}"

            hiddenOptionsTypeBirt()
        }
        hiddenOptionsTypeBirt()
    </script>
@endsection
