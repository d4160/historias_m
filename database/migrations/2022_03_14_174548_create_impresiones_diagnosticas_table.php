<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpresionesDiagnosticasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresiones_diagnosticas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_id');
            $table->text('impresion_diagnostica')->nullable(); // espacio a mitad

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
        Schema::dropIfExists('impresiones_diagnosticas');
    }
}
