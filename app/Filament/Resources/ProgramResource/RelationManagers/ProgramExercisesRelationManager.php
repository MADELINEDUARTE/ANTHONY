<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class ProgramExercisesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'exercises';

    protected static ?string $recordTitleAttribute = 'description';

    protected static ?string $title = 'Exercises';
    protected static ?string $label = 'Exercises';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                                
                Forms\Components\RichEditor::make('description')
                ->label('Description')
                ->required(), 
              
                Forms\Components\FileUpload::make('video')->disk('public')
                    ->directory('exercises/video')
                    ->visibility('public')
                    ->imagePreviewHeight('200')
                    ->preserveFilenames()
                    ->label('Video')
                    ->multiple()
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
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
                Tables\Columns\TextColumn::make('exercise_user.name')->sortable()->searchable()->label('User'),

            ])
            ->filters([
                //
            ]);
    }

    
    /*public static function getRelations(): array
    {
        return [
            RelationManagers\ProgramDayRoutineRelationManager::class,
        ];
    }
    */

    

}
