<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { $totalPurchaseValue = $this->faker->randomFloat(2, 0, 10000);
        $soldPurchaseValue = $this->faker->randomFloat(2, 0, 10000);

        return [
            'total_purchase_value' => $totalPurchaseValue,
            'sold_purchase_value' => $soldPurchaseValue,
            'ordered' => $this->faker->randomFloat(2, 0, 6000),
            'revenue' => $this->faker->randomFloat(2, 1, 10000),
            'profit_margin' => min(($soldPurchaseValue - $totalPurchaseValue) / $totalPurchaseValue * 100, 100),
        ];
    }
}
