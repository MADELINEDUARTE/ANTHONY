<?php

namespace App\Http\Controllers\WebHooks;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class EasyPostWebHook extends Controller
{
    public function index(Request $request){
        
        if($request['description'] == 'tracker.updated'){
            \Log::info('Llego hasta aqui');
            // \Log::info($request['result']['shipment_id']);
            $shipment = Shipment::where('shipment_id',$request['result']['shipment_id'])->update([
              'tracker_status'        => $request['result']['status'],
              'tracker_signed_by'     => $request['result']['signed_by'],
              'tracker_carrier'       => $request['result']['carrier'],
              'tracker_public_url'    => $request['result']['public_url'],
            ]);
            // \Log::info($shipment);
            
          return response()->json(['status'=> true, 'shipment' => '$shipment']);
        }
        return;
    }
}
