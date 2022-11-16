<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Filament::registerPages([
            \RyanChandler\FilamentProfile\Pages\Profile::class,
            // 
        ]);

        Filament::registerResources([
            \App\Filament\Resources\ProductsResource::class,
            \App\Filament\Resources\CountryResource::class,
            \App\Filament\Resources\ExercisePlaceResource::class,
            \App\Filament\Resources\ExperienceResource::class,
            \App\Filament\Resources\FrequencyResource::class,
            \App\Filament\Resources\FrequentlyAskedQuestionResource::class,
            \App\Filament\Resources\GenderResource::class,
            \App\Filament\Resources\OrdersResource::class,
            \App\Filament\Resources\PackageResource::class,
            \App\Filament\Resources\PackagesPricesResource::class,
            \App\Filament\Resources\ProductCategorieResource::class,
            \App\Filament\Resources\ProgramCategoryResource::class,
            \App\Filament\Resources\ProgramResource::class,
            \App\Filament\Resources\ReasonResource::class,
            \App\Filament\Resources\RecurrenceResource::class,
            \App\Filament\Resources\StatusResource::class,
            \App\Filament\Resources\UserResource::class,
        ]);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         // Cashier::calculateTaxes();
        //Schema::defaultStringLength(191);
        if (App::environment('production', 'development'))
        { 
            URL::forceScheme('https');
        }
    }
}
