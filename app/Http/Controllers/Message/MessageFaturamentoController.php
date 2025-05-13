<?php

namespace App\Http\Controllers\Message;

use App\Models\Message;
use App\Models\ConfSistema;
use Illuminate\Http\Request;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Requests\MessageStoreOrderRequest;
use App\Http\Controllers\Config\System\SystemChargeController;

class MessageFaturamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function moduloConfiguradoWhatsApp(): bool
    {
        session()->put('modulo_id_executando', 2);
        $whats = (new SystemChargeController)->statuConexaoWhatsapp();

        return $whats;
    }

    public function redirConfigWhatsapp()
    {
        $previousUrl = url()->previous();
        session()->put('url_criar_msg', $previousUrl);
        return redirect()->route('config.sistema.connect-whatsapp', 2);
    }

    /**
     * Criar msg pedido
     *
     * @return void
     */
    public function createOrderRecebido()
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOrderExist('FATURAMENTO - PEDIDO RECEBIDO');
        $moduloConfigurado = $this->moduloConfigurado();

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.faturamento.create_order_recebido', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function createOrderAndamento()
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOrderExist('FATURAMENTO - PEDIDO EM ANDAMENTO');
        $moduloConfigurado = $this->moduloConfigurado();

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();

        return view('pages.messages.messages.faturamento.create_order_andamento', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function createOrderAtendido()
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOrderExist('FATURAMENTO - PEDIDO ATENDIDO');
        $moduloConfigurado = $this->moduloConfigurado();


        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.faturamento.create_order_atendido', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function createOrderSeparacao()
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOrderExist('FATURAMENTO - PEDIDO EM SEPARAÇÃO');
        $moduloConfigurado = $this->moduloConfigurado();


        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.faturamento.create_order_separacao', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function createOrderVerificado()
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOrderExist('FATURAMENTO - PEDIDO VERIFICADO');
        $moduloConfigurado = $this->moduloConfigurado();

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();

        return view('pages.messages.messages.faturamento.create_order_verificado', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function msgOrderExist($type)
    {
        $msg = Message::where('user_id', user_princ()->id)->where('type', $type)->where('module_id', 2)->first();
        return $msg;
    }

    public function moduloConfigurado(): bool
    {
        return ConfigSistemaModulo::where('user_id', user_princ()->id)->where('modulo_id', 2)->exists();
    }

    public function storeOrder(MessageStoreOrderRequest $request)
    {
        abortAccessForModule(2);
        authorizePermissions(['criar-mensagens']);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput()->with('whatsapp_nao_configurado', true);

        if ($this->moduloConfigurado() == false)
            return redirect()->back();

        if ($request->type == 'FATURAMENTO - PEDIDO RECEBIDO' && $this->msgOrderExist('FATURAMENTO - PEDIDO RECEBIDO'))
            abort(403);
        if ($request->type == 'FATURAMENTO - PEDIDO EM ANDAMENTO' && $this->msgOrderExist('FATURAMENTO - PEDIDO EM ANDAMENTO'))
            abort(403);
        if ($request->type == 'FATURAMENTO - PEDIDO ATENDIDO' && $this->msgOrderExist('FATURAMENTO - PEDIDO ATENDIDO'))
            abort(403);
        if ($request->type == 'FATURAMENTO - PEDIDO EM SEPARAÇÃO' && $this->msgOrderExist('FATURAMENTO - PEDIDO EM SEPARAÇÃO'))
            abort(403);
        if ($request->type == 'FATURAMENTO - PEDIDO VERIFICADO' && $this->msgOrderExist('FATURAMENTO - PEDIDO VERIFICADO'))
            abort(403);

        $message = (new Message)->fill($request->all());
        $message->user_id = user_princ()->id;
        $message->module_id = 2;
        $message->save();

        return redirect()
            ->route('messages.crud.index', $message->id)
            ->withSuccess('Mensagem salva com sucesso!');
    }

    public function editOrder(Message $message)
    {
        if ($message->user_id != user_princ()->id)
            abort(403);

        authorizePermissions(['edit-mensagens']);
        return view('pages.messages.messages.faturamento.edit_order', compact('message'));
    }

    public function update(MessageUpdateRequest $request, Message $message)
    {

        if ($message->user_id != user_princ()->id)
            abort(403);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput()->with('whatsapp_nao_configurado', true);

        authorizePermissions(['edit-mensagens']);

        $message = $message->fill($request->all());
        $message->save();

        session()->forget('confg_msg_id');
        session()->forget('url_criar_msg');

        if (session('url_prev_msg')):
            return redirect(session('url_prev_msg'))->withSuccess('Mensagem atualizada com sucesso!');
        endif;

        return redirect()->route('messages.crud.index')->withSuccess('Mensagem atualizada com sucesso!');
    }
}
