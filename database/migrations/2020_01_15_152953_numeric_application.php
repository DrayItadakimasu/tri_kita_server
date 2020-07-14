<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NumericApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function ($table) {

            $table->float('distance')->change();
            $table->float('max_scale')->change();
            $table->float('max_shortage')->change();
            $table->float('cost')->change();
            $table->float('amount')->change();

          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->string('distance')->change();
        $table->string('max_scale')->change();
        $table->string('max_shortage')->change();
        $table->string('cost')->change();
        $table->string('amount')->change();
    }
}
