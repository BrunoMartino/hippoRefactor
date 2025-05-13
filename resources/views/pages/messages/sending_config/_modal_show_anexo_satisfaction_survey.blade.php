<!--  -->
<div class="modal fade" id="modal-show-anexo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Visualizar Anexo
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelMsgNotify()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">

                    <!-- DADOS -->
                    <div class="">
                        <div class="row">
                            <div class="mb-3 col-12 col-lg-12">
                                <label for="" class="form-label">Nome da mensagem</label>
                                <input type="text" class="form-control fs-5 " id="msg_nome" placeholder=""
                                    value="" disabled required />
                            </div>
                        </div>
                        <div class="mb-4">

                            <div class="mb-3">
                                <label for="pergunta_inicial" class="form-label">Descrição</label>
                                <textarea class="form-control fs-5" id="pergunta_inicial" rows="5" disabled required></textarea>
                            </div>
                            <div class="fw-semibold ps-3" id="pergunta_inicial_op">
                            </div>
                        </div>

                        <!-- caso não -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO NÃO</strong>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label visually-hidden">Resposta caso
                                    não</label>
                                <textarea class="form-control fs-5" id="caso_nao_perg_inicial-msg" rows="4" disabled required></textarea>
                            </div>
                        </div>

                        <!-- Pergunta #1 -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO CLARO</strong>
                            </div>

                            <div class="mb-2">
                                <label for="pergunta1" class="form-label">Pergunta #1</label>
                                <textarea class="form-control fs-5 " id="pergunta1" rows="4" disabled required></textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>
                                <div class="" id="pergunta1_op">

                                </div>
                            </div>
                        </div>

                        <!-- Pergunta #2 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="pergunta2" class="form-label">Pergunta #2</label>
                                <textarea class="form-control fs-5" id="pergunta2" rows="4" disabled required></textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie de 1 a 5:
                                </div>
                                <div class="" id="pergunta2_op"></div>
                            </div>
                        </div>

                        <!-- Pergunta #3 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="pergunta3" class="form-label">Pergunta #3</label>
                                <textarea class="form-control fs-5" id="pergunta3" rows="4" disabled required></textarea>
                            </div>
                            <div class="fw-semibold ps-3">
                                <div class=" mb-2">
                                    Avalie:
                                </div>
                                <div class="" id="pergunta3_op"></div>
                            </div>
                        </div>
                        <!-- Agradecimento -->
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="agradecimento" class="form-label">Agradecimento</label>
                                <textarea class="form-control fs-5 " id="agradecimento" disabled rows="4" required></textarea>
                            </div>
                        </div>
                        <!-- pergunta4 -->
                        <div class="mb-4">
                            <div class="mb-2">
                                <label for="pergunta4" class="form-label">Pergunta #4</label>
                                <textarea class="form-control fs-5 " id="pergunta4" rows="4" disabled required></textarea>
                            </div>
                        </div>

                        <!-- caso resp. pergunta 4 -->
                        <div class="mb-4">
                            <div class="bg-orange-default text-white px-3 py-2 rounded mb-2">
                                <strong>CASO RESPOSTA DA PERGUNTA #4</strong>
                            </div>

                            <div class="mb-3">
                                <label for="caso_resp_perg4" class="form-label visually-hidden">CASO RESPOSTA DA
                                    PERGUNTA #4
                                </label>
                                <textarea class="form-control fs-5" id="caso_resp_perg4" rows="4" disabled required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">
                            <button type="button" data-bs-dismiss="modal"
                                aria-label="Close" class="btn btn-light  px-4 fs-3 text-primary">
                                <div class="px-lg-4">Voltar</div>
                            </button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
