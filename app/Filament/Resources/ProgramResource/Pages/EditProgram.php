<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EditProgram extends EditRecord
{
    protected static string $resource = ProgramResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        //$data['user_id'] = auth()->id();
        Session::put('program_id_hidden', $this->record->id);
        return $data;
    }

    
    protected function beforeFill(): void
    {
        //dd($this->all());
        session()->forget('hidden_slug');
        session(['hidden_slug' => Str::slug($this->record->name)]);
    }                        
}
