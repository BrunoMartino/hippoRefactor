<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImportedRemarketing>
 */
class ImportedRemarketingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement(['PF', 'PJ']),
            'order_number' => fake()->unique()->numberBetween(100, 1000),
            'nf_number' => fake()->unique()->numberBetween(100000, 999999),
            'whatsapp' =>  fake()->unique()->numberBetween(99111111111, 99999999999),
            'birth_date' => fake()->dateTimeBetween('-70 years', '-19 years'),
            'date_order' => fake()->dateTimeBetween('-3 days', '-0 days'),
            'date_nf' => fake()->dateTimeBetween('-3 days', '-0 days'),
            'date_contract' => fake()->dateTimeBetween('-3 days', '-0 days'),
            'contract' => rand(100000, 999999),
            'gender' => fake()->randomElement(['M', 'F']),
            'uf' => fake()->randomElement(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']),

            'module_id' => 1,
        ];
    }
}
