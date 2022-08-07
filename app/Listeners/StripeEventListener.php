<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Package;
use App\Events\SendPusher;


class StripeEventListener
{
    /**
     * Handle received Stripe webhooks.
     *
     * @param  \Laravel\Cashier\Events\WebhookReceived  $event
     * @return void
     */
    public function handle(WebhookReceived $event)
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            $user = User::where('stripe_id',$event->payload['data']['object']['customer'])->first();
            if($user){
                $package = Package::where('stripe_id',$event->payload['data']['object']['lines']['data'][0]['price']['product'])->first();
                $subscription = Subscription::where('user_id',$user->id)->latest()->first();
                $subscription->package_id = $package->id;
                $subscription->save();

                $data = [
                  'error'   => true,
                  'message' => 'Subscription processed. Press OK to continue',
                  'user_id' => $user->id
                ];
                event(new SendPusher($data));
               
            }else{
              \Log::info('============ customer.subscription.created');
              \Log::info('Nsot user');
              \Log::info('==========================================');
            }
        }
        // if ($event->payload['type'] === 'invoice.payment_failed') {
        //   $user = User::where('stripe_id',$event->payload['data']['object']['customer'])->first();
        //   $data = [
        //     'error'   => false,
        //     'message' => 'Error',
        //     'user_id' => $user->id
        //   ];
        //   event(new SendPushNotification($data));
        // }
    }
}