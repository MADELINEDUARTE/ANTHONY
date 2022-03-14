<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Package;
use App\Models\Program;
use App\Models\ProgramDay;
use App\Models\ProgramDayRoutine;
use App\Models\Status;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Session;

class ProgramDaySubscriptionRelationManager extends HasManyRelationManager
{
    
    protected static string $relationship = 'subscription_program_day_routines';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = 'Subscription program day routines';
    protected static ?string $label = 'Subscription program day routines';


    public static function form(Form $form): Form
    {
        
        //dd($form);
        
        return $form
            ->schema([
                                
                Forms\Components\Select::make('subscription_programs_id')
                    ->label('Subscription programs')
                    ->options(SubscriptionProgram::all()->where('program_id',Session::get('program_id_hidden'))->pluck('user.name', 'id'))
                    ->required(),
                    
                    Forms\Components\Select::make('program_day_id')
                    ->label('Program Day')
                    ->options(ProgramDay::where('program_id',Session::get('program_id_hidden'))->pluck('name', 'id'))
                    ->required(), 
                    
                    Forms\Components\Toggle::make('is_active')
                    ->label('Is Active?')
                    ->required()
                    ->inline(),

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
                Tables\Columns\TextColumn::make('subscription_program.user.name')->label('Subscription Programs')->sortable(),
                Tables\Columns\TextColumn::make('program_day.name')->label('Program days')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable(),

            ])
            ->filters([
                //
            ]);
    }

    


}
