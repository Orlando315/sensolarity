<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivosUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos_users_data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dispositivo_user_id');
            $table->foreign('dispositivo_user_id')->references('id')->on('dispositivos_users')->onDelete('cascade');
            $table->string('gateway', 30)->nullable();
            $table->float('data_1', 8, 2)->nullable();
            $table->float('data_2', 8, 2)->nullable();
            $table->float('data_3', 8, 2)->nullable();
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
        Schema::dropIfExists('dispositivos_users_data');
    }
}
