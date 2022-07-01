<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Laravel\Cashier\Cashier;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Package;
use App\Models\Subscription;

class SubscriptionStripeController extends Controller
{

    public $user;
    public $hasErrors = false;
    public $errors = [  "status"=> false,
                        "message"=>"Error", 
                        "errors"=> null ];
    private $setting;


    public function __construct($params = null)
    {
      
      if(isset($params['user'])){
        $user = $params['user'];
      }else{
        $user = null;
      }

      $this->user = isset($params['user']) && $params['user']['stripe_id'] ?  Cashier::findBillable($params['user']['stripe_id']):$user;

      $setting = Setting::find(1);
      $public_key_stripe = $setting[$setting->eviroment.'_public_key_stripe'];
      $secret_key_stripe = $setting[$setting->eviroment.'_secret_key_stripe'];
      $tax_id_stripe = $setting[$setting->eviroment.'_tax_id_stripe'];
     
      $this->setting = [
          'public_key_stripe' => $public_key_stripe,
          'secret_key_stripe' => $secret_key_stripe,
          'tax_id_stripe' => $tax_id_stripe,
          'trial_days_stripe' => $setting->trial_days_stripe,
      ];

    }

    public function getErrors(){
      if(count($this->errors)){

        return $this->errors;
      }
      return null;
    }

    public function hasClient()
    {
      if($this->user->stripe_id){
        return true;
      }
      return false;
    }

    private function setErrors($error){
      $this->hasErrors = true;

      foreach ($error as $key => $value) {
        $this->errors[$key] = $value;
      }

      return $this->getErrors();
    }

    public function getCustomer()
    {
      try {
        if($this->user->stripe_id){

          $this->user = Cashier::findBillable($this->user->stripe_id);

        }else{
          throw new \Exception("Client Stripe not found"); 
        }
      } catch (\Exception $e) {
        
        $this->setErrors(['message'=> $e->getMessage()]);

        return null;
      }
      
      return $this->user;
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


        $validator= Validator::make(collect($this->user)->all(),$rules);

        if ($validator->fails()) {
          return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
        }

        if($this->user->stripe_id){
          return $this->setErrors(['message'=> 'Client Stripe is ready']);
        }

        try {
            $this->user->createAsStripeCustomer([
              'description' => $this->user->name.' '.$this->user->last_name,
              'email' => $this->user->email,
              "address"=> [
                  "city"=> $this->user->city,
                  "country"=> $this->user->country->code,
                  "line1"=> $this->user->address,
                  "postal_code"=> $this->user->postal_code,
                  "state"=> $this->user->state->code
              ],
              'expand' => ['tax'],
            ]);

            return $this->user;

        } catch (\Exception $e) {

            $this->setErrors(['message'=> $e->getMessage()]);
            return $this->getErrors();

        }

        return ['status'=> true,'message'=>'Customer created'];
    }

    public function setupStripe(){
     
      if(!$this->user->stripe_id){
        $this->setErrors(['message'=> 'Client Stripe not found']);
        return $this->getErrors();
      }
      
      $client_secret = null;
      try {
        $client_secret = $this->user->createSetupIntent();
      } catch (\Exception $e) {
        $this->setErrors(['message'=> $e->getMessage()]);
        return $this->getErrors();
      }

      return ['status'=> true, 
              'message' => 'Client secret create',
              'data' => [
                'client_secret'=>$client_secret->id,
              ]
            ];
    }

