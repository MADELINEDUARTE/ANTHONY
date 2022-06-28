<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //dd($this->all());
        $request_password=12345678;
        $encrypted_password=Hash::make($request_password);
        $data['password'] = $encrypted_password;
     
        return $data;
    }
}
