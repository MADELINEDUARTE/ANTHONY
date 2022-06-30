<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Auth;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Settings';

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

                    Forms\Components\TextInput::make('number_of_programs')
                    ->label('Number of Programs')
                    ->required()
                    ->numeric(), 
                    
                    Forms\Components\TextInput::make('amount')
                    ->label('Amount')
                    ->default('333')
                    //->extraAttributes(['style' => 'display:none'])
                    ->hidden()
                    ->required()
                    ->numeric(), 

                    Forms\Components\BelongsToSelect::make('status_id')
                    ->relationship('package_status', 'description')
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
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->label('Name'),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable()->label('Description'),
            ])
            ->filters([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PackageSubscriptionRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
