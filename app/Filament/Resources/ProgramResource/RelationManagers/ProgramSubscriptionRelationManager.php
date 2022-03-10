<?php

namespace App\Filament\Resources\ProgramResource\RelationManagers;

use App\Models\Package;
use App\Models\Program;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use App\Models\Status;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class ProgramSubscriptionRelationManager extends HasManyRelationManager
{
    
    protected static string $relationship = 'subscription_programs';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = 'Subscription';
    protected static ?string $label = 'Subscription';


    public static function form(Form $form): Form
    {
        
        //dd($form);
        
        return $form
            ->schema([
                                
                    Forms\Components\Select::make('package_id')
                    ->label('Package')
                    ->options(Package::all()->pluck('name', 'id'))
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(fn (callable $set) => $set('subscription_id',null)),
                    
                    Forms\Components\Select::make('subscription_id')
                    ->label('Subscription')
                    ->required()
                    ->options(function(callable $get){
                        
                        $package_id = Package::find($get('package_id'));

                        if(!$package_id){
                            return Subscription::all()->pluck('user.name', 'id')->toArray();
                        }else{
                            return Subscription::all()->where('package_id',$get('package_id'))->pluck('user.name', 'id')->toArray();
                            
                        }

                        
                    }),

                    Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->options(Status::where('id','>',0)->pluck('description', 'id'))
                    /*->disablePlaceholderSelection()*/
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
                Tables\Columns\TextColumn::make('user.name')->label('User')->sortable(),
                Tables\Columns\TextColumn::make('status.description')->label('Status')->sortable(),
                Tables\Columns\TextColumn::make('subscription.user.name')->label('Subscription')->sortable(),

            ])
            ->filters([
                //
            ]);
    }

    


}
