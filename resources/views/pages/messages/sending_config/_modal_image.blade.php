<div class="modal fade" id="modal-image" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
    aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Enviar imagem junto com a mensagem
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="closeModalImg()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">


                    <div class="mt-2">


                        <input type="file" id="input-img" class="visually-hidden" name="image_file"
                            accept="image/jpeg,image/png">

                        @error('image_file')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror


                        <div class="text-center mt-3 mb-4 mx-auto" style="width: 100%; max-width: 350px">
                            <div class="text-start mb-1"> Selecione uma imagem: </div>
                            <button type="button" class="btn btn-none p-0 borde-0 w-100 position-relative"
                                onclick="document.getElementById('input-img').click()">


                                <div class="position-absolute d-flex rounded image-msg-example" style="">
                                    <i class="ti ti-upload fs-12 m-auto text-white"></i>
                                </div>

                                <img src="{{ asset($dataSettings->image ? 'storage/mensagem/' . $dataSettings->image : 'assets/images/examples/default-image.png') }}"
                                    alt="" class="border  w-100 rounded" id="img-elemento" style="min-height: 150px">
                            </button>

                            <div class="text-end small text-muted opacity-75">
                                Tamanho máximo de 500kb
                            </div>
                        </div>

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 justify-content-center">

                            <button type="button" class="btn btn-primary  px-2 fs-3" onclick="closeModalImg()">
                                @if ($dataSettings->image != '')
                                    <div class="px-lg-5">Atualizar</div>
                                @else
                                    <div class="px-lg-5">Salvar</div>
                                @endif
                            </button>

                            <button type="button" class="btn btn-light  px-4 fs-3 text-primary"
                                onclick="resetFileImg()">
                                <div class="px-lg-4">Cancelar</div>
                            </button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
