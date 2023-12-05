<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesAuxiliaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes_auxiliares', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_id');
            $table->enum('titulo', array('Tomografía','Rayos X', 'Laboratorio', 'Ecografía','Resonancia Magnética', 'Otros'))->default('Laboratorio');
            $table->string('descripcion', 1000)->nullable();
            $table->string('url', 512)->nullable();
            $table->string('viewer_url', 512)->nullable();
            $table->string('download_url', 512)->nullable();
            $table->unsignedBigInteger('medico_1_id')->nullable();
            $table->unsignedBigInteger('medico_2_id')->nullable();
            $table->unsignedBigInteger('medico_3_id')->nullable();
            $table->timestamps();

            $table->foreign('historia_id')->references('id')->on('historias')->cascadeOnDelete();
            // $table->foreign('medico_1_id')->references('id')->on('medicos')->cascadeOnDelete();
            // $table->foreign('medico_2_id')->references('id')->on('medicos')->cascadeOnDelete();
            // $table->foreign('medico_3_id')->references('id')->on('medicos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examenes_auxiliares');
    }
}
