<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations. Create 'topics' table in database
     *
     * @return void
     */
    public function up()
    {
        //Languge codes according to ISO 693-3
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(False);
            $table->enum('language',['eng','spa','cat','glg',
            'eus','jpn','chi','deu','ita','fra','por','gre','gle','ukr'])->nullable(False);
            $table->bigInteger('number_users_speaking')->default('0');
            $table->bigInteger('number_times_searched')->default('0');
            $table->boolean('bann')->default(False);
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
        Schema::dropIfExists('topics');
    }
};
