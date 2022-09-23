<?php

namespace App\Filament\Resources\ProductsResource\Pages;

use App\Filament\Resources\ProductsResource;
use App\Http\Controllers\Api\SubscriptionStripeController as ManageStripe;
use App\Models\ProductsPrices;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProducts extends CreateRecord
{
    protected static string $resource = ProductsResource::class;

    protected function afterCreate(): void
    {

        $product = $this->record;
        $manageStripe = new ManageStripe();

        $productStripe = $manageStripe->createProduct([
            'name'        => $product->name,
            'description' => $product->description,
            'status'      => true,
            'id' => $product->id
        ]);

        $product->stripe_id = $productStripe->id;
        $product->save();

        $price = new ProductsPrices();
        $price->products_id = $product->id;
        $price->price = $product->price_last;
        $price->status = 1;
        $price->save();

        $priceStripe = $manageStripe->createPriceUnique([
            'amount' => $price->price,
            'product_id' => $productStripe->id,
            'name'    => $product->name,
        ]);

        if($priceStripe){
            $price->stripe_id = $priceStripe->id;
            $price->save();
        }

        if($product->price_offert_last){

            $priceOffert = new ProductsPrices();
            $priceOffert->products_id = $product->id;
            $priceOffert->price = $product->price_offert_last;
            $priceOffert->status = 1;
            $priceOffert->save();

            $product->price_id_offert = $priceOffert->id;
            $product->save();

            $priceStripeOffert = $manageStripe->createPriceUnique([
                'amount'     => $priceOffert->price,
                'product_id' => $productStripe->id,
                'name'       => $product->name,
            ]);

            $priceOffert->stripe_id = $priceStripeOffert->id;
            $priceOffert->save();

        }

    }


    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        dd('ajs');
        $record->update($data);
     
        return $record;
    }  
}
