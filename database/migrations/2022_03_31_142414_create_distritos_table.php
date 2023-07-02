<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritos', function (Blueprint $table) {
            $table->string('codigo_dis', 6)->primary();
            $table->string('nombre_dis', 45);
            $table->string('codigo_prov', 4);
            $table->string('codigo_dep', 2);

            $table->foreign('codigo_dep')->references('codigo_dep')->on('departamentos');
            $table->foreign('codigo_prov')->references('codigo_prov')->on('provincias')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('distritos');
    }
}
