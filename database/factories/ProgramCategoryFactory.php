<?php

namespace Database\Factories;

use App\Models\ProgramCategory;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = ProgramCategory::class;

     public function definition()
    {
        return [
            'description'=>'Legs'
        ];
    }
}
