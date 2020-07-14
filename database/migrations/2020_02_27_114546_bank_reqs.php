<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BankReqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userBankReqs', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('bik');
            $table->string('bank_name');
            $table->string('bank_account');
            $table->string('bank_account_number');
            

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
        Schema::dropIfExists('userBankReqs');
    }
}
