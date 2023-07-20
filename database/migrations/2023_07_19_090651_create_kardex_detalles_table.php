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
            $table->string('via', 10);
            $table->string('frecuencia', 50);
            $table->string('dia1', 50);
            $table->string('dia2', 50);
            $table->string('dia3', 50);
            $table->string('dia4', 50);
            $table->string('dia5', 50);
            $table->string('dia6', 50);
            $table->string('dia7', 50);
            $table->string('dia8', 50);

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
