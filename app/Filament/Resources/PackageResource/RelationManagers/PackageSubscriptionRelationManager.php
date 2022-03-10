<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

use App\Models\Package;
use App\Models\Subscription;
use App\Models\Status;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class PackageSubscriptionRelationManager extends HasManyRelationManager
{
    
    protected static string $relationship = 'package_subscription';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $title = 'Package Subscriptions';
    protected static ?string $label = 'Package Subscriptions';


    public static function form(Form $form): Form
    {
        
        //dd($form);
        
        return $form
            ->schema([
                                
                    
                    Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->options(Status::where('id','>',0)->pluck('description', 'id'))
                    /*->disablePlaceholderSelection()*/
                    ->required(),
                
                    Forms\Components\Select::make('user_id')
                    ->label('Usuario')
                    ->options(User::where('id','>',0)->pluck('name', 'id'))
                    /*->default(Auth::user()->id)*/
                    /*->disablePlaceholderSelection()*/
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status.description')->sortable()->searchable()->label('Status'),
                Tables\Columns\TextColumn::make('user.name')->sortable()->searchable()->label('User'),
            ])
            ->filters([
                //
            ]);
    }

    


}
