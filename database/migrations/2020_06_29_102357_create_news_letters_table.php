<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('type')->nullable();
            $table->boolean('allusers')->nullable();
            $table->text('users')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('url')->nullable();
            $table->text('params')->nullable();
            $table->integer('status')->nullable();
            $table->integer('success')->nullable();
            $table->integer('fails')->nullable();
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
        Schema::dropIfExists('newsletters');
    }
}
