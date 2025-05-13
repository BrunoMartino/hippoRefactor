<div class="modal fade" id="modal-notify" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Não receber notificações
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelMsgNotify()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">
                    <label for="" class="form-label fs-4 fw-semibold mb-1">
                        Mensagem personalizada para não receber mais notificações:
                    </label>
                    <textarea class="form-control visually-hidden" name="enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto" id="msg-not" rows="3">{{ old('enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto', str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto)) }}</textarea>
                    <textarea class="form-control" id="msg-not-insert" rows="3">{{ old('enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto', str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto)) }}</textarea>
                    <div class="small mt-2 pt-2 pb-1 d-flex align-items-center lh-sm gap-1">
                        <i class="ti ti-info-circle"></i>
                        A mensagem a seguir é padrão e ficará logo abaixo da mensagem personalizada.
                    </div>
                    <div class="alert alert-warning p-2 py-1 d-inline-block mt-1 fs-2" role="alert">
                        Para se retirar da lista de notificações envie SAIR
                    </div>

                    <div class="mt-2">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">

                            <button type="button" class="btn btn-primary  px-2 fs-3"
                                onclick="updateMsgNotify()";>
                                @if ($dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto != '')
                                    <div class="px-lg-5">Atualizar</div>
                                @else
                                    <div class="px-lg-5">Salvar</div>
                                @endif
                            </button>


                            <button onclick="cancelMsgNotify()" type="button"
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
