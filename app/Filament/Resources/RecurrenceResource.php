<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecurrenceResource\Pages;
use App\Filament\Resources\RecurrenceResource\RelationManagers;
use App\Models\Recurrence;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RecurrenceResource extends Resource
{
    protected static ?string $model = Recurrence::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Stripe';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Select::make('description')
                ->options([
                    'Annual' => 'Annual',
                    'Monthly' => 'Monthly',
                    '6 Months' => '6 Months',
                ])
                ->default('Annual')
                ->required(),
                
                Forms\Components\Select::make('interval')
                ->options([
                    'year' => 'Year',
                    'month' => 'Month',
                    'custom' => 'Custom',
                ])
                ->default('year')
                ->required(),
                
                Forms\Components\Select::make('days')
                ->options([
                    '365' => '365',
                    '180' => '180',
                ])
                ->default('365')
                ->required(),

                Forms\Components\Toggle::make('is_recurrence')
                    ->required(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('interval'),
                Tables\Columns\TextColumn::make('days'),
                Tables\Columns\BooleanColumn::make('is_recurrence'),
                Tables\Columns\BooleanColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
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
            'index' => Pages\ListRecurrences::route('/'),
            'create' => Pages\CreateRecurrence::route('/create'),
            'edit' => Pages\EditRecurrence::route('/{record}/edit'),
        ];
    }    
}
