<?php

namespace App\Http\Livewire\Admin;
use App\Models\ProgramDayRoutine;
use App\Models\ProgramDay;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditProgramDayRoutineComponent extends Component
{
    
    use WithFileUploads;

    public $programdayroutine_id;
    public $newVideo;

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
        
        if($this->newVideo){

            $this->validateOnly($fields,[
               'newVideo' => 'required'
            ]);

        }
    }

    public function updateProgramDayRoutine(){

        $this->validate([
            'title' => 'required',
            'video' => 'required',
            'sets' => 'required',
            'repetitions' => 'required',
            'program_day_id' => 'required',
            'status_id' => 'required'
        ]);

        
        if($this->newVideo){

            $this->validate([
               'newVideo' => 'required'
            ]);

        }

        
        $programdayroutine = ProgramDayRoutine::find($this->programdayroutine_id);
        $programdayroutine->title = $this->title;
        $programdayroutine->sets = $this->sets;
        $programdayroutine->repetitions = $this->repetitions;
        $programdayroutine->program_day_id = $this->program_day_id;
        $programdayroutine->status_id = $this->status_id;
        $programdayroutine->user_id = Auth::user()->id;
        
        if($this->newVideo){

            unlink('assets/videos/programdayroutines'.'/'.$programdayroutine->video);
            $videoName = Carbon::now()->timestamp.'.'.$this->newVideo->extension();
            $this->newVideo->storeAs('videos/programdayroutines',$videoName);
            $programdayroutine->video = $videoName;

        }
        
        
        $programdayroutine->save();

       
        session()->flash('message','El program day routine se ha actualizado con exito:');


    }

    public function mount($programdayroutine_id){


        $this->programdayroutine_id=$programdayroutine_id;
        $programdayroutine = ProgramDayRoutine::where('id',$programdayroutine_id)->first();
        
        $this->title = $programdayroutine->title;
        $this->sets = $programdayroutine->sets;
        $this->repetitions = $programdayroutine->repetitions;
        $this->program_day_id = $programdayroutine->program_day_id;
        $this->status_id = $programdayroutine->status_id;
        $this->video = $programdayroutine->video;
        $this->newVideo = $programdayroutine->newVideo;
        

    }


    public function render()
    {
        
        $statuses = Status::all();
        $programdays = ProgramDay::all();
        $programDayRoutine = new ProgramDayRoutine();

        
        return view('livewire.admin.admin-edit-program-day-routine-component',
        ['statuses' => $statuses,
        'programdays' => $programdays,
        'programDayRoutine' => $programDayRoutine]);
    }
}
