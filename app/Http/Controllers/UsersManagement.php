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
class UsersManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(Request $request)
    {

        /*
        $user=User::with("gender")
        ->with("country")
        ->where('email',$request->email)
        ->first();

        $pasword = $request->password;
        $cost=10;
        $password = password_hash($pasword, PASSWORD_BCRYPT, ['cost' => $cost]);
        
        $hash = $user->password;
        
        if (password_verify($pasword, $hash)) {
            return response($user);
        } else {
            return response("Not authorized (not logged in)", 401);
        }
        */

        // $request->authenticate();

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
                'status'=> false,
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
            ]);

        }
        
        
    }


    public function register(Request $request)
    {
        
        $request->validate([
            'email' => 'required|string|email'
        ]);

        $validate_user=User::where('email',$request->email)->get();

        if(count($validate_user)>0){
            
             return response()->json(["message"=>"User already exists"],422);

        }else{

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                // 'password' => 'required',
                // 'middle_name' => 'required',
                'last_name' => 'required',
                // 'gender_id' => 'required',
                // 'date_of_birth' => 'required',
                'country_id' => 'required',
                // 'address' => 'required',
                'telephone' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                // 'password' => Hash::make($request->password),
                // 'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                // 'gender_id' => $request->gender_id,
                // 'date_of_birth' => $request->date_of_birth,
                'country_id' => $request->country_id,
                // 'address' => $request->address,
                'telephone' => $request->telephone,
            ]);
    
            
    
            $token = $user->createToken('authtoken');

            $user->token = $token->plainTextToken;
            $numero_aleatorio = rand(100000,900000);
            $user->code = $numero_aleatorio;
            $user->save();

            Mail::to($user->email)->send(new SendCode($numero_aleatorio,$user));

            // event(new Registered($user));
            
            if($token){

                return response()->json(
                    [
                        'message'=>'User Registered',
                        'data'=> ['token' => $token->plainTextToken, 'user' => $user]
                    ]
                );
    
            }else{
    
                return response()->json(["message"=>"User Not Registered"],422);
    
            }

        }

        

        

        
        
        /*
        $request->validate([
            'name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'country_id' => 'required',
            'address' => 'required',
            'telephone' => 'required'
        ]);*/

        /*
        $user = new User();
        $user->name = $request->name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->gender_id = $request->gender_id;
        $user->date_of_birth = $request->date_of_birth;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->country_id = $request->country_id;
        $user->address = $request->address;
        $user->telephone = $request->telephone;
        $user->save();
        */

        //$user = User::create($request->all());

        
        //return response("El usuario ha sido creado correctamente", 201);
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
        
        
        

        $User->save();

        //$token = $User->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Updated',
                'data'=> ['user' => $User]
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

    

    /*public function register_user_program(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required',
            'program_id' => 'required',
            'status_id' => 'required',
            'user_id' => 'required',
            'is_active' => 'required'
        ]);

        $user_program = new SubscriptionProgram();
        $user_program->subscription_id = $request->subscription_id;
        $user_program->program_id = $request->program_id;
        $user_program->status_id = $request->status_id;
        $user_program->user_id = $request->user_id;
        $user_program->is_active = $request->is_active;
        $user_program->save();

        //$user = User::create($request->all());

        
        return response("El usuario ha sido asociado correctamente añ programa", 201);
    }*/

    
    

    public function index(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
