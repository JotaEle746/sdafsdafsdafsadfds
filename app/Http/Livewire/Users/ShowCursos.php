<?php

namespace App\Http\Livewire\Users;

use App\Models\Colegiado;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Persona;
use App\Models\Post;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;
use GuzzleHttp\Client;
use PDF;
class ShowCursos extends Component
{   use WithPagination;
    public $curso, $dato;
    public $certcodigo;
    public $estado='0';
    public $persona=false;
    public $tipo;
    public $search;
    public $searchbool=false;
    public $open_edit=false;
    public $inscribir_persona=false;
    public $dni;
    public $dnii, $nombres, $paterno, $materno, $email, $direccion, $telefono;
    public $showDropdown=false;
    protected $rules=[
        'dnii' => 'required|max:8',
        'nombres' => 'required',
        'paterno' => 'required',
        'materno' => 'required',
        'email' => 'required',
        'direccion' => 'required',
        'telefono' => 'required|max:9'
    ];

    protected $messages = [
        'dni.required' => 'Ingrese el numero de DNI'
    ];
/* 
    protected $validationAttributes = [
        'dni' => 'required'
    ]; */

    protected $listeners=['estado'=>'estado', 'search'=>'search', 'codigo'=>'codigo'];

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function mount(){
        $this->curso=new Curso();
    }
    public function render()
    {   if($this->estado!="0"){
            if($this->searchbool==true){
                $cursos=Curso::where('capitulo_id', 'like', $this->search)
                    ->where('estado', $this->estado)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }
            else{
                $cursos=Curso::where('estado', $this->estado)
                ->orderBy('id', 'desc')
                ->paginate(10);
            };
        }
        else{
            if($this->searchbool==true){
                $cursos=Curso::where('capitulo_id', 'like', $this->search)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }
            else{
                $cursos=Curso::where('capitulo_id', 'like', '%'.$this->search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            };
        }
        /* if (empty($this->dato)) {
            if($this->searchbool==true){
                $cursos=Curso::where('capitulo_id', 'like', $this->search)
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            }
            else{
                $cursos=Curso::where('capitulo_id', 'like', '%'.$this->search.'%')
                    ->orderBy('id', 'desc')
                    ->paginate(10);
            };
        } else {
            if (empty($this->persona)) {
                $cursos=Curso::join('matriculas', 'matriculas.curso_id', '=', 'cursos.id')
                    ->where('matriculas.colegiado_id', $this->dato)
                    ->paginate(10);
            } else {
                $cursos=Curso::join('matriculas', 'matriculas.curso_id', '=', 'cursos.id')
                    ->where('matriculas.persona_id', $this->dato)
                    ->paginate(10);
            }
            
        } */
        /* $colegiados = Matricula::join('colegiados', 'matriculas.colegiado_id', '=', 'colegiados.id')
            ->select('matriculas.id AS id_matricula', 'colegiados.id', 'colegiados.dni', 'colegiados.nombres', 'colegiados.a_paterno', 'colegiados.a_materno', 'matriculas.rol')
            ->where('matriculas.curso_id', $id)
            ->get(); */
        return view('livewire.users.show-cursos', compact('cursos'));
    }

    public function edit(Curso $curso){
        $this->curso=$curso;
        $this->open_edit=true;
    }

    public function inscribir(Curso $curso){
        $validatedData = $this->validate([
            'dni' => 'required|min:8|max:8'
        ]);
        $individio=Colegiado::where('dni', $this->dni)->first();
        if(!empty($individio)){
            $this->showDropdown=true;
        }
        else{
            $individio=Persona::where('dni', $this->dni)->first();
            if(!empty($individio)){
                $this->showDropdown=true;
            }
            else{
                $this->open_edit=false;
                $this->reset(['dni']);
                $this->inscribir_persona=true;
            }
        }
    }

    public function inscribirse(Curso $curso){
        $validatedData = $this->validate([
            'dni' => 'required|min:8|max:8',
        ]);
        $individio=Colegiado::where('dni', $this->dni)->first();
        if(!empty($individio)){
            $matricula=Matricula::where('colegiado_id', $individio->id)->where('curso_id', $curso->id)->first();
            if (empty($matricula)) {
                $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $codigo = substr(str_shuffle($permitted_chars), 0, 1) . $individio->capitulo->nombre[12] . $curso->nombre[0] . $individio->codigo[0] . $individio->paterno[0] . $individio->materno[0];
                Matricula::create([
                    'colegiado_id' => $individio->id,
                    'curso_id' => $curso->id,
                    'codigo' => $codigo
                ]);
                $this->emit('alert','Se a inscrito satisfactoriamente al curso');
            } else {
                session()->flash('message', 'Utd, ya se encuetra matriculado en el curso');
            }
        }
        else{
            $individio=Persona::where('dni', $this->dni)->first();
            if(!empty($individio)){
                $matricula=Matricula::where('persona_id', $individio->id)->where('curso_id', $curso->id)->first();
                if(empty($matricula)){
                    $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $codigo = substr(str_shuffle($permitted_chars), 0, 1) . substr(str_shuffle($permitted_chars), 0, 1) . $curso->nombre[0] . rand(0,9) . $individio->paterno[0] . $individio->materno[0];
                    Matricula::create([
                        'curso_id' => $curso->id,
                        'persona_id' => $individio->id,
                        'codigo' => $codigo
                    ]);
                    $this->emit('alert', 'Se a inscrito satisfactoriamente al curso');
                }
                else{
                    session()->flash('message', 'Utd, ya se encuentra matriculado en el curso');
                    
                }
            }
        }
        $this->showDropdown=false;
        $this->open_edit=false;
        $this->reset(['dni']);
    }

    public function save(){
        $this->nombres=ucwords($this->nombres);
        $this->paterno=ucwords($this->paterno);
        $this->materno=ucwords($this->materno);
        $validatedData=$this->validate([
            'dnii' => 'required|min:8|max:8|unique:personas,dni|unique:colegiados,dni',
            'nombres' => 'required',
            'paterno' => 'required',
            'materno' => 'required',
            'email' => 'required',
            'direccion' => 'required',
            'telefono' => 'required|max:9'
        ]);
        $this->validate();
        $token = '';
        $numero = $this->dnii;
        $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Referer' => 'https://apis.net.pe/api-consulta-dni',
                'User-Agent' => 'laravel/guzzle',
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $numero]
        ];
        $res = $client->request('GET', '/v1/dni', $parameters);
        $response = json_decode($res->getBody()->getContents(), true);
        $dninum=0;
        if(!empty($response)){
            foreach ($response as $key => $value) {
                if($key=="numeroDocumento"){
                    $dninum=$value;
                }
            }
        }

