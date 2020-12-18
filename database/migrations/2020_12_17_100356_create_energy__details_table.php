<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnergyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('energy__details', function (Blueprint $table) {
            $table->ID();
            $table->string('Energy_Unit');
            $table->integer('Total_Unit');
            $table->string('Energy_Provider');
            $table->dateTime('Date');
            $table->integer('Unit_Price');
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
        Schema::dropIfExists('energy__details');
    }
}
