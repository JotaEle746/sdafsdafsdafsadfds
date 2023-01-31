<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable=[
        'colegiado_id',
        'curso_id',
        'persona_id',
        'codigo'
    ];

    public function colegiado(){
        return $this->belongsTo(Colegiado::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function persona(){
        return $this->belongsTo(Colegiado::class);
    }
}
