<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class AdminBlogComponent extends Component
{
    use WithPagination;
    public $searchTerm;

    public function deleteBlog($id){

        $blog = Blog::find($id);
        $blog->delete();
        session()->flash('message','El blog se ha eliminado con exito');

    }

    public function render()
    {
        $search = '%'.$this->searchTerm.'%';
        $blogs = Blog::where('title','LIKE',$search)->paginate(2);
        
        return view('livewire.admin.admin-blog-component',['blogs' => $blogs]);
    }
}
