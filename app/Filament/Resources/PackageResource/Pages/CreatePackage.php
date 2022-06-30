<?php

namespace App\Filament\Resources\PackageResource\Pages;

use App\Filament\Resources\PackageResource;
use App\Models\Package;
use Filament\Resources\Pages\CreateRecord;

use App\Http\Controllers\Api\SubscriptionStripeController;

class CreatePackage extends CreateRecord
{
    protected static string $resource = PackageResource::class;

    protected function afterCreate(): void
    {
        
        //dd($this->all());
        
        $Package = Package::where('id',$this->record->id)->first();

        $subscription = new SubscriptionStripeController();
 
        $product = $subscription->createProduct([
            'name'=> $this->record->name,
            'description'=> html_entity_decode($this->record->description),
            'status' => $this->record->status_id ? true : false
        ]);

        //dd($product);

        $Package->stripe_id = $product->id;
        $Package->save();

    }

}
