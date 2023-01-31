<?php

namespace App\Http\Livewire\Users;

use App\Models\Colegiado;
use App\Models\Curso;
use App\Models\Persona;
use Livewire\Component;
use Livewire\WithPagination;

class InscripcionCurso extends Component
{   use WithPagination;
    public $nombre, $individuo="colegiado";
    public $colegiado;
    public $persona;
    public $open_edit=false;
    public $telefono;
    public $readyToLoad=false;
    protected $listeners=['render', 'delete'];
    protected $rules=[
        'colegiado.dni' => 'required|min:8|max:8|unique:personas,dni',
        'colegiado.dni' => 'required|min:8|max:8|unique:colegiados,dni',
        'colegiado.nombres' => 'required',
        'colegiado.materno' => 'required',
        'colegiado.paterno' => 'required',
        'colegiado.capitulo_id' => 'required',
        'colegiado.codigo' => 'required',
        'colegiado.email' => 'required',
        'colegiado.direccion' => 'required'
    ];

    public function mount(){
        $this->colegiado=new Colegiado();
        $this->persona=new Persona();
    }
    public function render()
    {   
        if($this->readyToLoad){
            if ($this->individuo=="colegiado") {
                $colegiados=Colegiado::where('nombres', 'like', '%'. $this->nombre .'%')
                ->orwhere('paterno', 'like', '%'. $this->nombre .'%')
                ->orwhere('materno','like', '%'. $this->nombre .'%')
                ->paginate(15);
            }
            else{
                $colegiados=Persona::where('nombres', 'like', '%'. $this->nombre .'%')
                ->orwhere('paterno', 'like', '%'. $this->nombre .'%')
                ->orwhere('materno','like', '%'. $this->nombre .'%')
                ->paginate(15);
            }
        }
        else{
            $colegiados=[];
        }
        return view('livewire.users.inscripcion-curso', compact('colegiados'));
    }

    public function loadColegiados(){
        $this->readyToLoad=true;
    }

    public function edit($colegiados){
        if ($this->individuo=="colegiado") {
            $this->colegiado=$colegiados;
        }
        else{
            $this->persona=$colegiados;
        }
        $this->open_edit=true;
    }

    public function update(){
        if ($this->individuo=="colegiado") {
            $this->colegiado->save();
        }
        else{
            $colegiado = $this->validate([
                'persona.dni' => 'required|min:8|max:8|unique:personas,dni',
                'persona.dni' => 'required|min:8|max:8|unique:colegiados,dni',
                'persona.nombres' => 'required',
                'persona.materno' => 'required',
                'persona.paterno' => 'required',
                'persona.email' => 'required',
                'persona.direccion' => 'required'
            ]);
            $this->persona->save();
        }
        $this->reset(['open_edit']);
        $this->emit('alert', 'El curso se actualizo satisfactoriamente');
    }
}
