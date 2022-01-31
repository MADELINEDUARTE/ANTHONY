<?php

namespace App\Http\Livewire\Admin;
use App\Models\ExerciseVideo;
use App\Models\Exercise;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddExerciseVideoComponent extends Component
{
    
    use WithFileUploads;

    public $video;
    public $exercise_id;
    public $user_id;

        
    public function updated($fields){
        $this->validateOnly($fields,[
            'video' => 'required',
            'exercise_id' => 'required'
        ]);
    }

    public function addExerciseVideo(){

        $this->validate([
            'video' => 'required',
            'exercise_id' => 'required'
        ]);


        $exercisevideo = new ExerciseVideo();
        $exercisevideo->exercise_id = $this->exercise_id;
        $exercisevideo->user_id = Auth::user()->id;
        
        $videoName = Carbon::now()->timestamp.'.'.$this->video->extension();
        $this->video->storeAs('videos/exercisevideos',$videoName);
        $exercisevideo->video = $videoName;

        $exercisevideo->save();
       
        session()->flash('message','El exercise video se ha creado con exito:');


    }

    public function mount(){


    }


    public function render()
    {
        $ExerciseVideo = new ExerciseVideo();
        $exercises = Exercise::all();

        return view('livewire.admin.admin-add-exercise-video-component',
        ['exercises' => $exercises,
        'ExerciseVideo' => $ExerciseVideo]);
    }
}
