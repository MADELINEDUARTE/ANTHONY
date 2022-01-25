<?php

namespace App\Http\Livewire\Admin;
use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditProgramComponent extends Component
{
    
    use WithFileUploads;

    public $program_id;
    public $newImage;

    public $name;
    public $description;
    public $program_category_id;
    public $video;
    public $number_of_days;
    public $popular;
    public $recommended;
    public $status_id;
    public $image;

        
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'description' => 'required',
            'program_category_id' => 'required',
            'video' => 'required',
            'number_of_days' => 'required',
            'popular' => 'required',
            'recommended' => 'required',
            'status_id' => 'required'
        ]);
        if($this->newImage){

            $this->validateOnly($fields,[
               'newImage' => 'required|mimes:jpg,png'
            ]);

        }
    }

    public function updateProgram(){

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'program_category_id' => 'required',
            'video' => 'required',
            'number_of_days' => 'required',
            'popular' => 'required',
            'recommended' => 'required',
            'status_id' => 'required'
        ]);

        if($this->newImage){

            $this->validate([
               'newImage' => 'required|mimes:jpg,png'
            ]);

        }


        $program = Program::find($this->program_id);
        $program->name = $this->name;
        $program->description = $this->description;
        $program->program_category_id = $this->program_category_id;
        $program->video = $this->video;
        $program->number_of_days = $this->number_of_days;
        $program->popular = $this->popular;
        $program->recommended = $this->recommended;
        $program->status_id = $this->status_id;
        
        if($this->newImage){

            unlink('assets/images/programs'.'/'.$program->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('programs',$imageName);
            $program->image = $imageName;

        }
        
        
        $program->save();
       
        session()->flash('message','El programa se ha actualizado con exito:');


    }

    public function mount($program_id){


        $this->program_id=$program_id;
        $program = Program::where('id',$program_id)->first();
        $this->name = $program->name;
        $this->description = $program->description;
        $this->program_category_id = $program->program_category_id;
        $this->video = $program->video;
        $this->number_of_days = $program->number_of_days;
        $this->image = $program->image;
        $this->popular = $program->popular;
        $this->recommended = $program->recommended;
        $this->status_id = $program->status_id;
        
        $this->newImage = $program->newImage;
        

    }


    public function render()
    {
        
        $statuses = Status::all();
        $program_categories = ProgramCategory::all();

        
        return view('livewire.admin.admin-edit-program-component',
        ['statuses' => $statuses,
        'program_categories' => $program_categories]);
    }
}
