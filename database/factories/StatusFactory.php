<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = Status::class;

     public function definition()
    {
        return [
            'description'=>'Activo',
            'user_id' => 1
        ];
    }
}
