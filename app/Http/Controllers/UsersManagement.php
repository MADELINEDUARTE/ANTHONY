<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Package;
use App\Models\Subscription;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UsersManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {

      $rules=[
        'email'    => 'required',
        'password'   => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      $credentials = $request->validate([
          'email' => ['required', 'email'],
          'password' => ['required'],
      ]);

      if (Auth::attempt($credentials)) {
        return response()->json([ 
            'status'=> true,
            "message" => "User Logged",
            "data" => [
                "user"=> Auth::user(),
                "token" =>  Auth::user()->token
            ]
        ]); 
      }else{
        return response()->json([ 
            'status'=> false,
            'message' => 'The provided credentials do not match our records.',
        ], 403);
      }
    }

    public function validateCode(Request $request)
    {
      $rules=[
        'code' => 'required',
        'user_id' => 'required'
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
          return response()->json($validator->errors(),422);
      }

      $user = User::where('id', $request->user_id)->first();

      if($user){

        $fechaDeEnvio = Carbon::parse($user->updated_at);
        $hoy = Carbon::now();
        $diferencia = $fechaDeEnvio->diffInMinutes($hoy); 

        if($diferencia > 60){
          return response()->json(["status" => false, "message"=>"Code Expired"], 422);
        }

        if($user->code == $request->code){

          $token = $user->createToken('authtoken');
          $user->token = $token->plainTextToken;
          $user->save();

          return response()->json([
              'message'=>'User Validated',
              'data'=> ['token' => $user->token, 'user' => $user]
          ],200);

        }
      }else{
          return response()->json(["status" => false, "message"=>"User Not Found"],422);
      }
    }
    public function recover_password(Request $request)
    {
      $rules=[
        'email' => 'required',
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
          return response()->json($validator->errors(),422);
      }

      $user = User::where('email', $request->email)->first();

      if($user){

        // $token                = $user->createToken('authtoken');
        // $user->remember_token = $token->plainTextToken;
        $user->updated_at = Carbon::now();
        $numero_aleatorio = rand(100000,900000);
        $user->code       = $numero_aleatorio;
        $user->save();

        Mail::to($user->email)->send(new SendCode($numero_aleatorio,$user));

        return response()->json(['status'=> true, 'message'=> 'Code email send'], 200);

      }else{
        return response()->json(['status'=> false, 'message'=> 'Client no fotund'], 403);
      }
    }

    public function new_password(Request $request)
    {
      $rules=[
        'email' => 'required',
        'paswword' => 'required',
        'password_confirmation' => 'required|confirmed'
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
          return response()->json($validator->errors(),422);
      }

      $user = User::where('email', $request->email)->first();

      if($user){

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(["status" => true, "message"=>"Saved Password"]);

      }else{ 
        return response()->json(["status" => false, "message"=>"User Not Found"],422);
      }
    }

    public function resend_code(Request $request)
    {
       $rules=[
        'email' => 'required'
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
          return response()->json($validator->errors(),422);
      }

      $user = User::where('email', $request->email)->first();

      if($user){

        $user->updated_at = Carbon::now();
        $numero_aleatorio = rand(100000,900000);
        $user->code       = $numero_aleatorio;
        $user->save();

        Mail::to($user->email)->send(new SendCode($numero_aleatorio,$user));
        
        return response()->json(["status" => true, "message"=>"Saved Password"]);

      }else{ 
        return response()->json(["status" => false, "message"=>"User Not Found"],422);
      }
    }

    public function register(Request $request)
    {
      $rules=[
        'email' => 'required|string|email'
      ];

      $validator = Validator::make($request->all(),$rules);

      if ($validator->fails()) {
        return response()->json($validator->errors(),422);
      }

      $validate_user=User::where('email',$request->email)->get();

      if(count($validate_user)>0){
        return response()->json(["message"=>"User already exists"],422);
      }else{

        $rules=[
            'name'       => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'password'   => 'required',
            'last_name'  => 'required',
            'country_id' => 'required',
            'telephone'  => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
          return response()->json($validator->errors(),422);
        }

        $user = User::create([
          'name'       => $request->name,
          'email'      => $request->email,
          'password'   => Hash::make($request->password),
          'last_name'  => $request->last_name,
          'country_id' => $request->country_id,
          'telephone'  => $request->telephone,
        ]);

        // $token = $user->createToken('authtoken');
        // $user->token = $token->plainTextToken;
        $numero_aleatorio = rand(100000,900000);
        $user->code = $numero_aleatorio;
        $user->save();

        Mail::to($user->email)->send(new SendCode($numero_aleatorio,$user));

        if($token){
          return response()->json(
            [
              'message'=>'User Registered',
              'data'=> [ 'user' => $user ]
            ]
          );
        }else{
          return response()->json(["message"=>"User Not Registered"],422);
        }
      }

    }

    public function update_user(Request $request)
    {
        
        /*
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'required',
            'date_of_birth' => 'required',
            'country_id' => 'required',
            'address' => 'required',
            'telephone' => 'required'
        ]);
        */

        $User = User::find($request->user_id);
        
        if($request->name && $request->name!=""){
            $User->name = $request->name;
        }
        
        
        /*
        if($request->email && $request->email!=""){
            $User->email = $request->email;
        } 
        */    

        if($request->middle_name && $request->middle_name!=""){
            $User->middle_name = $request->middle_name;
        }    

        if($request->last_name && $request->last_name!=""){
            $User->last_name = $request->last_name;
        }    

        if($request->gender_id && $request->gender_id!=""){
            $User->gender_id = $request->gender_id;
        }    

        
        if($request->date_of_birth && $request->date_of_birth!=""){
            $User->date_of_birth = $request->date_of_birth;
        }

        if($request->country_id && $request->country_id!=""){
            $User->country_id = $request->country_id;
        }

        if($request->address && $request->address!=""){
            $User->address = $request->address;
        }

        if($request->telephone && $request->telephone!=""){
            $User->telephone = $request->telephone;
        }

        if($request->experience_id && $request->experience_id!=""){
            $User->experience_id = $request->experience_id;
        }
        
        if($request->reason_id && $request->reason_id!=""){
            $User->reason_id = $request->reason_id;
        }

        if($request->frequency_id && $request->frequency_id!=""){
            $User->frequency_id = $request->frequency_id;
        }

        if($request->exercise_place_id && $request->exercise_place_id!=""){
            $User->exercise_place_id = $request->exercise_place_id;
        }

        if($request->state_id && $request->state_id!=""){
            $User->state_id = $request->state_id;
        }

        if($request->city && $request->city!=""){
            $User->city = $request->city;
        }
        if($request->postal_code && $request->postal_code!=""){
            $User->postal_code = $request->postal_code;
        }


        $User->save();

        //$token = $User->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Updated',
                'data'=> ['user' => $User, 'token' => $User->token]
            ]
        );
    }


    public function logout(Request $request)
    {
      $request->user()->tokens()->delete();

      return response()->json(
          [
              'message' => 'Logged out'
          ]
      );

      //return response("El usuario ha finalizado sesion", 201);

    }

    public function register_user_subscription(Request $request)
    {
      $request->validate([
        'package_id' => 'required',
        'user_id' => 'required',
        'status_id' => 'required'
      ]);
      $user_subscription = new Subscription();
      $user_subscription->package_id = $request->package_id;
      $user_subscription->user_id = $request->user_id;
      $user_subscription->status_id = $request->status_id;
      $user_subscription->save();
      return response("El usuario ha sido asociado correctamente a la suscripción", 201);
    }


}
