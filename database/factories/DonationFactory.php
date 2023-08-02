<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->numberBetween(5, 200),
            'currency' => fake()->randomElement(['USD', 'CAD', 'EUR']),
            'message' => fake()->text(),
            'created_at' => fake()->dateTimeBetween('-3 months'),
        ];
    }
}
