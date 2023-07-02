<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesRegionalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes_regionales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_id');
            $table->text('examen_regional')->nullable();

            $table->timestamps();

            $table->foreign('historia_id')->references('id')->on('historias')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examenes_regionales');
    }
}
