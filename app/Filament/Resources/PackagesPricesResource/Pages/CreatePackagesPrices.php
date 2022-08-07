<?php

namespace App\Filament\Resources\PackagesPricesResource\Pages;

use App\Filament\Resources\PackagesPricesResource;
use App\Models\PackagesPrices;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Http\Controllers\Api\SubscriptionStripeController;

class CreatePackagesPrices extends CreateRecord
{
    protected static string $resource = PackagesPricesResource::class;

    protected function beforeCreate(): void
    {
        
        //dd($this->all());
        $subscription = new SubscriptionStripeController();
        $PackagesPrices = PackagesPrices::where('packages_id',$this->data["packages_id"])
        ->where('recurrences_id',$this->data["recurrences_id"])
        ->first();

        if($PackagesPrices){

            if($PackagesPrices->recurrence->is_recurrence==$this->data["is_recurrence"]){

                if($PackagesPrices->recurrence->is_recurrence==1){
                    $subscription->cancelPlan(['stripe_id' => $PackagesPrices->stripe_id]);
                }elseif($PackagesPrices->recurrence->is_recurrence==0){
                    $subscription->cancelPriceUnique(['stripe_id' => $PackagesPrices->stripe_id]);
                }

                $PackagesPrices->delete();
            }

        }

        

    }

    protected function afterCreate(): void
    {
        
        //dd($this->all());
        
        $PackagesPrices = PackagesPrices::where('id',$this->record->id)->first();

        $subscription = new SubscriptionStripeController();
 
        
        if($this->data["is_recurrence"]==1){
          try {
            $plan = $subscription->createPlan([
                'amount'=> ($this->record->amount),
                'interval'=> $this->record->recurrence->interval,
                'product_id'=> $this->record->packages->stripe_id,
            ]);
          } catch (\Exception $e) {
            \Log::info($e->getMessage());
          }
            //si es recurrente 
            
            // dd($plan);

        }elseif($this->data["is_recurrence"]==0){

            //Si no es recurrente
            $plan = $subscription->createPriceUnique([
              'amount' => ($this->record->amount),
              'product_id' => $this->record->packages->stripe_id,
              'name' => $this->record->recurrence->description,
            ]);

        }

        //dd($product);

        $PackagesPrices->stripe_id = $plan->id;
        $PackagesPrices->save();

    }
}
