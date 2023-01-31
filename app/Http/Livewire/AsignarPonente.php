<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AsignarPonente extends Component
{
    public $rol;
    public $colegiado;
    public $Ponentes;
    public function mount($colegiado){
        $this->colegiado=$colegiado;
    }

    public function render()
    {
        return view('livewire.asignar-ponente');
    }

    public function AsignarP(){
        $this->rol=1;
    }
}
