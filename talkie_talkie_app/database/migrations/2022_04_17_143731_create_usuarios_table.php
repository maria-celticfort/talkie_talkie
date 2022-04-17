<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\False_;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50)->nullable(False);
            $table->string('apellido_1',100)->nullable(False);
            $table->string('apellido_2',100)->nullable(True);
            $table->string('email')->unique()->nullable(False);
            $table->string('nickname',50)->unique()->nullable(False);
            $table->date('fecha_nacimiento')->nullable(False);
            $table->enum('pronombres', ['Él','Ella','Elle','He/him','She/her','They/them'])->nullable(False);
            $table->boolean('bann')->default(False);
            $table->string('motivo_bann',100)->default('None');
            $table->boolean('admin')->default(False);
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
        Schema::dropIfExists('usuarios');
    }
};
