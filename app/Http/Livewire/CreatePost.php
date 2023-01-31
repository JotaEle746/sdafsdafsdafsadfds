<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{   use WithFileUploads;
    public $open=false;
    public $title, $content; //$image;
    protected $rules=[
        'title' => 'required|max:100',
        //'content' => 'requered|min:100'
        'content' => 'required',
        //'image' => 'required|image|max:2048'
    ];

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save(){
        $this->validate();

        //$image=$this->image->path_public('storage/posts');
        
        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);
        $this->reset(['open', 'title', 'content']);
        //$this->emit('render');
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'Se creo el post');
    }

    public function updatingOpen(){
        if($this->open==false){
            $this->reset(['title', 'content']);
            $this->emit('resetCKEditor');
        }
    }
}