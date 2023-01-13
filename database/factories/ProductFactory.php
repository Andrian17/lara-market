<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'seller_id' => $this->faker->numberBetween(1, 15),
            'code_product' => uniqid(),
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(8000, 999999),
            'image_url' => $this->faker->imageUrl(320, 240, 'gadget')
        ];
    }
}
