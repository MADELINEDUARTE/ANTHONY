<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Session;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        //$data['user_id'] = auth()->id();
        Session::put('program_id_hidden', $this->record->id);
        return $data;
    }
}
