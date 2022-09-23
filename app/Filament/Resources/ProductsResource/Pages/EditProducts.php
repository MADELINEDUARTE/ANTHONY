<?php

namespace App\Filament\Resources\ProductsResource\Pages;

use App\Filament\Resources\ProductsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductsPrices;
use App\Http\Controllers\Api\SubscriptionStripeController as ManageStripe;


class EditProducts extends EditRecord
{
    protected static string $resource = ProductsResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {   
        // dd($data);

        $precio = ProductsPrices::where('products_id', $record->id)->where('status',1)->first();
       
        if($precio->price != $data['price_last']){

          $precio->status = 0;
          $precio->save();

          $price              = new ProductsPrices();
          $price->products_id = $record->id;
          $price->price       = $data['price_last'];
          $price->status      = 1;
          $price->save();

          $manageStripe = new ManageStripe();

          $manageStripe->cancelPriceUnique(['stripe_id' => $precio->stripe_id]);

          $priceStripe = $manageStripe->createPriceUnique([
            'amount'     => $price->price,
            'product_id' => $record->stripe_id,
            'name'       => $record->name,
          ]);

          if($priceStripe){
              $price->stripe_id = $priceStripe->id;
              $price->save();
          }

        }


        if($data['price_offert_last']){
          $precioOffert = ProductsPrices::where('id', $record->price_id_offert)->where('status',1)->first();

          $manageStripe = new ManageStripe();

          if($precioOffert){

            if($data['price_offert_last'] != $precioOffert->price){

              $manageStripe->cancelPriceUnique(['stripe_id' => $precioOffert->stripe_id]);

              $precioOffert              = new ProductsPrices();
              $precioOffert->products_id = $record->id;
              $precioOffert->price       = $data['price_offert_last'];
              $precioOffert->status      = 1;
              $precioOffert->save();

              $precioStripeOffert = $manageStripe->createPriceUnique([
                'amount'     => $precioOffert->price,
                'product_id' => $record->stripe_id,
                'name'       => $record->name,
              ]);

              if($precioStripeOffert){
                  $precioOffert->stripe_id = $precioStripeOffert->id;
                  $precioOffert->save();
              }
              
            }
          }else{
            $precioOffert = new ProductsPrices();
            $precioOffert->products_id = $record->id;
            $precioOffert->price = $data['price_offert_last'];
            $precioOffert->status = 1;
            $precioOffert->save();

            $record->price_id_offert = $precioOffert->id;
            $record->save();

            $priceStripeOffert = $manageStripe->createPriceUnique([
                'amount'     => $precioOffert->price,
                'product_id' => $record->stripe_id,
                'name'       => $record->name,
            ]);

            $precioOffert->stripe_id = $priceStripeOffert->id;
            $precioOffert->save();
          }

        }else{

          $precioOffert = ProductsPrices::where('id', $record->price_id_offert)->where('status',1)->first();

          if($precioOffert){
            $manageStripe = new ManageStripe();
            $manageStripe->cancelPriceUnique(['stripe_id' => $precioOffert->stripe_id]);
            
            $precioOffert->status      = 0;
            $precioOffert->save();

            $record->price_id_offert = 0;
            $record->save(); 
          }
        }
        
        $record->update($data);

        return $record;
    }



    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


}
