@extends('layouts.basic')
@section('title', 'Rastreamento')
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
                    <h4 class="fw-semibold mb-8">Rastreamento</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item text-muted">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Rastreamento</li>
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
                <div class="card-body" id="content-01">
                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />


                    <!-- Rastreamento -->
                    <div class="" id="">
                        @php
                            if (is_null($dataConfig)) {
                                $showBtnAtualizar = true;
                                $dataConfigCharge = new stdClass();
                                $dataConfigCharge->enviar_codigo_de_rastreamento = false;
                                $dataConfigCharge->enviar_codigo_de_rastreamento_msg_id = null;

                                $dataConfigCharge->enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria = false;
                                $dataConfigCharge->enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id = false;

                                $dataConfigCharge->enviar_mensagem_de_aviso_saiu_para_entrega = false;
                                $dataConfigCharge->enviar_mensagem_de_aviso_saiu_para_entrega_msg_id = null;

                                $dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega = false;
                                $dataConfigCharge->enviar_mensagem_de_confirmacao_de_entrega_msg_id = null;

                                $dataConfigCharge->enviar_mensagem_de_aviso_de_destinatario_ausente = false;
                                $dataConfigCharge->enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id = null;

                                $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes = false;
                                $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto = null;

                                $dataConfigCharge->usar_dados_da_integracao = false;

                                $dataConfigCharge->usar_dados_importados = false;
                                $dataConfigCharge->usar_dados_importados_import = '';

                                $dataConfigCharge->enviar_notificacoes_para_cnpj = false;
                                $dataConfigCharge->enviar_notificacoes_para_cpf = false;
                            } else {
                                $dataConfigCharge = $dataConfig;
                            }

                        @endphp
                        @include('pages.config.system.rastreamento._options', [
                            'dataConfigCharge' => $dataConfigCharge,
                            'showBtnAtualizar' => isset($showBtnAtualizar) ? true : false,
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <!-- Imask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/imask/7.1.3/imask.min.js"></script>
    <script>
        IMask(document.getElementById('quantidade_de_envios_antecipados'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_dias_antes_do_vencimento'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_dias_de_intervalo_do_envio'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_envios_no_vencimento'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_horas_de_intervalo_do_envio'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_envios_apos_vencimento'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_dias_intervalo_do_envio'), {
            mask: '00000000000000'
        });
    </script>


    <script>
        /* Modal msg não receber notificações */
        const modalMsgNotify = new bootstrap.Modal(document.getElementById("modal-notify"));

        document.getElementById('enviar_mensagem_sobre_nao_receber_mais_notificacoes').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('enviar_mensagem_sobre_nao_receber_mais_notificacoes').checked) {
                    modalMsgNotify.show()
                }
            }, 100);
        }

        function cancelMsgNotify() {
            document.getElementById('msg-not-insert').value =
                `{{ str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto) }}`;
            document.getElementById('msg-not').value =
                `{{ str_replace("\r\n\r\nPara se retirar da lista de notificações envie SAIR.", '', $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto) }}`;

            modalMsgNotify.hide()
        }

        function updateMsgNotify() {
            document.getElementById('msg-not').value = document.getElementById('msg-not-insert').value
            modalMsgNotify.hide()
        }
    </script>


    <script>
        document.getElementById('enviar_notificacoes_para_cnpj').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('enviar_notificacoes_para_cnpj').checked == false) {
                    document.getElementById('enviar_notificacoes_para_cpf').checked = true
                }
            }, 100);
        }
        document.getElementById('enviar_notificacoes_para_cpf').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('enviar_notificacoes_para_cpf').checked == false) {
                    document.getElementById('enviar_notificacoes_para_cnpj').checked = true
                }
            }, 100);
        }

        if (document.getElementById('enviar_notificacoes_para_cnpj').checked == false && document.getElementById(
                'enviar_notificacoes_para_cpf').checked == false) {
            document.getElementById('enviar_notificacoes_para_cnpj').checked = true
        }
    </script>

    <!-- Importar dados -->
    <script>
        const modalImportedData = new bootstrap.Modal(document.getElementById("modal-imported-data"));
        // modalImportedData.show()

        document.getElementById('usar_dados_importados').onchange = function() {

            // exibir modal se for selecionado
            if (document.getElementById('usar_dados_importados').checked) {
                modalImportedData.show();
            }

            setTimeout(() => {
                if (document.getElementById('usar_dados_importados').checked == false) {
                    document.getElementById('usar_dados_da_integracao').checked = true
                }
            }, 100);
        }

        document.getElementById('usar_dados_da_integracao').onchange = function() {
            setTimeout(() => {
                if (document.getElementById('usar_dados_da_integracao').checked == false) {
                    document.getElementById('usar_dados_importados').checked = true
                    modalImportedData.show();
                }
            }, 100);
        }

        if (document.getElementById('usar_dados_da_integracao').checked == false && document.getElementById(
                'usar_dados_importados').checked == false) {
            document.getElementById('usar_dados_da_integracao').checked = true
        }

        function saveImportedData() {
            let itens = document.querySelectorAll('.check-imported-groups')
            let checkeds = 0;
            for (let i in itens) {
                if (itens[i].checked)
                    checkeds++;
            }

            if (checkeds == 0) {
                Swal.fire({
                    title: "Aviso!",
                    text: "Você precisa selecionar pelo menos uma opção antes de salvar!",
                    icon: "warning",
                });
            } else {
                modalImportedData.hide()
            }
        }

        function cancelImportedData() {
            modalImportedData.hide()
            document.getElementById('usar_dados_importados').checked = false;
            document.getElementById('usar_dados_da_integracao').checked = true;
        }

        if (document.getElementById('group-todos'))
            document.getElementById('group-todos').onchange = function() {
                let itens = document.querySelectorAll('.check-imported-groups')
                if (document.getElementById('group-todos').checked) {
                    for (let i in itens) {
                        itens[i].checked = true
                    }
                }
                if (document.getElementById('group-todos').checked == false) {
                    for (let i in itens) {
                        itens[i].checked = false
                    }
                }
            }

        function changeGroupImport() {
            // document.getElementById('group-todos').checked = false

            let itens = document.querySelectorAll('.check-imported-groups')
            let noChecks = 0
            for (let i in itens) {
                if (itens[i].checked == false)
                    noChecks++
            }
            if (document.getElementById('group-todos')) {
                if (noChecks > 0) {
                    document.getElementById('group-todos').checked = false
                } else {
                    document.getElementById('group-todos').checked = true
                }
            }

        }

        changeGroupImport()


        /* Modal cod rastremento */
        const modalRastreio = new bootstrap.Modal(document.getElementById("modal-cod-rastre"));
        document.getElementById('enviar_codigo_de_rastreamento').onchange = function() {
            let elCheck = document.getElementById('enviar_codigo_de_rastreamento')
            if (elCheck.checked) {
                modalRastreio.show()
                document.getElementById('description').required = true
            } else {
                document.getElementById('description').required = false
            }
        }

        function updateCodRastreamento() {
            if (document.getElementById('description').value == '') {
                if (document.getElementById('description').value == '') {
                    document.getElementById('alert-erro-msg-rastreio').style.display = 'block'
                    document.getElementById('alert-erro-msg-rastreio').innerHTML = 'A descrição é obrigatória.'
                }
            } else {
                modalRastreio.hide()
            }
        }

        document.getElementById('description').onkeyup = function() {
            document.getElementById('alert-erro-msg-rastreio').style.display = 'none'
        }

        function cancelCodRastremento() {
            modalRastreio.hide()

            if (document.getElementById('description').value == '') {
                document.getElementById('enviar_codigo_de_rastreamento').checked = false
            }

            let elCheck = document.getElementById('enviar_codigo_de_rastreamento')

            if (elCheck.checked) {
                document.getElementById('description').required = true
            } else {
                document.getElementById('description').required = false
            }

        }


        /* Modal loc atual */
        const modalLocAtual = new bootstrap.Modal(document.getElementById("modal-loc-atual"));
        document.getElementById('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria').onchange =
            function() {
                let elCheck = document.getElementById('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria')
                if (elCheck.checked) {
                    modalLocAtual.show()
                    document.getElementById('loc_description').required = true
                } else {
                    document.getElementById('loc_description').required = false
                }
            }

        function updateMsgLocAtual() {
            if (document.getElementById('loc_description').value == '') {
                if (document.getElementById('loc_description').value == '') {
                    document.getElementById('alert-erro-msg-loc').style.display = 'block'
                    document.getElementById('alert-erro-msg-loc').innerHTML = 'A descrição é obrigatória.'
                }
            } else {
                modalLocAtual.hide()
            }
        }

        document.getElementById('loc_description').onkeyup = function() {
            document.getElementById('alert-erro-msg-loc').style.display = 'none'
        }

        function cancelMsgLocAtual() {
            modalLocAtual.hide()

            if (document.getElementById('loc_description').value == '') {
                document.getElementById('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria').checked =
                    false
            }

            let elCheck = document.getElementById('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria')

            if (elCheck.checked) {
                document.getElementById('loc_description').required = true
            } else {
                document.getElementById('loc_description').required = false
            }

        }

        /* Modal saiu entregar */
        const modalSaiuEntrega = new bootstrap.Modal(document.getElementById("modal-saiu-entregar"));
        document.getElementById('enviar_mensagem_de_aviso_saiu_para_entrega').onchange = function() {
            let elCheck = document.getElementById('enviar_mensagem_de_aviso_saiu_para_entrega')
            if (elCheck.checked) {
                modalSaiuEntrega.show()
                document.getElementById('saiu_entregar_description').required = true
            } else {
                document.getElementById('saiu_entregar_description').required = false
            }
        }

        function updateMsgSaiuEntregar() {
            if (document.getElementById('saiu_entregar_description').value == '') {
                if (document.getElementById('saiu_entregar_description').value == '') {
                    document.getElementById('alert-erro-msg-saiu-entregar').style.display = 'block'
                    document.getElementById('alert-erro-msg-saiu-entregar').innerHTML = 'A descrição é obrigatória.'
                }
            } else {
                modalSaiuEntrega.hide()
            }
        }

        document.getElementById('saiu_entregar_description').onkeyup = function() {
            document.getElementById('alert-erro-msg-saiu-entregar').style.display = 'none'
        }

        function cancelMsgSaiuEntregar() {
            modalSaiuEntrega.hide()

            if (document.getElementById('saiu_entregar_description').value == '') {
                document.getElementById('enviar_mensagem_de_aviso_saiu_para_entrega').checked = false
            }

            let elCheck = document.getElementById('enviar_mensagem_de_aviso_saiu_para_entrega')

            if (elCheck.checked) {
                document.getElementById('saiu_entregar_description').required = true
            } else {
                document.getElementById('saiu_entregar_description').required = false
            }

        }


        /* Modal rastreio confirmação */
        const modalConfirmEntrega = new bootstrap.Modal(document.getElementById("modal-confirm-entrega"));
        document.getElementById('enviar_mensagem_de_confirmacao_de_entrega').onchange = function() {
            let elCheck = document.getElementById('enviar_mensagem_de_confirmacao_de_entrega')
            if (elCheck.checked) {
                modalConfirmEntrega.show()
                document.getElementById('confir_entrega_description').required = true
            } else {
                document.getElementById('confir_entrega_description').required = false
            }
        }

        function updateMsgConfirmEntrega() {
            if (document.getElementById('confir_entrega_description').value == '') {
                if (document.getElementById('confir_entrega_description').value == '') {
                    document.getElementById('alert-erro-msg-confirm-entrega').style.display = 'block'
                    document.getElementById('alert-erro-msg-confirm-entrega').innerHTML = 'A descrição é obrigatória.'
                }

            } else {
                modalConfirmEntrega.hide()
            }
        }

        document.getElementById('confir_entrega_description').onkeyup = function() {
            document.getElementById('alert-erro-msg-confirm-entrega').style.display = 'none'
        }

        function cancelMsgConfirmEntrega() {
            modalConfirmEntrega.hide()

            if (document.getElementById('confir_entrega_description').value == '') {
                document.getElementById('enviar_mensagem_de_confirmacao_de_entrega').checked = false
            }

            let elCheck = document.getElementById('enviar_mensagem_de_confirmacao_de_entrega')

            if (elCheck.checked) {
                document.getElementById('confir_entrega_description').required = true
            } else {
                document.getElementById('confir_entrega_description').required = false
            }

        }


        /* ============== Modal destino ausente ============= */
        const modalDestAusente = new bootstrap.Modal(document.getElementById("modal-dest-ausente"));
        document.getElementById('enviar_mensagem_de_aviso_de_destinatario_ausente').onchange = function() {
            let elCheck = document.getElementById('enviar_mensagem_de_aviso_de_destinatario_ausente')
            if (elCheck.checked) {
                modalDestAusente.show()
                document.getElementById('dest_ausente_description').required = true
            } else {
                document.getElementById('dest_ausente_description').required = false
            }
        }

        function updateMsgDestAusente() {
            if (document.getElementById('dest_ausente_description').value == '') {
                if (document.getElementById('dest_ausente_description').value == '') {
                    document.getElementById('alert-erro-msg-dest-ausente').style.display = 'block'
                    document.getElementById('alert-erro-msg-dest-ausente').innerHTML = 'A descrição é obrigatória.'
                }

            } else {
                modalDestAusente.hide()
            }
        }

        document.getElementById('dest_ausente_description').onkeyup = function() {
            document.getElementById('alert-erro-msg-dest-ausente').style.display = 'none'
        }

        function cancelMsgDestAusente() {
            modalDestAusente.hide()

            if (document.getElementById('dest_ausente_description').value == '') {
                document.getElementById('enviar_mensagem_de_aviso_de_destinatario_ausente').checked = false
            }

            let elCheck = document.getElementById('enviar_mensagem_de_aviso_de_destinatario_ausente')

            if (elCheck.checked) {
                document.getElementById('dest_ausente_description').required = true
            } else {
                document.getElementById('dest_ausente_description').required = false
            }

        }
    </script>

    @if (session('show_modal_imported_data'))
        <script>
            modalImportedData.show()
        </script>
    @endif

    @if (auth()->user()->hasPermissionTo('edit-modulo-rastreamento') == false)
        <script>
            const inputs = (document.querySelector('#content-01')).querySelectorAll('input');

            // Desabilita cada input encontrado
            inputs.forEach(input => {
                input.disabled = true;
            });
        </script>
    @endif

@endsection
