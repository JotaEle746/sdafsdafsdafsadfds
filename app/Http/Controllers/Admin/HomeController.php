<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Persona;
use finfo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function cursos(){
        return view('admin.cursos');
    }
    public function showspeakers(Request $request)
    {
        $id= $request['kis'];
        $curso = Curso::find($id);
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->where('matriculas.rol', '1')
            ->paginate(1);
        $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
            ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->where('matriculas.rol', '1')
            ->get();
        return view('admin.ponentes', compact('curso', 'colegiados', 'personas'));
    }

    public function showcompetitors($id)
    {
        $curso = Curso::find($id);

        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->get();

        $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
            ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->get();
        return view('admin.participantes', compact('curso', 'colegiados', 'personas'));
    }

    public function newmatricula(Request $request, $id){
        $curso = Curso::find($id);
        return view('admin.matricular', compact('curso'));
    }

    public function newmatri($id, Request $request)
    {
        $curso = Curso::find($id);
        $persona = new Persona;
        $persona->dni = $request->dni;
        $persona->nombres = $request->nombres;
        $persona->a_paterno = $request->a_paterno;
        $persona->a_materno = $request->a_materno;
        $persona->email = $request->email;
        $persona->direccion = $request->direccion;

        $persona->save();

        $personab = Persona::where('dni', $request->dni)->first();

        if (!empty($personab)) {
            $matricula = new Matricula;
            $matricula->curso_id = $curso->id;
            $matricula->persona_id = $personab->id;
            $matricula->rol = "0";
            $id=$curso->id;
            $matricula->save();

            $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.a_paterno', 'colegiados.a_materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->get();

            $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
                ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.a_paterno', 'personas.a_materno', 'matriculas.rol')
                ->where('matriculas.curso_id', $id)
                ->get();

            return view('certificados.administrador.matriculas', compact('curso', 'colegiados', 'personas'))->with('mensaje', 'Inscripción exitosa, persona registrada al curso');
        }
    }

    public function inscritos(Request $request)
    {
        $id=$request['kis'];
        $curso = Curso::find($id);
        $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.paterno', 'colegiados.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->where('matriculas.rol', '1')
            ->get();
        $personas = Matricula::join('personas', 'matriculas.persona_id', '=', 'personas.id')
            ->select('matriculas.id AS id_matricula', 'personas.id', 'personas.dni', 'personas.nombres', 'personas.paterno', 'personas.materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->where('matriculas.rol', '1')
            ->get();
        $curso=Curso::paginate(10);
        return view('livewire.custom-capitulo', compact('curso', 'colegiados', 'personas'));
        /* return view('Livewire.users.custom-capitulo', compact('curso', 'colegiados', 'personas')); */
    }

    public function capital()
    {
        return view('admin.users.ShowCapitulos');
    }

    public function exportexcel()
    {
        return Excel::download(new usersExport, 'users.xlsx');
    }
}
