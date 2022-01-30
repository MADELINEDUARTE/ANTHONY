<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProgramDayRoutine;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProgramDayRoutineComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteProgramDayRoutine($id){

        $programdayroutine = ProgramDayRoutine::find($id);
        $programdayroutine->delete();
        session()->flash('message','El program day routine se ha eliminado con exito');

    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $programdayroutines = ProgramDayRoutine::where('title','LIKE',$search)->paginate(2);
        
        return view('livewire.admin.admin-program-day-routine-component',['programdayroutines' => $programdayroutines]);
    }
}
