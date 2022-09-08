<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductCategorie;

class ProductCategorieFactory extends Factory
{

    protected $model = ProductCategorie::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text($maxNbChars = 10),
            'status' => 1
        ];
    }
}
