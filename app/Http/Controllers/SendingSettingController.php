<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ConfSistema;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SendingSetting;
use App\Models\ImportedOrderGroup;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SendingSettingStoreRequest;
use App\Http\Controllers\Config\System\SystemController;
use App\Http\Controllers\Config\System\SystemChargeController;

class SendingSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check_disabled_account']);
    }

    public function moduloConfiguradoWhatsApp(): bool
    {
        session()->put('modulo_id_executando', 3);
        $whats = (new SystemChargeController)->statuConexaoWhatsapp();

        return $whats;
    }

    public function config(Message $message)
    {
        session()->forget('confg_msg_id');

        $dataSettings = $this->dataSettings($message);
        $msgsSatisfactionSurveyAnexo = Message::where('user_id', user_princ()->id)
            ->where('type', "PESQUISA SATISFAÇÃO ANEXO")
            ->orderBy('name')->get();
        /* TODO: talves corrigir para pegar dados para user sec */
        $grupoDataImport = ImportedOrderGroup::where('user_id', user_princ()->id)
            ->where('module_id', $message->module_id)
            ->latest()->get();

        $showMsgIntegrationThisUsed = $this->showMsgIntegrationThisUsed($message);
        $usedIntegrationInOthers = $this->usedIntegrationInOthers($message);

        // SendingSetting::where('id', '>', 0)->delete();

        // dd($message->toArray()['sending_setting']['settings']);

        session()->forget('configs_selecionadas');

        return view('pages.messages.sending_config.config', compact(
            'message',
            'dataSettings',
            'msgsSatisfactionSurveyAnexo',
            'grupoDataImport',
            'showMsgIntegrationThisUsed',
            'usedIntegrationInOthers'
        ));
    }

    public function redirCofigWhatsapp($msgId)
    {
        session()->put('confg_msg_id', $msgId);
        return redirect()->route('config.sistema.connect-whatsapp', 3);
    }


    public function showMsgIntegrationThisUsed($message): bool
    {
        $dataSettings = $this->dataSettings($message);

        if ($dataSettings->use_integration_data)
            return true;

        return false;
    }

    public function usedIntegrationInOthers($message): bool
    {
        $x = Message::where('user_id', user_princ()->id)
            ->where('type', $message->type)
            ->whereHas('sending_setting', function ($query) {
                return $query->where('use_integration_data',  true);
            })->count();

        if ($x > 0)
            return true;

        return false;
    }

    public function dataSettings($message): object
    {

        // dd($this->issetInArray($message, 'message_no_receiving_notifications_text'));

        
        return (object) [
            'name' => isset($message->name) ? $message->name : '',
            'message_no_receiving_notifications' => $this->issetInArray($message, 'message_no_receiving_notifications'),
            'message_no_receiving_notifications_text' => $this->issetInArray($message, 'message_no_receiving_notifications_text'),
            'send_message_for_satisfaction_survey' => $this->issetInArray($message, 'send_message_for_satisfaction_survey'),
            'send_message_for_satisfaction_survey_id_message' => $this->issetInArray($message, 'send_message_for_satisfaction_survey_id_message'),
            'send_to_pj' => $this->issetInArray($message, 'send_to_pj'),
            'send_to_pf' => $this->issetInArray($message, 'send_to_pf'),
            'automatic_send_at_9am_every_day' => $this->issetInArray($message, 'automatic_send_at_9am_every_day'),
            'every_day_at_specific_time' => $this->issetInArray($message, 'every_day_at_specific_time'),
            'every_day_at_specific_time_value' => $this->issetInArray($message, 'every_day_at_specific_time_value'),
            'specific_date' => $this->issetInArray($message, 'specific_date'),
            'specific_date_value_date' => $this->issetInArray($message, 'specific_date_value_date'),
            'specific_date_value_time' => $this->issetInArray($message, 'specific_date_value_time'),
            'only_customers_nf' => $this->issetInArray($message, 'only_customers_nf'),
            'use_imported_data' => $this->issetInArray($message, 'use_imported_data'),
            'use_imported_data_import' => $this->issetInArray($message, 'use_imported_data_import'),
            'use_integration_data' => $this->issetInArray($message, 'use_integration_data'),
            'send_only_for_new_sales' => $this->issetInArray($message, 'send_only_for_new_sales'),
            'send_to_sales_from' => $this->issetInArray($message, 'send_to_sales_from'),
            'send_to_sales_from_date' => $this->issetInArray($message, 'send_to_sales_from_date'),
            'image' => $this->issetInArray($message, 'image'),
            'qtd_dias_apos_entrega' => $this->issetInArray($message, 'qtd_dias_apos_entrega'),
            'qtd_dias_apos_entrega_valor' => $this->issetInArray($message, 'qtd_dias_apos_entrega_valor'),
            'qtd_dias_nao_rast' => $this->issetInArray($message, 'qtd_dias_nao_rast'),
            'qtd_dias_nao_rast_valor' => $this->issetInArray($message, 'qtd_dias_nao_rast_valor'),
        ];
    }

    public function updateNameInJson(Message $message)
    {
        /* TODO: se for editar msg, talvez atualizar tbm  o nome da msg no json do model SendingSetting */
    }

    public function issetInArray($message, $value): string|array
    {
        return isset($message->sending_setting->{$value}) ? $message->sending_setting->{$value} : '';

        // return isset($message->sending_setting->settings[$value]) ? $message->sending_setting->settings[$value] : '';
    }

    public function store(SendingSettingStoreRequest $request, Message $message)
    {


        // se a mensagem pertence ao usuário
        if ($message->user_id != user_princ()->id)
            abort(403);


        /* ======= Desativar opções por enquanto ========== */
        /* ============ validaçẽos de data especifica, 9h e enviar todos os dias ============== */
        // Validação de checkbox permitidos para envio

        /****************
        $checkedCount = count(array_filter([
            $request->input('specific_date'),
            $request->input('every_day_at_specific_time'),
            $request->input('automatic_send_at_9am_every_day'),
        ]));


        if ($message->type != 'PESQUISA SATISFAÇÃO') :
            if ($this->showMsgIntegrationThisUsed($message) == false && $this->usedIntegrationInOthers($message)):
                if ($request->has('use_imported_data') == false) :
                    return back()
                        ->withErrors(['specific_date' => 'É obrigatório selecionar a opção de "Usar dados importados".']);
                endif;
            endif;
        endif;

        if ($checkedCount == 0)
            return back()
                ->withErrors(['specific_date' => 'É obrigatório selecionar uma opção entre: "Enviar automático às 9h todos os dias", "Enviar todos os dias às" ou "Data específica".']);

        if ($checkedCount > 1)
            return back()
                ->withErrors(['specific_date' => 'Apenas uma opção pode ser selecionada entre "Enviar automático às 9h todos os dias", "Enviar todos os dias às" ou "Data específica".']);

         *******************************/

        // colocar false nas opçoes por enquanto
        unset($request['every_day_at_specific_time']);
        unset($request['automatic_send_at_9am_every_day']);
        $request['specific_date_value_time'] = '';
        $request['every_day_at_specific_time_value'] = '';


        /* ============  /// validaçẽos de data especifica, 9h e enviar todos os dias ============== */


        // Validação de checkbox permitidos para envio
        $checkedCount = count(array_filter([
            $request->input('send_to_sales_from'),
            $request->input('send_only_for_new_sales'),
        ]));

        if ($checkedCount > 1)
            return back()
                ->withInput()
                ->withErrors(['send_to_sales_from' => 'Apenas uma opção pode ser selecionada entre "Enviar somente para novas vendas" ou "Enviar para vendas a partir de:".']);

        if ($checkedCount  == 0 && $message->type != 'ANIVERSÁRIO')
            return back()
                ->withInput()
                ->withErrors(['send_to_sales_from' => 'É obrigatório selecionar uma opção entre "Enviar somente para novas vendas" ou "Enviar para vendas a partir de:".']);


        /* Validar Envio PJ e PF */
        $sendToPf = $request->has('send_to_pf') ? true : false;
        $sendToPj = $request->has('send_to_pj') ? true : false;

        if ($message->type != 'ANIVERSÁRIO')
            if ($sendToPf == false && $sendToPj == false) :
                return back()
                    ->withInput()
                    ->withErrors(['send_to_pj' => 'Você precisa selecionar uma ou ambas as opções de "Enviar PJ" ou "Enviar PF".']);
            endif;


        /* Validar Usar dados importados e integração  */
        $useImportedData = $request->has('use_imported_data') ? true : false;
        $useIntegrationData = $request->has('use_integration_data') ? true : false;
        if ($this->showMsgIntegrationThisUsed($message) == false && $this->usedIntegrationInOthers($message)):
            $useIntegrationData = false;
        endif;

        if ($message->type != 'PESQUISA SATISFAÇÃO') :
            if ($useImportedData == false && $useIntegrationData == false) :
                return back()
                    ->withInput()
                    ->withErrors(['send_to_pj' => 'Você precisa selecionar uma ou ambas as opções de "Usar dados importados" ou "Usar dados da integração".']);
            endif;
        endif;

        // validar Enviar mensagem após
        if ($request->has('qtd_dias_apos_entrega')) :
            if (!$request->has('qtd_dias_apos_entrega_valor') || $request->qtd_dias_apos_entrega_valor == '') :
                return back()
                    ->withInput()
                    ->withErrors(['qtd_dias_apos_entrega' => 'Você precisa adicionar um valor em Enviar mensagem após ___ dia(s) da entrega do pedido.']);
            endif;
            if (intval($request->qtd_dias_apos_entrega_valor) < 1) :
                return back()
                    ->withInput()
                    ->withErrors(['qtd_dias_apos_entrega' => 'Você precisa adicionar um valor maior que 0 em Enviar mensagem após ___ dia(s) da entrega do pedido.']);
            endif;
        endif;

        // validar Enviar mensagem agradecimento após dias
        if ($request->has('qtd_dias_nao_rast')) :
            if (!$request->has('qtd_dias_nao_rast_valor') || $request->qtd_dias_nao_rast_valor == '') :
                return back()
                    ->withInput()
                    ->withErrors(['qtd_dias_nao_rast' => 'Você precisa adicionar um valor em Enviar mensagem de agradecimento após ___ dias.*']);
            endif;
            if (intval($request->qtd_dias_nao_rast_valor) < 1) :
                return back()
                    ->withInput()
                    ->withErrors(['qtd_dias_nao_rast' => 'Você precisa adicionar um valor maior que 0 em Enviar mensagem de agradecimento após ___ dias.*']);
            endif;
        endif;


        /*  */
        if (!$request->has('send_message_for_satisfaction_survey'))
            $request['send_message_for_satisfaction_survey_id_message'] = "";


        /* Grupos de dados importados */
        $useImportedDataImport = null;
        if ($request->has('groups_import')) :
            $useImportedDataImport = $request->groups_import;
        endif;
        // if ($request->has('groups_import_all')) :
        //     $useImportedDataImport = [];
        // endif;

        if ($useImportedData && $useImportedDataImport == '') { // se tiver selecionado dados importados e não tiver dados
            return back()
                ->withInput()
                ->withErrors(['use_imported_data' => 'Não tem grupo de dados importados selecionado.']);
        }


        $dataS = $this->dataSettings($message);
        // dd($dataS);



        $image = false;
        if ($request->has('image') && $request->hasFile('image_file')):

            $imageFile = $request->file('image_file');
            $originalName = str_replace('.' . $imageFile->getClientOriginalExtension(), '', $imageFile->getClientOriginalName());
            $newName = Str::slug($originalName . '_' . time(), '_') . '.' . $imageFile->getClientOriginalExtension();

            $image = $imageFile->storeAs('mensagem', $newName, 'public');
            $image = str_replace('mensagem/', '', $image);
        // $pathImage = $request->file('image_file')->store('public/mensagem');
        // $image = Storage::url($pathImage);
        /* TODO: deletar a outra img aqui se tiver */
        endif;

        if ($request->has('image') && $request->hasFile('image_file') == false):

            if ($dataS->image == '' || $dataS->image == false):
                return back()->withInput()->withErrors(['image_file' => 'Você precisa selecionar uma imagem.']);
            else:
                $image = $dataS->image;
            endif;
        endif;


        if ($message->type == 'PESQUISA SATISFAÇÃO' && $request->has('use_imported_data') == false):
            return back()->withInput()->withErrors(['use_imported_data' => 'A opção de "Usar dados importados" é obrigatório.']);
        endif;


        // $request->has('image') && $request->hasFile('image_file') == false



        /* TODO: Adicionar verificação se o usuário tem o modulo */

        $msgTextoNaoReceberNotif = null;
        if ($request->has('message_no_receiving_notifications_text')):
            $msgTextoNaoReceberNotif = $request->message_no_receiving_notifications_text;
            $msgTextoNaoReceberNotif .= "\r\n\r\nPara se retirar da lista de notificações envie SAIR.";
        endif;

        $settings = [
            "name" => $message->name,
            "message_no_receiving_notifications" => $request->has('message_no_receiving_notifications') ? true : false,
            "message_no_receiving_notifications_text" => $msgTextoNaoReceberNotif,
            "send_message_for_satisfaction_survey" => $request->has('send_message_for_satisfaction_survey') ? true : false,
            "send_message_for_satisfaction_survey_id_message" => $request->send_message_for_satisfaction_survey_id_message == "" ? null : $request->send_message_for_satisfaction_survey_id_message,
            "send_to_pj" => $sendToPj,
            "send_to_pf" => $sendToPf,
            "automatic_send_at_9am_every_day" => $request->has('automatic_send_at_9am_every_day') ? true : false,
            "every_day_at_specific_time" => $request->has('every_day_at_specific_time') ? true : false,
            "every_day_at_specific_time_value" => $request->every_day_at_specific_time_value == '' ? null : $request->every_day_at_specific_time_value,
            "specific_date" => $request->has('specific_date') ? true : false,
            "specific_date_value_date" => $request->specific_date_value_date == ''  ? null : $request->specific_date_value_date,
            "specific_date_value_time" => $request->specific_date_value_time == '' ? null : $request->specific_date_value_time,
            "only_customers_nf" => $request->has('only_customers_nf') ? true : false,
            "use_imported_data" => $useImportedData,
            "use_imported_data_import" => $useImportedDataImport,
            "use_integration_data" => $useIntegrationData,
            "send_only_for_new_sales" => $request->has('send_only_for_new_sales') ? true : false,
            "send_to_sales_from" => $request->has('send_to_sales_from') ? true : false,
            "send_to_sales_from_date" => $request->send_to_sales_from_date ?? null,
            "image" => $image == false ? null : $image,
            "qtd_dias_apos_entrega" => $request->has('qtd_dias_apos_entrega') ? true : false,
            "qtd_dias_apos_entrega_valor" => $request->has('qtd_dias_apos_entrega_valor') && $request->qtd_dias_apos_entrega_valor != '' ? $request->qtd_dias_apos_entrega_valor : null,
            "qtd_dias_nao_rast" => $request->has('qtd_dias_nao_rast') ? true : false,
            "qtd_dias_nao_rast_valor" => $request->has('qtd_dias_nao_rast_valor') && $request->qtd_dias_nao_rast_valor != '' ? $request->qtd_dias_nao_rast_valor : null,
        ];

        // dd($settings);

        $sendingSetting = SendingSetting::where('message_id', $message->id)->first();
        if ($sendingSetting): // atualizar


            $sendingSetting = $sendingSetting->fill($settings);
            $sendingSetting->module_id = $request->module_id;
            // $sendingSetting->settings = $settings;
            $sendingSetting->save();

        else: // criar

            $sendingSetting = (new SendingSetting)->fill($settings);
            $sendingSetting->message_id = $message->id;
            $sendingSetting->module_id = $request->module_id;
            // $sendingSetting->settings = $settings;
            $sendingSetting->save();

        // SendingSetting::updateOrCreate(
        //     ['message_id' => $message->id],
        //     [
        //         'module_id' => $request->module_id,
        //         'settings' => $settings,
        //     ]
        endif;

        // $sendingSetting = SendingSetting::updateOrCreate(
        //     ['message_id' => $message->id],
        //     [
        //         'module_id' => $request->module_id,
        //         'settings' => $settings,
        //     ]
        // );

        if ($this->moduloConfiguradoWhatsApp() == false)
            return redirect()->back()->withInput()->with('whatsapp_nao_configurado', true);

        if ($request->has('use_integration_data')):
            if (SystemController::configBlingExist() == false)
                return back()
                    ->withInput()
                    ->withWarning('Não há uma integração ativa com o Bling. Acesse as configurações do Bling de algum módulo para ativá-la e utilizar os dados da integração.');
        endif;

        session()->forget('confg_msg_id');
        session()->forget('url_criar_msg');

        if (session('url_prev_msg')):
            return redirect(session('url_prev_msg'))->withSuccess('Envio de mensagem configurado com sucesso!');
        endif;

        return redirect()->route('messages.crud.index')->withSuccess('Envio de mensagem configurado com sucesso!');
    }

    public function redirFormImportData(Request $request, Message $message)
    {
        session()->put('edit_sending_message_id', $message->id);
        session()->put('edit_sending_message_inputs', $request->all());
        /* TODO: verificar esse redirect se tá ok para o módulo */
        return redirect()->route('config.import.rm.index');
    }
}
