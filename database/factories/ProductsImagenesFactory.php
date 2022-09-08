<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductsImagenesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'image' => $this->faker->image('storage/app/public/products', 360, 360)
            'image' => $this->faker->file($sourceDir = 'storage/app/public/storage', $targetDir = 'storage/app/public/products')
        ];
    }
}
