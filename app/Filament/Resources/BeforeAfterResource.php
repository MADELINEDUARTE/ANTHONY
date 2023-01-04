<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeforeAfterResource\Pages;
use App\Filament\Resources\BeforeAfterResource\RelationManagers;
use App\Models\BeforeAfter;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BeforeAfterResource extends Resource
{
    protected static ?string $model = BeforeAfter::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->groupBy('subscription_programs_id');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('user.name'),
                // Tables\Columns\TextColumn::make('user.last_name'),
                Tables\Columns\TextColumn::make('subscripcion.program.name')->label('Program'),
                // Tables\Columns\TextColumn::make('pose'),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\ViewAction::make(),
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
            'index'  => Pages\ListBeforeAfters::route('/'),
            'create' => Pages\CreateBeforeAfter::route('/create'),
            'edit'   => Pages\EditBeforeAfter::route('/{record}/edit'),
            'view'   => Pages\BeforeAfterDetalle::route('/{record}'),
            // 'view'   => Pages\ViewBeforeAfter::route('/{record}'),
        ];
    }    
}
