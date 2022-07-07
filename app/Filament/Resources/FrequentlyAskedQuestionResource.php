<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrequentlyAskedQuestionResource\Pages;
use App\Filament\Resources\FrequentlyAskedQuestionResource\RelationManagers;
use App\Models\FrequentlyAskedQuestion;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class FrequentlyAskedQuestionResource extends Resource
{
    protected static ?string $model = FrequentlyAskedQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->label('Question')
                    ->maxLength(255),

                Forms\Components\Textarea::make('answer')
                    ->label('Answer')
                    ->required(),

                    Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->options(User::where('id',Auth::user()->id)->pluck('name', 'id'))
                    ->default(Auth::user()->id)
                    ->disablePlaceholderSelection()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('Id'),
                Tables\Columns\TextColumn::make('user.name')->sortable()->searchable()->label('User'),
                Tables\Columns\TextColumn::make('question')->sortable()->searchable()->label('Question'),
                Tables\Columns\TextColumn::make('answer')->sortable()->searchable()->label('Answer'),
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
            'index' => Pages\ListFrequentlyAskedQuestions::route('/'),
            'create' => Pages\CreateFrequentlyAskedQuestion::route('/create'),
            'edit' => Pages\EditFrequentlyAskedQuestion::route('/{record}/edit'),
        ];
    }
}
