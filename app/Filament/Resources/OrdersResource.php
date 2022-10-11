<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Models\Orders;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class OrdersResource extends Resource
{

     use HasPermissions;
    use RefreshesPermissionCache;

    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              Tables\Columns\TextColumn::make('created_at')->dateTime()
                ->sortable()
                ->searchable()
                ->label('Create date'),
              Tables\Columns\TextColumn::make('user.name')
                ->sortable()
                ->searchable()
                ->label('Client Name'),
              Tables\Columns\TextColumn::make('user.last_name')
                ->sortable()
                ->searchable()
                ->label('Client Lastname'), 
              Tables\Columns\TextColumn::make('direccion_envio')->sortable()->searchable()->label('Address'),
              Tables\Columns\TextColumn::make('price')->sortable()->searchable()->label('Total Price'),
              Tables\Columns\TextColumn::make('shipment.tracker_status')->sortable()->searchable()->label('Shipment Status'),
              Tables\Columns\TextColumn::make('shipment.tracker_tracking_code')->sortable()->searchable()->label('Tracking Code'),


              // Tables\Columns\TextColumn::make('shipment.tracker_public_url')
              //   ->sortable()
              //   ->searchable()
              //   ->formatStateUsing(fn (string $state): string => "<a target='_blank' href='{$state}'>Tracker</a>")
              //   ->wrap()
              //   ->html()
              //   ->label('Tracking Code'),

              Tables\Columns\ViewColumn::make('shipment.tracker_public_url')
              ->view('orders.tables.columns.tracker_public_url')
              ->label('Tracking Code'),

              Tables\Columns\ViewColumn::make('shipment.label_url')
              ->view('orders.tables.columns.label_url')
              ->label('LABEL'),


              // Tables\Columns\TextColumn::make('shipment.label_url')
              //   ->sortable()
              //   ->searchable()
              //   ->formatStateUsing(fn (string $state): string => "<a target='_blank' href='{$state}'>LABEL</a>")
              //   ->wrap()
              //   ->html()
              //   ->label('LABEL'),

              

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }    
}
