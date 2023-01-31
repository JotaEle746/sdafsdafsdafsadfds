<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Persona;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class CreateNew extends Component
{
    public $open=false;
    public $cole;
    public $individuo="colegiado";
    public $dnii, $nombres, $paterno, $materno, $email, $direccion, $telefono, $codigo, $capitulo;
    protected $rules=[
        'nombres' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'direccion' => 'required',
        'telefono' => 'required|min:9|max:9'
    ];
    public function render()
    {   $capitulos=Capitulo::all();
        return view('livewire.admin.create-new',compact('capitulos'));
    }
    public $emailtwo="vacio";
    public function save(){
        $this->nombres=ucwords($this->nombres);
        $this->paterno=ucwords($this->paterno);
        $this->materno=ucwords($this->materno);
        $this->validate();
        if ($this->individuo=="colegiado"){
            $correo=Colegiado::Where('dni', $this->dnii)
                /* ->orWhere('codigo', $this->codigo) */
                ->first();
            $validatedData = $this->validate([
                'dnii' => 'required|min:8|max:8|unique:colegiados,dni',
                'email' => 'required|email|string|unique:colegiados,email|unique:personas,email',
                'dnii' => 'required|min:8|max:8|unique:personas,dni',
                'codigo' => 'required|unique:colegiados,codigo',
            ]);
            if (empty($correo)) {
                Colegiado::create([
                    'dni' => $this->dnii,
                    'nombres' => $this->nombres,
                    'paterno' => $this->paterno,
                    'materno' => $this->materno,
                    'direccion' => $this->direccion,
                    'email' => $this->email,
                    'codigo' => $this->codigo,
                    'capitulo_id' => $this->capitulo,
                    'telefono' => $this->telefono
                ]);
                $this->reset(['open','dnii', 'nombres', 'paterno', 'materno', 'email', 'direccion', 'telefono', 'codigo', 'capitulo', 'telefono']);
                $this->emitTo('admin.inscripcion-curso','render');
                $this->emit('alert','Se a inscrito satisfactoriamente al curso');
            } else {
                session()->flash('message', 'El correo que utiliza ya esta en uso');
            }
        }
        else{
            $correo=Persona::where('dni', $this->dnii)
                ->orWhere('email', $this->email)
                ->first();
            $validatedData = $this->validate([
                'dnii' => 'required|min:8|max:8|unique:personas,dni',
                'email' => 'required|email|string|unique:personas,email',
                'dnii' => 'required|min:8|max:8|unique:colegiados,dni',
            ]);
            if (empty($correo)) { 
                Persona::create([
                    'dni'=> $this->dnii,
                    'nombres' => $this->nombres,
                    'paterno' => $this->paterno,
                    'materno'=> $this->materno,
                    'email' => $this->email,
                    'direccion' => $this->direccion,
                    'telefono' => $this->telefono
                ]);
                $this->reset(['open','dnii', 'nombres', 'paterno', 'materno', 'email', 'direccion', 'telefono', 'codigo', 'capitulo', 'telefono']);
                $this->emitTo('admin.inscripcion-curso','render');
                $this->emit('alert','Se a inscrito satisfactoriamente al curso');
            } else {
                session()->flash('message', 'El correo que utiliza ya esta en uso');
            }
            
        }
    }
}