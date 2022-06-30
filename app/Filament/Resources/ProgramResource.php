<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Models\Program;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $label = 'Program';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = 'programs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),

                Forms\Components\RichEditor::make('description')
                    ->label('Description')
                    ->required(),

                    Forms\Components\BelongsToSelect::make('program_category_id')
                    ->relationship('program_category', 'description')
                    ->required()
                    /*->searchable()*/
                    ->label('Program Category'),        
                    
                    Forms\Components\FileUpload::make('video')->disk('public')
                    ->directory('programs/video')
                    ->visibility('public')
                    //->imagePreviewHeight('200')
                    ->preserveFilenames()
                    ->label('Video'),
                    //->required(),

                    Forms\Components\TextInput::make('number_of_days')
                    ->label('Number of days')
                    ->required()
                    ->numeric(),  

                    Forms\Components\FileUpload::make('image')->disk('public')
                    ->directory('programs/images')
                    ->visibility('public')
                    //->imagePreviewHeight('200')
                    ->preserveFilenames()
                    ->label('Image')
                    ->required(),

                    Forms\Components\Toggle::make('popular')
                    ->label('Popular')
                    ->required()
                    ->inline(),

                    Forms\Components\Toggle::make('recommended')
                    ->label('Recommended')
                    ->required()
                    ->inline(),

                    Forms\Components\BelongsToSelect::make('status_id')
                    ->relationship('program_status', 'description')
                    ->label('Status')
                    ->default(1)
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
                Tables\Columns\TextColumn::make('status.description')->sortable()->searchable()->label('Status'),
                Tables\Columns\TextColumn::make('user.name')->sortable()->searchable()->label('User'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
                Tables\Columns\ImageColumn::make('image')->label('Image'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProgramDaysRelationManager::class,
            RelationManagers\ProgramDayRoutineRelationManager::class,
            //RelationManagers\ProgramExercisesRelationManager::class,
            //RelationManagers\ProgramSubscriptionRelationManager::class,
            //RelationManagers\ProgramDaySubscriptionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
