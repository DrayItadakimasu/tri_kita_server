<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userCars', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('verify')->nullable()->default(1);
            $table->string('car_number');
            $table->string('sts_front');
            $table->string('sts_back');
            

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
        Schema::dropIfExists('userCars');
    }
}
