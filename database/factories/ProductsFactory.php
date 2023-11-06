<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(1000, 1000000),
            'description' => $this->faker->sentence(),
            'stock'=> $this->faker->numberBetween(1, 150),
            'image_url' => $this->faker->word
        ];
    }
}
