<?php

namespace Database\Factories;

use App\Models\NFS;
use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $contatoIds= Contacts::pluck('userIdBling')->toArray();
        // $nfsId= NFS::pluck('notaFiscalBlingId')->toArray();

        $nfs= NFS::get(['notaFiscalBlingId', 'contatoId'])->toArray();
        $nfsRandom= fake()->unique()->randomElement($nfs);
        return [
            // 'user_id' => 1,
            'idBling' => fake()->unique()->numberBetween(1111111111, 9999999999),
            'numero' => fake()->unique()->numberBetween(1111,9999),
            'contatoId'=> $nfsRandom['contatoId'],
            'notaFiscalId' => $nfsRandom['notaFiscalBlingId'],
            'data' => fake()->dateTimeBetween('-2 months'),
        ];
    }
}
