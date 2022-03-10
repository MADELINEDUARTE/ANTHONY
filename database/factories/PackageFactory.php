<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = Package::class;

     public function definition()
    {
        return [
            'name' => 'Gold',
            'description'=>'Puro Oro',
            'number_of_programs' => 3,
            'amount' => 7,
            'status_id' => 1,
            'user_id' => 1
        ];
    }
}
