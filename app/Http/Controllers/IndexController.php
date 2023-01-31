<?php

namespace App\Http\Controllers;

use App\Models\Capitulo;
use App\Models\Colegiado;
use App\Models\Matricula;
use App\Models\Persona;
use BaconQrCode\Encoder\MatrixUtil;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller
{
    public function index(){
        return view('users.index');
    }

    public function certificado(Request $request)
    {
        $matricula=substr($request->string,7);
        $matricula=Matricula::find($matricula);
        $curso=$matricula->curso;
        $individuo=Colegiado::find($matricula->colegiado_id);
        if(is_null($individuo))
        {
            $individuo=Persona::where('id', $matricula->persona_id)->first();
        }
        $cap=Capitulo::find($curso->capitulo_id);
        $capitulo=substr($cap->nombre,11);
        $oficina=substr($cap->nombre,0,8);
        $url = $request->fullUrl();
        Carbon::setLocale('es');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fechai = Carbon::parse($curso->fecha_inicio);
        $vali=$fechai->formatLocalized('%m');
        $di=$fechai->formatLocalized('%d');
        $yi=$fechai->formatLocalized('%Y');
        $mesi = $meses[($fechai->format($vali)) - 1];
        $fecha = Carbon::parse($curso->fecha_fin);
        $val=$fecha->formatLocalized('%m');
        $d=$fecha->formatLocalized('%d');
        $y=$fecha->formatLocalized('%Y');
        $mes = $meses[($fecha->format($val)) - 1];
        $pdf = PDF::loadView('users.certificado', compact('matricula', 'curso', 'individuo', 'url', 'mes', 'di', 'yi', 'mesi', 'd', 'y', 'oficina', 'cap', 'capitulo'))->setPaper('a4', 'landscape');
        return $pdf->stream('CIP CD-Puno.pdf');
    }
}