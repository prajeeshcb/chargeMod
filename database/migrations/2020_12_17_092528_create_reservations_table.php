<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->ID();
            $table->string('user_id');
            $table->integer('cs_id');
            $table->integer('ctype_digit(text)');
            $table->integer('connector_id');
            $table->dateTime('reserve_date');
            $table->dateTime('reserve_time_from');
            $table->dateTime('reserve_time_end');
            $table->string('reservation_id');
            $table->float('user_present_loc');
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
        Schema::dropIfExists('reservations');
    }
}
