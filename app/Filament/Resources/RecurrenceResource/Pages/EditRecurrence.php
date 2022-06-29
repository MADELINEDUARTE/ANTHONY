<?php

namespace App\Filament\Resources\RecurrenceResource\Pages;

use App\Filament\Resources\RecurrenceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRecurrence extends EditRecord
{
    protected static string $resource = RecurrenceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
