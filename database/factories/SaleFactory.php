<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total_revenue' => random_int(0, 10000),
            'sold' => random_int(0, 10000),
            'remainder' => random_int(0, 10000),
            'purchased' => random_int(0, 10000)
        ];
    }
}
