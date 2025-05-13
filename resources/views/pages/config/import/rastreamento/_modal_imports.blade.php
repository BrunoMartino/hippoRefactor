<style>
    #modal-imports .modal-dialog {
        min-width: 95vw
    }

    @media (min-width: 1400px) {
        #modal-imports .modal-dialog {
            min-width: 90vw
        }
    }
</style>
<div class="modal fade" id="modal-imports" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Dados Importados
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">

                    <div class="">
                        <form action="#" method="post" class="" id="form-deletar2" style="display: none">
                            @csrf
                            @method('DELETE')

                            <div class="alert alert-warning text-center" role="alert">
                                <strong class="fs-5">Deletar Dados</strong>
                                <div class="fs-4">
                                    Você tem certeza de que deseja deletar este registro?
                                </div>
                                <div class="mt-2 d-flex gap-2 justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm px-3" id="btn-deletar-regitro2">
                                        Ok
                                    </button>
                                    <button type="button" class="btn btn-light text-orange btn-sm px-3 "
                                        onclick="closeAlertDelete2()">
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-hover  ">
                            <thead>
                                <tr class="border-0">
                                    <th scope="" class="p-0 border-0 pb-2 pe-3">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            Nome
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            Tipo
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary text-truncate  ">
                                            Nº do Pedido
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Nº Nota Fiscal
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  ">
                                            WhatsApp
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Data de nascimento
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Contrato
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Vencimento
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Link
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            Gênero
                                        </div>
                                    </th>
                                    <th scope="" class="py-0 border-0 pb-2 ps-0 text-truncate">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-truncate">
                                            UF
                                        </div>
                                    </th>
                                    <th scope="col " class="py-0 border-0 pb-2 px-0">
                                        <div class="p-3 border rounded-2 fw-semibold fs-4 text-primary  text-center">
                                            Ações
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="" id="dados-tabela">
                            </tbody>
                        </table>
                    </div>


                    <div class="mt-2">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">
                            <button data-bs-dismiss="modal" aria-label="Close" type="button"
                                class="btn btn-light  px-4 fs-3 text-primary">
                                <div class="px-lg-4">Voltar</div>
                            </button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
