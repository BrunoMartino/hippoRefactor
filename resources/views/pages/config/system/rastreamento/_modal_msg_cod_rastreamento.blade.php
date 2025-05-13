<div class="modal fade" id="modal-cod-rastre" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Enviar código de rastreamento
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelCodRastremento()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">


                    <div class="alert alert-warning" role="alert" style="display:none" id="alert-erro-msg-rastreio">
                    </div>

                    @php
                        $name = null;
                        $description = null;

                        if ($dataConfigCharge->enviar_codigo_de_rastreamento) {
                            if ($dataConfigCharge->enviar_codigo_de_rastreamento_msg_id != 1) {
                                $msg = \App\Models\Message::find(
                                    $dataConfigCharge->enviar_codigo_de_rastreamento_msg_id,
                                );
                                if ($msg) {
                                    $name = $msg->name;
                                    $description = $msg->description;
                                }
                            }
                        }
                    @endphp


                    <div class="mb-3">
                        <label for="description" class="form-label fs-4">Descrição:</label>
                        @php
                            if (is_null($description)) {
                                $nC = 'nome-cliente';
                                $nR = 'codigo-rastreio';
                                $nL = 'link-rastreamento';
                                $description = "Olá {{ $nC }},

Seu pedido foi enviado com sucesso! Segue abaixo o código de rastreamento para que você possa acompanhar a entrega:

Código de Rastreamento: {{ $nR }}

Você pode acompanhar o status da entrega através do site clicando no link {{ $nL }}.

Atenciosamente,
[Seu Nome / Nome da Empresa]";
                            }
                        @endphp
                        <textarea class="form-control fs-5 @error('enviar_codigo_de_rastreamento_msg_description') is-invalid @enderror"
                            name="enviar_codigo_de_rastreamento_msg_description" id="description" rows="7">{{ old('enviar_codigo_de_rastreamento_msg_description', $description) }}</textarea>
                        @error('enviar_codigo_de_rastreamento_msg_description')
                            <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex flex-wrap gap-1">
                        <button type="button" class="drag-btn rounded-2" draggable="true"
                            ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ codigo-"."rastreio }" @endphp}</button>
                        <button type="button" class="drag-btn rounded-2" draggable="true"
                            ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ nome-"."cliente }" @endphp}</button>
                        <button type="button" class="drag-btn rounded-2" draggable="true"
                            ondragstart="dragStart(event)" ondragend="dragEnd(event)">{@php echo "{ link-"."rastreamento }" @endphp}</button>
                    </div>
                    <div class="alert mt-2 alert-warning d-inline-block p-2 py-1 mb-2" role="alert">
                        <div class="small">
                            Clique no item acima e mova para o campo de descrição (Esse nome virá da integração ou dos
                            dados importados).
                        </div>
                        {{-- <div class="small">
                                Clique em algum dos itens acima e mova para o campo de descrição (Esses nomes já vêm da
                                integração ou dos dados importados).
                            </div> --}}
                    </div>

                    <div class="mt-2">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">

                            <button type="button" class="btn btn-primary  px-2 fs-3"
                                onclick="updateCodRastreamento()";>
                                @if ($dataConfigCharge->enviar_codigo_de_rastreamento != '')
                                    <div class="px-lg-5">Atualizar</div>
                                @else
                                    <div class="px-lg-5">Salvar</div>
                                @endif
                            </button>


                            <button type="button" onclick="cancelCodRastremento()"
                                class="btn btn-light  px-4 fs-3 text-primary">
                                <div class="px-lg-4">Cancelar</div>
                            </button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    /* rastreio */
    function dragStart(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('name').setAttribute('readonly', 'true')
        document.getElementById('description').onfocus()
    }

    function dragEnd(event) {
        document.getElementById('name').removeAttribute('readonly')
    }
    /* destino */
    function dragStartDestino(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('dest_nome').setAttribute('readonly', 'true')
        document.getElementById('dest_description').onfocus()
    }

    function dragEndDestino(event) {
        document.getElementById('dest_nome').removeAttribute('readonly')
    }
    /* confirm entrega */
    function dragStartConfi(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('confir_entrega_nome').setAttribute('readonly', 'true')
        document.getElementById('confir_entrega_description').onfocus()
    }

    function dragEndConfi(event) {
        document.getElementById('confir_entrega_nome').removeAttribute('readonly')
    }
    /* saiu entrega */
    function dragStartSaiur(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('saiu_entregar_nome').setAttribute('readonly', 'true')
        document.getElementById('saiu_entregar_description').onfocus()
    }

    function dragEndSaiur(event) {
        document.getElementById('saiu_entregar_nome').removeAttribute('readonly')
    }
    /* ausente */
    function dragStartAusent(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('dest_ausente_nome').setAttribute('readonly', 'true')
        document.getElementById('dest_ausente_description').onfocus()
    }

    function dragEndAusent(event) {
        document.getElementById('dest_ausente_nome').removeAttribute('readonly')
    }
    /* loc atual */
    function dragStartLocAtual(event) {
        event.dataTransfer.setData("text/plain", event.target.innerText);
        document.getElementById('loc_nome').setAttribute('readonly', 'true')
        document.getElementById('loc_description').onfocus()
    }

    function dragEndLocAtual(event) {
        document.getElementById('loc_nome').removeAttribute('readonly')
    }

    /*  */

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
</script>
