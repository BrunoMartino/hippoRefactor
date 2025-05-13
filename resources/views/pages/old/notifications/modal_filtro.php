<div class="modal fade" id="modalFiltro" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="<?= URL ?>/notificacoes" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Filtrar Informações</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="contrato">Contrato</label>
                                <input type="text" class="form-control" name="contrato" id="contrato">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" name="nome" id="nome">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="vencInicio">Vencimento Inicial</label>
                                <input type="date" class="form-control" name="vencInicio" id="vencInicio">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="vencFim">Vencimento Final</label>
                                <input type="date" class="form-control" name="vencFim" id="vencFim">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select class="form-control" name="situacao" id="situacao">
                                    <option value=""></option>
                                    <option value="Notificado">Notificado</option>
                                    <option value="Não Notificado">Não Notificado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="notifInicio">Notificação Inicial</label>
                                <input type="date" class="form-control" name="notifInicio" id="notifInicio">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="notifFim">Notificação Final</label>
                                <input type="date" class="form-control" name="notifFim" id="notifFim">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>