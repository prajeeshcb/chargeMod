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
            $table->string('User_ID');
            $table->integer('CS_ID');
            $table->integer('CP_ID');
            $table->dateTime('Reserve_Date');
            $table->dateTime('Reserve_Time_From');
            $table->dateTime('Reserve_Time_End');
            $table->string('Reservation_ID');
            $table->float('User_Present_Loc');
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
