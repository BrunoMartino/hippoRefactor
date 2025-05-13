@extends('layouts.basic')
@section('title', 'Editar Mensagem')
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
                            <li class="breadcrumb-item" aria-current="page">Editar Mensagem</li>
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
                    <form action="{{ route('messages.crud.update-satisfaction', $message->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3 col-12 col-lg-9">
                                <label for="name" class="form-label">Nome da mensagem</label>
                                <input type="text" class="form-control fs-5 @error('name') is-invalid @enderror"
                                    name="name" id="name" placeholder="" value="{{ old('name', $message->name) }}"
                                    required />
                                @error('name')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-lg-3">
                                <label for="type" class="form-label">Tipo</label>
                                <div class="fs-5 bg-light px-3 py-2 rounded border text-truncate">
                                    {{ $message->type }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">



                            <div class="mb-3">
                                @php
                                    $perguntaInicial = isset(
                                        $message->satisfaction_survey['pergunta_inicial']['pergunta'],
                                    )
                                        ? $message->satisfaction_survey['pergunta_inicial']['pergunta']
                                        : '';
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
                                    id="description" rows="5" required>{{ old('pergunta_inicial', $perguntaInicial) }}</textarea>
                                @error('pergunta_inicial')
                                    <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="fw-semibold ps-3">
                                <div id="opcoes-perguntaInicial">

                                    <div class=""> 1 - Claro </div>
                                    <div class=""> 2 - Não, obrigado! </div>

                                </div>

                            </div>
                        </div>

                        <!-- caso não -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO NÃO</strong>
                            </div>

                            <div class="mb-3">
                                @php
                                    $resCasoNao = isset($message->satisfaction_survey['caso_nao_perg_inicial']['msg'])
                                        ? $message->satisfaction_survey['caso_nao_perg_inicial']['msg']
                                        : '';
                                @endphp
                                <label for="resCasoNao" class="form-label visually-hidden">Resposta caso não</label>
                                <textarea class="form-control fs-5 @error('caso_nao_perg_inicial') is-invalid @enderror" name="caso_nao_perg_inicial"
                                    id="resCasoNao" rows="4" required>{{ old('caso_nao_perg_inicial', $resCasoNao) }}</textarea>
                            </div>
                        </div>

                        <!-- Pergunta #1 -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO CLARO</strong>
                            </div>

                            <div class="mb-2">
                                @php
                                    $pergunta1 = isset($message->satisfaction_survey['pergunta1']['pergunta'])
                                        ? $message->satisfaction_survey['pergunta1']['pergunta']
                                        : '';
                                @endphp
                                <label for="pergunta1" class="form-label">Pergunta #1</label>
                                <textarea class="form-control fs-5 @error('pergunta1') is-invalid @enderror" name="pergunta1" id="pergunta1"
                                    rows="4" required>{{ old('pergunta1', $pergunta1) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>
                                <div id="">
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        1. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta1_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][1]) ? $message->satisfaction_survey['pergunta1']['opcoes'][1] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        2. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta1_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][2]) ? $message->satisfaction_survey['pergunta1']['opcoes'][2] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        3. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta1_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][3]) ? $message->satisfaction_survey['pergunta1']['opcoes'][3] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        4. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta1_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][4]) ? $message->satisfaction_survey['pergunta1']['opcoes'][4] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        5. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta1_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta1']['opcoes'][5]) ? $message->satisfaction_survey['pergunta1']['opcoes'][5] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pergunta #2 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta2 = isset($message->satisfaction_survey['pergunta2']['pergunta'])
                                        ? $message->satisfaction_survey['pergunta2']['pergunta']
                                        : '';
                                @endphp
                                <label for="pergunta2" class="form-label">Pergunta #2</label>
                                <textarea class="form-control fs-5 @error('pergunta2') is-invalid @enderror" name="pergunta2" id="pergunta2"
                                    rows="4" required>{{ old('pergunta2', $pergunta2) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>
                                <div id="">
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        1. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta2_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][1]) ? $message->satisfaction_survey['pergunta2']['opcoes'][1] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        2. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta2_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][2]) ? $message->satisfaction_survey['pergunta2']['opcoes'][2] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        3. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta2_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][3]) ? $message->satisfaction_survey['pergunta2']['opcoes'][3] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        4. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta2_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][4]) ? $message->satisfaction_survey['pergunta2']['opcoes'][4] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                    <div class="d-flex gap-2 align-items-end mb-2">
                                        5. <input type="text" class="form-control form-control-sm fs-3 fw-semibold"
                                            name="pergunta2_op[]"
                                            value="{{ isset($message->satisfaction_survey['pergunta2']['opcoes'][5]) ? $message->satisfaction_survey['pergunta2']['opcoes'][5] : '' }}"
                                            style="max-width: 200px" disabled required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pergunta #3 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta3 = isset($message->satisfaction_survey['pergunta3']['pergunta'])
                                        ? $message->satisfaction_survey['pergunta3']['pergunta']
                                        : '';
                                @endphp
                                <label for="pergunta3" class="form-label">Pergunta #3</label>
                                <textarea class="form-control fs-5 @error('pergunta3') is-invalid @enderror" name="pergunta3" id="pergunta3"
                                    rows="4" required>{{ old('pergunta3', $pergunta3) }}</textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie:
                                </div>
                                <div class="">1 - Sim</div>
                                <div class="">2 - Não</div>
                            </div>
                        </div>
                        <!-- Agradecimento -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $agradecimento = isset($message->satisfaction_survey['agradecimento']['msg'])
                                        ? $message->satisfaction_survey['agradecimento']['msg']
                                        : '';
                                @endphp
                                <label for="agradecimento" class="form-label">Agradecimento</label>
                                <textarea class="form-control fs-5 @error('agradecimento') is-invalid @enderror" name="agradecimento"
                                    id="agradecimento" rows="4" required>{{ old('agradecimento', $agradecimento) }}</textarea>
                            </div>
                        </div>
                        <!-- pergunta4 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                @php
                                    $pergunta4 = isset($message->satisfaction_survey['pergunta4']['pergunta'])
                                        ? $message->satisfaction_survey['pergunta4']['pergunta']
                                        : '';
                                @endphp
                                <label for="pergunta4" class="form-label">Pergunta #4</label>
                                <textarea class="form-control fs-5 @error('pergunta4') is-invalid @enderror" name="pergunta4" id="pergunta4"
                                    rows="4" required>{{ old('pergunta4', $pergunta4) }}</textarea>
                            </div>
                        </div>

                        <!-- caso resp. pergunta 4 -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO RESPOSTA DA PERGUNTA #4</strong>
                            </div>

                            <div class="mb-3">
                                @php
                                    $casoResp4 = isset($message->satisfaction_survey['caso_resp_perg4']['msg'])
                                        ? $message->satisfaction_survey['caso_resp_perg4']['msg']
                                        : '';
                                @endphp
                                <label for="casoResp4" class="form-label visually-hidden">CASO RESPOSTA DA PERGUNTA
                                    #4</label>
                                <textarea class="form-control fs-5 @error('caso_resp_perg4') is-invalid @enderror" name="caso_resp_perg4"
                                    id="casoResp4" rows="4" required>{{ old('caso_resp_perg4', $casoResp4) }}</textarea>
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 mt-4">
                            <button type="submit" class="btn btn-primary  px-5 fs-5">
                                <div class="px-lg-5">Atualizar</div>
                            </button>
                            @if (session('url_prev_msg') && session('url_prev_msg') != url()->full())
                                <a href="{{ session('url_prev_msg') }}"
                                    class="btn btn-light  px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Cancelar</div>
                                </a>
                            @else
                                <a href="{{ route('messages.crud.index') }}"
                                    class="btn btn-light  px-5 fs-5 text-primary">
                                    <div class="px-lg-5">Cancelar</div>
                                </a>
                            @endif

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            if (this.value != 'PESQUISA SATISFAÇÃO') {
                localStorage.setItem("edit_type", this.value)
                window.location.href = "{{ route('messages.crud.edit', $message->id) }}"

            }
        }
    </script>
@endsection
