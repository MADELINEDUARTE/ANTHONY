<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Name')
                ->required(), 

                Forms\Components\TextInput::make('middle_name')
                ->label('Middle Name'), 

                Forms\Components\TextInput::make('last_name')
                ->label('Last Name')
                ->required(), 

                Forms\Components\BelongsToSelect::make('gender_id')
                ->relationship('gender', 'description')
                ->required()
                ->label('Gender'),

                Forms\Components\DatePicker::make('date_of_birth')
                ->required()
                ->label('Date of Birth'),

                Forms\Components\TextInput::make('email')
                ->label('Email')
                ->required()
                ->email(), 

                Forms\Components\BelongsToSelect::make('country_id')
                ->relationship('country', 'description')
                ->required()
                ->label('Country'),

                Forms\Components\Textarea::make('address')
                ->required()
                ->label('Address'),

                Forms\Components\TextInput::make('telephone')
                ->label('Telephone')
                ->required()
                ->numeric(), 

                Forms\Components\Hidden::make('password')->id('user_password'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('Id'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('last_name')->sortable()->searchable()->label('Last Name'),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable()->label('Email'),
                Tables\Columns\TextColumn::make('gender.description')->sortable()->searchable()->label('Gender'),
                Tables\Columns\TextColumn::make('country.description')->sortable()->searchable()->label('Country'),
                Tables\Columns\ImageColumn::make('address')->label('address'),
                Tables\Columns\ImageColumn::make('telephone')->label('telephone'),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
