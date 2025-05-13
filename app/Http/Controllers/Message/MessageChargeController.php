<?php

namespace App\Http\Controllers\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Controllers\Config\System\SystemChargeController;

class MessageChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function moduloConfiguradoWhatsApp(): bool
    {
        session()->put('modulo_id_executando', 1);
        $whats = (new SystemChargeController)->statuConexaoWhatsapp();

        return $whats;
    }

    public function redirConfigWhatsapp()
    {
        $previousUrl = url()->previous();
        session()->put('url_criar_msg', $previousUrl);
        return redirect()->route('config.sistema.connect-whatsapp', 1);
    }

    /**
     * Cobrança Gerada
     *
     * @return void
     */
    public function createGenerated()
    {
        abortAccessForModule(1);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');

        // permitir apenas se opções de envio estiver selecionadas
        if (!existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_emitida'))
            abort(403);


        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        $msgExist = $this->msgGenerated();
        $moduloConfigurado = $this->moduloConfigurado();
        return view('pages.messages.messages.charges.create_generated', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function msgGenerated()
    {
        $msg = Message::where('user_id', user_princ()->id)
            ->where('type', 'COBRANÇA GERADA')
            ->where('module_id', 1)
            ->first();
        return $msg;
    }

    /**
     * Cobrança Vencendo
     *
     * @return void
     */
    public function createExpiring()
    {
        abortAccessForModule(1);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgExpiring();
        $moduloConfigurado = $this->moduloConfigurado();
        $whatsappConfig = $this->moduloConfiguradoWhatsApp();

        // permitir apenas se opções de envio estiver selecionadas
        if (!existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencendo'))
            abort(403);

        return view('pages.messages.messages.charges.create_expiring', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function msgExpiring()
    {
        $msg = Message::where('user_id', user_princ()->id)
            ->where('type', 'COBRANÇA VENCENDO')
            ->where('module_id', 1)
            ->first();
        return $msg;
    }

    /**
     * Cobrança Vencimento
     *
     * @return void
     */
    public function createDueDate()
    {
        abortAccessForModule(1);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgDueDate();
        $moduloConfigurado = $this->moduloConfigurado();

        // permitir apenas se opções de envio estiver selecionadas
        if (!existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_no_vencimento'))
            abort(403);

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.charges.create_due_date', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function msgDueDate()
    {
        $msg = Message::where('user_id', user_princ()->id)
            ->where('type', 'COBRANÇA VENCIMENTO')
            ->where('module_id', 1)
            ->first();
        return $msg;
    }

    /**
     * Cobrança Vencida
     *
     * @return void
     */
    public function createOverdue()
    {
        abortAccessForModule(1);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $msgExist = $this->msgOverdue();
        $moduloConfigurado = $this->moduloConfigurado();

        if (!existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencida'))
            abort(403);

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.charges.create_overdue', compact('msgExist', 'moduloConfigurado', 'whatsappConfig'));
    }

    public function msgOverdue()
    {
        $msg = Message::where('user_id', user_princ()->id)
            ->where('type', 'COBRANÇA VENCIDA')
            ->where('module_id', 1)
            ->first();
        return $msg;
    }

    public function moduloConfigurado(): bool
    {
        return ConfigSistemaModulo::where('user_id', user_princ()->id)->where('modulo_id', 1)->exists();
    }

    public function store(MessageStoreRequest $request)
    {
        abortAccessForModule(1);
        authorizePermissions(['criar-mensagens']);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput()->with('whatsapp_nao_configurado', true);

        if ($this->moduloConfigurado() == false)
            return redirect()->back();

        // 
        if ($request->type == 'COBRANÇA GERADA' && $this->msgGenerated())
            abort(403);
        if ($request->type == 'COBRANÇA VENCENDO' && $this->msgExpiring())
            abort(403);
        if ($request->type == 'COBRANÇA VENCIMENTO' && $this->msgDueDate())
            abort(403);
        if ($request->type == 'COBRANÇA VENCIDA' && $this->msgOverdue())
            abort(403);

        // permitir apenas se opções de envio estiver selecionadas
        if ($request->type == 'COBRANÇA GERADA' && !existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_emitida'))
            abort(403);
        if ($request->type == 'COBRANÇA VENCENDO' && !existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencendo'))
            abort(403);
        if ($request->type == 'COBRANÇA VENCIMENTO' && !existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_no_vencimento'))
            abort(403);
        if ($request->type == 'COBRANÇA VENCIDA' && !existOpcaoConfigEnvioCobranca('enviar_notificacao_de_fatura_vencida'))
            abort(403);


        if ($request->type != 'COBRANÇA VENCIMENTO' && $request->type != 'COBRANÇA GERADA')
            if (strpos($request->description, '{{qtd-dias }}') === false && strpos($request->description, '{{ qtd-dias}}') === false && strpos($request->description, '{{qtd-dias}}') === false && strpos($request->description, '{{ qtd-dias }}') === false) :
                return redirect()->back()
                    ->withErrors(['description' => '{{ qtd-dias }} É obrigatório informar na descrição!'])
                    ->withInput();
            endif;

        $message = (new Message)->fill($request->all());
        $message->user_id = user_princ()->id;
        $message->module_id = 1;
        $message->save();

        return redirect()
            ->route('messages.crud.index', $message->id)
            ->withSuccess('Mensagem salva com sucesso!');
    }

    public function edit(Message $message)
    {
        authorizePermissions(['edit-mensagens']);
        if ($message->user_id != user_princ()->id)
            abort(403);
        return view('pages.messages.messages.charges.edit', compact('message'));
    }

    public function update(MessageUpdateRequest $request, Message $message)
    {
        authorizePermissions(['edit-mensagens']);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput()->with('whatsapp_nao_configurado', true);

        if ($message->type != 'COBRANÇA VENCIMENTO' && $message->type != 'COBRANÇA GERADA')
            if (strpos($request->description, '{{qtd-dias }}') === false && strpos($request->description, '{{ qtd-dias}}') === false && strpos($request->description, '{{qtd-dias}}') === false && strpos($request->description, '{{ qtd-dias }}') === false) :
                return redirect()->back()
                    ->withErrors(['description' => '{{ qtd-dias }} É obrigatório informar na descrição!'])
                    ->withInput();
            endif;


        if ($message->user_id != user_princ()->id)
            abort(403);

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
