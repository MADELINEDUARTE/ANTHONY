<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategorie;
use App\Models\Products;
use App\Models\ProductsColores;
use App\Models\ProductsImagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function products(Request $request)
    {
      $products = Products::where('status',1)->Name($request->name)->get();
      return response()->json($products); 
    }

    public function productCategories()
    {
      return response()->json(ProductCategorie::where('status',1)->get());
    }

    public function product(Products $product)
    {
      return response()->json($product);
    }


}
