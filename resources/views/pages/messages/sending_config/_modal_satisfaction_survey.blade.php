<div class="modal fade" id="modal-satisfaction-survey" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white ">
                    Anexo da pesquisa
                </h4>
                <button type="button" class="btn btn-transparent border-0 text-white p-0 fs-6" data-bs-dismiss="modal"
                    aria-label="Close" onclick="cancelMsgNotify()">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div class="modal-body p-lg-4 pt-lg-3">
                <div class="">
                    <label for="anexo" class="form-label fs-4 fw-semibold mb-1 ">
                        Selecione uma opção:
                    </label>
                    <div class="mb-3">
                        <select class="form-select form-select-lg"
                            name="send_message_for_satisfaction_survey_id_message" id="anexo">

                            @foreach ($msgsSatisfactionSurveyAnexo as $item)
                                @php
                                    $checkdPes = '';
                                    if (old('send_message_for_satisfaction_survey_id_message')) {
                                        if ($item->id == old('send_message_for_satisfaction_survey_id_message')) {
                                            $checkdPes = 'selected';
                                        }
                                    } else {
                                        if (session('anexo_message_id')) {
                                            if ($item->id == session('anexo_message_id')) {
                                                $checkdPes = 'selected';
                                            }
                                        } else {
                                            if (
                                                $item->id ==
                                                $dataSettings->send_message_for_satisfaction_survey_id_message
                                            ) {
                                                $checkdPes = 'selected';
                                            }
                                        }
                                    }
                                @endphp

                                <option value="{{ $item->id }}" {{ $checkdPes }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        {{-- <a href="{{ route('messages.crud.create-anexo-satisfaction', $message->id) }}"
                            class="btn btn-sm btn-orange">
                            Criar nova pesquisa de satisfação
                        </a> --}}
                        <button type="submit"
                            onclick="document.getElementById('input-img').value='';document.getElementById('form').action = '{{ route('messages.crud.create-anexo-satisfaction', $message->id) }}';"
                            class="btn btn-sm btn-orange">
                            Criar nova pesquisa de satisfação
                        </button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="showAnexo()">
                            Visualizar
                        </button>
                    </div>


                    <div class="mt-4">

                        <div class="d-flex flex-column flex-sm-row gap-3 gap-sm-4 pt-2 ">

                            <button type="button" class="btn btn-primary  px-2 fs-3" data-bs-dismiss="modal"
                                aria-label="Close">
                                <div class="px-lg-5">Salvar</div>
                            </button>

                            <button onclick="cancelAnexoSatisfactionSurvey()" type="button" data-bs-dismiss="modal"
                                aria-label="Close" class="btn btn-light  px-4 fs-3 text-primary">
                                <div class="px-lg-4">Cancelar</div>
                            </button>
                        </div>



                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
