<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capitulo;
use App\Models\Curso;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateCurso extends Component
{
    use WithFileUploads;
    public $open=false;
    public $identificador;
    public $nombre, $temario, $descripcion ,$fecha_inicio, $fecha_fin, $capitulo, $estado, $image, $duracion, $horas, $encabezado, $footer;
    protected $rules=[
        'nombre' => 'required',
        'temario' => 'required',
        'fecha_inicio' => 'required',
        'fecha_fin' => 'required',
        'estado' => 'required',
        'capitulo' => 'required',
//        '' => 'required|max:100',
        //'content' => 'requered|min:100'
   //     'content' => 'required',
        'image' => 'required|image|max:2048',
        'footer' => 'required',
        'encabezado' => 'required'
    ];

    public function mount(){
        $this->identificador=rand();
    }

    public function render()
    {   $capitulos=Capitulo::all();
        return view('livewire.admin.create-curso', compact('capitulos'));
    }
    public function save(){
        $this->validate();
        Carbon::setLocale('es');
        $image=$this->image->store('posts', 'public');
        $fecha_f = Carbon::parse($this->fecha_fin);
        $fecha_i = Carbon::parse($this->fecha_inicio);
        $this->duracion = strval($fecha_f->diffInDays($fecha_i));
        Curso::create([
            'nombre' => $this->nombre,
            'temario' => $this->temario,
            'duracion' => $this->duracion,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'descripcioncertificado' => $this->descripcion,
            'horas' => $this->horas,
            'encabezado' => $this->encabezado,
            'certificado' => $image,
            'codigo' =>Auth()->user()->id,
            'capitulo_id' => $this->capitulo,
            'estado' =>$this->estado,
            'footer' => $this->footer
        ]);
        $this->reset(['open', 'nombre', 'temario', 'fecha_inicio','fecha_fin', 'capitulo', 'estado', 'descripcion', 'image', 'footer']);
        //$this->emit('render');
        $this->identificador=rand();
        $this->emitTo('admin.show-cursos', 'render');
        $this->emit('alert', 'Se creo el curso');
    }

    public function updatingOpen(){
        if($this->open==false){
            $this->reset(['nombre', 'temario', 'fecha_inicio','fecha_fin', 'capitulo', 'estado', 'image']);
            $this->emit('resetCKEditor');
        }
    }
}
