<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegiado extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombres',
        'codigo',
        'dni',
        'paterno',
        'materno',
        'direccion',
        'email',
        'capitulo_id',
        'telefono'
    ];

    public function capitulo(){
        return $this->belongsTo(Capitulo::class);
    }

    public function matriculas(){
        return $this->hasMany(Matricula::class);
    }
}
