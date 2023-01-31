<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'temario',
        'duracion',
        'fecha_inicio',
        'fecha_fin',
        'descripcioncertificado',
        'horas',
        'encabezado',
        'certificado',
        'codigo',
        'capitulo_id',
        'footer',
        'estado'
    ];
    public function matriculas(){
        return $this->hasMany(Matricula::class);
    }
}
