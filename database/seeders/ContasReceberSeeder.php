<?php

namespace Database\Seeders;

use App\Models\Contrato;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContasReceberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $conts = Contrato::get(['periodicidadeVencimento', 'contatoId']);

        foreach ($conts as  $item) :
            $valor = rand(10, 50);
            for ($i = 0; $i < $item->periodicidadeVencimento; $i++) :
                \App\Models\ContasReceber::factory()->create([
                    'user_id' => 1,
                    'contatoId' => $item->contatoId,
                    'valor' => $valor,
                    'pedido' => rand(11111,999999),
                    'notaFiscal' => rand(111111,999999),
                    'contrato' => rand(111111,9999999)

                    // $table->string('idBling');
                    // $table->date('vencimento');
                    // $table->decimal('valor', 12, 2);
                    // $table->text('linkQRCodePix')->nullable();
                    // $table->string('linkBoleto')->nullable();
                    // $table->date('dataEmissao')->nullable();
                    // $table->string('contatoId');
                    // $table->string('formaPagamentoId');
                    // $table->string('pedido')->nullable();
                    // $table->string('notaFiscal')->nullable();
                    // $table->string('contrato')->nullable();
                    
                ]);
            endfor;
        endforeach;
    }
}
