<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnloadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloadings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('region_id');
            $table->string('name');
            $table->string('code');
            $table->string('city');
            $table->string('street');
            $table->string('build');
            $table->float('lat');
            $table->float('lon');
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
        Schema::dropIfExists('unloadings');
    }
}
