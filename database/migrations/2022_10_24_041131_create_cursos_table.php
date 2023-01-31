<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->text('temario');
            $table->string('duracion', 50);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('descripcioncertificado')->nullable();
            $table->string('certificado')->nullable();
            $table->string('horas')->nullable();
            $table->enum('encabezado',[0,1]);
            $table->string('codigo');
            $table->enum('footer',[0,1,2,3]);
            $table->foreignId('capitulo_id')
                ->constrained('capitulos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('estado', [1,2,3]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
