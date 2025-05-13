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
                    <form action="{{ route('messages.crud.update', $message->id) }}" method="post">
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
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição</label>
                            <textarea class="form-control fs-5 @error('description') is-invalid @enderror" name="description" id="description"
                                rows="10" required>{{ old('description', $message->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex flex-wrap gap-1">
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">@{{ nome }}</button>
                            @if ($message->type == 'AGRADECIMENTO')
                                <button type="button" id="move-pedido" class="drag-btn rounded-2" draggable="true"
                                    ondragstart="dragStart(event)"
                                    ondragend="dragEnd(event)">@{{ pedido }}</button>
                                <button type="button" id="move-nf" class="drag-btn rounded-2" draggable="true"
                                    ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ nota-" . "fiscal }" @endphp}</button>
                            @endif
                            {{-- <button type="button" id="move-dt-nasc" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ data-" . "nascimento }" @endphp}</button> --}}
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ saudacao }" @endphp}</button>
                            <button type="button" class="drag-btn rounded-2" draggable="true"
                                ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ contrato }" @endphp}</button>
                        </div>
                        <div class="alert mt-2 alert-warning d-inline-block p-2 py-1" role="alert">
                            <div class="small">
                                Clique em algum dos itens acima e mova para o campo de descrição (Esses nomes virão da
                                integração ou dos dados importados).
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
                                <a href="{{ route('messages.crud.index') }}" class="btn btn-light  px-5 fs-5 text-primary">
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

        /* ocultar opções caso o tipo seja ANIVERSÁRIO */
        function hiddenOptionsTypeBirt() {
            let select = document.getElementById('type')
            if (select.value == 'ANIVERSÁRIO') {
                document.getElementById('move-pedido').style.display = 'none'
                document.getElementById('move-nf').style.display = 'none'
                document.getElementById('move-dt-nasc').style.display = 'inline-block'
            } else {
                document.getElementById('move-pedido').style.display = 'inline-block'
                document.getElementById('move-nf').style.display = 'inline-block'
                document.getElementById('move-dt-nasc').style.display = 'none'
            }
        }
        document.getElementById('type').onchange = function() {
            hiddenOptionsTypeBirt()

            if (this.value == 'PESQUISA SATISFAÇÃO') {
                window.location.href = "{{ route('messages.crud.edit-satisfaction', $message->id) }}"
            }
        }
        hiddenOptionsTypeBirt()
    </script>

    @if ($message->type == 'PESQUISA SATISFAÇÃO')
        <script>
            if (localStorage.getItem('edit_type') != null)
                document.getElementById('type').value = localStorage.getItem('edit_type')
        </script>
    @endif
@endsection
