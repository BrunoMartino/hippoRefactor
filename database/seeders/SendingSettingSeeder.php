<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SendingSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPrinc = User::where('email', 'usuario.princ@email.com')->first();


        /* 

        "_token" => "N8LI4urxitkRwOgt14V3EFreovVpjacXtAydNVVy"
        "module_id" => "3"
        "message_no_receiving_notifications" => "on"
        "only_customers_nf" => "on"
        "send_to_pj" => "on"
        "send_to_pf" => "on"
        "use_imported_data" => "on"
        "use_integration_data" => "on"
        "send_only_for_new_sales" => "on"
        "send_to_sales_from_date" => "2024-04-24"
        "every_day_at_specific_time" => "on"
        "every_day_at_specific_time_value" => "05:00"
        "specific_date_value_date" => "2024-04-25"
        "specific_date_value_time" => "08:00"
        
         */

        $messages = Message::get();


        foreach ($messages as $key => $message) :
            $time1 = rand(7, 19);
            $time2 = rand(7, 19);

            $sendPf = $message->type == 'ANIVERSÁRIO' ? true : fake()->randomElement([true, false]);
            $sendPj = $message->type == 'ANIVERSÁRIO' ? false : !$sendPf;

            if ($message->type == 'ANIVERSÁRIO'):
                $sendPf = false;
                $sendPj = false;
            endif;

            $use_imported_data = fake()->randomElement([true, false]);
            $use_imported_data = $use_imported_data == false ? true : fake()->randomElement([true, false]);
            // if ($message->type == 'PESQUISA SATISFAÇÃO')
            //     $use_imported_data = false;

            /*  */
            // $send_message_for_satisfaction_survey = fake()->randomElement([true, false]);
            $send_message_for_satisfaction_survey = false;
            if ($send_message_for_satisfaction_survey) :
                $send_message_for_satisfaction_survey_id_message = Message::where('type', 'PESQUISA SATISFAÇÃO ANEXO')->first()->id;
            else :
                $send_message_for_satisfaction_survey_id_message = null;
            endif;

            $message_no_receiving_notifications = fake()->randomElement([true, false]);
            $settings = [
                "name" => $message->name,
                "message_no_receiving_notifications" => $message_no_receiving_notifications,
                "message_no_receiving_notifications_text" => $message_no_receiving_notifications ? fake()->sentence(5) : '',
                "send_to_pj" => $sendPj,
                "send_to_pf" => $sendPf,
                "send_message_for_satisfaction_survey" => $send_message_for_satisfaction_survey,
                "send_message_for_satisfaction_survey_id_message" => $send_message_for_satisfaction_survey_id_message,
                "automatic_send_at_9am_every_day" => fake()->randomElement([true, false]),
                "every_day_at_specific_time" => fake()->randomElement([true, false]),
                "every_day_at_specific_time_value" => ($time1 < 10 ? "0$time1" : $time1) . ':00',
                "specific_date" => fake()->randomElement([true, false]),
                "specific_date_value_date" => date('Y-m-d', strtotime("+ " . rand(1, 30) . " days")),
                "specific_date_value_time" => ($time2 < 10 ? "0$time2" : $time2) . ':00',
                "only_customers_nf" => fake()->randomElement([true, false]),
                "use_imported_data" => false,
                "use_imported_data_import" => "",
                "use_integration_data" => false,
                "send_only_for_new_sales" => fake()->randomElement([true, false]),
                "send_to_sales_from" => fake()->randomElement([true, false]),
                "send_to_sales_from_date" => date('Y-m-d', strtotime("- " . rand(1, 30) . " days")),
                "image" => '',
                'qtd_dias_apos_entrega' => false,
                'qtd_dias_nao_rast' => false,
                'qtd_dias_nao_rast_valor' => null
            ];

            if ($settings['automatic_send_at_9am_every_day']) :
                $settings['specific_date'] = false;
                $settings['every_day_at_specific_time'] = false;
            endif;
            if ($settings['specific_date']) :
                $settings['automatic_send_at_9am_every_day'] = false;
                $settings['every_day_at_specific_time'] = false;
            endif;
            if ($settings['every_day_at_specific_time']) :
                $settings['specific_date'] = false;
                $settings['automatic_send_at_9am_every_day'] = false;
            endif;
            if ($settings['send_only_for_new_sales']) :
                $settings['send_to_sales_from'] = false;
            endif;

            \App\Models\SendingSetting::factory()->create([
                'message_id' => $message->id,
                'module_id' => 3,
                // 'settings' => $settings,
                ...$settings
            ]);
        endforeach;
    }
}
