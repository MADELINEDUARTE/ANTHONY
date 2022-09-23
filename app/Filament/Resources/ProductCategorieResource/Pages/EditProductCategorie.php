<?php

namespace App\Filament\Resources\ProductCategorieResource\Pages;

use App\Filament\Resources\ProductCategorieResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategorie extends EditRecord
{
    protected static string $resource = ProductCategorieResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
