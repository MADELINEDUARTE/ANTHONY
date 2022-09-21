<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\EnviosController;
use App\Http\Controllers\Api\ShipmentController;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\OrdersProducts;
use App\Models\Products;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class OrderController extends Controller
{

  private $tax;
  private $user;
  private $setting;
  private $envio;
  private $tasa;

  public function __construct()
  {
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

  public function index()
  {
    $user = Auth::user();
    $orders = Orders::where('user_id',$user->id)->latest()->get();
    
    return response()->json($orders);
  }

  public function store()
  {
    $this->user = Auth::user();

    $checkout = null;

    if(count($this->user->cart)){

      $checkout = $this->createCheckout();
    }else{
      return response()->json(['status'=> false, 'message'=> 'Car is empty'], 422);
    }

    return response()->json($checkout);
  }

  private function createCheckout()
  {
    $YOUR_DOMAIN = 'https://realworld.uscreativity.com';

    $items = [];
    foreach ($this->user->cart as $key => $cart) {
      $items[] = [
        'price' => $this->getPrice($cart->product)->stripe_id, 
        'quantity' => $cart->count,
        'tax_rates' => [$this->setting['tax_id_stripe']],
      ];
    }

    $checkout = null;

    try {

      $envio = new EnviosController([ 'user' => $this->user ]);
      $envio = $envio->getEnvio($this->user->cart[0]->envio_easypost_id);
      
      $rate = null;
      $priceRate = 0;

      if(empty($envio['hasErrors'])){
        $index = array_search('First', array_column($envio['data']->rates, 'service'));
        $rate['price'] = $envio['data']->rates[$index]->retail_rate;
      }elseif(isset($envio['hasErrors']) && $envio['hasErrors']){
        $rate['errors'] = $envio['errors'];
      }

      $priceRate = $rate['price']*100;

      $data = [
        'success_url' => $YOUR_DOMAIN . '/success',
        'cancel_url'  => $YOUR_DOMAIN . '/cancel',
        'line_items'  => $items,
        'mode'        => 'payment',
        'currency'    => 'USD',
        'metadata'    => [ 'user_id' => $this->user->id ],
        'shipping_options' => [
          [
            'shipping_rate_data' => [
              'display_name' => 'Ground shipping',
              'type' => 'fixed_amount',
              'fixed_amount' => [
                'amount' => $priceRate,
                'currency' => 'usd',
              ],
            ]
          ]
        ]
      ];

      if($this->user->stripe_id){
        $data['customer'] = $this->user->stripe_id;
      }else{
        $data['customer_creation'] = 'always';
      }

      $checkout = Cashier::stripe()->checkout->sessions->create($data);

      foreach ($this->user->cart as $key => $cart) {
        $cart->stripe_id = $checkout->payment_intent;
        $cart->save();
      }
    } catch (\Exception $e) {

      \Log::info($e->getMessage());

    }
    

    return $checkout;
  }

  public function processCompra($params)
  {
    $user = $params['user'];

    $subtotal = 0;
    foreach ($user->cart as $key => $cart) {
      if($cart->stripe_id == $params['stripe_id']){
        $subtotal += $this->getPrice($cart->product)->price;
      }
    }

    $envio_easypost_id = $user->cart[0]->envio_easypost_id;

    $total = $this->calcTotal($subtotal, $user, $envio_easypost_id);
    
    // \Log::info($total);
    $direccion = $this->direccionEnvio($user);
    $index = array_search('First', array_column($this->envio['data']->rates, 'service'));

    $order = new Orders([
      'price'           => $total,
      'status'          => 1,
      'direccion_envio' => $direccion,
      'stripe_id'       => $params['stripe_id'],
      'envio_easypost_id' => $envio_easypost_id,
      'price_rate' =>  $this->envio['data']->rates[$index]->retail_rate
    ]);

    $user->order()->save($order);

    $ordersProducts = [];

    foreach ($user->cart as $key => $cart) {
      $ordersProducts[] = new OrdersProducts([
        'products_id' => $cart->products_id,
        'count'       => $cart->count,
        'talle_id'    => $cart->talle_id,
        'color_id'    => $cart->color_id,
        'price'       => $this->getPrice($cart->product)->price
      ]);
    }

    $order->ordersProducts()->saveMany($ordersProducts);

    $order = Orders::find($order->id);
    
    $this->shipment($envio_easypost_id, $order);

    foreach ($user->cart as $key => $cart) {
      if($cart->stripe_id == $params['stripe_id']){
        $cart->delete();
      }
    }

    return response()->json($order);
  }

  private function direccionEnvio(User $user)
  {
    $state = $user->state_id ? $user->state->name : '';
    return $user->address." ".$user->city." ".$state." ".$user->postal_code;
  }

  private function getPrice(Products $product)
  {
    if($product->price_id_offert){
      return $product->priceOffert;
    }

    return $product->price;
  }

  private function calcTotal($total, $user = null, $envio_easypost_id = null)
  {

    if($envio_easypost_id && $user){
      $this->envio = new EnviosController(['user' => $user]);
      $this->envio = $this->envio->getEnvio($envio_easypost_id);
    }

    $index = array_search('First', array_column($this->envio['data']->rates, 'service'));
    // $this->envio = $this->envio['data'];
    // \Log::info($this->envio['data']->rates);
    $rate = $this->envio['data']->rates[$index]->retail_rate;

    $total += $rate;
    $this->tax = ($total * 7) / 100;
    return $total + $this->tax;
  }

  private function shipment($id,$order)
  {
    try {
      $index = array_search('First', array_column($this->envio['data']->rates, 'service'));
      $shipment = \EasyPost\Shipment::retrieve($id);
      $shipment->buy(array('rate' => array('id' => $this->envio['data']->rates[$index]->id )));

      $shipmentTable = new ShipmentController();
      $shipmentTable = $shipmentTable->createShipment($shipment, $order);

      return ['shipment' => $shipment, 'shipmentTable' => $shipmentTable];

    } catch (\Exception $e) {
      \Log::info($e->getMessage());
    }
    
  }

 
}
