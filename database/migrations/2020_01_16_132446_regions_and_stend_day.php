<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RegionsAndStendDay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {

            $table->integer('stand_day')->nullable();
            $table->integer('exporter_id')->nullable();

          });

          Schema::dropIfExists('regions');

          Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('code')->nullable();
            $table->string('name');
            $table->string('type');
            $table->string('kladr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function ($table) {

            $table->dropColumn('stend_day');

          });

          Schema::dropIfExists('regions');
    }
}
