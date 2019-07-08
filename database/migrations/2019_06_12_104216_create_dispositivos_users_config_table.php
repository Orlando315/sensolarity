<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivosUsersConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispositivos_users_config', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('dispositivo_user_id');
            $table->foreign('dispositivo_user_id')->references('id')->on('dispositivos_users')->onDelete('cascade');
            $table->string('alias', 30)->nullable()->comment('Alias del dispositivo');

            $table->string('alias_1', 30)->nullable()->comment('Alias data_1');
            $table->float('min_1', 6,2)->nullable()->comment('Valor minimo data_1');
            $table->float('max_1', 6,2)->nullable()->comment('Valor maximo data_1');
            $table->boolean('porcentual_1')->default(false)->comment('Mostrar datos como % o con la unidad ingresada');
            $table->string('unidad_1', 10)->nullable()->comment('Unidad a mostrar data_1');

            $table->string('alias_2', 30)->nullable()->comment('Alias data_2');
            $table->float('min_2', 6,2)->nullable()->comment('Valor minimo data_2');
            $table->float('max_2', 6,2)->nullable()->comment('Valor maximo data_2');
            $table->boolean('porcentual_2')->default(false)->comment('Mostrar datos como % o con la unidad ingresada');
            $table->string('unidad_2', 10)->nullable()->comment('Unidad a mostrar data_2');

            $table->string('alias_3', 30)->nullable()->comment('Alias data_3');
            $table->float('min_3', 6,2)->nullable()->comment('Valor minimo data_3');
            $table->float('max_3', 6,2)->nullable()->comment('Valor maximo data_3');
            $table->boolean('porcentual_3')->default(false)->comment('Mostrar datos como % o con la unidad ingresada');
            $table->string('unidad_3', 10)->nullable()->comment('Unidad a mostrar data_3');
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
        Schema::dropIfExists('dispositivos_users_config');
    }
}
