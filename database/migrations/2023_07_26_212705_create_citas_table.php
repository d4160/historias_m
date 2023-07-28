<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->unsignedBigInteger('paciente_id'); //paciente dni/nombres/apellidos/celular si no existe tipo=0
            $table->enum('tipo', array('Consulta Médica', 'Tomografía','Rayos X', 'Laboratorio', 'Ecografía','Resonancia Magnética', 'Otros'))->default('Consulta Médica');
            $table->enum('consultorio', array('Consultorio 1', 'Consultorio 2'))->default('Consultorio 1');
            $table->enum('medico', array('Yamil Cabrera', 'Daysy Mechan', 'Rodolfo Cairo'))->default('Daysy Mechan');
            $table->enum('estado', array('Paciente confirmado', 'Paciente no confirmado'))->default('Paciente no confirmado');
            $table->enum('origen', array('Llamada', 'Red Social'))->default('Llamada');
            $table->timestamps();

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
        Schema::dropIfExists('citas');
    }
}
