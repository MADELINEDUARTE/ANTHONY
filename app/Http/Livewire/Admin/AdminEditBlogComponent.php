<?php

namespace App\Http\Livewire\Admin;
use App\Models\Blog;
use App\Models\Status;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AdminEditBlogComponent extends Component
{
    
    use WithFileUploads;

    public $blog_id;
    public $newImage;
    public $newVideo;

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
            'status_id' => 'required'
        ]);
        if($this->newImage){

            $this->validateOnly($fields,[
               'newImage' => 'required|mimes:jpg,png'
            ]);

        }

        if($this->newVideo){

            $this->validateOnly($fields,[
               'newVideo' => 'required'
            ]);

        }
        
    }

    public function updateBlog(){

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'video' => 'required',
            'status_id' => 'required'
        ]);

        if($this->newImage){

            $this->validate([
               'newImage' => 'required|mimes:jpg,png'
            ]);

        }


        if($this->newVideo){

            $this->validate([
               'newVideo' => 'required'
            ]);

        }

        $blog = Blog::find($this->blog_id);
        $blog->title = $this->title;
        $blog->description = $this->description;
        //$blog->video = $this->video;
        $blog->status_id = $this->status_id;
        
        if($this->newImage){

            unlink('assets/images/blogs'.'/'.$blog->image);
            $imageName = Carbon::now()->timestamp.'.'.$this->newImage->extension();
            $this->newImage->storeAs('images/blogs',$imageName);
            $blog->image = $imageName;

        }

        if($this->newVideo){

            unlink('assets/videos/blogs'.'/'.$blog->video);
            $videoName = Carbon::now()->timestamp.'.'.$this->newVideo->extension();
            $this->newVideo->storeAs('videos/blogs',$videoName);
            $blog->video = $videoName;

        }
        
        
        $blog->save();
       
        session()->flash('message','El blog se ha actualizado con exito:');


    }

    public function mount($blog_id){


        $this->blog_id=$blog_id;
        $blog = Blog::where('id',$blog_id)->first();
        $this->title = $blog->title;
        $this->description = $blog->description;
        $this->video = $blog->video;
        $this->image = $blog->image;
        $this->status_id = $blog->status_id;
        $this->newImage = $blog->newImage;
        $this->newVideo = $blog->newVideo;
        

    }


    public function render()
    {
        
        $statuses = Status::all();
        
        return view('livewire.admin.admin-edit-blog-component',
        ['statuses' => $statuses]);
    }
}
