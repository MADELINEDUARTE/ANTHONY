<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function createShipment($shipment, $order)
    {
      return Shipment::insert([
        'shipment_id'           => $shipment->id,
        'order_id'              => $order->id,
        'address_name'          => $shipment->to_address->name,
        'address_street1'       => $shipment->to_address->street1,
        'address_street2'       => $shipment->to_address->street2,
        'address_city'          => $shipment->to_address->city,
        'address_state'         => $shipment->to_address->state,
        'address_zip'           => $shipment->to_address->zip,
        'address_country'       => $shipment->to_address->country,
        'address_email'         => $shipment->to_address->email,
        'tracker_id'            => $shipment->tracker->id,
        'tracker_tracking_code' => $shipment->tracker->tracking_code,
        'tracker_status'        => $shipment->tracker->status,
        'tracker_created_at'    => $shipment->tracker->created_at,
        'tracker_signed_by'     => $shipment->tracker->signed_by,
        'tracker_carrier'       => $shipment->tracker->carrier,
        'tracker_public_url'    => $shipment->tracker->public_url,
        'label_date'            => $shipment->postage_label->label_date,
        'label_url'             => $shipment->postage_label->label_url,
        'rate_service'          => $shipment->selected_rate->service,
        'rate_price'            => $shipment->selected_rate->rate,
        'rate_retail_rate'      => $shipment->selected_rate->retail_rate,
      ]);
    }


}
