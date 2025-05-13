<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_usuario' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'tipo_usuario' => 'PF',
            'razao_social' => 'Lorem ipsum',
            'whatsapp' => '999' . fake()->unique()->numberBetween(10000000,99999999),
            'estado' => 'SP',
            'cidade' => "Guarulhos",
            'created_at' => fake()->dateTimeBetween('-10 days')
        ];
    }
   
}
