<?php

namespace Database\Factories;

use App\Models\ConsumerModel;
use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionModel>
 */
class TransactionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'consumer_id' => ConsumerModel::factory(),
            'product_id' => ProductModel::factory(),
            'transaction_type' => $this->faker->randomElement(['Issue', 'Return']),
            'quantity' => $this->faker->numberBetween(1, 10),
            'transaction_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'notes'=> $this->faker->optional()->sentence(10),
        ];
    }
}
