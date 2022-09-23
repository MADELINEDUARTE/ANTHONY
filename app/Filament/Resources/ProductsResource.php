<?php

namespace App\Filament\Resources;

use Closure;
use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\Products;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Toggle::make('status')->inline(false),
                Forms\Components\Select::make('categorie_id')->relationship('categorie', 'name')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('stock')->numeric()->required(),
                Forms\Components\TextInput::make('price_last')->label('Price')->numeric()->required(),
                Forms\Components\TextInput::make('price_offert_last')->label('Price Offert')->numeric(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\Repeater::make('imagenes')
                    ->relationship()
                    ->label('Images')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->disk('public')
                            ->directory('shop')
                            ->visibility('public')
                    ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('categorie.name')->sortable()->searchable()->label('Categorie'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('stock')->sortable()->searchable()->label('Stock'),
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
            RelationManagers\TallesRelationManager::class,
            RelationManagers\ColoresRelationManager::class
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }    
}
