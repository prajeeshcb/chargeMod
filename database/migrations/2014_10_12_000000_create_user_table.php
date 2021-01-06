<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Users', function (Blueprint $table) {
            $table->increments('User_ID');
            $table->integer('User_Type');
            $table->string('User_Name');
            $table->integer('User_Mobile');
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
        Schema::dropIfExists('users');
    }
}
