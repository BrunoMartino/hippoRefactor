<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NFS>
 */
class ContratoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contatoIds = Contacts::pluck('userIdBling')->toArray();

        $data = date('Y-m-d', strtotime("-". rand(0,60). " days"));
        return [
            'user_id' => 1,
            'idBling' => fake()->unique()->numberBetween(111111, 999999),
            'numero' => fake()->unique()->numberBetween(99111111111, 99999999999),
            'data' => $data,
            'valor' => rand(20, 50),
            'situacao' => rand(0, 3),
            'contatoId' => fake()->unique()->randomElement($contatoIds),
            'diaVencimento' => date('d', strtotime($data . " + 1 months")),
            'periodicidadeVencimento' => rand(1, 4),
        ];
    }
}