        if ($dninum==$this->dnii) {
            Persona::create([
                'dni'=> $this->dnii,
                'nombres' => $this->nombres,
                'paterno' => $this->paterno,
                'materno'=> $this->materno,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono
            ]);
            $individio=Persona::where('dni', $this->dnii)->first();
            $permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $codigo = substr(str_shuffle($permitted_chars), 0, 1) . substr(str_shuffle($permitted_chars), 0, 1) . $this->curso->nombre[0] . rand(0,9) . $individio->paterno[0] . $individio->materno[0];
            Matricula::create([
                'curso_id' => $this->curso->id,
                'persona_id' => $individio->id,
                'codigo' => $codigo
            ]);
            $this->reset(['inscribir_persona','dnii', 'nombres', 'paterno', 'materno', 'email', 'direccion']);
            $this->emit('alert','Se a inscrito satisfactoriamente al curso');
        } else {
            $this->reset(['inscribir_persona','dnii', 'nombres', 'paterno', 'materno', 'email', 'direccion']);
            session()->flash('message', 'Los datos aparentemente no son correctos, consulte con el administrador');
        }
        
    }

    public function codigo($codigo){
        /* $pdf = PDF::loadView('users.certificado');
        $pdf->setPaper('a4', 'landscape');
        return response()->streamDownload(function () use($pdf) {
            echo  $pdf->stream();
        }, 'invoice.pdf'); */
        $codigos=Matricula::where('codigo', $codigo)->first();
        if (is_null($codigos)) {
            session()->flash('message', 'Certificado no encontrado');
        } else {
            $matricula=Matricula::where('codigo', $codigo)->first();
            $string="type".$codigo[3]."=?".$matricula->id;
            redirect()->route('certificados', compact('string'));
            /* $pdf = PDF::loadView('certificados.usuarios.certificadopdf', compact('colegiado', 'curso', 'qr','p'))->setPaper('a4', 'landscape'); */

            /* $pdf->setPaper('a4', 'landscape');

            return response()->streamDownload(function () use($pdf) {
                echo  $pdf->stream();
            }, 'invoice.pdf'); */
            
            /* return $pdf->download('tutsmake.pdf');
            $this->certcodigo=$codigo->codigo; */
            /* return $pdf->stream('tutsmake.pdf'); */
        }
        /* $individuo=Colegiado::where('dni', $dni)->first();
        if(is_null($individuo)){
            $individuo=Persona::where('dni', $dni)->first();
            $this->persona=true;
        }
        if(is_null($individuo)){
            session()->flash('message', 'No se encuentra el numero registrado');
            $this->reset(['dato']);
        }
        else{
            $this->dato=$individuo->id;
        } */
    }

    public function estado($estado){
        $this->estado=$estado;
        $this->resetPage();
    }

    public function search($search){
        if($search!="--Seleccione--"){
            $this->search=$search;
            $this->searchbool=true;
            $this->resetPage();
        }
        else{
            $this->reset(['search', 'searchbool']);
        }
    }
}
