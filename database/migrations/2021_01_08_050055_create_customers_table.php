<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('Id');
            $table->integer('User_ID');
            $table->integer('User_Type');
            $table->string('User_Name');
            $table->string('User_Mobile');
            $table->string('Username')->nullable();
            $table->string('User_Password')->nullable();
            $table->string('User_Address');
            $table->integer('User_Pin');
            $table->string('User_State');
            $table->string('User_District');
            $table->string('Status');
            // $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
}
