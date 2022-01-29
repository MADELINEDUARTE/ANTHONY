<?php

namespace App\Http\Livewire\Admin;

use App\Models\Program;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProgramComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteProgram($id){

        $program = Program::find($id);
        $program->delete();
        session()->flash('message','El programa se ha eliminado con exito');

    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $programs = Program::where('name','LIKE',$search)->paginate(5);
        //$programs = Program::paginate(15);
        
        return view('livewire.admin.admin-program-component',['programs' => $programs]);
    }
}
