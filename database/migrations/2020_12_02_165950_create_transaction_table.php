<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->ID();
            $table->integer('Connector_ID');
            $table->integer('CP_ID');
            $table->integer('CS_ID');
            $table->string('User_ID');
            $table->string('Reservation_ID');
            $table->dateTime('Trans_DateTime');
            $table->integer('Trans_Meter_Start');
            $table->integer('Trans_Meter_Stop');
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
        Schema::dropIfExists('transaction_data');
    }
}
