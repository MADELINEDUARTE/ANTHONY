<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackagesPricesResource\Pages;
use App\Filament\Resources\PackagesPricesResource\RelationManagers;
use App\Models\PackagesPrices;
use App\Models\Recurrence;
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
                ->relationship('packages', 'name')
                ->required()
                ->label('Package'),
                
                Forms\Components\Select::make('is_recurrence')
                ->options([
                    '0' => 'No',
                    '1' => 'Si',
                    
                ])
                ->reactive()
                ->afterStateUpdated(fn (callable $set) => $set('recurrences_id',null))
                ->label('Is recurrence')
                ->required(),
                
                /*Forms\Components\BelongsToSelect::make('recurrences_id')
                ->relationship('recurrence', 'description')
                ->required()
                ->label('Recurrence'),*/

                Forms\Components\Select::make('recurrences_id')
                ->label('Recurrences')
                //->disablePlaceholderSelection()
                //->disabled()
                /*->extraAttributes(function(callable $get){
                    if($get('color_id')){
                        $desccolor = Color::where('id',$get('color_id'))->get();
                        foreach($desccolor as $dc)
                        {
                            return ['style' => 'background-color:'.$dc->code.';'];
                        }
                    }else{
                        return ['style' => 'background-color:white;'];
                    }
                    
                    
                })*/
                ->options(function(callable $get){
                    return Recurrence::where('is_recurrence',$get('is_recurrence'))->pluck('description', 'id')->toArray();
                })
                ->required(),


                Forms\Components\TextInput::make('amount')->mask(fn (Mask $mask) => $mask
                ->patternBlocks([
                    'money' => fn (Mask $mask) => $mask
                        ->numeric()
                        ->thousandsSeparator(',')
                        ->decimalSeparator('.'),
                ])
                ->pattern('$money'),
                )
                ->required(),
                Forms\Components\Textarea::make('stripe_id')
                    ->required()
                    ->extraAttributes(['style' => 'display:none;'])
                    ->default("Stripe Code")
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('packages.name'),
                Tables\Columns\TextColumn::make('recurrence.description'),
                Tables\Columns\TextColumn::make('recurrence.is_recurrence'),
                Tables\Columns\TextColumn::make('amount'),
                //Tables\Columns\TextColumn::make('stripe_id'),
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
