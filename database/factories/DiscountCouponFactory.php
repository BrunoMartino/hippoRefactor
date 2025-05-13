<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DiscountCoupon>
 */
class DiscountCouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(1),
            'description' => fake()->sentence(4),
            'value' => rand(5, 15),
            'code' => strtoupper(Str::random(6)),
            'expiration_date' => date('Y-m-d', strtotime('+ ' . rand(10, 50) . ' days')),
            'qtd_total'=> rand(10,20),
            'qtd_uso'=> rand(1,2)
        ];
    }
}
