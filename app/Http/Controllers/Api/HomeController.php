<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class HomeController extends Controller
{
    public function index(Request $request){
        //dd($request->all());
        $programs = Program::paginate(1);
        
        return response()->json(['status'=> true, 'programs'=> $programs]);
    }

}
