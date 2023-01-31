<?php

namespace App\Http\Livewire\Admin;

use App\Models\Capitulo;
use App\Models\Curso;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowCursos extends Component
{   use WithFileUploads;
    use WithPagination;
    public $search, $cursos, $image, $identificador;
    public $open_edit=false;
    protected $listeners=['render'=>'render', 'delete'];
    protected $rules=[
        'cursos.nombre' => 'required',
        'cursos.temario' => 'required',
        'cursos.fecha_inicio' => 'required',
        'cursos.fecha_fin' => 'required',
        'cursos.horas' => 'nullable',
        'cursos.encabezado' =>'required',
        'cursos.estado' => 'required',
        'cursos.capitulo_id' => 'required',
        'cursos.descripcioncertificado' => 'nullable',
        'cursos.footer' => 'required'
    ];

    public function mount(){
        $this->identificador=rand();
        $this->cursos=new Curso();
    }

    public function render()
    {  
        $user=Auth()->user();
        if($user->can('admin.users.index')){
            $curso=Curso::where('nombre', 'like', '%'. $this->search.'%')
                ->orderBy('id', 'desc')
                ->paginate(15);
        }
        else{
            $curso=Curso::where('nombre', 'like', '%'. $this->search.'%')
                ->where('cursos.codigo', $user->id)
                ->orderBy('id', 'desc')
                ->paginate(15);
        }
        $capitulos=Capitulo::all();
        return view('livewire.admin.show-cursos', compact('curso', 'capitulos'));
    }

    public function edit(Curso $cursos){
        $this->cursos=$cursos;
        $this->open_edit=true;

    }

    public function update(){
        $this->validate();
        if ($this->image) {
            Storage::delete([$this->cursos->certificado]);
            $this->cursos->certificado=$this->image->store('posts','public');
        }
        $this->cursos->save();
        $this->reset(['open_edit', 'image']);
        $this->identificador=rand();
        $this->emit('alert', 'El curso se actualizo satisfactoriamente');
    }

    public function delete(Curso $curso){
        $curso->delete();
    }
}
