<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConfSistemasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('conf_sistemas')->insert([
            'user_id' => 1,
            'modulo_id' => 1,
            'status' => 'ativo',
            'tipo' => 'whatsapp',
            'integracao' => '{"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJjb25uZWN0aW9uS2V5IjoiNzgxZGY1NDI3NmQ4YTgzYjdmM2Y0ZDExMSIsImlhdCI6MTcxNjU3NjQ5OH0.o8zektrZyAbRsM1Ac13QU_i1KSJn1iRQv5_sSxLSHAg", "whatsapp": "556291544877", "connectionKey": "781df54276d8a83b7f3f4d111"}'
        ]);
    }
}
