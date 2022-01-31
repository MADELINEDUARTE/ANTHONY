<?php

namespace App\Http\Livewire\Admin;
use App\Models\ExerciseVideo;
use App\Models\Exercise;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditExerciseVideoComponent extends Component
{
    
    use WithFileUploads;

    public $exercisevideo_id;
    public $newVideo;

    public $video;
    public $exercise_id;
    public $user_id;

        
    public function updated($fields){
        $this->validateOnly($fields,[
            'video' => 'required',
            'exercise_id' => 'required'
        ]);
        
        if($this->newVideo){

            $this->validateOnly($fields,[
               'newVideo' => 'required'
            ]);

        }
        
    }

    public function updateExerciseVideo(){

        $this->validate([
            'video' => 'required',
            'exercise_id' => 'required'
        ]);

       
        if($this->newVideo){

            $this->validate([
               'newVideo' => 'required'
            ]);

        }

        $exercisevideo = ExerciseVideo::find($this->exercisevideo_id);
        $exercisevideo->video = $this->video;
        $exercisevideo->exercise_id = $this->exercise_id;
        

        if($this->newVideo){

            unlink('assets/videos/exercisevideos'.'/'.$exercisevideo->video);
            $videoName = Carbon::now()->timestamp.'.'.$this->newVideo->extension();
            $this->newVideo->storeAs('videos/exercisevideos',$videoName);
            $exercisevideo->video = $videoName;

        }
        
        
        $exercisevideo->save();
       
        session()->flash('message','El exercise video se ha actualizado con exito:');


    }

    public function mount($exercisevideo_id){


        $this->exercisevideo_id=$exercisevideo_id;
        $exercisevideo = ExerciseVideo::where('id',$exercisevideo_id)->first();
        $this->video = $exercisevideo->video;
        $this->exercise_id = $exercisevideo->exercise_id;
        $this->newVideo = $exercisevideo->newVideo;
        
    }


    public function render()
    {
        
        $ExerciseVideo = new ExerciseVideo();
        $exercises = Exercise::all();
        
        return view('livewire.admin.admin-edit-exercise-video-component',
        ['exercises' => $exercises,
        'ExerciseVideo' => $ExerciseVideo]);
    }
}
