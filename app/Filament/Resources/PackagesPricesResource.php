<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackagesPricesResource\Pages;
use App\Filament\Resources\PackagesPricesResource\RelationManagers;
use App\Models\PackagesPrices;
use Filament\Forms;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PackagesPricesResource extends Resource
{
    protected static ?string $model = PackagesPrices::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Stripe';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('packages_id')
                ->relationship('packages', 'description')
                ->required()
                ->label('Package'),
                Forms\Components\BelongsToSelect::make('recurrences_id')
                ->relationship('recurrence', 'description')
                ->required()
                ->label('Recurrence'),
                Forms\Components\TextInput::make('amount')->mask(fn (Mask $mask) => $mask
                ->patternBlocks([
                    'money' => fn (Mask $mask) => $mask
                        ->numeric()
                        ->thousandsSeparator(',')
                        ->decimalSeparator('.'),
                ])
                ->pattern('$money'),
                ),
                Forms\Components\Textarea::make('stripe_id')
                    ->required()
                    ->default("Stripe Code")
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('packages.description'),
                Tables\Columns\TextColumn::make('recurrence.description'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('stripe_id'),
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
            'index' => Pages\ListPackagesPrices::route('/'),
            'create' => Pages\CreatePackagesPrices::route('/create'),
            'edit' => Pages\EditPackagesPrices::route('/{record}/edit'),
        ];
    }    
}
