<?php

namespace App\Http\Controllers\WebHooks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EasyPostWebHook extends Controller
{
    public function index(Request $request){
        \Log::info($request);
        return true;
    }
}
