<?php

namespace App\Http\Livewire;

use App\Models\Capitulo;
use GuzzleHttp\Promise\Create;
use Livewire\Component;

class CreateCatitulos extends Component
{
    public $create = false;
    public $nombre, $decano;
    public $message='';
    protected $rules=[
        'nombre' => 'required',
        'decano' => 'required'
    ];
    public function render()
    {
        return view('livewire.create-catitulos');
    }

    public function save()
    {
        $this->validate();
        Capitulo::create([
            'nombre' => $this->nombre,
            'decano' => $this->decano,
        ]);
        $this->reset(['create', 'nombre', 'decano']);
        $this->emit('alert', 'Se creo correctamente');
        $this->emitTo('admin.capitulos-show','render');
        $this->message = 'Actualizado en timestamp: '. time();
    }
}
