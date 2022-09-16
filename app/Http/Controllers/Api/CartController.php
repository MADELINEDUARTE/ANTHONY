<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\EnviosController;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
  

  public function index()
  {

    $user = Auth::user();
    $cart = $user->cart;

    $arreglo = function ($cart){
      $product = $cart->product;
      $product->cart = [
        'id' => $cart->id,
        'color' => $cart->color,
        'talle' => $cart->talle,
        'count' => $cart->count,
      ];
      return $product;
    };
    
    $rate = null;
    
    if($cart->count()){
      if(!$cart[0]->envio_easypost_id){
        $envio = new EnviosController(['user' => $user]);
        $envio = $envio->consultaEnvio();

        if(empty($envio['hasErrors'])){
          foreach ($cart as $key => $car) {
            $car->envio_easypost_id = $envio['data']->id;
            $car->save();
          }
        }
      }else{
        $envio = new EnviosController(['user' => $user]);
        $envio = $envio->getEnvio($cart[0]->envio_easypost_id);
        
      }
    }

    $cart = array_map($arreglo, collect($cart)->all());

    
    if(empty($envio['hasErrors'])){
      $index = array_search('First', array_column($envio['data']->rates, 'service'));
      $rate['price'] = $envio['data']->rates[$index]->retail_rate;
    }elseif(isset($envio['hasErrors']) && $envio['hasErrors']){
      $rate['errors'] = $envio['errors'];
    }

    return response()->json([ 'cart' => $cart, 'rate' => $rate ]);
  }

  public function store(Request $request)
  {  

    $data = [
      'products_id' => $request->product['id'],
      'count'       => $request->count,
      'talle_id'    => isset($request->talle) && count($request->talle) ? $request->talle['id']: null,
      'color_id'    => isset($request->color) && count($request->color) ? $request->color['id']: null
    ];

    if($request->id){

      $cart = Cart::find($request->id)->update($data);

    }else{
      $user = Auth::user();
      
      $cart = Cart::where('user_id',$user->id)->where('products_id', $request->product['id'])->first();

      if($cart){
        $cart->update($data);
      }else{
        $cart = new Cart($data);
        $user->cart()->save($cart);
      }

    }
    
    return response()->json($cart);   
  }

  

 
  
}
