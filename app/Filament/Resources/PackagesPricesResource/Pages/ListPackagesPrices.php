<?php

namespace App\Filament\Resources\PackagesPricesResource\Pages;

use App\Filament\Resources\PackagesPricesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackagesPrices extends ListRecords
{
    protected static string $resource = PackagesPricesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
