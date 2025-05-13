<?php

namespace App\Http\Controllers\Config\System;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;

class SystemRastreamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin|admin|usuario_princ|usuario_sec', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index()
    {
        abortAccessForModule(4);
        authorizePermissions(['ver-modulo-rastreamento']);

        $dataConfig = ConfigSistemaModulo::where('user_id', user_princ()->id)->where('modulo_id', 4)->first();
        session()->forget('modulo_id_para_redirect');
        $getConfigModuleExist = SystemController::getConfigModuleExist2();
        return view('pages.config.system.rastreamento.index', compact('dataConfig', 'getConfigModuleExist'));
    }

    public function storeConfig(Request $request)
    {

        abortAccessForModule(4);
        authorizePermissions(['edit-modulo-rastreamento']);

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

        /* msg rastremento */
        $enviarCodigoRastreamentoMsgId = null;
        if ($request->has('enviar_codigo_de_rastreamento')) :
            if ($request->enviar_codigo_de_rastreamento_msg_description == null) :
                return redirect()->back()->withInput()->withWarning('Em  "Enviar código de rastreamento" a descrição da mensagem é obrigatória.');
            endif;

            $msgRastreamento = $this->createMsgRastreio($request);
            $enviarCodigoRastreamentoMsgId = $msgRastreamento->id;
        endif;

        /* msg loc atual */
        $msgLocAtualId = null;
        if ($request->has('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria')) :
            if ($request->enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_description == null) :
                return redirect()->back()->withInput()->withWarning('Em  "Enviar mensagem de localização atual da mercadoria" a descrição da mensagem é obrigatória.');
            endif;

            $msgLocAtual = $this->createMsgLocAtual($request);
            $msgLocAtualId = $msgLocAtual->id;
        endif;

        /* msg saiu para entrega */
        $msgSaiuEntregaId = null;
        if ($request->has('enviar_mensagem_de_aviso_saiu_para_entrega')) :
            if ($request->enviar_mensagem_de_aviso_saiu_para_entrega_msg_description == null) :
                return redirect()->back()->withInput()->withWarning('Em  "Enviar mensagem de aviso `Saiu para Entrega`" a descrição da mensagem é obrigatória.');
            endif;

            $msgSaiuEntrega = $this->createMsgSaiuEntregar($request);
            $msgSaiuEntregaId = $msgSaiuEntrega->id;
        endif;


        /* msg confirm entrega */
        $msgConfirmEntregaId = null;
        if ($request->has('enviar_mensagem_de_confirmacao_de_entrega')) :
            if ($request->enviar_mensagem_de_confirmacao_de_entrega_msg_description == null) :
                return redirect()->back()->withInput()->withWarning('Em  "Enviar mensagem de confirmação de entrega" a descrição da mensagem é obrigatória.');
            endif;

            $msgConfirmEntrega = $this->createMsgRastreioConfirm($request);
            $msgConfirmEntregaId = $msgConfirmEntrega->id;
        endif;

        /* msg confirm entrega */
        $msgDestAusentId = null;
        if ($request->has('enviar_mensagem_de_aviso_de_destinatario_ausente')) :
            if ($request->enviar_mensagem_de_aviso_de_destinatario_ausente_msg_description == null) :
                return redirect()->back()->withInput()->withWarning('Em  "Enviar mensagem de aviso de destinatário ausente" a descrição da mensagem é obrigatória.');
            endif;

            $msgDestAusent = $this->createMsgDestinoAusente($request);
            $msgDestAusentId = $msgDestAusent->id;
        endif;


        $msgTextoNaoReceberNotif = null;
        if ($request->has('enviar_mensagem_sobre_nao_receber_mais_notificacoes')):
            $msgTextoNaoReceberNotif = $request->enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto;
            $msgTextoNaoReceberNotif .= "\r\n\r\nPara se retirar da lista de notificações envie SAIR.";
        endif;

        // config
        $dataConfig = [

            'enviar_codigo_de_rastreamento' => $request->has('enviar_codigo_de_rastreamento') ? true : false,
            'enviar_codigo_de_rastreamento_msg_id' => $enviarCodigoRastreamentoMsgId,
            'enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria' => $request->has('enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria') ? true : false,
            'enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_id' => $msgLocAtualId,

            'enviar_mensagem_de_aviso_saiu_para_entrega' => $request->has('enviar_mensagem_de_aviso_saiu_para_entrega') ? true : false,
            'enviar_mensagem_de_aviso_saiu_para_entrega_msg_id' => $msgSaiuEntregaId,

            'enviar_mensagem_de_confirmacao_de_entrega' => $request->has('enviar_mensagem_de_confirmacao_de_entrega') ? true : false,
            'enviar_mensagem_de_confirmacao_de_entrega_msg_id' => $msgConfirmEntregaId,

            'enviar_mensagem_de_aviso_de_destinatario_ausente' => $request->has('enviar_mensagem_de_aviso_de_destinatario_ausente') ? true : false,
            'enviar_mensagem_de_aviso_de_destinatario_ausente_msg_id' => $msgDestAusentId,

            'enviar_mensagem_sobre_nao_receber_mais_notificacoes' => $request->has('enviar_mensagem_sobre_nao_receber_mais_notificacoes') ? true : false,
            'enviar_mensagem_sobre_nao_receber_mais_notificacoes_texto' => $msgTextoNaoReceberNotif,
            'usar_dados_da_integracao' => $request->has('usar_dados_da_integracao') ? true : false,
            'usar_dados_importados' => $request->has('usar_dados_importados') ? true : false,
            'usar_dados_importados_import' => $useImportedDataImport,
            'enviar_notificacoes_para_cnpj' => $request->has('enviar_notificacoes_para_cnpj') ? true : false,
            'enviar_notificacoes_para_cpf' => $request->has('enviar_notificacoes_para_cpf') ? true : false,
        ];

        $confg = ConfigSistemaModulo::updateOrCreate(
            [
                'user_id' => user_princ()->id,
                'modulo_id' => 4, // módulo rastreamento
            ],
            [
                ...$dataConfig
            ]
        );


        // se existe whatsapp
        session()->put('modulo_id_executando', 4);
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

    public function createMsgRastreio($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - CODIGO')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->enviar_codigo_de_rastreamento_msg_description,
            'type' => 'RASTREIO - CODIGO',
        ]);

        return $message;
    }

    public function createMsgDestinatario($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - PROXIMO DESTINO')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->envia_uma_mensagem_com_o_proximo_destino_do_pacote_msg_description,
            'type' => 'RASTREIO - PROXIMO DESTINO',
        ]);

        return $message;
    }

    public function createMsgLocAtual($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - LOC ATUAL')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->enviar_mensagem_de_loc_atual_e_prox_cid_da_mercadoria_msg_description,
            'type' => 'RASTREIO - LOC ATUAL',
        ]);

        return $message;
    }

    public function createMsgSaiuEntregar($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - SAIU ENTREGAR')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->enviar_mensagem_de_aviso_saiu_para_entrega_msg_description,
            'type' => 'RASTREIO - SAIU ENTREGAR',
        ]);

        return $message;
    }

    public function createMsgRastreioConfirm($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - CONFIRMACAO')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->enviar_mensagem_de_confirmacao_de_entrega_msg_description,
            'type' => 'RASTREIO - CONFIRMACAO',
        ]);

        return $message;
    }

    public function createMsgDestinoAusente($request)
    {

        Message::where('user_id', user_princ()->id)
            ->where('module_id', 4)
            ->where('type', 'RASTREIO - AUSENTE')
            ->forceDelete();

        $message = Message::create([
            'module_id' => 4,
            'user_id' => user_princ()->id,
            'name' => 'rastreamento-3',
            'description' => $request->enviar_mensagem_de_aviso_de_destinatario_ausente_msg_description,
            'type' => 'RASTREIO - AUSENTE',
        ]);

        return $message;
    }
}
