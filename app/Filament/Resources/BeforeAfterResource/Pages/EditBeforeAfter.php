<?php

namespace App\Filament\Resources\BeforeAfterResource\Pages;

use App\Filament\Resources\BeforeAfterResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeforeAfter extends EditRecord
{
    protected static string $resource = BeforeAfterResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
