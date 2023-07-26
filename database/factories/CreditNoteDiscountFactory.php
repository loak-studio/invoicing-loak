<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreditNoteDiscount>
 */
class CreditNoteDiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(5),
            'is_percentage' => fake()->boolean(),
            'amount' => fake()->numberBetween(10, 30),
        ];
    }
}
