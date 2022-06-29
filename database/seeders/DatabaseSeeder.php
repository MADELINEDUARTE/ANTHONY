<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Gender::factory(1)->create();
        \App\Models\Country::factory(1)->create();
        \App\Models\Status::factory(1)->create();
        \App\Models\ProgramCategory::factory(1)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\Package::factory(1)->create();
        \App\Models\Subscription::factory(1)->create();

        $this->call([ RoleSeeder::class, RecurrenceSeeder::class ]);
    }
}
