<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Subscription;
use App\Models\SubscriptionProgram;
use Illuminate\Http\Request;
use App\Models\ProgramDayRoutine;
use App\Models\SubscriptionProgramLogDetail;
use App\Models\SubscriptionProgramLog;


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
            $subscription_program=SubscriptionProgram::where("user_id",Auth::user()->id)->where('status_id',1)->where('is_active',1)->get();
            $arr = [];
            foreach ($subscription_program as $key => $value) {
                $arr[] = $value->program;
            }
            $subscription_program = $arr;
            return response()->json(['data'=> $subscription_program]);
        }

        $program_recommended=Program::where("recommended",1)->limit(6)->get();

        $program_popular=Program::where("popular",1)->limit(6)->get();

        if(Auth::user() ){
            $subscription_program=SubscriptionProgram::where("user_id",Auth::user()->id)->where('status_id',1)->where('is_active',1)->get();
            $arr = [];
            foreach ($subscription_program as $key => $value) {
                $arr[] = $value->program;
            }
            $subscription_program = $arr;
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
        $status_program = null;

        if($user->subscription){
          $status_package = [ // saber si pago si no tiene sub llega null 
            "id"      => $user->subscription->package->id,
            "name"    => $user->subscription->package->name,
            "status"  => $user->subscription->stripe_status =='active' ? true:false,
            "message" => "", //alert
            "subscription_id" => $user->subscription->id
          ];
        
  
        

            $subscriptionProgram = SubscriptionProgram::where('program_id',$program->id)
                                    ->where('subscription_id',$user->subscription->id)
                                    ->where('user_id',$user->id)
                                    ->latest()
                                    ->first();

            

            if($subscriptionProgram && $subscriptionProgram->status_id == 1){
              $status_program = [ //si el programa en el que entro esta registrado o no o nulo
                "id"     => $subscriptionProgram->id,
                "status" => $subscriptionProgram->is_active  ? true: false,
                "active" => $subscriptionProgram->is_active,
              ];
            }
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
            $dia['status'] = false;
            $dia['muscular_group'] = '';
          foreach ($dia['exercise'] as $d => $ejercicio) {
            
            $ejercicio['completed'] = false;
            $ejercicio['log'] = [];

            if($subscriptionProgram){
                $log = SubscriptionProgramLog::where('program_days_id', $dia['id'])
                            ->where('program_day_routines_id', $ejercicio['id'])
                            ->where('subscription_programs_id', $subscriptionProgram->id)
                            ->first(); 
                if($log){


                    $logs = SubscriptionProgramLogDetail::where('subscription_program_logs_id', $log->id)->get();        

                    if(count($logs) == $ejercicio->sets){ // completo el ejercicio
                        $ejercicio['completed'] = true;
                    }elseif(count($logs) < $ejercicio['sets']){ //sNo lo ha completado
                        $ejercicio['completed'] = false;
                    }

                    $arr = [];
                    foreach ($logs as $y => $value) {
                        $arr[] = [
                          "set"=> $value->set,
                          "repetitions"=> $value->repeticiones,
                          "weight"=> $value->peso
                        ];
                    }

                    $ejercicio['log'] = $arr;
                }
            }
            
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
