<?php

namespace Database\Factories;

use App\Models\CreditCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ManualEdit>
 */
class ManualEditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'credit_card_id' => CreditCard::factory(),
            'field_name' => fake()->randomElement(['fees', 'product_name']),
            'manual_value' => fake()->sentence(),
        ];
    }
}
