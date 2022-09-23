<?php

namespace App\Filament\Resources\ProductCategorieResource\Pages;

use App\Filament\Resources\ProductCategorieResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategorieResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
