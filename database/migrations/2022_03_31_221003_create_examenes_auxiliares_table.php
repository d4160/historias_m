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
            $table->string('titulo');
            $table->string('descripcion', 1000)->nullable();
            $table->string('url', 512)->nullable();
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
        Schema::dropIfExists('examenes_auxiliares');
    }
}
