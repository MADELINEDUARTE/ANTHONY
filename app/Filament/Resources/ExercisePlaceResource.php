<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExercisePlaceResource\Pages;
use App\Filament\Resources\ExercisePlaceResource\RelationManagers;
use App\Models\ExercisePlace;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class ExercisePlaceResource extends Resource
{
    protected static ?string $model = ExercisePlace::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                ->required()
                ->label('Description')
                ->maxLength(255),
                Forms\Components\Select::make('user_id')
                ->label('')
                ->options(User::where('id',Auth::user()->id)->pluck('name', 'id'))
                ->default(Auth::user()->id)
                ->disablePlaceholderSelection()
                ->extraAttributes(['style' => 'display:none;'])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('Id'),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListExercisePlaces::route('/'),
            'create' => Pages\CreateExercisePlace::route('/create'),
            'edit' => Pages\EditExercisePlace::route('/{record}/edit'),
        ];
    }
}
