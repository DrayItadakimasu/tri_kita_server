<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoadAndUnloadPlace extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('applications', function ($table) {
    
                $table->string('load_place')->nullable();
                $table->string('unload_place')->nullable();
    
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
            $table->dropColumn('load_place');
            $table->dropColumn('unload_place');
          });
    }
}
