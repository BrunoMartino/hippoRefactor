<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImportedInvoicing>
 */
class ImportedInvoicingFactory extends Factory
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
            'contract' => rand(100000, 999999),
            'birth_date' => fake()->dateTimeBetween('-70 years', '-19 years'),
            'link_nf' => 'hpps://',
            'link_xml' => 'hpps://',
            'gender' => fake()->randomElement(['M', 'F']),
            'uf' => fake()->randomElement(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']),
            'situacao' => fake()->randomElement([
                'Em aberto',
                'Em andamento',
                'Atendido',
                'Em separação',
                'Verificado',
            ]),

            'module_id' => 1,
        ];
    }
}
