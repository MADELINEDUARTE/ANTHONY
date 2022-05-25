<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use Illuminate\Http\Request;

class HomeDisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $program_recommended=Program::where("recommended",1)->get();

        $program_popular=Program::where("popular",1)->get();

        if($request->user){
            $subscription_program=SubscriptionProgram::where("user_id",$request->user)->get();
        }else{
            $subscription_program=[];
        }

        

        return response()->json([$program_recommended, $program_popular,$subscription_program]);

        //return response($program_recommended);
    }

    public function program_detail(Request $request)
    {
        $program_detail=Program::
        with("programCategory")
        ->with("status")
        ->with("program_category")
        ->with("program_status")
        ->with("user")
        ->with("details")
        ->with("details_program_day_routine")
        ->with("exercises")
        ->with("subscription_programs")
        ->with("subscription_program_day_routines")
        ->where("id",$request->program_id)->get();

        return response($program_detail);
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
