<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capitulo;
use Livewire\Component;

class CapitulosShow extends Component
{
    public $edit=false;
    public $capitulo;
    protected $rules=[
        'capitulo.nombre'=> 'required',
        'capitulo.decano' => 'required'
    ];
    protected $listeners=['render', 'delete'];
    public function mount()
    {
        $this->capitulo=new Capitulo();
    }
    public function render()
    {
        $capitulos = Capitulo::all();
        return view('livewire.admin.capitulos-show', compact('capitulos'));
    }

    public function editcapitulo(Capitulo $capitulo)
    {
        $this->capitulo=$capitulo;
        $this->edit=true;
    }

    public function save()
    {
        $this->validate();
        $this->capitulo->save();
        $this->reset(['capitulo', 'edit']);
        $this->emit('alert', 'El capitulo se actualizo satisfactoriamente');
    }
    
    public function delete(Capitulo $capitulo)
    {
        $capitulo->delete();
    }
}