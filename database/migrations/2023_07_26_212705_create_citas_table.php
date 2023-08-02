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
            //$table->enum('tipo', array('Consulta Médica', 'Tomografía','Rayos X', 'Laboratorio', 'Ecografía','Resonancia Magnética', 'Otros'))->default('Consulta Médica');
            $table->string('tipo', 200)->nullable();
            //$table->string('tipo_otros', 150)->nullable();
            $table->enum('consultorio', array('Consultorio 1', 'Consultorio 2', 'Tópico'))->default('Consultorio 1');
            $table->enum('medico', array('Yamil Cabrera', 'Daysy Mechan', 'Rodolfo Cairo'))->default('Daysy Mechan');
            $table->string('estado', 150)->nullable();
            $table->string('origen', 150)->nullable();
            $table->enum('estado_enum', array('Atendido','En espera','No atendido'))->default('No atendido');
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
