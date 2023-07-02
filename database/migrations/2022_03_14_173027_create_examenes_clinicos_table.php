<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamenesClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examenes_clinicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('historia_id');
            $table->string('funciones_vitales', 1000)->nullable();
            $table->decimal('peso')->nullable();
            $table->decimal('talla')->nullable();
            $table->string('deposiciones', 250)->nullable();
            $table->string('orina', 250)->nullable();
            $table->string('fur')->nullable();
            $table->text('otros')->nullable();

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
        Schema::dropIfExists('examenes_clinicos');
    }
}
