<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions_load', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->string('load_region')->nullable();
            $table->string('load_area')->nullable();

            $table->timestamps();
        });

        Schema::create('subscriptions_unload', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->boolean('active')->default(true);
            
            $table->string('unload_region')->nullable();
            $table->string('unload_area')->nullable();
            $table->string('unload_settlement')->nullable();
            $table->string('unload_org')->nullable();

            $table->timestamps();
        });
        

        Schema::table('users', function ($table) {

            $table->boolean('n_answer_approve')->nullable()->default(true); // уведомлять о подтверждении водителя
            $table->boolean('n_new_answer')->nullable()->default(true); // уведомлять о новых ответах заказчика 

          });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions_load');
        Schema::dropIfExists('subscriptions_unload');

        Schema::table('users', function ($table) {
            $table->dropColumn('n_answer_approve');
            $table->dropColumn('n_new_answer');
        });

    }

}
