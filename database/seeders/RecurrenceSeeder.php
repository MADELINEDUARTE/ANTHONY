<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recurrence;

class RecurrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Recurrence::insert([
            [
                'description'  => 'Annual',
                'interval'     => 'year',
                'days'         =>  365,
                'is_recurrence'=> true,
                'status'       => true,
            ],
            [
                'description'  => 'Monthly',
                'interval'     => 'month',
                'days'         =>  365,
                'is_recurrence'=> true,
                'status'       => true,
            ],
            [
                'description'  => '6 Months',
                'interval'     => 'custom',
                'days'         =>  180,
                'is_recurrence'=> true,
                'status'       => true,
            ],
            [
                'description'  => 'Annual',
                'interval'     => 'year',
                'days'         =>  365,
                'is_recurrence'=> false,
                'status'       => true,
            ],
            [
                'description'  => 'Monthly',
                'interval'     => 'month',
                'days'         =>  365,
                'is_recurrence'=> false,
                'status'       => true,
            ],
            [
                'description'  => '6 Months',
                'interval'     => 'custom',
                'days'         =>  180,
                'is_recurrence'=> false,
                'status'       => true,
            ],
        ]);

        //  php artisan db:seed --class=RecurrenceSeeder
    }
}
