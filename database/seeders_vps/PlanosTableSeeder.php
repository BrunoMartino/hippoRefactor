<?php

namespace Database\Seeders;

use App\Models\Plano;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PlanosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        /* $i -> o id do módulo */
        for ($i = 1; $i <= 4; $i++) :
            Plano::create([
                'modulo_id' => $i,
                'nome' => 'premium',
                'limite_mensagens' => 30000,
                'valor' => 39.90,
                'qtd_usuarios' => 3,
                'qtd_instancias' => 1,
                'custo_excedente' => 0.003,
                'icon' => 'assets/images/pngs/coroa.png',
                'color' => '#ff621d'
            ]);
            Plano::create([
                'modulo_id' => $i,
                'nome' => 'total',
                'limite_mensagens' => 12000,
                'valor' => 36.90,
                'qtd_usuarios' => 2,
                'qtd_instancias' => 1,
                'custo_excedente' => 0.005,
                'icon' => 'assets/images/pngs/raio.png',
                'color' => '#0853FC'
            ]);
            Plano::create([
                'modulo_id' => $i,
                'nome' => 'basic',
                'limite_mensagens' => 4500,
                'valor' => 31.90,
                'qtd_usuarios' => 1,
                'qtd_instancias' => 1,
                'custo_excedente' => 0.01,
                'icon' => 'assets/images/pngs/fogo.png',
                'color' => '#0853FC'
            ]);
            Plano::create([
                'modulo_id' => $i,
                'nome' => 'Test',
                'limite_mensagens' => 200,
                'valor' => 0.00,
                'qtd_usuarios' => 1,
                'qtd_instancias' => 1,
                'custo_excedente' => 0.00,
                'icon' => 'assets/images/pngs/coracao.png',
                'color' => '#0853FC'
            ]);
        endfor;
    }
}
