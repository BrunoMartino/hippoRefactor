<?php

namespace App\Http\Controllers\Config\System;

use App\Models\ConfSistema;
use Illuminate\Http\Request;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;

class SystemFaturamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {
        abortAccessForModule(2);
        authorizePermissions(['ver-modulo-faturamento']);

        $dataConfig = ConfigSistemaModulo::where('user_id', user_princ()->id)->where('modulo_id', 2)->first();
        session()->forget('modulo_id_para_redirect');
        $getConfigModuleExist = SystemController::getConfigModuleExist2();
        return view('pages.config.system.faturamento.index', compact('dataConfig', 'getConfigModuleExist'));
    }

    public function storeConfig(Request $request)
    {
        abortAccessForModule(2);
        authorizePermissions(['edit-modulo-faturamento']);


        /* Grupos de dados importados */
        $useImportedDataImport = null;
        if ($request->has('groups_import')) :
            $useImportedDataImport = $request->groups_import;
        endif;
        // if ($request->has('groups_import_all')) :
        //     $useImportedDataImport = [];
        // endif;

        if ($request->has('usar_dados_importados') && $useImportedDataImport == '') { // se tiver selecionado dados importados e não tiver dados
            return back()
                ->withInput()
                ->withErrors(['usar_dados_importados' => 'Não tem grupo de dados importados selecionado.']);
        }


        $msgTextoNaoReceberNotif = null;
        if ($request->has('enviar_mensagem_sobre_nao_receber_mais_notificacoes')):
            $msgTextoNaoReceberNotif = $request->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto;
            $msgTextoNaoReceberNotif .= "\r\n\r\nPara se retirar da lista de notificações envie SAIR.";
        endif;


        // config
        $dataConfig = [

            'enviar_pdf_da_nota_fiscal' => $request->has('enviar_pdf_da_nota_fiscal') ? true : false,
            'enviar_link_da_nota_fiscal' => $request->has('enviar_link_da_nota_fiscal') ? true : false,
            'enviar_xml_para_cnpj' => $request->has('enviar_xml_para_cnpj') ? true : false,
            'enviar_xml_para_cpf' => $request->has('enviar_xml_para_cpf') ? true : false,
            'enviar_link_xml' => $request->has('enviar_link_xml') ? true : false,
            'enviar_arquivo_xml' => $request->has('enviar_arquivo_xml') ? true : false,

            'enviar_notificacoes_para_cnpj' => $request->has('enviar_notificacoes_para_cnpj') ? true : false,
            'enviar_notificacoes_para_cpf' => $request->has('enviar_notificacoes_para_cpf') ? true : false,

            'enviar_mensagem_sobre_nao_receber_mais_notificacoes' => $request->has('enviar_mensagem_sobre_nao_receber_mais_notificacoes') ? true : false,
            'enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto' => $msgTextoNaoReceberNotif,
            'usar_dados_da_integracao' => $request->has('usar_dados_da_integracao') ? true : false,
            'usar_dados_importados' => $request->has('usar_dados_importados') ? true : false,
            'usar_dados_importados_import' => $useImportedDataImport,
        ];

        $confg = ConfigSistemaModulo::updateOrCreate(
            [
                'user_id' => user_princ()->id,
                'modulo_id' => 2, // módulo faturamento
            ],
            [
                // 'config' => $dataConfig,
                ...$dataConfig
            ]
        );


        // se existe whatsapp
        session()->put('modulo_id_executando', 2);
        if ((new SystemChargeController)->statuConexaoWhatsapp() == false):
            return back()->withInput()->withWarning('É necessário que tenha integração com o WhatsApp para utilizar as configurações.');
        endif;

        // se existe bling
        if ($request->has('usar_dados_da_integracao')):
            if (SystemController::configBlingExist() == false)
                return back()
                    ->withInput()
                    ->withWarning('Não há uma integração ativa com o Bling. Acesse as configurações do Bling para ativá-la e utilizar os dados da integração.');
        endif;


        // return $dataConfig;
        return redirect()->back()->withSuccess('Configuração atualizada com sucesso!');
    }
}
