<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserIdAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('answers', function ($table) {

            $table->float('cost')->nullable()->change();
            $table->float('difference')->nullable()->change();
            $table->dropColumn('name');
            $table->integer('status')->default(0);
            $table->integer('user_id')->after('application_id');

          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function ($table) {
            $table->string('name')->nullable();
            $table->dropColumn('user_id');
            $table->float('cost')->change();
            $table->float('difference')->change();
        });

    }
}
