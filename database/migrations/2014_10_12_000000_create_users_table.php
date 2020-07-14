<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('label');
            $table->boolean('allow_register')->nullable();
        });


        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->string('org')->nullable();
            $table->string('phone')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('skype')->unique()->nullable();
            $table->string('inn')->unique()->nullable();
            $table->boolean('work_with_nds')->nullable();
            $table->boolean('super_user')->nullable();
            $table->boolean('active')->default(false);
            $table->integer('group_id')->unsigned();
            $table->string('photo')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable(); // дата подтверждения номера
            $table->string('phone_verified_code')->nullable(); // код подтверждения
            $table->timestamp('phone_verified_code_time')->nullable(); //дата отправки sms
            $table->string('password');
            $table->timestamp('password_update')->nullable(); //дата отправки sms
            $table->boolean('to_edit_profile')->nullable(); // При необходимости отправить на страницу редактирования профиля
            $table->float('rating')->nullable();
            $table->timestamp('rating_update')->nullable(); //дата обновления рейтинга
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('sequre_ip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip');
            $table->timestamp('password_reset')->nullable();
            $table->timestamp('auth_login')->nullable();
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
        Schema::dropIfExists('user_groups');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sequre_ip');
    }
}
