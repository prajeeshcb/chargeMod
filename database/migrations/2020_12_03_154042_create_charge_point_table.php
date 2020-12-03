<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargePointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_point', function (Blueprint $table) {
            $table->id();
            $table->string('charge_point_vendor');
            $table->string('charge_point_model');
            $table->string('charge_point_serialnumber');
            $table->string('charge_box_serial_number');
            $table->string('firmware_version');
            $table->string('iccid');
            $table->string('imsi');
            $table->string('meter_type');
            $table->string('meter_serial_number');
            $table->integer('interval');
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
        Schema::dropIfExists('charge_point');
    }
}
