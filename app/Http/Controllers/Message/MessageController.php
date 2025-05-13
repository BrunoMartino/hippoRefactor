<?php

namespace App\Http\Controllers\Message;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SendingSettingController;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function index(Request $request)
    {

        $this->showNotConfigSend();

        authorizePermissions(['ver-mensagens']);
        $messages = $this->filter($request);
        $showNotConfigSend = $this->showNotConfigSend();
        /** @disregard */
        session()->put('url_prev_msg', url()->full());
        return view('pages.messages.messages.index', compact('messages', 'showNotConfigSend'));
    }

    public function filter($request)
    {
        $messages = Message::where('user_id', user_princ()->id)
            ->whereNotIn('type', [
                "PESQUISA SATISFAÇÃO ANEXO",
                "RASTREIO - CODIGO",
                "RASTREIO - PROXIMO DESTINO",
                "RASTREIO - LOC ATUAL",
                "RASTREIO - SAIU ENTREGAR",
                "RASTREIO - CONFIRMACAO",
                "RASTREIO - AUSENTE",
            ]);
        // ->where('type', "!=", "PESQUISA SATISFAÇÃO ANEXO");

        // nome
        if ($request->has('nome') && $request->nome != '') :
            $messages->where('id', $request->nome);
        endif;

        // tipo
        $types = [];
        if ($request->has('t1') && $request->t1 != '')
            $types[] = 'AGRADECIMENTO';
        if ($request->has('t2') && $request->t2 != '')
            $types[] = 'ANIVERSÁRIO';
        if ($request->has('t3') && $request->t3 != '')
            $types[] = 'PESQUISA SATISFAÇÃO';
        if ($request->has('t4') && $request->t4 != '')
            $types[] = 'COBRANÇA GERADA';
        if ($request->has('t5') && $request->t5 != '')
            $types[] = 'COBRANÇA VENCENDO';
        if ($request->has('t6') && $request->t6 != '')
            $types[] = 'COBRANÇA VENCIMENTO';
        if ($request->has('t7') && $request->t7 != '')
            $types[] = 'COBRANÇA VENCIDA';
        if ($request->has('t8') && $request->t8 != '')
            $types[] = 'RASTREAMENTO';
        if ($request->has('t9') && $request->t9 != '')
            $types[] = 'FATURAMENTO - PEDIDO RECEBIDO';
        if ($request->has('t10') && $request->t10 != '')
            $types[] = 'FATURAMENTO - PEDIDO EM ANDAMENTO';
        if ($request->has('t11') && $request->t11 != '')
            $types[] = 'FATURAMENTO - PEDIDO ATENDIDO';
        if ($request->has('t12') && $request->t12 != '')
            $types[] = 'FATURAMENTO - PEDIDO VERIFICADO';
        if ($request->has('t13') && $request->t13 != '')
            $types[] = 'FATURAMENTO - PEDIDO EM SEPARAÇÃO';


        // 'FATURAMENTO - PEDIDO RECEBIDO',
        // 'FATURAMENTO - PEDIDO EM ANDAMENTO',

        // '',
        // 'FATURAMENTO - PEDIDO VERIFICADO',
        // 'FATURAMENTO - PEDIDO EM SEPARAÇÃO',

        if (count($types) > 0)
            $messages->whereIn('type', $types);

        $messages = $messages->latest()->paginate(10);
        return $messages;
    }

    /**
     * Exibir msg de configurações de envio não salvas, apenas para os tipos aniversario, agradecimento e persquisa satisfação
     *
     * @return bool
     */
    public function showNotConfigSend(): bool
    {

        $bool = Message::where('user_id', user_princ()->id)
            ->whereIn('type', ['ANIVERSÁRIO', 'AGRADECIMENTO', 'PESQUISA SATISFAÇÃO',])
            ->doesntHave('sending_setting')
            ->exists();

        return $bool;
    }

    public function show(Message $message)
    {
        authorizePermissions(['ver-mensagens']);
        $sendingSettingController = new SendingSettingController;
        $showMsgIntegrationThisUsed = $sendingSettingController->showMsgIntegrationThisUsed($message);
        $usedIntegrationInOthers = $sendingSettingController->usedIntegrationInOthers($message);
        $dataSettings = $sendingSettingController->dataSettings($message);

        return view('pages.messages.messages.show', compact('message', 'dataSettings', 'showMsgIntegrationThisUsed', 'usedIntegrationInOthers'));
    }

    public function destroy(Message $message)
    {
        authorizePermissions(['deletar-mensagens']);
        if (user_princ()->id != $message->user_id)
            abort(403);

        $message->delete();
        return redirect()->back()->withSuccess('Mensagem deletada com sucesso!');
    }
}
