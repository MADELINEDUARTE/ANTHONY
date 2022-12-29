<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BeforeAfter;
use App\Models\SubscriptionProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class BeforeAfterController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $subscription_program = SubscriptionProgram::where("user_id",Auth::user()->id)->where('status_id',1)->where('is_active',1)->get();

        $subscription_program = $subscription_program->map(function($value){
            $value->program->makeHidden(['id','description','program_category_id','video','number_of_days','popular','recommended','status_id','user_id','created_at','updated_at','deleted_at']);
            
            $program          = $value->program;
            $program['image'] = asset('storage').'/'.$program['image'];


            $program['fotos'] = [ 'before' => [] , 'after' => [] ];

            if($value->fotos->count()){

                $fotos            = $value->fotos->groupBy('type');

                if(isset($fotos['before'])){

                    $fotos['before'] = $fotos['before']->pluck('url_foto');
                }

                if(isset($fotos['after'])){

                    $fotos['after']  = $fotos['after']->pluck('url_foto');
                }

                $program['fotos'] = $fotos->map(function($grupo){
                    return $grupo->map(function($foto){
                       return asset('storage').'/'.$foto;
                    });
                });
            }

            $program['subscription_programs_id'] = $value->id;
            $program['status'] = 'aka';
            return $program;
        });

        return response()->json(['data'=> [ 'incomplete' => $subscription_program , 'complete' => [] ] ]);

    }

    public function addFoto(Request $request)
    {
        $rules=[
          'foto'                     => 'required|mimes:jpg,png',
          'type'                     => 'required',
          'pose'                     => 'required',
          'subscription_programs_id' => 'required'
        ];

        $validator= Validator::make($request->all(),$rules);

        if ($validator->fails()) {
          return response()->json($validator->errors());
        }

        $beforeAfter = BeforeAfter::where('type', $request->type)
                        ->where('pose', $request->pose)
                        ->where('subscription_programs_id', $request->subscription_programs_id)
                        ->where('user_id',Auth::user()->id)
                        ->first();

        
        if($beforeAfter){
            if( Storage::disk('public')->exists($beforeAfter->url_foto)){
                Storage::disk('public')->delete($beforeAfter->url_foto);
            }
        }else{
            $beforeAfter = new BeforeAfter();
        }

        $foto = Storage::disk('public')->put($request->type, $request->file('foto'));

        $beforeAfter->user_id                  = Auth::user()->id;
        $beforeAfter->subscription_programs_id = $request->subscription_programs_id;
        $beforeAfter->url_foto                 = $foto;
        $beforeAfter->type                     = $request->type;
        $beforeAfter->pose                     = $request->pose;
        $beforeAfter->save();

        return $beforeAfter;
    }
}
