<?php

namespace App\Filament\Resources\PackagesPricesResource\Pages;

use App\Filament\Resources\PackagesPricesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPackagesPrices extends EditRecord
{
    protected static string $resource = PackagesPricesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
