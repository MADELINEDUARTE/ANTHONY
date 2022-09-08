<?php

namespace Database\Factories;

use App\Models\Products;
use App\Models\ProductsTalles;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
class ProductsTallesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = ProductsTalles::class;

    public function definition()
    {
        return [
            // 'products_id' =>  1,
            'description' =>  Str::of($this->faker->randomLetter())->upper(),
            'status' => 1,
        ];
    }
}
