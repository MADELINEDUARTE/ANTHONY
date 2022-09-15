<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class EnviosController extends Controller
{
  private $setting;
  private $easy_post; 
  private $from_address;
  private $to_address;
  private $parcel;
  private $shipment;
  private $user;
  private $errors = [ 'status' => false, 'errors' => [] ];

  private function setErrors($message)
  {
    $this->errors['errors'][] = $message;
  }

  public function hasErrors()
  {
    if(count($this->errors['errors'])){
      $this->errors['status'] = true;
    }else{
      $this->errors['status'] = false;
    }
    return $this->errors['status'];
  }

  public function getErrors()
  {
    $this->hasErrors();
    return $this->errors;
  }

  public function __construct($params)
  {
    try {
      $this->user = $params['user'];
      $setting = Setting::find(1);

      if(!$setting->street1 || !$setting->zip){
        throw new \Exception('Company address and zip code is required');
      }

      $easy_post = $setting[$setting->eviroment.'_easy_post'];
      $this->setting = [ 'easy_post' => $easy_post ];

      \EasyPost\EasyPost::setApiKey($this->setting['easy_post']);

      if(!$setting->easy_post_adress_id){
        $address_params = [
          // "verify"  => true,
          "verify_strict" => true,
          "street1"       =>  $setting->street1,
          "street2"       =>  $setting->street2,
          "city"          =>  $setting->city,
          "state"         =>  $setting->state,
          "zip"           =>  $setting->zip,
          "country"       =>  $setting->country,
          "company"       =>  $setting->company_name,
          "phone"         =>  $setting->phone 
        ];

        $this->from_address = \EasyPost\Address::create($address_params);

        $setting->easy_post_adress_id = $this->from_address->id;
        $setting->save();

      }else{
        $this->from_address = \EasyPost\Address::retrieve($setting->easy_post_adress_id);
      }

    } catch (\Exception $e) {
      $this->setErrors($e->getMessage());
      return $this->getErrors();
    }

  }

  /*
   * Crea direccion de de recepcion del paquete
   * Required Model User $user
   */
  public function createToAdress()
  {
    try {
      $user = $this->user;

      if(!$user->address || !$user->postal_code){
        throw new \Exception('Client address and zip code is required');
      }


      $address_params = [
        // "verify"  => true,
        "verify_strict"=> true,
        "name"    => $user->name." ".$user->last_name,
        "phone"   => $user->telephone,
        "email"   => $user->email,
        "street1" => $user->address,
        "city"    => $user->city,
        "state"   => $user->state->name,
        "country" => "US",
        "zip"     => $user->postal_code
      ];

      $this->to_address = \EasyPost\Address::create($address_params);

      return  ['status' => true, 'data' => json_decode($this->to_address) ];

    } catch (\Exception $e) {
      $this->setErrors($e->getMessage());
      return $this->getErrors();
    }
  }

  /*
   * Crea el Paquete nuevo
   */
  public function createParcel()
  {
    try {

      $parcel = [
        "predefined_packages" => "MediumFlatRateBox",
        // "length" => 9,
        // "width" => 6,
        // "height" => 2,
        "weight" => 10
      ];

      $this->parcel = \EasyPost\Parcel::create($parcel);

      return  ['status' => true, 'data' => json_decode($this->parcel) ];

    } catch (\Exception $e) {

      $this->setErrors($e->getMessage());
      return $this->getErrors();

    }
  }

  /*
   * Crea el Envio
   */
  public function createShipment()
  {
    try {

      $shipment = [
        "to_address"   => $this->to_address,
        "from_address" => $this->from_address,
        "parcel"       => $this->parcel
      ];

      $this->shipment = \EasyPost\Shipment::create($shipment);

      return  ['status' => true, 'data' => json_decode($this->shipment) ];

    } catch (\Exception $e) {
      $this->setErrors($e->getMessage());
      return $this->getErrors();
    }
  }

  /*
   * Simula un envio
   */

  public function consultaEnvio()
  {
    $this->createToAdress();
    $this->createParcel();
    return $this->createShipment();
  }


}
