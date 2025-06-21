<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConsumerModel>
 */
class ConsumerModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'type' => $this->faker->randomElement(['Person', 'Department', 'BusinessUnit']), 
            'contact_info' => $this->faker->optional()->address() . ', ' . $this->faker->phoneNumber(),
        ];
    }
}
