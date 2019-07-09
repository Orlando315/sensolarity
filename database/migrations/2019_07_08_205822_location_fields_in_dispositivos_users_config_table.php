<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationFieldsInDispositivosUsersConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispositivos_users_config', function (Blueprint $table) {
            $table->float('lat', 10, 6)->nullable()->after('alias');
            $table->float('lng', 10, 6)->nullable()->after('lat');
            $table->tinyInteger('zoom')->nullable()->after('lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispositivos_users_config', function (Blueprint $table) {
            $table->dropColumn(['lat', 'lng', 'zoom']);
        });
    }
}
