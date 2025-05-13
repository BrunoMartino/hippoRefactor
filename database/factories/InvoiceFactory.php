<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImportedOrder>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status= fake()->randomElement(['paid', 'overdue']);
        return [
            'invoice_id' => fake()->unique()->numberBetween(100000, 10000000000),
            'client_id' => md5(fake()->unique()->numberBetween(1,1000)),
            'plan_id' => 1,
            'status' => $status,
            'discount_coupon' => null,
            'total_value' => 3690,
            'type' => 'change_plan',
            'quant_users' => null,
            'qrcode' => "00020101021226850014br.gov.bcb.pix2563qrcodepix.bb.com...",
            'date_payment' => $status == 'paid' ? date('Y-m-d') : null,
            'situation' => 'processing',
        ];
    }
}
