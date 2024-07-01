<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('estudiante_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->date('fecha')->nullable(false);
            $table->time('hora_entrada')->nullable(false);
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreign('grupo_id')->references('id')->on('grupo');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
