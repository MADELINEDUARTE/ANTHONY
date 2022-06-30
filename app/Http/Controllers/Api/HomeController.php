<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\State;
use App\Models\Country;
use App\Http\Controllers\Api\SubscriptionStripeController; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    public function index(Request $request){
        //dd($request->all());
        $programs = Program::paginate(1);
        
        return response()->json(['status'=> true, 'programs'=> $programs]);
    }

    public function createClienteStripe(Request $request )
    {

      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);
      $create = $subscription->createClienteStripe();

      if(!$create['status']){
          return response()->json($create,422);
      }
      
      return response()->json($create,200);
    }

    public function setupStripe(Request $request)
    {

      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);
      $setup = $subscription->setupStripe();

      if(!$setup['status']){
          return response()->json($setup,422);
      }

      $presupuesto = $subscription->getPresupuesto([
                                    'package_id'=> 1, 
                                    'price_id'=> 1,
                                  ]);

      if(!$presupuesto['status']){
          return response()->json($presupuesto,422);
      }
      
      return response()->json(['setup'=> $setup, 'presupuesto' => $presupuesto ],200);
    }

    public function createProduct(Request $request )
    {
        $subscription = new SubscriptionStripeController();
 
        $product = $subscription->createProduct([
            'name'=> 'Gold',
            'description'=> 'Subscription detail',
            'status' => true
        ]);

        if(isset($product['status']) && !$product['status']){
            return response()->json($product,422);
        }

        $price = $subscription->createPriceUnique([
          'amount' => 100,
          'product_id' => $product->id,
          'name' => '1Mes',
        ]);

        // $subscription->cancelPriceUnique(['stripe_id' => '']);


        // if(isset($price['status']) && !$price['status']){
        //     return response()->json($price,422);
        // }

        $plan = $subscription->createPlan([
            'amount'=> 50,
            'interval'=> 'month',
            'product_id'=> $product->id,
        ]);

        //$subscription->cancelPlan(['stripe_id' => '']);

        // if(isset($plan['status']) && !$plan['status']){
        //     return response()->json($plan,422);
        // }

        return response()->json(['message'=>'Produc created']);

    }

    public function createSubscription(Request $request)
    {
      $rules=[
        'package_id'        => 'required',
        'price_id'      => 'required',
      ];

      $validator= Validator::make($request->all(),$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);

      if(!$subscription->hasClient()){
         $customer = $subscription->createClienteStripe();

        if(isset($customer['status']) && !$customer['status']){
         return response()->json($subscription->getErrors(),422);
        }
      }
      

      $subscriptionData = $subscription->createSubscription([
                                        'package_id'=> $request->package_id, 
                                        'price_id'=> $request->price_id,
                                        'create_method_payment' => false,
                                        'payment_method' => ''
                                      ]);

      if(!$subscriptionData['status']){
        return response()->json($subscription->getErrors(),422);

      }

        return response()->json($subscriptionData);
    }

    public function cancelSubscription(Request $request)
    {
      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);

      $subscriptionData = $subscription->cancelSubscription([
                                        'package_id'=> 1, 
                                      ]);

      if(!$subscriptionData['status']){
        return response()->json($subscriptionData,422);
      }

      // TODO 
      // Razon de cancelacion

      return response()->json(['status'=> true,'message'=> 'Subscription Canceled']);
    }

    public function reanudarSubscription(Request $request)
    {
      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);

      $subscriptionData = $subscription->reanudarSubscription([
                                        'package_id'=> 1, 
                                      ]);

      if(!$subscriptionData['status']){
         return response()->json($subscriptionData,422);
      }

        return response()->json(['status'=> true,'message'=> 'Subscription Canceled']);
    }

    public function getInvoices(Request $request)
    {
      $subscription = new SubscriptionStripeController([ 'user' => Auth::user() ]);

      $invoices = $subscription->getInvoices();

      if(!$invoices['status']){
         return response()->json($invoices,422);
      }

      return response()->json($invoices);
    }

    public function getState()
    {
      return response()->json(['status'=> true, 'data'=> State::all() ]);
    }

    public function getCountry()
    {
      return response()->json(['status'=> true, 'data'=> Country::all() ]);
    }


    

}
