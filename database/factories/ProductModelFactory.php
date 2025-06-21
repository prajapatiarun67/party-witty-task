<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductModel>
 */
class ProductModelFactory extends Factory
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
        'price' => $this->faker->randomFloat(2, 1, 1000), // Random price between 1 and 1000
        'description' => $this->faker->optional()->text(200), // Optional description with max length of 200 characters
        'product_code' => $this->faker->unique()->bothify('??-#####'), // Unique product code in the format of two letters followed by five digits
        ];
    }
}
