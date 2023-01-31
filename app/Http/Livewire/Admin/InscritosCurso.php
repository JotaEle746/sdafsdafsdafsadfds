<?php

namespace App\Http\Livewire\Admin;

use App\Exports\UsersExport;
use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Persona;
use Livewire\Component;
use PDF;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class InscritosCurso extends Component
{
    use WithPagination;
    public $cursos;
    public $rol;
    public $Ponentes;
    public $matricula;
    public $nombre;
    public $searchid;
    public $individuo;
    protected $listeners=['render'=>'render', 'deleteCo', 'deletePe'];
    public function mount(Curso $curso){
        $this->cursos=$curso;
    }
    public function updating()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search=$this->nombre;
        $searchdni=$this->searchid;
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
                ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol')
                ->where('matriculas.curso_id', $this->cursos->id)
                ->where(function ($query) use ($search) {
                    $query = $query->orWhere('colegiados.nombres','like',"%$search%");
                    $query = $query->orWhere('colegiados.paterno','like',"%$search%");
                    $query = $query->orWhere('colegiados.materno','like',"%$search%");
                  })
                  ->where('colegiados.dni', 'like', '%'.$this->searchid.'%')
                  ->where('matriculas.rol', 'like','%'.$this->individuo.'%')
                ->paginate(30);

            $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
                ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol')
                ->where('matriculas.curso_id', $this->cursos->id)
                ->where(function ($query) use ($search) {
                    $query = $query->orWhere('personas.nombres','like',"%$search%");
                    $query = $query->orWhere('personas.paterno','like',"%$search%");
                    $query = $query->orWhere('personas.materno','like',"%$search%");
                  })
                  ->where('personas.dni', 'like', '%'.$this->searchid.'%')
                  ->where('matriculas.rol', 'like','%'.$this->individuo.'%')
                ->paginate(30);
        return view('livewire.admin.inscritos-curso', compact('colegiados', 'personas'));
    }

    public function AsignarP(Colegiado $colegiado)
    {
        $matricula=$colegiado->matriculas;
        foreach ($matricula as $key => $value) {
            if($value->curso_id==$this->cursos->id)
            {
                if ($value->rol=="0") {
                    $value->rol="1";
                } else {
                    $value->rol="0";
                }
                $value->save();
            }
        }
        /* if ($matricula[0]->rol=="0") {
            $matricula[0]->rol="1";
        } else {
            $matricula[0]->rol="0";
        }
        $matricula[0]->save(); */
    }
    public function AsignarC(Persona $colegiado)
    {
        $matricula=$colegiado->matriculas;
        foreach ($matricula as $key => $value) {
            if($value->curso_id==$this->cursos->id)
            {
                if ($value->rol=="0") {
                    $value->rol="1";
                } else {
                    $value->rol="0";
                }
                $value->save();
            }
        }
    }

    public function deleteCo(Colegiado $colegiado){
        $matriculas = Matricula::where('colegiado_id', $colegiado->id)
            ->where('curso_id', $this->cursos->id)
            ->first();
        $matriculas->delete();
    }

    public function deletePe(Persona $persona){
        $persona->delete();
    }
    public $codigoscertificados;

    public function singin($colegiado){
        $colegiados=Matricula::join('colegiados', 'colegiados.id', '=', 'matriculas.colegiado_id')
            ->select('matriculas.id', 'matriculas.codigo')
            ->where('matriculas.curso_id', $this->cursos->id)
            ->where('colegiados.dni', $colegiado)
            ->first();
        if(is_null($colegiados))
        {
            $colegiados=Matricula::join('personas', 'personas.id', '=', 'matriculas.persona_id')
                ->select('matriculas.id', 'matriculas.codigo')
                ->where('matriculas.curso_id', $this->cursos->id)
                ->where('personas.dni', $colegiado)
                ->first();
        }
        $string="type".$colegiados->codigo[3]."=?".$colegiados->id;
        redirect()->route('certificados', compact('string'));
    }
    
    public function gcertificados(){
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id','matriculas.codigo')
            ->where('matriculas.curso_id', $this->cursos->id)
            ->get();
        $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
            ->select('matriculas.codigo')
            ->where('matriculas.curso_id', $this->cursos->id)
            ->get();
        //Creas el objeto para trabajar
        foreach ($colegiados as $key => $value) {
            /* $string="type".$value->codigo[3]."=?".$value->id; */
            //Una vez descargues la librería, haces el enlace
            /* $pdf = new DOMPDF(); */
            /* $pdf = PDF::loadView('users.certificado')->setPaper('a4', 'landscape'); */
            
            /* $pdf->load_html($html); */
            /* $pdf->render();
            $pdf->stream("Admit card.pdf",array("Attachment"=>0)); */
            /* response()->streamDownload(function () use($pdf) {
                echo  $pdf->stream();
            }, 'invoice'.$key.'.pdf'); */
            /* $pdf->clear(); */
            /* return $pdf->stream('tutsmake.pdf'); */
            /* redirect()->route('certificados', compact('string')); */
        }
    }

    public function exportexcel()
    {
        $search=$this->nombre;
        $searchdni=$this->searchid;
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
                ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol', 'colegiados.telefono', 'colegiados.email')
                ->where('matriculas.curso_id', $this->cursos->id)
                ->where(function ($query) use ($search) {
                    $query = $query->orWhere('colegiados.nombres','like',"%$search%");
                    $query = $query->orWhere('colegiados.paterno','like',"%$search%");
                    $query = $query->orWhere('colegiados.materno','like',"%$search%");
                  })
                  ->where('colegiados.dni', 'like', '%'.$this->searchid.'%')
                  ->where('matriculas.rol', 'like','%'.$this->individuo.'%')
                ->paginate(30);

            $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
                ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol', 'personas.telefono', 'personas.email')
                ->where('matriculas.curso_id', $this->cursos->id)
                ->where(function ($query) use ($search) {
                    $query = $query->orWhere('personas.nombres','like',"%$search%");
                    $query = $query->orWhere('personas.paterno','like',"%$search%");
                    $query = $query->orWhere('personas.materno','like',"%$search%");
                  })
                  ->where('personas.dni', 'like', '%'.$this->searchid.'%')
                  ->where('matriculas.rol', 'like','%'.$this->individuo.'%')
                ->paginate(30);
        return Excel::download(new usersExport($colegiados, $personas), 'users.xlsx');
    }
}
