<?php

namespace App\Http\Livewire\Admin;

use App\Models\Colegiado;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Persona;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Livewire\WithPagination;

class InscripcionCurso extends Component
{
    use WithPagination;
    public $nombre='', $individuo="colegiado";
    public $readyToLoad=false;
    public $colegiado;
    public $open_edit=false;
    public $curso;
    public $searchid;
    protected $listeners=['render'=>'render', 'delete'];
    protected function rules(){
        if ($this->individuo=="colegiado") {
            return[
                'colegiado.dni' => 'required|unique:personas,dni',
                'colegiado.nombres' => 'required',
                'colegiado.materno' => 'required',
                'colegiado.paterno' => 'required',
                'colegiado.capitulo_id' => 'required',
                'colegiado.email' => 'required|email',
                'colegiado.codigo' => 'required|min:6|max:6',
                'colegiado.direccion' => 'required',
                'colegiado.telefono' => 'required'
            ];
        } else {
            return[
                'colegiado.dni' => 'required|unique:colegiados,dni',
                'colegiado.nombres' => 'required',
                'colegiado.materno' => 'required',
                'colegiado.paterno' => 'required',
                /* 'colegiado.capitulo_id' => 'required|not_in:personas,capitulo_id',
                'colegiado.codigo' => 'required|min:6|max:6|not_in:personas', */
                'colegiado.email' => 'required|email',
                'colegiado.direccion' => 'required',
                'colegiado.telefono' => 'required'
            ];
        }
        
    }
    public function mount(Curso $curso){
        $this->curso=$curso->id;
    }
    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        if($this->readyToLoad){
            if ($this->individuo=="colegiado") {
                if (is_null($this->searchid)) {
                    $colegiados=Colegiado::where('nombres', 'like', '%'.$this->nombre.'%')
                        ->orwhere('paterno', 'like', '%'. $this->nombre.'%')
                        ->orwhere('materno','like', '%'.$this->nombre.'%')
                        ->paginate(20);
                } else {
                    $colegiados=Colegiado::where('dni', 'like', '%'.$this->searchid.'%')
                        ->paginate(20);
                }
            }
            else{
                if (is_null($this->searchid)) {
                    $colegiados=Persona::where('nombres', 'like', '%'. $this->nombre .'%')
                        ->orwhere('paterno', 'like', '%'. $this->nombre .'%')
                        ->orwhere('materno','like', '%'. $this->nombre .'%')
                        ->paginate(20);
                } else {
                    $colegiados=Persona::where('dni','like', '%'.$this->searchid.'%')
                    ->paginate(20);
                }
                
            }
        }
        else{
            $colegiados=[];
        }
        return view('livewire.admin.inscripcion-curso', compact('colegiados'));
    }

    public function loadColegiados(){
        $this->readyToLoad=true;
    }

    public function edit(Colegiado $colegiado){
        $this->colegiado=$colegiado;
        $this->open_edit=true;
    }

    public function editP(Persona $colegiado){
        $this->colegiado=$colegiado;
        $this->open_edit=true;
    }

    public function update(){
        $this->validate();
        $this->colegiado->save();
        $this->reset(['open_edit']);
        $this->emit('alert', 'El curso se actualizo satisfactoriamente');
    }

    public function delete($colegiados){
        if ($this->individuo=="colegiado") {
            Colegiado::find($colegiados)->delete();
        } else {
            Persona::find($colegiados)->delete();
        }
        $this->emitTo('admin.inscritos-curso','render');
    }

    public function singin($id){
        $curso=Curso::find($this->curso);
        if ($this->individuo=="colegiado") {
            $individio=Colegiado::find($id);
            $matricula=Matricula::where('colegiado_id', $individio->id)->where('curso_id', $curso->id)->first();
            if (empty($matricula)) {
                $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $codigo = substr(str_shuffle($permitted_chars), 0, 1) . $individio->capitulo->nombre[12] . $curso->nombre[0] . $individio->codigo[0] . $individio->paterno[0] . $individio->materno[0];
                Matricula::create([
                    'colegiado_id' => $individio->id,
                    'curso_id' => $this->curso,
                    'codigo' => $codigo
                ]);
                $this->emitTo('admin.inscritos-curso','render');
                $this->emit('alert','Se a inscrito satisfactoriamente al curso');
            } else {
                session()->flash('message', 'Utd, ya se encuetra matriculado en el curso');
            }
        } else {
            $individio=Persona::find($id);
            $matricula=Matricula::where('persona_id', $id)->where('curso_id', $curso->id)->first();
            if(empty($matricula)){
                $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $codigo = substr(str_shuffle($permitted_chars), 0, 1) . substr(str_shuffle($permitted_chars), 0, 1) . $curso->nombre[0] . rand(0,9) . $individio->paterno[0] . $individio->materno[0];
                Matricula::create([
                    'curso_id' => $curso->id,
                    'persona_id' => $individio->id,
                    'codigo' => $codigo
                ]);
                $this->emitTo('admin.inscritos-curso','render');
                $this->emit('alert', 'Se a inscrito satisfactoriamente al curso');
            }
            else{
                session()->flash('message', 'Utd, ya se encuentra matriculado en el curso');
            }
        }
    }
}
