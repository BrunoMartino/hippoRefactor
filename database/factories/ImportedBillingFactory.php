<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImportedBilling>
 */
class ImportedBillingFactory extends Factory
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
            'whatsapp' =>  fake()->unique()->numberBetween(99111111111, 99999999999),
            'birth_date' => fake()->dateTimeBetween('-70 years', '-19 years'),
            'issue_date' => fake()->dateTimeBetween('-1 day', '-0 days'),
            'due_date' => fake()->dateTimeBetween('-0 day', '+30 days'),
            'order_number' => fake()->unique()->numberBetween(100, 1000),
            'nf_number' => fake()->unique()->numberBetween(100000, 999999),
            'contract' => rand(100000, 999999),
            'link_boleto' => 'http://',
            'qr_code_pix' => 'data:image/png;base64,iVBORw0KGgoA...',
            'payment_method' => 'PIX',
            'gender' => fake()->randomElement(['M', 'F']),
            'value' => rand(26,39) + 0.99,
            'uf' => fake()->randomElement(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']),
            'type' => fake()->randomElement(['PF', 'PJ']),

            'module_id' => 1,
            // 'user_id' => 1,
            // 'group_id' => 1,

        ];
    }
}
