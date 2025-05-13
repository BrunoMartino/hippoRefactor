<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonthlyDiscount>
 */
class MonthlyDiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => ,
            'modulo_id' => 3,
            'plano_id' => 2,
            'valor' => rand(5, 15),
            'porcentagem' => null,
            'dt_inicio' => date('Y-m-05'), // 05 para evitar bugs, mas será considerado apenas o ano e mês
            'dt_termino' => date('Y-m-d', strtotime(date('Y-m-05') . '+ 1 months')),
        ];
    }
}
