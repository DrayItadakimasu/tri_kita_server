<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSaveDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('black_list', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id'); // Блокировщик
            $table->integer('blocked_id'); // Заблокированный
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('save_info_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->mediumText('text');
        });
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('black_list');
        Schema::dropIfExists('save_info_text');
    }
}
