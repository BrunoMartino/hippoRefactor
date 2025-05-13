<div class="modal fade" id="modal-confirm-entrega" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Enviar mensagem de confirmação de entrega
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelMsgConfirmEntrega()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">


                    <div class="alert alert-warning" role="alert" style="display:none"
                        id="alert-erro-msg-confirm-entrega">
                    </div>

                    @php
                        $name = null;
                        $nC = 'nome-cliente';
                        $description = "Olá, {{ $nC }}, 👋

Seu produto foi entregue com sucesso! 📦🎉  

Se precisar de qualquer ajuda, estou à disposição. 😊

Obrigado por comprar conosco! 🙏

Atenciosamente,
[Nome da Empresa]";

                        if ($dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega) {
                            if ($dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega_msg_id != 1) {
                                $msg = \App\Models\Message::find(
                                    $dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega_msg_id,
                                );
                                if ($msg) {
                                    $name = $msg->name;
                                    $description = $msg->description;
                                }
                            }
                        }
                    @endphp

                    <div class="mb-3">
                        <label for="confir_entrega_description" class="form-label fs-4">Descrição:</label>
                        <textarea
                            class="form-control fs-5 @error('enviar_mensagem_de_confirmacao_de_entrega_msg_description') is-invalid @enderror"
                            name="enviar_mensagem_de_confirmacao_de_entrega_msg_description" id="confir_entrega_description" rows="7">{{ old('enviar_mensagem_de_confirmacao_de_entrega_msg_description', $description) }}</textarea>
                        @error('enviar_mensagem_de_confirmacao_de_entrega_msg_description')
                            <div class="invalid-feedback fw-semibold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-wrap gap-1">
                        <button type="button" class="drag-btn rounded-2" draggable="true"
                            ondragstart="dragStartConfi(event)" ondragend="dragEndConfi(event)">{@php echo "{ nome-"."cliente }" @endphp}</button>
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
                                onclick="updateMsgConfirmEntrega()";>
                                @if ($dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega != '')
                                    <div class="px-lg-5">Atualizar</div>
                                @else
                                    <div class="px-lg-5">Salvar</div>
                                @endif
                            </button>


                            <button type="button" onclick="cancelMsgConfirmEntrega()"
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
