<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contacts>
 */
class ContactsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userIdBling' => fake()->unique()->numberBetween(111111,999999),
            'name' => fake()->name(),
            'type' => fake()->randomElement(['J', 'F']),
            'UF' => fake()->randomElement(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO']),
            'celular' => fake()->unique()->numberBetween(99111111111,99999999999),
            'sexo' => fake()->randomElement(['M', 'F']),
        ];
    }
}
