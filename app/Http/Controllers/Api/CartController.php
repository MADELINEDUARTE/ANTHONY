<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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

    $cart = array_map($arreglo, collect($cart)->all());

    return response()->json($cart);
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

      $cart = new Cart($data);

      $user = Auth::user();

      $user->cart()->save($cart);

    }
    
    return response()->json($cart);   
  }
  
}
