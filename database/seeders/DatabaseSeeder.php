<?php

namespace Database\Seeders;

use App\Models\ProductCategorie;
use App\Models\Products;
use App\Models\ProductsColores;
use App\Models\ProductsImagenes;
use App\Models\ProductsPrices;
use App\Models\ProductsTalles;
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
        // $categori = ProductCategorie::factory(3)->create();

        // $product = Products::factory()
        //                     ->count(7)
        //                     ->has(ProductsTalles::factory()->count(5),'talles')
        //                     ->has(ProductsColores::factory()->count(5),'colores')
        //                     ->has(ProductsImagenes::factory()->count(5),'imagenes')
        //                     ->has(ProductsPrices::factory()->count(1))
        //                     ->create();

        // \App\Models\Gender::factory(1)->create();
        // \App\Models\Country::factory(1)->create();
        // \App\Models\Status::factory(1)->create();
        // \App\Models\ProgramCategory::factory(1)->create();
        // \App\Models\User::factory(1)->create();
        // \App\Models\Package::factory(1)->create();
        // \App\Models\Subscription::factory(1)->create();

        // $this->call([ RoleSeeder::class, RecurrenceSeeder::class ]);
        $this->call([ EasyPostPredefinedPackageSeeder::class ]);
    }
}
