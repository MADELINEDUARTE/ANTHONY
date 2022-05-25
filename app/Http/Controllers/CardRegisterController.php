<?php

namespace App\Http\Controllers;

use App\Models\UserCard;
use Illuminate\Http\Request;

class CardRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register_card(Request $request){

        $request->validate([
            'number' => 'required|unique:user_cards',
            'name' => 'required',
            'cvv' => 'required',
            'expiration_date' => 'required',
            'user_id' => 'required'
        ]);

        $UserCard = new UserCard();
        $UserCard->number = $request->number;
        $UserCard->name = $request->name;
        $UserCard->cvv = $request->cvv;
        $UserCard->expiration_date = $request->expiration_date;
        $UserCard->user_id = $request->user_id;
        $UserCard->save();
       
        return response("La tarjeta para  usuario ha sido creado correctamente", 201);

    }

     public function index()
    {
        //
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
