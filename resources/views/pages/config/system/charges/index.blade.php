@extends('layouts.basic')
@section('title', 'Cobranças')
@section('style')
@endsection
@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-2">
        <div class="card-body px-4 py-3">

            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Cobranças</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">Configurações</a>
                            </li>
                            <li class="breadcrumb-item text-muted">Sistema</li>
                            <li class="breadcrumb-item" aria-current="page">Cobranças</li>
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


                    <!-- Cobranças -->
                    <div class="" id="">
                        @php
                            if (is_null($dataConfigCharge)) {
                                $showBtnAtualizar = true;
                                $dataConfigCharge = new stdClass();
                                $dataConfigCharge->enviar_notificacao_de_fatura_emitida = false;

                                $dataConfigCharge->enviar_notificacao_de_fatura_vencendo = false;
                                $dataConfigCharge->quantidade_de_envios_antecipados = null;
                                $dataConfigCharge->quantidade_de_dias_antes_do_vencimento = null;
                                $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencimento = null;

                                $dataConfigCharge->enviar_notificacao_de_fatura_no_vencimento = false;

                                $dataConfigCharge->enviar_notificacao_de_fatura_vencida = false;
                                $dataConfigCharge->quantidade_de_envios_apos_vencimento = null;
                                $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencida = null;

                                $dataConfigCharge->enviar_notificacoes_para_cnpj = false;
                                $dataConfigCharge->enviar_notificacoes_para_cpf = false;
                                $dataConfigCharge->enviar_link_do_boleto = false;
                                $dataConfigCharge->enviar_pdf_do_boleto = false;
                                // $dataConfigCharge->enviar_notificacao_de_boletos = false;
                                // $dataConfigCharge->enviar_notificacao_de_cartao = false;
                                $dataConfigCharge->formas_pagamento = 0;

                                $dataConfigCharge->usar_dados_da_integracao = false;

                                $dataConfigCharge->usar_dados_importados = false;
                                $dataConfigCharge->usar_dados_importados_import = '';

                                $dataConfigCharge->enviar_para_faturas_com_vencimento_a_partir_de = false;
                                $dataConfigCharge->data_inicial = false;

                                $dataConfigCharge->enviar_todos_os_dias_as_hora = null;
                            } else {
                                // $dataConfigCharge = (object) $dataConfigCharge->config;
                                // if ($dataConfigCharge->data_inicial != null) {
                                //     $dataConfigCharge->data_inicial = implode(
                                //         '-',
                                //         array_reverse(explode('/', $dataConfigCharge->data_inicial)),
                                //     );
                                // }
                            }


                        @endphp
                        @include('pages.config.system.charges._content_charge', [
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
        IMask(document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_envios_apos_vencimento'), {
            mask: '00000000000000'
        });
        IMask(document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida'), {
            mask: '00000000000000'
        });
    </script>
    <script>
        document.getElementById('enviar_notificacao_de_fatura_vencendo').onchange = function() {
            if (document.getElementById('enviar_notificacao_de_fatura_vencendo').checked) {
                document.getElementById('quantidade_de_envios_antecipados').required = true
                document.getElementById('quantidade_de_envios_antecipados').value =
                    '{{ $dataConfigCharge->quantidade_de_envios_antecipados }}'
                document.getElementById('quantidade_de_dias_antes_do_vencimento').required = true
                document.getElementById('quantidade_de_dias_antes_do_vencimento').value =
                    "{{ $dataConfigCharge->quantidade_de_dias_antes_do_vencimento }}"
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento').required = true
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento').value =
                    "{{ $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencimento }}"

            } else {
                document.getElementById('quantidade_de_envios_antecipados').required = false
                document.getElementById('quantidade_de_envios_antecipados').value = ''
                document.getElementById('quantidade_de_dias_antes_do_vencimento').required = false
                document.getElementById('quantidade_de_dias_antes_do_vencimento').value = ''
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento').required = false
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencimento').value = ''
            }
            ""
        }
       
        document.getElementById('enviar_notificacao_de_fatura_vencida').onchange = function() {
            if (document.getElementById('enviar_notificacao_de_fatura_vencida').checked) {
                document.getElementById('quantidade_de_envios_apos_vencimento').required = true
                document.getElementById('quantidade_de_envios_apos_vencimento').value =
                    "{{ $dataConfigCharge->quantidade_de_envios_apos_vencimento }}"
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida').required = true
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida').value =
                    "{{ $dataConfigCharge->quantidade_de_dias_de_intervalo_do_envio_vencida }}"
            } else {
                document.getElementById('quantidade_de_envios_apos_vencimento').required = false
                document.getElementById('quantidade_de_envios_apos_vencimento').value = ''
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida').required = false
                document.getElementById('quantidade_de_dias_de_intervalo_do_envio_vencida').value = ''
            }
        }
    </script>

    <script>
        function dateSendSalesToggleRequired() {
            let el = document.getElementById('enviar_para_faturas_com_vencimento_a_partir_de')
            if (el.checked) {
                document.getElementById('data_inicial').required = true
            } else {
                document.getElementById('data_inicial').required = false
            }

        }
        dateSendSalesToggleRequired()


        /* Validar quais checkbox de envio está selecionado 2 */
        function validateSendCheck2(elChange, bool) {
            document.getElementById('enviar_para_faturas_com_vencimento_a_partir_de').checked = false
            if (bool) {
                document.getElementById(elChange.id).checked = true
            }

            dateSendSalesToggleRequired()
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
            if (document.getElementById('group-todos')){
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

    @if (auth()->user()->hasPermissionTo('edit-modulo-cobrancas') == false)
        <script>
            const inputs = (document.querySelector('#content-01')).querySelectorAll('input');

            // Desabilita cada input encontrado
            inputs.forEach(input => {
                input.disabled = true;
            });
        </script>
    @endif
@endsection
