<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Setting;

class SubscriptionStripeController extends Controller
{

    public $user;
    private $setting;

    public function __construct()
    {
        $setting = Setting::find(1);
        $public_key_stripe = $setting[$setting->eviroment.'_public_key_stripe'];
        $secret_key_stripe = $setting[$setting->eviroment.'_secret_key_stripe'];
        $tax_id_stripe = $setting[$setting->eviroment.'_tax_id_stripe'];
       
        $this->setting = [
            'public_key_stripe' => $public_key_stripe,
            'secret_key_stripe' => $secret_key_stripe,
            'tax_id_stripe' => $tax_id_stripe
        ];
    }

    public function errors($e)
    {
      \Log::info($e->getMessage());
    } 

    public function createClienteStripe()
    {
        $rules=[
          'name'        => 'required',
          'country_id'  => 'required',
          'address'     => 'required',
          'email'       => 'required',
          'state_id'    => 'required',
          'city'        => 'required',
          'postal_code' => 'required',
        ];

        $user = Auth::user();

        $validator= Validator::make(collect($user)->all(),$rules);

        if ($validator->fails()) {
            return response()->json(["message" => $validator->errors()],422);
        }

        if($user->stripe_id){
          return response()->json(['message'=> 'Client Stripe is ready'],422);
        }

        try {
            $user->createAsStripeCustomer([
              'description' => $user->name.' '.$user->last_name,
              'email' => $user->email,
              "address"=> [
                  "city"=> $user->city,
                  "country"=> $user->country->code,
                  "line1"=> $user->address,
                  "postal_code"=> $user->postal_code,
                  "state"=> $user->state->code
              ],
              'expand' => ['tax'],
            ]);
        } catch (\Exception $e) {
            $this->errors($e);
            return response()->json(['message'=> $e->getMessage()],422);
        }

        return response()->json(['message'=>'Customer created', 'data' => $user]);
    }

    public function setupStripe(){
      $user = Auth::user();

      if(!$user->stripe_id){
        return response()->json(['message'=> 'Client Stripe not found'],422);
      }
      
      $client_secret = null;
      try {
        $client_secret = $user->createSetupIntent();
      } catch (\Exception $e) {
        $this->errors($e);
        return response()->json(['message'=> $e->getMessage()],422);
      }

      return response()->json(['message' => 'Client secret create',
                              'data' => [
                                'client_secret'=>$client_secret
                              ]
                            ]);
    }

}
