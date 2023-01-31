<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;
    protected $fillable=['nombre', 'decano'];
    public function colegiados(){
        return $this->hasMany(Colegiado::class);
    }
}
