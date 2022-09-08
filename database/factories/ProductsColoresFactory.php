<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsColoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->safeColorName(),
            'code'        => $this->faker->hexcolor(),
            'status'      => 1,
        ];
    }
}
