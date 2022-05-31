<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.Create 'conveersations' table in database
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date')->nullable('False');
            $table->boolean('finished')->default(False);
            $table->dateTime('end_date')->nullable('True');
            $table->unsignedBigInteger('user_1_id');
            $table->unsignedBigInteger('user_2_id')->nullable('True');
            $table->unsignedBigInteger('topic_id');
            

            $table->foreign('user_1_id')->references('id')->on('users');
            $table->foreign('user_2_id')->references('id')->on('users');
            $table->foreign('topic_id')->references('id')->on('topics');
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
        Schema::dropIfExists('conversations');
    }
};
