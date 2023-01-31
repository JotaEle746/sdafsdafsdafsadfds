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
        Schema::create('colegiados', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 80);
            $table->char('codigo', 6)->unique();
            $table->char('dni', 8)->unique();
            $table->string('paterno', 50);
            $table->string('materno', 50);
            $table->string('direccion', 80);
            $table->string('email',60);
            $table->foreignId('capitulo_id')
                ->constrained('capitulos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('telefono', 9);
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
        Schema::dropIfExists('colegiados');
    }
};
