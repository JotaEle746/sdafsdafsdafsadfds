<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Livewire\CustomCapitulo;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class, 'index'])->middleware('can:home')->name('home');
Route::get('cursos',[HomeController::class, 'cursos'])->middleware('can:indexadmin')->name('indexadmin');
Route::get('capitulos',[HomeController::class, 'capital'])->middleware('can:capitulos')->name('capitulos');
Route::get('cursos/inscritos', [HomeController::class, 'showspeakers'])->middleware('can:mostrarponentes')->name('mostrarponentes');
/* Route::get('/cursos/inscritos/{id}', CustomCapitulo::class)->middleware('can:mostrarponentes')->name('prueba'); */

/* Route::get('/register', [HomeController::class, 'register'])->name('registeradmin'); */

Route::get('/cursos/participantes/{id}', [HomeController::class, 'showcompetitors'])->middleware('can:mostrarparticipantes')->name('mostrarparticipantes');
Route::get('/cursos/matricula/{id}', [HomeController::class, 'newmatricula'])->middleware('can:matricularnew')->name('matricularnew');
Route::post('/cursos/nuevamatricula/{id}', [MatriculaController::class, 'newmatri'])->middleware('can:newmatri')->name('newmatri');
Route::resource('users', UserController::class)->only('index', 'edit', 'update')->names('admin.users');