<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
      
        User::create([
            'name'=>'Ramon',
            'email'=>'ramonguerra1@gmail.com',
            'password'=>bcrypt('12345678'),
            'middle_name'=>'Jose',
            'last_name'=>'Guerra',
            'gender_id'=>'1',
            'date_of_birth'=>'1976-07-10',
            'country_id'=>'1',
            'address'=>'Caracas - Venezuela',
            'telephone'=>'0412-610-17-95'
        ])->assignRole('Admin');

        User::factory(1)->create();
    }
}


