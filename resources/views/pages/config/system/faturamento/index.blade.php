@extends('layouts.basic')
@section('title', 'Faturamento')
@section('style')
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">

            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Faturamento</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item text-muted">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Faturamento</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div id="cancelar-conta"></div>

    <div class="row">
        <div class="col-12">
            <div class="card" id="content-01">
                <div class="card-body">

                    <x-alerts.success />
                    <x-alerts.error />
                    <x-alerts.warning />


                    <!-- Rastreamento -->
                    <div class="" id="">
                        @php
                            if (is_null($dataConfig)) {
                                $showBtnAtualizar = true;
                                $dataConfigCharge = new stdClass();

                                $dataConfigCharge->enviar_pdf_da_nota_fiscal = false;
                                $dataConfigCharge->enviar_link_da_nota_fiscal = false;
                                $dataConfigCharge->enviar_xml_para_cnpj = false;
                                $dataConfigCharge->enviar_xml_para_cpf = false;
                                $dataConfigCharge->enviar_link_xml = false;
                                $dataConfigCharge->enviar_arquivo_xml = false;
                                $dataConfigCharge->enviar_notificacoes_para_cnpj = false;
                                $dataConfigCharge->enviar_notificacoes_para_cpf = false;
                                $dataConfigCharge->enviar_notificacoes_sobre_o_status_da_separacao_do_pedido = false;

                                $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes = false;
                                $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto = null;

                                $dataConfigCharge->usar_dados_da_integracao = false;

                                $dataConfigCharge->usar_dados_importados = false;
                                $dataConfigCharge->usar_dados_importados_import = '';
                            } else {
                                $dataConfigCharge = $dataConfig;
                            }

                        @endphp
                        @include('pages.config.system.faturamento._options', [
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

            @if (old(
                    'enviar_mensagem_sobre_nao_receber_mais_notificacoes',
                    $dataConfigCharge->enviar_mensagem_sobre_nao_receber_mais_notificacoes))
                document.getElementById('enviar_mensagem_sobre_nao_receber_mais_notificacoes').checked = true;
            @else
                document.getElementById('enviar_mensagem_sobre_nao_receber_mais_notificacoes').checked = false;
            @endif ;
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
    </script>

    @if (session('show_modal_imported_data'))
        <script>
            modalImportedData.show()
        </script>
    @endif

    @if (auth()->user()->hasPermissionTo('edit-modulo-faturamento') == false)
        <script>
            const inputs = (document.querySelector('#content-01')).querySelectorAll('input');

            // Desabilita cada input encontrado
            inputs.forEach(input => {
                input.disabled = true;
            });
        </script>
    @endif

@endsection
