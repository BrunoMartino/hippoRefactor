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
                                Para realizar as notificações é preciso integrar o whatsapp no módulo Remarketing.
                            </div>
                            <a href="{{ route('messages.redir-whatsapp') }}" class="btn btn-primary mt-2 fs-4">
                                Configurar Whatsapp
                            </a>
                        </div>
                    @endif

                    <form action="{{ route('messages.crud.store-satisfaction') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-12 col-lg-5 col-xxl-4">
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
                                                <option value="PESQUISA SATISFAÇÃO" selected>
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
                                                <option value="FATURAMENTO - PEDIDO EM ANDAMENTO">
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
                            <div class="mb-3 col-12 col-lg-7 col-xxl-8">
                                <label for="name" class="form-label">Nome da mensagem</label>
                                <input type="text" class="form-control fs-5 @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="" value="{{ old('name') }}"
                                    @if ($whatsappConfig == false) disabled @endif required />
                                @error('name')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">



                            <div class="mb-3">
                                @php
                                    $perguntaInicial = "Faaaaala {{ nome }}, como vai?\n\n";
                                    $perguntaInicial .=
                                        'Queremos deixar a nossa parceria ainda melhor! Topa responder ';
                                    $perguntaInicial .= 'algumas perguntinhas em troca de um cupom de desconto? Só ';
                                    $perguntaInicial .= 'leva 1 minutinho, bora?';
                                @endphp
                                {{-- <label for="description" class="f  orm-label">Descrição</label> --}}
                                <div class="d-flex flex-wrap gap-1">
                                    <button type="button" class="drag-btn rounded-2" draggable="true"
                                        ondragstart="dragStart(event)"
                                        ondragend="dragEnd(event)">@{{ nome }}</button>
                                    <button type="button" class="drag-btn rounded-2" draggable="true"
                                        ondragstart="dragStart(event)"
                                        ondragend="dragEnd(event)">@{{ saudacao }}</button>
                                </div>
                                <div class=" alert mt-2 alert-warning d-inline-block p-2 py-1" role="alert">
                                    <div class="small">
                                        Clique no item acima e mova para o campo de descrição (Esse nome já virá da
                                        integração ou dos dados importados).
                                    </div>
                                </div>
                                <textarea class="form-control fs-5 @error('pergunta_inicial') is-invalid @enderror" name="pergunta_inicial"
                                    id="description" rows="5" @if ($whatsappConfig == false) disabled @endif required>{{ old('pergunta_inicial', $perguntaInicial) }}</textarea>
                                @error('pergunta_inicial')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=""> 1 - Claro </div>
                                <div class=""> 2 - Não, obrigado! </div>
                                {{-- <div id="opcoes-perguntaInicial">
                                    <div class="d-flex mb-1">
                                        <button type="button" class="btn btn-none py-1 px-2 border-0"
                                            onclick="this.parentNode.remove()">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </div> --}}
                                {{-- <div class="mt-2">
                                    <button type="button" class="btn btn-primary btn-sm border-0 "
                                        onclick="addOpcaoPeguntaInicial()">
                                        <i class="ti ti-plus"></i>
                                    </button>
                                </div> --}}

                            </div>
                        </div>

                        <!-- caso não -->
                        <div class="mb-4">
                            <div class=" bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO NÃO</strong>
                            </div>

                            <div class="mb-3">
                                @php
                                    $resCasoNao = "Sem problemas, {{ nome }}!\n\n";
                                    $resCasoNao .= 'Agradecemos mesmo assim pela sua consideração. ';
                                    $resCasoNao .= 'Se precisar de algo, é só chamar!';
                                @endphp
                                <label for="resCasoNao" class="form-label visually-hidden">Resposta caso não</label>
                                <textarea class="form-control fs-5 @error('caso_nao_perg_inicial') is-invalid @enderror" name="caso_nao_perg_inicial"
                                    id="resCasoNao" rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('caso_nao_perg_inicial', $resCasoNao) }}</textarea>
                            </div>
                        </div>

                        <!-- Pergunta #1 -->
                        <div class="mb-4">
                            <div class=" bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO CLARO</strong>
                            </div>

                            <div class="mb-2">
                                @php
                                    $pergunta1 = 'O produto/serviço atendeu às suas expectativas?';
                                @endphp
                                <label for="pergunta1" class="form-label">Pergunta #1</label>
                                <textarea class="form-control fs-5 @error('pergunta1') is-invalid @enderror" name="pergunta1" id="pergunta1"
                                    rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('pergunta1', $pergunta1) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3 ">

                                @if ($firstSurvey['exist'] == false)
                                    <div class="alert alert-warning py-1 px-2 d-inline-block fw-normal fs-2 mb-2 mt-2"
                                        role="alert">
                                        Essas opções serão utilizadas em todas as próximas pesquisas de satisfação que
                                        você cadastrar.
                                    </div>
                                @endif

                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>

                                <div id="">

                                    @if ($firstSurvey['exist'])
                                        @foreach ($firstSurvey['data']['op_pergunta1'] as $key => $item)
                                            @php
                                                if ($item == 'Avalie de 1 a 5:') {
                                                    continue;
                                                }
                                            @endphp
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                {{ $key }}. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta1_op[]" value="{{ $item }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            1. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta1_op[]" value="Péssimo" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            2. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta1_op[]" value="Ruim" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            3. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta1_op[]" value="Médio" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            4. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta1_op[]" value="Bom" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            5. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta1_op[]" value="Excelente" style="max-width: 200px"
                                                required>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <!-- Pergunta #2 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta2 = 'Suas necessidades foram atendidas durante sua experiência conosco?';
                                @endphp
                                <label for="pergunta2" class="form-label">Pergunta #2</label>
                                <textarea class="form-control fs-5 @error('pergunta2') is-invalid @enderror" name="pergunta2" id="pergunta2"
                                    rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('pergunta2', $pergunta2) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3 ">
                                @if ($firstSurvey['exist'] == false)
                                    <div class="alert alert-warning py-1 px-2 d-inline-block fw-normal fs-2 mb-2 mt-2"
                                        role="alert">
                                        Essas opções serão utilizadas em todas as próximas pesquisas de satisfação que
                                        você cadastrar.
                                    </div>
                                @endif
                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>
                                <div id="">

                                    @if ($firstSurvey['exist'])
                                        @foreach ($firstSurvey['data']['op_pergunta2'] as $key => $item)
                                            @php
                                                if ($item == 'Avalie de 1 a 5:') {
                                                    continue;
                                                }
                                            @endphp
                                            <div class="d-flex gap-2 align-items-end mb-2">
                                                {{ $key }}. <input type="text"
                                                    class="form-control form-control-sm fs-3 fw-semibold"
                                                    name="pergunta2_op[]" value="{{ $item }}"
                                                    style="max-width: 200px" disabled required>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            1. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta2_op[]" value="Péssimo" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            2. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta2_op[]" value="Ruim" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            3. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta2_op[]" value="Médio" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            4. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta2_op[]" value="Bom" style="max-width: 200px" required>
                                        </div>
                                        <div class="d-flex gap-2 align-items-end mb-2">
                                            5. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                                name="pergunta2_op[]" value="Excelente" style="max-width: 200px"
                                                required>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Pergunta #3 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta3 =
                                        'Você consideraria indicar nossos produtos/serviços para outras pessoas?';
                                @endphp
                                <label for="pergunta3" class="form-label">Pergunta #3</label>
                                <textarea class="form-control fs-5 @error('pergunta3') is-invalid @enderror" name="pergunta3" id="pergunta3"
                                    rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('pergunta3', $pergunta3) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie:
                                </div>
                                <div id="">
                                    <div class="">1 - Sim</div>
                                    <div class="">2 - Não</div>
                                </div>
                            </div>
                        </div>
                        <!-- Agradecimento -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $agradecimento =
                                        "Obrigado por ajudar a tornar nossos produtos/serviços ainda melhores! \n\n";
                                    $agradecimento .=
                                        'Como prometido, aqui está seu cupom de desconto para a próxima compra/contratação: CUPOM';
                                @endphp
                                <label for="agradecimento" class="form-label">Agradecimento</label>
                                <textarea class="form-control fs-5 @error('agradecimento') is-invalid @enderror" name="agradecimento"
                                    id="agradecimento" rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('agradecimento', $agradecimento) }}</textarea>
                            </div>
                        </div>
                        <!-- pergunta4 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta4 =
                                        "Notou algo que poderíamos ter feito de forma diferente para tornar sua experiência mais agradável?\n\n";
                                    $pergunta4 .= 'Compartilhe conosco!';
                                @endphp
                                <label for="pergunta4" class="form-label">Pergunta #4</label>
                                <textarea class="form-control fs-5 @error('pergunta4') is-invalid @enderror" name="pergunta4" id="pergunta4"
                                    rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('pergunta4', $pergunta4) }}</textarea>
                            </div>
                        </div>

                        <!-- caso resp. pergunta 4 -->
                        <div class="mb-4">
                            <div class=" bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO RESPOSTA DA PERGUNTA #4</strong>
                            </div>

                            <div class="mb-3">
                                @php
                                    $casoResp4 = 'Agradecemos muito pelo seu feedback e sugestões! ';
                                    $casoResp4 .= 'Sua opinião nos ajuda a melhorar e garantir que nossos ';
                                    $casoResp4 .= 'clientes tenham as melhores experiências possíveis. ';
                                    $casoResp4 .= 'Obrigado por compartilhar seus pensamentos conosco!';
                                @endphp
                                <label for="casoResp4" class="form-label visually-hidden">CASO RESPOSTA DA PERGUNTA
                                    #4</label>
                                <textarea class="form-control fs-5 @error('caso_resp_perg4') is-invalid @enderror" name="caso_resp_perg4"
                                    id="casoResp4" rows="4" @if ($whatsappConfig == false) disabled @endif required>{{ old('caso_resp_perg4', $casoResp4) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 mt-4">
                            <button type="submit" class="btn btn-primary  px-5 fs-5"
                                @if ($whatsappConfig == false) disabled @endif>
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

        document.getElementById('type').onchange = function() {
            if (this.value == 'PESQUISA SATISFAÇÃO')
                window.location.href = "{{ route('messages.crud.create-satisfaction') }}"

            if (this.value == 'COBRANÇA GERADA')
                window.location.href = "{{ route('messages.charges.create-generated') }}"

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

            if (this.value == 'FATURAMENTO - PEDIDO RECEBIDO')
                window.location.href = "{{ route('messages.faturamento.recebido') }}"

            if (this.value == 'FATURAMENTO - PEDIDO EM ANDAMENTO')
                window.location.href = "{{ route('messages.faturamento.andamento') }}"

            if (this.value == 'FATURAMENTO - PEDIDO ATENDIDO')
                window.location.href = "{{ route('messages.faturamento.atendido') }}"

            if (this.value == 'FATURAMENTO - PEDIDO EM SEPARAÇÃO')
                window.location.href = "{{ route('messages.faturamento.separacao') }}"

            if (this.value == 'FATURAMENTO - PEDIDO VERIFICADO')
                window.location.href = "{{ route('messages.faturamento.verificado') }}"

            if (this.value == '')
                window.location.href = "{{ route('messages.crud.new') }}"

        }

        /*  */
        function addOpcaoPeguntaInicial() {
            let el = document.getElementById('opcoes-perguntaInicial');

            let div = document.createElement('div')
            div.className = "d-flex mb-1"
            div.innerHTML = `
                <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                    name="pergunta_inicial_op[]" value="" style="max-width: 200px" required>
                <button type="button" class="btn btn-none py-1 px-2 border-0" onclick="this.parentNode.remove()">
                    <i class="ti ti-trash"></i>
                </button>
            `

            el.appendChild(div)

        }
    </script>
@endsection
