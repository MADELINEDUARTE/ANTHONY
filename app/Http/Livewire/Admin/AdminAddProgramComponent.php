<?php

namespace App\Http\Livewire\Admin;
use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddProgramComponent extends Component
{
    
    use WithFileUploads;

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
            'status_id' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);
    }

    public function addProgram(){

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'program_category_id' => 'required',
            'video' => 'required',
            'number_of_days' => 'required',
            'popular' => 'required',
            'recommended' => 'required',
            'status_id' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);

        //https://laravel-livewire.com/docs/2.x/file-uploads#preview-urls
        //https://forum.laravel-livewire.com/t/temporary-preview-urls-for-file-uploads-on-s3/1941

        $program = new Program();
        $program->name = $this->name;
        $program->description = $this->description;
        $program->program_category_id = $this->program_category_id;
        //$program->video = $this->video;
        $program->number_of_days = $this->number_of_days;
        $program->popular = $this->popular;
        $program->recommended = $this->recommended;
        $program->status_id = $this->status_id;
        
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('images/programs',$imageName);
        $program->image = $imageName;
        

        $videoName = Carbon::now()->timestamp.'.'.$this->video->extension();
        $this->video->storeAs('videos/programs',$videoName);
        $program->video = $videoName;
        $program->save();
       
        session()->flash('message','El programa se ha creado con exito:');


    }

    public function mount(){

        $this->popular = '0';
        $this->recommended = '0';
        $this->status_id = '1';
        $this->program_category_id = '1';
        $this->name = 'Uno';
        $this->description = 'One';
        //$this->video = 'Dos';
        $this->number_of_days = '333';

    }


    public function render()
    {
        $program = new Program();
        $statuses = Status::all();
        $program_categories = ProgramCategory::all();

        
        return view('livewire.admin.admin-add-program-component',
        ['program' => $program,
        'statuses' => $statuses,
        'program_categories' => $program_categories]);
    }
}
