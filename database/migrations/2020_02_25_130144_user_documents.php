<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userDocuments', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('verify')->nullable()->default(1);

            //1.ЕГРИП
            $table->string('egrip');
            //2.ИНН
            $table->string('inn');
            //3.ЕГРИП выписка
            $table->string('egrip_vipiska');
            //4.Паспортные данные ИП
            $table->string('ip_pass_1');
            $table->string('ip_pass_2');
            $table->string('ip_pass_3');
            //5.Форма контрагента
            $table->string('contragent_card');
            //6.Права на владение
            $table->string('ownership_1');
            $table->string('ownership_2');
            $table->string('ownership_3');
            //7.Водительское удостоверение
            $table->string('driverpass');
            //8.Паспорт удостоверяющий личность водителя
            $table->string('driver_pass_1');
            $table->string('driver_pass_2');
            $table->string('driver_pass_3');
            //9.Список автотранспорта
            $table->string('cars_list');
            //10.Согласие на обработку персональных данных
            $table->string('pers_data');
            //11.Сведения о застрахованных лицах
            $table->string('insured_persons');
            //12.Штатное расписание (на водителей)
            $table->string('staff_list');
            //13.Трудовые договоры с водителями
            $table->string('employment_contract');
            //14.Расчет сумм налога на доходы физ.лиц
            $table->string('tax_amounts');
            //15.Гарантийное письмо
            $table->string('guarantee_letter');

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
        Schema::dropIfExists('userDocuments');
    }
}
