<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditCard>
 */
class CreditCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bank_id' => Bank::factory(),
            'product_id' => fake()->uuid(),
            'product_name' => fake()->creditCardType(),
            'logo' => fake()->imageUrl(),
            'link' => fake()->url(),
            'fees' => fake()->randomFloat(2, 0, 50),
            'tae' => fake()->randomFloat(2, 0, 30),
            'annual_fee_first_year' => fake()->randomFloat(2, 0, 50),
        ];
    }
}
