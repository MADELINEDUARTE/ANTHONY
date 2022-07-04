<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        //dd($this->all());
        //$request_password=12345678;
        //$encrypted_password=Hash::make($request_password);
        //$data['password'] = $encrypted_password;
        $data['password'] = Hash::make($data['password']);
        return $data;
    }
}
