<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeDisplayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        if(isset($request->todos) && $request->todos == 'all'){
            return response()->json(['data'=> Program::Search($request->search)->get()]);
        }

        if(isset($request->popular) && $request->popular == 'all'){
            return response()->json(['data'=> Program::where("popular",1)->Search($request->search)->get()]);
        }

        if(isset($request->recommended) && $request->recommended == 'all'){
            return response()->json(['data'=> Program::where("recommended",1)->Search($request->search)->get()]);
        }

        if(isset($request->my_programs) && $request->my_programs == 'all'){
            return response()->json(['data'=> SubscriptionProgram::where("user_id",Auth::user()->id)->get()]);
        }

        $program_recommended=Program::where("recommended",1)->limit(6)->get();

        $program_popular=Program::where("popular",1)->limit(6)->get();

        if(Auth::user() ){
            $subscription_program=SubscriptionProgram::where("user_id",Auth::user()->id)->get();
        }else{
            $subscription_program=[];
        }

        return response()->json([
            'data'=> [
                'recommended'   => $program_recommended,
                'popular'       => $program_popular,
                'my_programs'   => $subscription_program
            ]
        ]);

        //return response($program_recommended);
    }

    public function program_detail(Request $request)
    {

        $program = Program::with([
          "programCategory",
          "status",
          "program_category",
          "program_status",
          "user",
          "details"=>function($query){
            $query->with(['exercise']);
          },
          "details_program_day_routine",
          "exercises",
          "subscription_programs",
          "subscription_program_day_routines"
        ])
        ->where("id",$request->program_id)
        ->first();

        $user = Auth::user();

        $status_package = null;

        if($user->subscription){
          $status_package = [ // saber si pago si no tiene sub llega null 
            "id"      => $user->subscription->package->id,
            "name"    => $user->subscription->package->name,
            "status"  => $user->subscription->status_id ? true:false,
            "message" => "", //alert
          ];
        }

        $subscriptionProgram = SubscriptionProgram::where('program_id',$program->id)
                                ->where('subscription_id',$user->subscription->id)
                                ->where('user_id',$user->id)
                                ->latest()
                                ->first();

        $status_program = null;

        if($subscriptionProgram && $subscriptionProgram->status_id == 1){
          $status_program = [ //si el programa en el que entro esta registrado o no o nulo
            "id"     => $subscriptionProgram->id,
            "status" => $subscriptionProgram->is_active ? true: false,
            "active" => $subscriptionProgram->is_active,
          ];
        }

        $program_detail =  [
          "id"                  => $program->id,
          "name"                => $program->name,
          "description"         => $program->description,
          "program_category_id" => $program->program_category_id ,
          "video"               => $program->video,
          "number_of_days"      => $program->number_of_days,
          "image"               => $program->image,
          "status_package"      => $status_package,
          "status_program"      => $status_program,
          "details"             => $program->details
        ];

        foreach ($program_detail['details'] as $key => $dia) {
          foreach ($dia['exercise'] as $d => $ejercicio) {

            $ejercicio['complete'] = false;
            $ejercicio['log'] = [];
          }
        }

        return response()->json(['date'=> $program_detail]);
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
