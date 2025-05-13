<?php

namespace App\Http\Controllers\Config\System;

use App\Models\Modulo;
use App\Models\ConfSistema;
use Illuminate\Http\Request;
use App\Services\SystemService;
use App\Services\ApiBlingService;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;
use App\Services\ApiWhatsappService;

class SystemChargeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {

        abortAccessForModule(1);
        authorizePermissions(['ver-modulo-cobrancas']);

        $dataConfigCharge = $this->dataConfigCharge();
        session()->forget('modulo_id_para_redirect');
        $getConfigModuleExist = SystemController::getConfigModuleExist2();
        return view('pages.config.system.charges.index', compact('dataConfigCharge', 'getConfigModuleExist'));
    }

    /**
     * Obter dados de configuração do modulo cobranças
     *
     * @return void
     */
    public function dataConfigCharge()
    {
        abortAccessForModule(1);
        $config = ConfigSistemaModulo::where('user_id', user_princ()->id)->where('modulo_id', 1)->first();

        return $config;
    }

    public function statuConexaoWhatsapp(): bool
    {
        $systemController = (new SystemController((new ApiWhatsappService), (new SystemService(new ApiWhatsappService)), (new ApiBlingService)));

        if ($systemController->statusConexao() == 'conectado')
            return true;

        return false;
    }

    public function storeConfigCharges(Request $request)
    {
        abortAccessForModule(1);
        authorizePermissions(['edit-modulo-cobrancas']);

        /* Grupos de dados importados */
        $useImportedDataImport = null;
        if ($request->has('groups_import')) :
            $useImportedDataImport = $request->groups_import;
        endif;

        if ($request->has('usar_dados_importados') && $useImportedDataImport == '') { // se tiver selecionado dados importados e não tiver dados
            return back()
                ->withInput()
                ->withErrors(['usar_dados_importados' => 'Não tem grupo de dados importados selecionado.']);
        }

        /* formas pag */
        if ($request->has('formas_pagamento') == false) :
            return back()
                ->withInput()
                ->withWarning('É obrigatório selecionar uma opção em "Formas de pagamento".');
        endif;
        $formasPag = 0;
        if ($request->has('formas_pagamento') && is_array($request->formas_pagamento)) :
            $formasPag = $request->formas_pagamento;
        endif;

        // tipo envio boleto
        if ($request->has('enviar_link_do_boleto') == false && $request->has('enviar_pdf_do_boleto') == false) {
            return back()
                ->withInput()
                ->withWarning('É obrigatório selecionar uma opção em "Tipo de envio do boleto".');
        }


        /* Validar dia antes do vencimento em 'Enviar notificação de fatura a vencer' */
        if ($request->has('enviar_notificacao_de_fatura_vencendo')) :

            if ($request->quantidade_de_envios_antecipados == '0') :
                return back()
                    ->withInput()
                    ->withWarning('É obrigatório um valor acima de 0 em "Quantidade de envios" de "Enviar notificação de fatura a vencer". ');
            endif;

            $qDiasENFV = $request->quantidade_de_envios_antecipados;
            $qIntervaloENFV = $request->quantidade_de_dias_de_intervalo_do_envio_vencimento;
            $qDiasAntesENFV = $request->quantidade_de_dias_antes_do_vencimento;

            if ($qIntervaloENFV == '0') :

                if ($qDiasAntesENFV < $qDiasENFV) :
                    return back()
                        ->withInput()
                        ->withWarning('Em "Enviar notificação de fatura a vencer" no campo "Dias antes do vencimento" o valor tem que ser maior ou igual a ' . $qDiasENFV . '.');
                endif;

            elseif ($qDiasENFV >=  $qIntervaloENFV) :
                $qIntervaloENFV = $qIntervaloENFV == '0' ? 1 : $qIntervaloENFV;
                $minDiasENFV = $qDiasENFV * $qIntervaloENFV + ($qDiasENFV - $qIntervaloENFV);

                $minDiasENFV = ($qDiasENFV - 1) * $qIntervaloENFV + $qDiasENFV;

                if ($qDiasAntesENFV < $minDiasENFV) :
                    return back()
                        ->withInput()
                        ->withWarning('Em "Enviar notificação de fatura a vencer" no campo "Dias antes do vencimento" o valor tem que ser maior ou igual a ' . $minDiasENFV . '.');
                endif;

            elseif ($qDiasENFV <  $qIntervaloENFV) :

                $minDiasENFV = ($qDiasENFV - 1) * $qIntervaloENFV + $qDiasENFV;
                if ($qDiasAntesENFV < $minDiasENFV) :
                    return back()
                        ->withInput()
                        ->withWarning('Em "Enviar notificação de fatura a vencer" no campo "Dias antes do vencimento" o valor tem que ser maior ou igual a ' . $minDiasENFV . '.');
                endif;
            endif;
        endif;

        if ($request->has('data_inicial') && strtotime($request->data_inicial) < strtotime(date('Y-m-d') . ' - 1 years')) {
            return back()
                ->withInput()
                ->withWarning('A data do campo "Enviar para faturas com vencimento a partir de" deve ser posterior a ' . date('d/m/Y', strtotime('- 1 years')) . '.');
        }

        // config
        $dataConfigCharge = [
            'enviar_notificacao_de_fatura_emitida' => $request->has('enviar_notificacao_de_fatura_emitida') ? true : false,

            'enviar_notificacao_de_fatura_vencendo' => $request->has('enviar_notificacao_de_fatura_vencendo') ? true : false,
            'quantidade_de_envios_antecipados' => $request->quantidade_de_envios_antecipados, // num
            'quantidade_de_dias_antes_do_vencimento' => $request->quantidade_de_dias_antes_do_vencimento, // num
            'quantidade_de_dias_de_intervalo_do_envio_vencimento' => $request->quantidade_de_dias_de_intervalo_do_envio_vencimento, // num

            'enviar_notificacao_de_fatura_no_vencimento' => $request->has('enviar_notificacao_de_fatura_no_vencimento') ? true : false,

            'enviar_notificacao_de_fatura_vencida' => $request->has('enviar_notificacao_de_fatura_vencida') ? true : false,
            'quantidade_de_envios_apos_vencimento' => $request->quantidade_de_envios_apos_vencimento, // num
            'quantidade_de_dias_de_intervalo_do_envio_vencida' => $request->quantidade_de_dias_de_intervalo_do_envio_vencida, // num

            'enviar_notificacoes_para_cnpj' => $request->has('enviar_notificacoes_para_cnpj') ? true : false,
            'enviar_notificacoes_para_cpf' => $request->has('enviar_notificacoes_para_cpf') ? true : false,
            'enviar_link_do_boleto' => $request->has('enviar_link_do_boleto') ? true : false,
            'enviar_pdf_do_boleto' => $request->has('enviar_pdf_do_boleto') ? true : false,
            'formas_pagamento' => $formasPag,

            'usar_dados_da_integracao' => $request->has('usar_dados_da_integracao') ? true : false,

            'usar_dados_importados' => $request->has('usar_dados_importados') ? true : false,
            'usar_dados_importados_import' => $useImportedDataImport,

            'enviar_para_faturas_com_vencimento_a_partir_de' => $request->has('enviar_para_faturas_com_vencimento_a_partir_de') ? true : false,
            'data_inicial' => $request->data_inicial != null ? date('Y-m-d', strtotime($request->data_inicial)) : null, // 2024-01-01

            'enviar_todos_os_dias_as_hora' =>  $request->enviar_todos_os_dias_as_hora, // 10:00
        ];

        $confg = ConfigSistemaModulo::updateOrCreate(
            [
                'user_id' => user_princ()->id,
                'modulo_id' => 1, // módulo cobranças
            ],
            [
                // 'config' => $dataConfigCharge,
                ...$dataConfigCharge
            ]
        );

        // se existe whatsapp
        session()->put('modulo_id_executando', 1);
        if ($this->statuConexaoWhatsapp() == false):
            return back()->withInput()->withWarning('É necessário que tenha integração com o WhatsApp para utilizar as configurações.');
        endif;

        // se existe bling
        if ($request->has('usar_dados_da_integracao')):
            if (SystemController::configBlingExist() == false)
                return back()
                    ->withInput()
                    ->withWarning('Não há uma integração ativa com o Bling. Acesse as configurações do Bling para ativá-la e utilizar os dados da integração.');
        endif;


        // return $dataConfigCharge;
        return redirect()->back()->withSuccess('Configuração atualizada com sucesso!');
    }
}
