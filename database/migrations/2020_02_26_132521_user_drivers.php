<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userDrivers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('verify')->nullable()->default(1);
            $table->string('name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->string('phone');

            $table->string('drive_front');
            $table->string('drive_back');

            $table->string('passport_front');
            $table->string('passport_back');


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
        Schema::dropIfExists('userDrivers');
    }
}
