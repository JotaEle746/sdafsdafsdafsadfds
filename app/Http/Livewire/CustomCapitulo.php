<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Models\Matricula;
use Livewire\Component;
use Illuminate\Http\Request;
class CustomCapitulo extends Component
{
    public $open;
    public $op;
    public function mount($id)
    {
        $this->open=$id;
        $this->op;
    }
    public function render()
    {
        $id=$this->open;
        $curso = Curso::find($id);
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->paginate(4);
        $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
            ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->paginate(1);
        return view('livewire.custom-capitulo', compact('curso', 'colegiados', 'personas'));
        /* return view('livewire.custom-capitulo', compact('curso')); */
    }

    public function increment()
    {
        $this->op++;
    }
}