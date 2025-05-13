<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\ControlQuantMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $userPrinc = User::where('email', 'usuario.princ@email.com')->first();

        // user 1
        \App\Models\MessageReport::factory(1500)->create([
            'user_id' => $userPrinc ? $userPrinc->id : 1,
        ]);

        ControlQuantMessage::create([
            'user_id' =>  $userPrinc ? $userPrinc->id : 1,
            'quant_mensagens' => 12000,
            'mensagens_enviadas' => 500,
            'mensagens_restantes' => 11500
        ]);

    }
}
