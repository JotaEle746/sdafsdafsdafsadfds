<?php

namespace App\Http\Livewire;

use App\Models\Capitulo;
use Livewire\Component;

class FiltrarCapitulo extends Component
{   
    public function render()
    {   $capitulos=Capitulo::all();   
        return view('livewire.filtrar-capitulo', compact('capitulos'));
    }
}
