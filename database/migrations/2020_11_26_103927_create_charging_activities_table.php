<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargingActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charging_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('vehicle_tag_id'); // Column dropped.
            $table->integer('station_id');
            $table->integer('connector_id'); // Column dropped.
            $table->integer('reservation_id');
            $table->integer('meter_start_reading')->nullable();
            $table->integer('meter_end_reading')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('stopped_at')->nullable();
            $table->time('duration')->nullable();
            $table->boolean('status')->default(0); // Column dropped.
            $table->softDeletes();
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
        Schema::dropIfExists('charging_activities');
    }
}
