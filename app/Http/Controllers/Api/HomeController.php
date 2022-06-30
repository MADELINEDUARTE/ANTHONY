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
use App\Models\Subscription;
use App\Models\Package;
use App\Models\SubscriptionProgram;

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

    public function updateAddress(Request $request)
    {

      $rules=[
        'address'    => 'required',
        'state_id'   => 'required',
        'city'       => 'required',
        'postal_code'=> 'required',
      ];

      $validator= Validator::make($request->all(),$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $user = Auth::user();

      $user->address     = $request->address;
      $user->state_id    = $request->state_id;
      $user->city        = $request->city;
      $user->postal_code = $request->postal_code;
      $user->save();


      return response()->json(['status'=> true,'message'=> 'Update address', 'data' => $user]);
    }

    public function register_user_program(Request $request)
    {
        $rules=[
          'subscription_id' => 'required',
          'program_id' => 'required',
          'status_id' => 'required',
          'is_active' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
          return response()->json($validator->errors(),422);
        }
      
        $subscription = Subscription::where('id',$request->subscription_id)
        ->where('user_id',Auth::user()->id)
        ->first();
    
        $package = Package::where('id',$subscription->package_id)->first();
    
        $subscription_program = SubscriptionProgram::where('subscription_id',$request->subscription_id)
        ->where('status_id',1)
        ->where('user_id',Auth::user()->id)
        ->orderBy('created_at','desc')
        // ->where('is_active',1)
        ->get();
        
    
            $subscription_program_per_user = SubscriptionProgram::where('subscription_id',$request->subscription_id)
            ->where('status_id',1)
            ->where('user_id',Auth::user()->id)
            ->where('program_id',$request->program_id)
            ->where('is_active',1)
            ->get();

            if(count($subscription_program_per_user)>0){
              return response()->json(['status'=> true, 'message'=> "The user already has this program associated"], 403);
            }else{ 

              $programsActivos = $subscription_program->where('is_active',1);

              if(count($programsActivos) >= $package->number_of_programs){

                return response()->json(['status'=> true, 'message'=> "The user has reached and/or exceeded the program limit according to its associated package:"], 403);
      
              }else{

                $programsInactivo = $subscription_program->where('is_active',0);
                if(count($programsInactivo)){

                  $programsInactivo[0]->is_active = 1;
                  $programsInactivo[0]->save();

                }else{

                  $user_program = new SubscriptionProgram();
                  $user_program->subscription_id = $request->subscription_id;
                  $user_program->program_id = $request->program_id;
                  $user_program->status_id = $request->status_id;
                  $user_program->user_id = Auth::user()->id;
                  $user_program->is_active = $request->is_active;
                  $user_program->save();
               }
                //$user = User::create($request->all());
    
                return response()->json(['status'=> true,'message'=>"The user has been successfully associated with the program; they have ".count($programsActivos)." associated programs "],201);
              }
            }
    }

    public function cancel_user_program(Request $request)
    {
      $rules=[
        'status_program_id' => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      $subscription_program = SubscriptionProgram::where('id', $request->status_program_id)->first();

      if($subscription_program){
        $subscription_program->is_active = 0;
        $subscription_program->save();

        return response()->json(['status'=> true, 'message'=> 'Program stop']);
      }
      return response()->json(['status'=> false, 'message'=> 'Program not found'], 422);
    }
    

}
