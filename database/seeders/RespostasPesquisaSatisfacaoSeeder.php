<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use App\Models\RespostasPesquisaSatisfacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RespostasPesquisaSatisfacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) :
            $what1 = rand(11111111111, 99999999999);
            \App\Models\RespostasPesquisaSatisfacao::factory(3)->create([
                'user_id' => 1,
                'whatsapp' => $what1,
                'message_id' => Message::whereIn('type', ['ANIVERSÁRIO', 'AGRADECIMENTO'])->first()->id,
                'pesquisa_id' => Message::whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])->first()->id,
            ]);
            // \App\Models\ImportedOrder::factory()->create([
            //     'user_id' => 1, // 3 -> id usuário princ.
            //     'group_id' => 1,
            //     'whatsapp' => $what1,
            // ]);
        endfor;

        $res = RespostasPesquisaSatisfacao::where('user_id', 1)->get()->groupBy('whatsapp');
        foreach ($res as $key => $value) {
            # code...
            \App\Models\Contacts::factory()->create([
                'user_id' => 1,
                'celular' => $key,
            ]);
        }

        // registros para teste
        for ($i = 0; $i < 20; $i++) {
            \App\Models\RespostasPesquisaSatisfacao::factory()->create([
                'user_id' => 1,
                'whatsapp' => $i . '1999999999',
                'message_id' => Message::whereIn('type', ['ANIVERSÁRIO', 'AGRADECIMENTO'])->first()->id,
                'pesquisa_id' => Message::whereIn('type', ['PESQUISA SATISFAÇÃO', 'PESQUISA SATISFAÇÃO ANEXO'])->first()->id,
            ]);
            // \App\Models\ImportedOrder::factory()->create([
            //     'user_id' => 1, // 3 -> id usuário princ.
            //     'group_id' => 1,
            //     'whatsapp' => $i . '1999999999'
            // ]);
        }
    }
}
