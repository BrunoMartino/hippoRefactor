<?php

namespace App\Http\Controllers\Message;

use App\Models\Message;
use App\Models\ConfSistema;
use Illuminate\Http\Request;
use App\Models\SendingSetting;
use App\Models\ConfigSistemaModulo;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageStoreRequest;
use App\Http\Requests\MessageUpdateRequest;
use App\Http\Requests\MessageSatisfactionStoreRequest;
use App\Http\Requests\MessageSatisfactionUpdateRequest;
use App\Http\Controllers\Config\System\SystemChargeController;

class MessageRemarketingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_data_freeplan', 'check_payment', 'check_disabled_account']);
    }

    public function dataSatisfactionSurvey($request)
    {
        if ($this->existSatisfactionSurvey()) : // add valores anteriores

            $primeiraMsgPS = Message::where('user_id', user_princ()->id)
                ->whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])->latest()->first();
            $opcoesPerg1 = $primeiraMsgPS->satisfaction_survey['pergunta1']['opcoes'];
            $opcoesPerg2 = $primeiraMsgPS->satisfaction_survey['pergunta2']['opcoes'];

        else : // salvar novos valores
            $opcoesPerg1 = [
                'titulo' => 'Avalie de 1 a 5:',
                '1' => $request->pergunta1_op[0],
                '2' => $request->pergunta1_op[1],
                '3' => $request->pergunta1_op[2],
                '4' => $request->pergunta1_op[3],
                '5' => $request->pergunta1_op[4],
            ];

            $opcoesPerg2 = [
                'titulo' => 'Avalie de 1 a 5:',
                '1' => $request->pergunta2_op[0],
                '2' => $request->pergunta2_op[1],
                '3' => $request->pergunta2_op[2],
                '4' => $request->pergunta2_op[3],
                '5' => $request->pergunta2_op[4],
            ];
        endif;

        $data = [
            'pergunta_inicial' => [
                'pergunta' => $request->pergunta_inicial,
                'opcoes' => [
                    1 => 'Claro',
                    2 => 'Não, obrigado!',
                ]
            ],
            'caso_nao_perg_inicial' => [
                'msg' => $request->caso_nao_perg_inicial
            ],
            'pergunta1' => [
                'pergunta' => $request->pergunta1,
                'opcoes' => $opcoesPerg1,
            ],
            'pergunta2' => [
                'pergunta' => $request->pergunta2,
                'opcoes' => $opcoesPerg2
            ],
            'pergunta3' => [
                'pergunta' => $request->pergunta3,
                'opcoes' => [
                    "titulo" => "Avalie:",
                    1 => "Sim",
                    2 => "Não"
                ]
            ],
            'agradecimento' => [
                'msg' => $request->agradecimento
            ],
            'pergunta4' => [
                'pergunta' => $request->pergunta4,
            ],
            'caso_resp_perg4' => [
                'msg' => $request->caso_resp_perg4,
            ],
        ];

        return $data;
    }

    public function editSatisfactionSurvey(Message $message)
    {
        authorizePermissions(['edit-mensagens']);
        return view('pages.messages.messages.satisfaction_survey.edit', compact('message'));
    }

    public function updateSatisfactionSurvey(MessageSatisfactionUpdateRequest $request, Message $message)
    {
        authorizePermissions(['edit-mensagens']);

        $data = $this->dataSatisfactionSurvey($request);

        $message->name = $request->name;
        $message->description = $request->description;
        $message->type = 'PESQUISA SATISFAÇÃO';
        $message->satisfaction_survey = $data;
        $message->description = null;
        $message->save();

        session()->forget('confg_msg_id');
        session()->forget('url_criar_msg');
        
        if (session('url_prev_msg')):
            return redirect(session('url_prev_msg'))->withSuccess('Mensagem atualizada com sucesso!');
        endif;

        return redirect()->route('messages.crud.index')->withSuccess('Mensagem atualizada com sucesso!');
    }

    public function createSatisfactionSurvey()
    {
        authorizePermissions(['criar-mensagens']);

        $firstSurvey = $this->getOptionsFirstSurvey();
        session()->forget('url_criar_msg');

        $whatsappConfig = $this->moduloConfiguradoWhatsApp();

        return view('pages.messages.messages.satisfaction_survey.create', compact('firstSurvey', 'whatsappConfig'));
    }

    public function storeSatisfactionSurvey(MessageSatisfactionStoreRequest $request)
    {
        authorizePermissions(['criar-mensagens']);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput();

        $message = (new Message)->fill($request->all());
        $message->user_id = user_princ()->id;
        $message->type = 'PESQUISA SATISFAÇÃO';
        $message->satisfaction_survey = $this->dataSatisfactionSurvey($request);
        $message->module_id = 3;
        $message->save();

        return redirect()
            ->route('messages.sending-settings.config', $message->id)
            ->withSuccess('Mensagem salva com sucesso!');
    }

    public function existSatisfactionSurvey(): bool
    {
        $survey = Message::where('user_id', user_princ()->id)
            ->whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO']);

        return $survey->exists();
    }

    /**
     * Obter opções da primeria msg do tipo 'pergunta de satisfação' para utilizar como padrão
     *
     * @return array
     */
    public function getOptionsFirstSurvey(): array
    {
        $survey = Message::where('user_id', user_princ()->id)
            ->whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])->latest()->first();

        $data = ['op_pergunta1' => [], 'op_pergunta2' => []];

        if ($survey) :
            $data['op_pergunta1'] = $survey->satisfaction_survey['pergunta1']['opcoes'];
            $data['op_pergunta2'] = $survey->satisfaction_survey['pergunta2']['opcoes'];
        endif;

        $survey = [
            'exist' => $this->existSatisfactionSurvey(),
            'data' => $data
        ];

        return $survey;
    }


    public function createAnexoSatisfactionSurvey(Request $request, Message $message)
    {

        abortAccessForModule(3);
        authorizePermissions(['criar-mensagens']);
        $firstSurvey = $this->getOptionsFirstSurvey();


        $configSelecionadas = [
            'name' => null,
            'message_no_receiving_notifications' => null,
            'message_no_receiving_notifications_text' => null,
            'send_message_for_satisfaction_survey' => null,
            'send_message_for_satisfaction_survey_id_message' => null,
            'send_to_pj' => null,
            'send_to_pf' => null,
            'automatic_send_at_9am_every_day' => null,
            'every_day_at_specific_time' => null,
            'every_day_at_specific_time_value' => null,
            'specific_date' => null,
            'specific_date_value_date' => null,
            'specific_date_value_time' => null,
            'only_customers_nf' => null,
            'use_imported_data' => null,
            'use_imported_data_import' => null,
            'use_integration_data' => null,
            'send_only_for_new_sales' => null,
            'send_to_sales_from' => null,
            'send_to_sales_from_date' => null,
            'image' => null,
            ...$request->all()
        ];

        // $configSelecionadas= (new SendingSetting)->fill($request->all());
        unset($configSelecionadas['send_message_for_satisfaction_survey_id_message']);
        session()->put('configs_selecionadas', $configSelecionadas);


        // dd(session('configs_selecionadas'));
        return view('pages.messages.messages.anexo_satisfaction_survey.create', compact('message', 'firstSurvey'));
    }

    public function storeAnexoSatisfactionSurvey(MessageSatisfactionStoreRequest $request, Message $message)
    {
        abortAccessForModule(3);
        authorizePermissions(['criar-mensagens']);
        $newMessage = (new Message)->fill($request->all());
        $newMessage->user_id = user_princ()->id;
        $newMessage->type = 'PESQUISA SATISFAÇÃO ANEXO';
        $newMessage->satisfaction_survey = $this->dataSatisfactionSurvey($request);
        $newMessage->module_id = 3;
        $newMessage->save();

        if (isset($message->id)) :
            return redirect()
                ->route('messages.sending-settings.config', $message->id)
                ->with('anexo_message_id', $newMessage->id)->withInput(session('configs_selecionadas'));
        else :
            return redirect()
                ->route('config.sistema.index')
                ->with(['anexo_message_id' => $newMessage->id, 'edit_config_cobranças' => true]);
        endif;
    }

    public function cancelAnexoSatisfactionSurvey(Message $message)
    {
        if (isset($message->id)) :
            return redirect()
                ->route('messages.sending-settings.config', $message->id)
                ->withInput(session('configs_selecionadas'));
        else :
            return redirect()->route('messages.crud.index');
        endif;
    }

    public function getJsonAnexoSatisfactionSurvey(Request $request)
    {
        $message = Message::where('user_id', user_princ()->id)->where('id', $request->id)->first();


        $perguntaInicial = isset($message->satisfaction_survey['pergunta_inicial']['pergunta']) ? $message->satisfaction_survey['pergunta_inicial']['pergunta'] : '';

        $resCasoNao = isset($message->satisfaction_survey['caso_nao_perg_inicial']['msg']) ? $message->satisfaction_survey['caso_nao_perg_inicial']['msg'] : '';

        $pergunta1 = isset($message->satisfaction_survey['pergunta1']['pergunta']) ? $message->satisfaction_survey['pergunta1']['pergunta'] : '';

        $pergunta2 = isset($message->satisfaction_survey['pergunta2']['pergunta']) ? $message->satisfaction_survey['pergunta2']['pergunta'] : '';

        $pergunta3 = isset($message->satisfaction_survey['pergunta3']['pergunta']) ? $message->satisfaction_survey['pergunta3']['pergunta'] : '';

        $agradecimento = isset($message->satisfaction_survey['agradecimento']['msg']) ? $message->satisfaction_survey['agradecimento']['msg'] : '';

        $pergunta4 = isset($message->satisfaction_survey['pergunta4']['pergunta']) ? $message->satisfaction_survey['pergunta4']['pergunta'] : '';

        $casoResp4 = isset($message->satisfaction_survey['caso_resp_perg4']['msg']) ? $message->satisfaction_survey['caso_resp_perg4']['msg'] : '';

        $data = [
            'msg_nome' => $message->name,
            'pergunta_inicial' => [
                'pergunta' => $perguntaInicial,
                'opcoes' => ($perguntaInicial != '') ? $message->satisfaction_survey['pergunta_inicial']['opcoes'] : []
            ],
            'caso_nao_perg_inicial' => [
                'msg' => $resCasoNao
            ],
            'pergunta1' => [
                'pergunta' => $pergunta1,
                'opcoes' => ($pergunta1 != '') ? $message->satisfaction_survey['pergunta1']['opcoes'] : []
            ],
            'pergunta2' => [
                'pergunta' => $pergunta2,
                'opcoes' => ($pergunta2 != '') ? $message->satisfaction_survey['pergunta2']['opcoes'] : []
            ],
            'pergunta3' => [
                'pergunta' => $pergunta3,
                'opcoes' => ($pergunta3 != '') ? $message->satisfaction_survey['pergunta3']['opcoes'] : []
            ],
            'agradecimento' => [
                'msg' => $agradecimento
            ],
            'pergunta4' => [
                'pergunta' => $pergunta4,
            ],
            'caso_resp_perg4' => [
                'msg' => $casoResp4,
            ],
        ];

        return $data;
    }

    public function moduloConfiguradoWhatsApp(): bool
    {
        session()->put('modulo_id_executando', 3);
        $whats = (new SystemChargeController)->statuConexaoWhatsapp();

        return $whats;
    }

    public function redirConfigWhatsapp()
    {
        $previousUrl = url()->previous();
        session()->put('url_criar_msg', $previousUrl);
        return redirect()->route('config.sistema.connect-whatsapp', 3);
    }

    public function create()
    {
        // abortAccessForModule(3);
        // authorizePermissions(['criar-mensagens']);

        session()->forget('url_criar_msg');
        return view('pages.messages.messages.remarketing.create');
    }

    public function createGratitude()
    {
        abortAccessForModule(3);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        // verificar conexão bling
        // if (SystemController::blingConnectionStatus() == false) :
        // return redirect()->back()->withError('Você não possui uma conexão ativa com o Bling. Vá para Configurações/Sistema e faça a integração com suas credenciais!');
        // endif;
        $whatsappConfig = $this->moduloConfiguradoWhatsApp();

        return view('pages.messages.messages.remarketing.create_gratitude', compact('whatsappConfig'));
    }

    public function createBirthday()
    {
        abortAccessForModule(3);
        authorizePermissions(['criar-mensagens']);
        session()->forget('url_criar_msg');
        $whatsappConfig = $this->moduloConfiguradoWhatsApp();
        return view('pages.messages.messages.remarketing.create_birthday', compact('whatsappConfig'));
    }

    public function store(MessageStoreRequest $request)
    {

        abortAccessForModule(3);
        authorizePermissions(['criar-mensagens']);

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput();

        $message = (new Message)->fill($request->all());
        $message->user_id = user_princ()->id;
        $message->module_id = 3;
        $message->save();

        return redirect()
            ->route('messages.sending-settings.config', $message->id)
            ->withSuccess('Mensagem salva com sucesso!');
    }


    public function edit(Message $message)
    {
        authorizePermissions(['edit-mensagens']);
        return view('pages.messages.messages.remarketing.edit', compact('message'));
    }

    public function update(MessageUpdateRequest $request, Message $message)
    {
        authorizePermissions(['edit-mensagens']);
        $message->name = $request->name;
        $message->description = $request->description;
        $message->satisfaction_survey = null;
        $message->save();

        session()->forget('confg_msg_id');
        session()->forget('url_criar_msg');

        if (session('url_prev_msg')):
            return redirect(session('url_prev_msg'))->withSuccess('Mensagem atualizada com sucesso!');
        endif;

        return redirect()->route('messages.crud.index')->withSuccess('Mensagem atualizada com sucesso!');
    }
}
