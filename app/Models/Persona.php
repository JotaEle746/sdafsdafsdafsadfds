<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillable=[
        'dni',
        'nombres',
        'paterno',
        'materno',
        'direccion',
        'email',
        'telefono'
    ];

    public function matriculas(){
        return $this->hasMany(Matricula::class);
    }
}
