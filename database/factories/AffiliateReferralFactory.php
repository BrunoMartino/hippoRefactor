<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AffiliateReferral>
 */
class AffiliateReferralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id',
            // 'affiliate_id',
            'contract_date' => fake()->dateTimeBetween('-3 week', '-1 week'),
            'commission' => rand(2, 5),
        ];
    }
}
