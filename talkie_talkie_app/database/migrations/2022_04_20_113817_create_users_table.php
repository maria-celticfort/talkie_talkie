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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',50)->nullable(False);
            $table->string('surname_1',100)->nullable(False);
            $table->string('surname_2',100)->nullable(True);
            $table->string('email')->unique()->nullable(False);
            $table->string('nickname',50)->unique()->nullable(False);
            $table->string('password',100)->nullable(False);
            $table->date('date_of_birth')->nullable(False);
            $table->enum('pronouns', ['Él','Ella','Elle','He/him','She/her','They/them'])->nullable(False);
            $table->boolean('bann')->default(False);
            $table->string('bann_motive',100)->default('None');
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
        Schema::dropIfExists('users');
    }
};
