<?php

namespace Database\Factories;

use App\Models\ProductsPrices;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsPricesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = ProductsPrices::class;
    
    public function definition()
    {
        return [
            'price' => $this->faker->numberBetween($min = 50, $max = 1000),
            'status' => 1
        ];
    }
}
