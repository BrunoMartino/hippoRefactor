<?php

namespace Database\Factories;

use App\Models\Contacts;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NFS>
 */
class NFSFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contatoIds= Contacts::pluck('userIdBling')->toArray();
        return [
            'user_id' => 1,
            'numero' => fake()->unique()->numberBetween(99111111111,99999999999),
            'dataEmissao' => fake()->dateTimeBetween('-2 months'),
            'contatoId'=> fake()->randomElement($contatoIds),
            'notaFiscalBlingId' => fake()->unique()->numberBetween(111111,999999),
        ];
    }
}
