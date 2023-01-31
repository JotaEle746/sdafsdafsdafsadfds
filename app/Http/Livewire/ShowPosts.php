<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
class ShowPosts extends Component
{   use WithPagination;
    
    public $search, $post;
    public $sort='id';
    public $direction='desc';
    public $open_edit=false;
    public $readyToLoad=false;
    //protected $listeners=['render' => 'render'];
    protected $listeners=['render', 'delete'];

    protected $rules=[
        'post.title'=>'required',
        'post.content'=>'required'
    ];

    public function render()
    {   if($this->readyToLoad){
            $posts=Post::where('title', 'like', '%'. $this->search.'%')
                ->orwhere('content', 'like', '%'. $this->search.'%')
                ->orderBy($this->sort, $this->direction)
                ->paginate(10);
        }
        else{
            $posts=[];
        }
        return view('livewire.show-posts', compact('posts'));
    }

    public function loadPosts(){
        $this->readyToLoad=true;
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){
        $this->post=new Post();
    }

    public function order($sort)
    {   if ($this->sort==$sort) {
            if ($this->direction=='desc') {
                $this->direction='asc';
            } else {
                $this->direction='desc';
            }
            
        } else {
            $this->sort=$sort;
            $this->direction='desc';
        }
    }

    public function edit(Post $post){
        $this->post=$post;
        $this->open_edit=true;
    }

    public function update(){
        $this->validate();
        $this->post->save();
        $this->reset(['open_edit']);
        $this->emit('alert', 'El post se actualizo satisfactoriamente');
    }

    public function delete(Post $post){
        $post->delete();
    }
}
