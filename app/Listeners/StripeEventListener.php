<?php

namespace App\Listeners;

use App\Events\SendPusher;
use App\Http\Controllers\Api\OrderController;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Laravel\Cashier\Events\WebhookReceived;


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
                  'status'   => true,
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

        if($event->payload['type'] === 'checkout.session.completed'){
            try {
                $user = User::where('stripe_id',$event->payload['data']['object']['customer'])->first();

                if(!$user){
                    throw new Exception('User not Found');
                }

                $order = new OrderController();
                $order = $order->processCompra(['user' => $user, 
                                                'stripe_id'=> $event->payload['data']['object']['payment_intent']
                                                ]);

                $data = [
                  'status'   => false,
                  'message' => 'Payment Success. Press OK to continue',
                  'user_id' => $user->id
                ];
                
                event(new SendPusher($data));

            } catch (\Exception $e) {
                \Log::info('============ checkout.session.completed');
                \Log::info($e->getMessage());
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