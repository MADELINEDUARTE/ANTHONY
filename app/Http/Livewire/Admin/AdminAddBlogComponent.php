<?php

namespace App\Http\Livewire\Admin;
use App\Models\Blog;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminAddBlogComponent extends Component
{
    
    use WithFileUploads;

    public $title;
    public $description;
    public $video;
    public $status_id;
    public $image;

        
    public function updated($fields){
        $this->validateOnly($fields,[
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
            'status_id' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);
    }

    public function addBlog(){

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
            'status_id' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);

        //https://laravel-livewire.com/docs/2.x/file-uploads#preview-urls
        //https://forum.laravel-livewire.com/t/temporary-preview-urls-for-file-uploads-on-s3/1941

        $blog = new Blog();
        $blog->title = $this->title;
        $blog->description = $this->description;
        $blog->video = $this->video;
        $blog->status_id = $this->status_id;
        $blog->user_id = Auth::user()->id;
        
        $imageName = Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('blogs',$imageName);
        $blog->image = $imageName;
        $blog->save();
       
        session()->flash('message','El blog se ha creado con exito:');


    }

    public function mount(){

        $this->status_id = '1';
        $this->title = 'Mariah';
        $this->description = 'Carey';
        $this->video = 'Forever';

    }


    public function render()
    {
        $blog = new Blog();
        $statuses = Status::all();

        
        return view('livewire.admin.admin-add-blog-component',
        ['blog' => $blog,
        'statuses' => $statuses]);
    }
}
