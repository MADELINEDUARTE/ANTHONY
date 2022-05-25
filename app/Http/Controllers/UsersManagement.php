<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionProgram;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;

class UsersManagement extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function login(LoginRequest $request)
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

        $request->authenticate();


        $token = $request->user()->createToken('authtoken');

       return response()->json(
           [
               'message'=>'Logged in baby',
               'data'=> [
                   'user'=> $request->user(),
                   'token'=> $token->plainTextToken
               ]
           ]
        );

       

        
    }


    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'required',
            'date_of_birth' => 'required',
            'country_id' => 'required',
            'address' => 'required',
            'telephone' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender_id' => $request->gender_id,
            'date_of_birth' => $request->date_of_birth,
            'country_id' => $request->country_id,
            'address' => $request->address,
            'telephone' => $request->telephone,
        ]);

        event(new Registered($user));

        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Registered',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );
        
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

        
        return response("El usuario ha sido creado correctamente", 201);
    }


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();

        /*return response()->json(
            [
                'message' => 'Logged out'
            ]
        );*/

        return response("El usuario ha finalizado sesion", 201);

    }

    public function register_user_program(Request $request)
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
    }
    

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
