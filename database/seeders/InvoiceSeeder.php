<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // usuário princ. de teste
        \App\Models\Invoice::factory(15)->create([
            'user_id' => 1,
        ]);


        // outros usuários princ.
        $users = User::role('usuario_princ')->where('id', '!=', 3)->get();
        foreach ($users as $key => $value) {
            \App\Models\Invoice::factory()->create([
                'user_id' => $value->id,
            ]);
        }
    }
}
