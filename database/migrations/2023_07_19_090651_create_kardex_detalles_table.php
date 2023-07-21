<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_detalles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kardex_id');
            $table->string('medicamento');
            $table->string('dosis', 25);
            $table->string('via', 10)->nullable();
            $table->string('frecuencia', 50)->nullable();
            $table->string('dia1', 50)->nullable();
            $table->string('dia2', 50)->nullable();
            $table->string('dia3', 50)->nullable();
            $table->string('dia4', 50)->nullable();
            $table->string('dia5', 50)->nullable();
            $table->string('dia6', 50)->nullable();
            $table->string('dia7', 50)->nullable();
            $table->string('dia8', 50)->nullable();

            $table->timestamps();

            $table->foreign('kardex_id')->references('id')->on('kardexes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardex_detalles');
    }
}
