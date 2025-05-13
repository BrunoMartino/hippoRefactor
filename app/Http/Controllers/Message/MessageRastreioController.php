<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;

/* Talvez remover esse controller por não ser utilizado */

class MessageRastreioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    /**
     * Cobrança Gerada
     *
     * @return void
     */
    public function create()
    {
        abortAccessForModule(4);
        authorizePermissions(['criar-mensagens']);
        return view('pages.messages.messages.rastreamento.create');
    }

    public function store(MessageStoreRequest $request)
    {
        abortAccessForModule(4);
        authorizePermissions(['criar-mensagens']);

        $message = (new Message)->fill($request->all());
        $message->user_id = user_princ()->id;
        $message->module_id = 4;
        $message->save();

        return redirect()
            ->route('messages.sending-settings.config', $message->id)
            ->withSuccess('Mensagem salva com sucesso!');
    }

    public function edit(Message $message)
    {
        if ($message->user_id != user_princ()->id)
            abort(403);

        authorizePermissions(['edit-mensagens']);
        return view('pages.messages.messages.rastreamento.edit', compact('message'));
    }

    public function update(MessageUpdateRequest $request, Message $message)
    {

        if ($message->user_id != user_princ()->id)
            abort(403);

        authorizePermissions(['edit-mensagens']);
        // if (strpos($request->description, '{{qtd-dias }}') === false && strpos($request->description, '{{ qtd-dias}}') === false && strpos($request->description, '{{qtd-dias}}') === false && strpos($request->description, '{{ qtd-dias }}') === false) :
        //     return redirect()->back()
        //         ->withErrors(['description' => '{{ qtd-dias }} É obrigatório informar na descrição!'])
        //         ->withInput();
        // endif;

        $message = $message->fill($request->all());
        $message->save();

        return redirect()->route('messages.crud.index')->withSuccess('Mensagem atualizada com sucesso!');
    }
}
