<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProgramDay;
use App\Models\ProgramDayRoutine;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProgramDayRoutineComponent extends Component
{
    
    use WithFileUploads;

    public $title;
    public $video;
    public $sets;
    public $repetitions;
    public $program_day_id;
    public $status_id;
    public $user_id;

        


    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
            'video' => 'required',
            'sets' => 'required',
            'repetitions' => 'required',
            'program_day_id' => 'required',
            'status_id' => 'required'
        ]);
    }

    public function addProgramDayRoutine(){

        $this->validate([
            'title' => 'required',
            'video' => 'required',
            'sets' => 'required',
            'repetitions' => 'required',
            'program_day_id' => 'required',
            'status_id' => 'required'
        ]);


        $programdayroutine = new ProgramDayRoutine();
        $programdayroutine->title = $this->title;
        
        $videoName = Carbon::now()->timestamp.'.'.$this->video->extension();
        $this->video->storeAs('videos/programdayroutines',$videoName);
        $programdayroutine->video = $videoName;

        $programdayroutine->sets = $this->sets;
        $programdayroutine->repetitions = $this->repetitions;
        $programdayroutine->program_day_id = $this->program_day_id;
        $programdayroutine->status_id = $this->status_id;
        $programdayroutine->user_id = Auth::user()->id;
        $programdayroutine->save();
       
        session()->flash('message','El program day routine se ha creado con exito:');


    }

    public function mount(){

        $this->title="Brandy";
        $this->sets="10";
        $this->repetitions="1000";

    }


    public function render()
    {
        $programDayRoutine = new ProgramDayRoutine();
        $statuses = Status::all();
        $program_days = ProgramDay::all();

        
        return view('livewire.admin.admin-add-program-day-routine-component',
        ['programDayRoutine' => $programDayRoutine,
        'statuses' => $statuses,
        'programdays' => $program_days]);
    }
}