    public function getPresupuesto($data)
    {
      $rules=[
        'package_id'        => 'required',
        'price_id'      => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $package = Package::where('id',$data['package_id'])
                        ->where('status_id',1)
                        ->with(['prices'=> function($query) use ($data){
                          $query->where('id',$data['price_id']);
                        }])
                        ->first();
      if(!$package){
        return $this->setErrors(['message'=> 'Package not Found' ]);
      }


      $precio = $package->prices[0]->amount;
      $tax = (intval($precio) * 7) / 100;
      $subtotal = $precio + $tax;
      $total = $subtotal;

      return [
        'status' => true,
        'data'=> [
          'precio'    => intval($precio), 
          'tax'       => $tax, 
          'subtotal'  => $subtotal, 
          'total'     => $total, 
        ]
      ];
      
    }

    public function createProduct($data)
    {
      $rules=[
        'name'        => 'required',
        'description'      => 'required',
        'status' => 'required'
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }


      // $stripe = new \Stripe\StripeClient($_SESSION['user']['key_stripe_secret']);

      // $prices = Cashier::stripe()->prices->all();
      try {

        $product = Cashier::stripe()->products->create([
          'name'        => $data['name'],
          'description' => $data['description'],
          'active'      => $data['status'],
          'tax_code'    => "txcd_99999999",
          'metadata'    => []
        ]);

      } catch (\Exception $e) {
        return $this->setErrors(['message'=> $e->getMessage()]);
      }
      
      return $product;
    }

    public  function createPriceUnique($data)
    { 
      $rules=[
        'amount'        => 'required',
        'name'      => 'required',
        'product_id'     => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try{

        $price = Cashier::stripe()->prices->create([
          'unit_amount'  => $data['amount']*100,
          'currency'     => 'usd',
          'product'      => $data['product_id'],
          "tax_behavior" => "exclusive",
          "nickname"     => $data['name']
        ]);

        return $price;
      }catch(\Exception $e){
         return $this->setErrors(['message'=> $e->getMessage()]);
      } 
      return null;   
    }

    public  function cancelPriceUnique($data)
    { 
      $rules=[
        'stripe_id'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try{

        $price = Cashier::stripe()->prices->update($data['stripe_id'],
          [
            'active' => false
          ]
        );

        return $price;
      }catch(\Exception $e){
         return $this->setErrors(['message'=> $e->getMessage()]);
      } 
      return null;   
    }

    public  function createPlan($data)
    { 

      $rules=[
        'amount'        => 'required',
        'interval'      => 'required',
        'product_id'     => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try{

        $plan =  Cashier::stripe()->plans->create([
          'amount'         => $data['amount']*100,
          'currency'       => 'usd',
          'interval'       => $data['interval'] == 'custom' ? 'month':$data['interval'],
          'interval_count' => $data['interval'] == 'custom' ? 6:1,
          'product'        => $data['product_id'],
        ]);

        return $plan;

      }catch(\Exception $e){
         return $this->setErrors(['message'=> $e->getMessage()]);
      } 
      return null;   
    }

    public  function cancelPlan($data)
    { 

      $rules=[
        'stripe_id'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try{

        $plan =  Cashier::stripe()->plans->update(
          $data['stripe_id'],
          [ 'active'=> false ]
        );

        return $plan;

      }catch(\Exception $e){
         return $this->setErrors(['message'=> $e->getMessage()]);
      } 
      return null;   
    }

    private function createMethodPayment($data)
    {
      $rules=[
        'payment_method'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try {

        $this->user->updateDefaultPaymentMethod($data['payment_method']);
        $this->user->addPaymentMethod($user->defaultPaymentMethod()->asStripePaymentMethod()->id);

      } catch (\Exception $e) {
         return $this->setErrors(['message'=> $e->getMessage()]);
      }
      
      return ['status'=> true, 'message'=> 'Method Payment create', 'payment_method'=> $user->defaultPaymentMethod()->asStripePaymentMethod()->id];
    }

    public function createSubscription($data)
    {
      $rules=[
        'package_id'        => 'required',
        'price_id'      => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $package = $this->getPackage(['package_id' => $data['package_id'] , 'price_id' => $data['price_id'] ]);
      
      if(!$package){
        return $this->setErrors(['message'=> 'Package not Found' ]);
      }

      $price = $package->prices[0];

      if(!$price->stripe_id){
        return $this->setErrors(['message'=> 'Price not Found' ]);
      }

      $product = $this->getProduct(['stripe_id' => $package->stripe_id]);

      if(!$product){
        return $this->setErrors(['message'=> 'Price not Found' ]);
      }

      if(isset($data['create_method_payment']) && $data['create_method_payment']){
        $payment_method = $this->createMethodPayment(['payment_method' => $data['payment_method']]);
      }
      
      try {
        
        $YOUR_DOMAIN = 'https://realworld.uscreativity.com';
        if($price->recurrence->is_recurrence){
          
          // \Stripe\Stripe::setApiKey($this->setting['secret_key_stripe']);
          if(!$this->user->stripe_id){
            return $this->setErrors(['message'=> 'Customer not Found' ]);
          }

          $checkout_session = Cashier::stripe()->checkout->sessions->create([
            'line_items' => [[
              'price' => $price->stripe_id,
              'quantity' => 1,
              'tax_rates' => [$this->setting['tax_id_stripe']],
            ]],
            'mode' => 'subscription',
            'success_url' => $YOUR_DOMAIN . '/success?package_id='.$package.'price_id='.$price->id,
            'cancel_url' => $YOUR_DOMAIN . '/cancel',
            'customer' => $this->user->stripe_id,
          ]);

          if(!$checkout_session){
            return $this->setErrors($checkout_session, 422);
          }
          

          // return $subscription = $this->user->newSubscription($product->id, $price->stripe_id)
          //                   ->trialDays($this->setting['trial_days_stripe'])
          //                   ->checkout();
                            // ->add();

        }else{

            try {

              $itemInvoice = Cashier::stripe()->invoiceItems->create([
                "customer" => $this->user->stripe_id,
                "price"    => $price->stripe_id,
                "quantity" => 1,
              ]);

              $factura = Cashier::stripe()->invoices->create([
                'customer'               => $this->user->stripe_id,
                'default_payment_method' => $this->user->defaultPaymentMethod()->id,
                'default_tax_rates'      => [$this->setting['tax_id_stripe']],
              ]);

              $pago = Cashier::stripe()->invoices->pay(
                $factura->id,
                [ "payment_method"=> $user->defaultPaymentMethod()->id ]
              );

            } catch (\Exception $e) {
              return $this->setErrors(['message'=> $e->getMessage()]);
            }
        }
        
      } catch(IncompletePayment $exception){
          return $this->setErrors(['message'=> $exception]);
      } catch (\Exception $e) {
         return $this->setErrors(['message'=> $e->getMessage()]);
      }
    

      return ['status'=> true,'message'=> 'Subscription Create', 
        'data'=> [ 'url' => $checkout_session->url ]
      ];

    }

    public function cancelSubscription($data)
    {
      $rules=[
        'package_id'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $package = $this->getPackage(['package_id' => $data['package_id'], 'price_id' => null]);

      if(!$package){
        return $this->setErrors(['message'=> 'Package not Found' ]);
      }

      try {

        // $this->user->subscription($package->stripe_id)->cancel();

        Cashier::stripe()->subscriptions->cancel(
          $this->user->subscription->stripe_id,
          []
        );

        // $this->user->id
        // Subscription::where('user_id',)


      } catch (\Exception $e) {
        return $this->setErrors(['message'=> $e->getMessage()]);
      }

      return ['status' => true, 'message'=> 'Subscription Canceled'];
    }

    public function reanudarSubscription($data)
    {
      $rules=[
        'package_id'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      $package = $this->getPackage(['package_id' => $data['package_id'], 'price_id' => null]);

      if(!$package){
        return $this->setErrors(['message'=> 'Package not Found' ]);
      }

      try {

         // dd() ;
          Cashier::stripe()->subscriptions->update(
            $this->user->subscription->stripe_id,
            [
              'cancel_at_period_end' => false,
            ]
          );

         // Cashier::findBillable($this->user->stripe_id)->subscription($package->stripe_id)->resume();
        // $this->user;

        // Cashier::stripe()->subscriptions->cancel(
        //   $this->user->subscription->stripe_id,
        //   []
        // );

      } catch (\Exception $e) {
        return $this->setErrors(['message'=> $e->getMessage()]);
      }

      return ['status' => true, 'message'=> 'Subscription resume'];
    }

    public function getProduct($data)
    {
      $rules=[
        'stripe_id'        => 'required',
      ];

      $validator= Validator::make($data,$rules);

      if ($validator->fails()) {
        return $this->setErrors(['errors'=> collect($validator->errors())->all()]);
      }

      try{

        $product = Cashier::stripe()->products->retrieve($data['stripe_id'],[]);

        return $product;
      }catch(\Exception $e){
         return $this->setErrors(['message'=> $e->getMessage()]);
      } 

      return null;
    }

    public function getPackage($data){

      $package = Package::where('id',$data['package_id'])
                        ->where('status_id',1)
                        ->when($data['price_id'], function ($query) use ($data){
                            $query->with(['prices'=> function($query) use ($data){
                              $query->where('id',$data['price_id']);
                            }]);
                        })
                        ->first();

      return $package;
    }

    public function getInvoices(){
      try {

        $invoices = $this->user->invoices();
        
        $datos = [];
        foreach ($invoices as $key => $invoice) {
          if($invoice->total() != '$0.00'){
            $datos[] = [
              'name' => $this->user->subscription->package->name,
              'amount' => $invoice->total(),
              'date' => $invoice->date()->toFormattedDateString(),
              'invoice_pdf' => $invoice->hosted_invoice_url,
              'status' => $invoice->status,
              'pm_last_four' => $this->user->pm_last_four,
              'pm_type' => $this->user->pm_type,
            ];
          }
        }

      } catch (\Exception $e) {
         return $this->setErrors(['message'=> $e->getMessage()]);
      }

      return ['status'=> true, 'data'=> $datos];
    }
}
