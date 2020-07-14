<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->integer('region_id');
            //$table->integer('settement_id');
            //$table->integer('unloading_id');

            // location load
            $table->string('load_full_address');
            $table->string('load_region');
            $table->string('load_area')->nullable();
            $table->string('load_city')->nullable();
            $table->string('load_settlement')->nullable();
            $table->string('load_street')->nullable();
            $table->string('load_house')->nullable();
            $table->double('load_lat', 15, 7);
            $table->double('load_lon', 15, 7);
            // location unload
            $table->string('unload_full_address');
            $table->string('unload_region');
            $table->string('unload_area')->nullable();
            $table->string('unload_city')->nullable();
            $table->string('unload_settlement')->nullable();
            $table->string('unload_street')->nullable();
            $table->string('unload_house')->nullable();
            $table->double('unload_lat', 15, 7);
            $table->double('unload_lon', 15, 7);;

            $table->integer('user_id');
            $table->integer('distance');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('max_scale');// груз. под. весов при погрузке
            $table->string('where_calc'); // Где расчет
            $table->integer('max_shortage');
            $table->integer('culture_id'); // Культура
            $table->integer('loading_id')->nullable(); // Способ загрузки
            $table->boolean('allow_call_me')->default(true)->nullable(); // Разрешить завонки
            $table->boolean('without_tender')->default(false)->nullable();
            $table->string('stand')->nullable(); // Простой
            $table->integer('cost'); // Цена перевозки
            $table->integer('amount'); // Объем перевозки тонн
            $table->mediumText('information')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
