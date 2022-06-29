<?php

namespace App\Filament\Resources\RecurrenceResource\Pages;

use App\Filament\Resources\RecurrenceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRecurrences extends ListRecords
{
    protected static string $resource = RecurrenceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
