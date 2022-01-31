<?php

namespace App\Http\Livewire\Admin;

use App\Models\ExerciseVideo;
use Livewire\Component;
use Livewire\WithPagination;

class AdminExerciseVideoComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteExerciseVideo($id){

        $ExerciseVideo = ExerciseVideo::find($id);
        $ExerciseVideo->delete();
        session()->flash('message','El Exercise Video se ha eliminado con exito');

    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $exercisevideos = ExerciseVideo::where('video','LIKE',$search)->paginate(2);
        
        return view('livewire.admin.admin-exercise-video-component',['exercisevideos' => $exercisevideos]);
    }
}
