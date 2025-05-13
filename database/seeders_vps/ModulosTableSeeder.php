<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('modulos')->insert([
            'nome' => 'cobrancas',
            'titulo' => 'Cobranças'
        ]);
        DB::table('modulos')->insert([
            'nome' => 'faturamento',
            'titulo' => 'Faturamento'
        ]);
        DB::table('modulos')->insert([
            'nome' => 'remarketing',
            'titulo' => 'Remarketing'
        ]);
        DB::table('modulos')->insert([
            'nome' => 'rastreamento',
            'titulo' => 'Rastreamento'
        ]);
    }
}
