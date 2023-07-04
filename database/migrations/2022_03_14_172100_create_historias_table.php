<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('antecedente_id')->nullable();
            $table->unsignedBigInteger('anamnesis_id')->nullable();
            $table->unsignedBigInteger('examen_clinico_id')->nullable();
            $table->unsignedBigInteger('examen_regional_id')->nullable();
            $table->unsignedBigInteger('impresion_diagnostica_id')->nullable();
            $table->unsignedBigInteger('tratamiento_id')->nullable();
            $table->date('proxima_cita')->nullable();;
            // nuevo campo, sede de atencion
            $table->timestamps();

            // $table->foreign('enfermedad_actual_id')->references('id')->on('enfermedad_actuales');
            // $table->foreign('funcion_id')->references('id')->on('funciones');
            // $table->foreign('tratamiento_id')->references('id')->on('tratamientos');
            // $table->foreign('examen_id')->references('id')->on('examenes');
            // $table->foreign('diagnostico_id')->references('id')->on('diagnosticos');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historias');
    }
}
