<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userDocuments', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('verify')->nullable()->default(1);
            
            $table->string('inn');
            $table->string('inn_image');
            $table->string('agency_name');
            $table->string('ogrn');
            $table->string('ogrn_image');
            $table->string('passport_series');
            $table->string('passport_number');
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
        Schema::dropIfExists('userDocuments');
    }
}
