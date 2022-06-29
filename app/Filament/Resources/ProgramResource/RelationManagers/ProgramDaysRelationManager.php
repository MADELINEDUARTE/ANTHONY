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

class ProgramDaysRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'details';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $title = 'Program Days';
    protected static ?string $label = 'Program Days';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                                
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(255),

                Forms\Components\TextInput::make('number')
                ->required()
                ->numeric()
                ->label('Number'),   
              
                Forms\Components\RichEditor::make('description')
                ->label('Description')
                ->default(' '),
           
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
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
                Tables\Columns\TextColumn::make('number')->sortable()->searchable()->label('number'),
                Tables\Columns\TextColumn::make('program_day_user.name')->sortable()->searchable()->label('User'),

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

    protected function beforeCreate(): void
    {
        
        //dd($this->all());

        $program_days = ProgramDay::where('program_id',$this->ownerRecord["id"])->get();
        
        if(count($program_days)>=$this->ownerRecord["number_of_days"]){

            //$this->notify('warning', 'Say My Name');
            //exit;
            //dd($program_days);

        }else{


        }

        
    }

    protected function afterCreate(): void
    {
        
        //dd($this->all());

        
    }

    protected function beforeDelete(): void
    {

        

    }

    protected function afterSave(): void
    {

        

    }

}
