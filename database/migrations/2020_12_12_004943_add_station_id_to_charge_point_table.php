<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStationIdToChargePointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('charge_point', function (Blueprint $table) {
            $table->integer('station_id');
            $table->integer('connector_type');
            $table->integer('status')->comment('1- unlock, 2-lock');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('charge_point', function (Blueprint $table) {
            $table->dropColumn('station_id');
            $table->dropColumn('connector_type');
            $table->dropColumn('status');
        });
    }
}
