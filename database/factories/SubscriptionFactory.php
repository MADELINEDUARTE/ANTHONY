<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    protected $model = Subscription::class;

     public function definition()
    {
        return [
            'package_id' => 1,
            'user_id' => 1,
            'status_id' => 1
        ];
    }
}
