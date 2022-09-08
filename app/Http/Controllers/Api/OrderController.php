<?php

namespace App\Http\Controllers\Api;

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
    $orders = Orders::get();
    
    return response()->json($orders);
  }

  public function store()
  {
    $this->user = Auth::user();

    $checkout = null;

    if(count($this->user->cart)){
      $checkout = $this->createCheckout();
    }else{
      return response()->json(['status'=> false, 'message'=> 'Car is empty']);
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

      $data = [
        'success_url' => $YOUR_DOMAIN . '/success',
        'cancel_url' => $YOUR_DOMAIN . '/cancel',
        'line_items' => $items,
        'mode'     => 'payment',
        'currency' => 'USD',
        'metadata' => [ 'user_id' => $this->user->id ]
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

    foreach ($user->cart as $key => $cart) {
      if($cart->stripe_id == $params['stripe_id']){
        $subtotal += $this->getPrice($cart->product)->price;
      }
    }

    $total = $this->calcTotal($subtotal);
    
    $direccion = $this->direccionEnvio($user);

    $order = new Orders([
      'price'           => $total,
      'status'          => 1,
      'direccion_envio' => $direccion,
      'stripe_id'       => $params['stripe_id'],
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

    foreach ($user->cart as $key => $cart) {
      if($cart->stripe_id == $params['stripe_id']){
        $cart->delete();
      }
    }

    return response()->json($order);
  }

  private function direccionEnvio(User $user)
  {
    return $user->address." ".$user->city." ".$user->state->name." ".$user->postal_code;
  }

  private function getPrice(Products $product)
  {
    if($product->price_id_offert){
      return $product->priceOffert;
    }

    return $product->price;
  }

  private function calcTotal($total)
  {
    $this->tax = ($total * 7) / 100;
    return $total + $this->tax;
  }
}
