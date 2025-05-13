<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuggestionAnswer>
 */
class SuggestionAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => Str::limit(fake()->sentence(50), 1500),
            'user_id' => rand(1, User::count()),
            'suggestion_id' => rand(1,3),
        ];
    }
}
