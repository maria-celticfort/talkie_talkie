<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversaciones', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_inicio')->nullable('False');
            $table->dateTime('fecha_fin');
            $table->unsignedBigInteger('usuario_1_id');
            $table->unsignedBigInteger('usuario_2_id');


            $table->foreign('usuario_1_id')->references('id')->on('usuarios');
            $table->foreign('usuario_2_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversacions');
    }
};
