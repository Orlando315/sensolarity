<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivosUsersRangosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos_users_rangos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dispositivo_user_id');
            $table->foreign('dispositivo_user_id')->references('id')->on('dispositivos_users')->onDelete('cascade');
            $table->tinyInteger('data')->comment('Data al que pertenecen los rangos');
            $table->float('min', 6, 2)->comment('Rango minimo');
            $table->float('max', 6, 2)->comment('Rango maximo');
            $table->string('color', 7)->comment('Color hexadecimal');
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
        Schema::dropIfExists('dispositivos_users_rangos');
    }
}
