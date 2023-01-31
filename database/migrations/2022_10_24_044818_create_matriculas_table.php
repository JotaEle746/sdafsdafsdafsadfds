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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colegiado_id')->nullable()->constrained('colegiados')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('persona_id')->nullable()->constrained('personas')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->enum('rol',[0,1]);
            $table->string('codigo')->unique();
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
        Schema::dropIfExists('matriculas');
    }
};
