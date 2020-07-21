@extends('layouts.lk')


@section('content')
    <div id="user_docs_list" class="col middle-block">
        <div class="wrapper">
            <div class="row no-gutters">
                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>1</p>
                            </div>
                            <p class="text">
                                Свидетельство о гос.регистрации физического лица в качестве индивидуального
                                предпринимателя, либо Лист записи
                                ЕГРИП (внесения записи о приобритении физическим лицом статуса индивидуального
                                предпринимателя)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form  method="POST" id="egrip_upload" enctype="multipart/form-data"
                                                  action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#egrip_upload','#egrip','.egrip_value','.egrip_output')"
                                                        class="file_upload_input" type="file" id="egrip" name="egrip">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output egrip_output">
                                                <span class="egrip_value">file.jpg</span>
                                                <span class="remove-item"
                                                      onclick="clearInput('#egrip','.egrip_output')">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>2</p>
                            </div>
                            <p class="text">
                                Свидетельство о постановке на учет физического лица в налоговом органе
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form id="inn_form" enctype="multipart/form-data" method="POST" action="{{route('user.private.info', Auth::user()->id)}}">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#inn_form','#inn','#inn_value','.inn_output')"
                                                        name="inn" type="file" id="inn">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            @if(Auth::user()->documents)
                                            <p class="output inn_output show">
                                                <span id="inn_value">{{ Auth::user()->documents->inn}}</span>
                                                <a href="{{route('get.file',['user_id'=>Auth::user()->id,'type'=>'users_inn','file_id'=>Auth::user()->documents->inn])}}">123</a>
                                                <span class="remove-item ">&#10006;</span>
                                            </p>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>3</p>
                            </div>
                            <p class="text">
                                Выписка из ЕГРИП, выданная регистрирующим органом не ранее чем за 30 дней до заключения
                                договора
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" id="egrip_vipiska_form" method="POST" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#egrip_vipiska_form','#egrip_vipiska','.egrip_vipiska_output','.egrip_vipiska_output_container')"
                                                        type="file" id="egrip_vipiska" name="egrip_vipiska">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6 ">
                                            <p class="output egrip_vipiska_output_container">
                                                <span class="egrip_vipiska_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>4</p>
                            </div>
                            <p class="text">
                                Паспорт удостоверяющий личтость ИП (стр. 2-3, и раздел «место жительства)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ip_pass_1_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ip_pass_1_form','#ip_pass_1','.ip_pass_1_output','.ip_pass_1_output_container')"
                                                        id="ip_pass_1" type="file" name="ip_pass_1">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ip_pass_1_output_container">
                                                <span class="ip_pass_1_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ip_pass_2_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ip_pass_2_form','#ip_pass_2','.ip_pass_2_output','.ip_pass_2_output_container')"
                                                        id="ip_pass_2" type="file" name="ip_pass_2">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ip_pass_2_output_container">
                                                <span class="ip_pass_2_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ip_pass_3_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ip_pass_3_form','#ip_pass_3','.ip_pass_3_output','.ip_pass_3_output_container')"
                                                        id="ip_pass_3" type="file" name="ip_pass_3">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ip_pass_3_output_container">
                                                <span class="ip_pass_3_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>5</p>
                            </div>
                            <p class="text">
                                Карточка контрагента по форме приложения №1 к настоящему перечню
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="contragent_card_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#contragent_card_form','#contragent_card','.contragent_card_output','.contragent_card_output_container')"
                                                        type="file" id="contragent_card" name="contragent_card">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output contragent_card_output_container">
                                                <span class="contragent_card_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>6</p>
                            </div>
                            <p class="text">
                                Документы подтверждающие право собственности или владения транспортным(и) средством
                                (Свидетельством о регистрации транспортного средства, ПТС, договор аренды
                                транспортного средства либо договор безвозмездного пользования автомобиля, договор
                                лизинга)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ownership_form_1" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ownership_form_1','#ownership_1','.ownership_1_output','.ownership_1_output_container')"
                                                        type="file" id="ownership_1" name="ownership_1">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ownership_1_output_container">
                                                <span class="ownership_1_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ownership_form_2" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ownership_form_2','#ownership_2','.ownership_2_output','.ownership_2_output_container')"
                                                        type="file" id="ownership_2" name="ownership_2">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ownership_2_output_container">
                                                <span class="ownership_2_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="ownership_form_3" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#ownership_form_3','#ownership_3','.ownership_3_output','.ownership_3_output_container')"
                                                        type="file" id="ownership_3" name="ownership_3">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output ownership_3_output_container">
                                                <span class="ownership_3_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>7</p>
                            </div>
                            <p class="text">
                                Водительское удостоверение
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="driverpass_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#driverpass_form','#driverpass','.driverpass_output','.driverpass_output_container')"
                                                        type="file" id="driverpass" name="driverpass">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output driverpass_output_container">
                                               <span class="driverpass_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>
                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>8</p>
                            </div>
                            <p class="text">
                                Паспорт удостоверяющий личтость водителя (стр. 2-3, и раздел «место жительства)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="driver_pass_1_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#driver_pass_1_form','#driver_pass_1','.driver_pass_1_output','.driver_pass_1_output_container')"
                                                        type="file" id="driver_pass_1" name="driver_pass_1">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output driver_pass_1_output_container">
                                                <span class="driver_pass_1_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="driver_pass_2_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#driver_pass_2_form','#driver_pass_2','.driver_pass_2_output','.driver_pass_2_output_container')"
                                                        type="file" id="driver_pass_2" name="driver_pass_2">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output driver_pass_2_output_container">
                                                <span class="driver_pass_2_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="driver_pass_3_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#driver_pass_3_form','#driver_pass_3','.driver_pass_3_output','.driver_pass_3_output_container')"
                                                        type="file" id="driver_pass_3" name="driver_pass_3">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output driver_pass_3_output_container">
                                                <span class="driver_pass_3_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>9</p>
                            </div>
                            <p class="text">
                                Перечень автотранспорта
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="cars_list_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#cars_list_form','#cars_list','.cars_list_output','.cars_list_output_container')"
                                                        type="file" id="cars_list" name="cars_list">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output cars_list_output_container">
                                                <span class="cars_list_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>10</p>
                            </div>
                            <p class="text">
                                Согласие на обработку персональных данных, в соответствии с Федеральным законом "О персональных данных"
                                от 27.07.2006 г. №152-ФЗ
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="pers_data_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#pers_data_form','#pers_data','.pers_data_output','.pers_data_output_container')"
                                                        type="file" id="pers_data" name="pers_data">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output pers_data_output_container">
                                                <span class="pers_data_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>11</p>
                            </div>
                            <p class="text">
                               "Сведения о застрахованных лицах" - Отчет по форме СЗВ-М(ежемесячная отчетность в ПДФ для работадателей),
                                образец отчета Приложения №2 к настоящему перечню
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="insured_persons_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#insured_persons_form','#insured_persons','.insured_persons_output','.insured_persons_output_container')"
                                                        type="file" id="insured_persons" name="insured_persons">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output insured_persons_output_container">
                                                <span class="insured_persons_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>12</p>
                            </div>
                            <p class="text">
                                Штатное расписание(на водителей автотранспортных систем)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="staff_list_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#staff_list_form','#staff_list','.staff_list_output','.staff_list_output_container')"
                                                        type="file" id="staff_list" name="staff_list">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output staff_list_output_container">
                                                <span class="staff_list_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>13</p>
                            </div>
                            <p class="text">
                                Трудовые договоры с водителями автотранспорта (Копии)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="employment_contract_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#employment_contract_form','#employment_contract','.employment_contract_output','.employment_contract_output_container')"
                                                        type="file" id="employment_contract" name="employment_contract">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output employment_contract_output_container">
                                                <span class="employment_contract_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>14</p>
                            </div>
                            <p class="text">
                                Расчет сумм налога на доходы физических лиц, исчисленных и удержанных
                                налоговым агентом (форма 6-НДФЛ) ежеквартральная
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="tax_amounts_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#tax_amounts_form','#tax_amounts','.tax_amounts_output','.tax_amounts_output_container')"
                                                        type="file" id="tax_amounts" name="tax_amounts">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output tax_amounts_output_container">
                                                <span class="tax_amounts_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

                <div class="col-12 doc-item">
                    <div class="row m-0">
                        <div class="col-8 text-side">
                            <div class="num">
                                <p>15</p>
                            </div>
                            <p class="text">
                                Гарантийное письмо(по образцу согласно Приложения №2 к перечню) о представленнии ежеквартального Расчета
                                сумм налога на доходы физических лиц, исчисленных и удержанных налоговым агентом (форма 6-НДФЛ)
                            </p>
                        </div>
                        <div class="col-3">
                            <div class="row ">
                                <div class="col-12 doc-single-item m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <form enctype="multipart/form-data" method="POST" id="guarantee_letter_form" action="">
                                                @csrf
                                                <label class="file_input_wrap">
                                                    Загрузить
                                                    <input
                                                        onchange="submitForm('#guarantee_letter_form','#guarantee_letter','.guarantee_letter_output','.guarantee_letter_output_container')"
                                                        type="file" id="guarantee_letter" name="guarantee_letter">
                                                </label>
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <p class="output guarantee_letter_output_container">
                                                <span class="guarantee_letter_output">file.jpg</span>
                                                <span class="remove-item">&#10006;</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10 offset-1 line_bottom"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <style>
        .wrapper {
            margin-left: 15px;
            border-radius: 25px;
            background-color: rgb(255, 255, 255);
            width: 998px;
            padding-bottom: 15px;
            margin-bottom: 30px;
            max-width: 98%;

        }

        .file_input_wrap {
            font-size: 12px;

            color: rgb(92, 158, 255);
            text-decoration: underline;
            line-height: 1.2;
            margin-bottom: 0;
            cursor: pointer;
        }

        .file_input_wrap:hover {
            color: #3d537c;
        }

        .file_input_wrap input[type="file"] {
            display: none;
        }

        .doc-item {
            padding: 15px 30px;

        }

        .doc-item:first-child {
            padding-top: 30px;
        }

        .doc-item:last-child .line_bottom {
            display: none;
        }

        .text-side {
            padding-left: 30px;
        }

        #user_docs_list {

        }

        .doc-item .text-side {
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .doc-item .text-side p {
            margin-bottom: 0;
            font-size: 12px;

            color: rgb(50, 50, 50);
            line-height: 1.2;
        }

        .doc-item .text-side .num {
            padding: 15px;
            margin-right: 20px;
            border-radius: 50%;
            background-color: rgb(240, 243, 248);
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .doc-item .text-side .num p {
            font-size: 12px;
            color: rgb(179, 193, 219);
            line-height: 1.2;
            margin-bottom: 0;
        }

        .doc-item .line_bottom {
            margin-top: 30px;
            background-color: rgb(240, 243, 248);
            height: 1px;
        }

        .doc-item .output {
            display: none;
            padding-top: 7px;
            text-align: center;
            font-size: 12px;
            color: rgb(129, 129, 129);
            line-height: 1.2;
            text-align: left;
            margin-bottom: 0;
        }

        .doc-item .output.show {
            display: block;
        }

        .doc-item .remove-item {
            margin-left: 5px;
            cursor: pointer;
        }

        .doc-item .remove-item:hover {
            color: #3d537c;
        }
    </style>
    <script type="text/javascript">
        function submitForm(form, input, output, output_container) {
            let _form = document.querySelector(form);
            _inp = document.querySelector(input),
                _output = document.querySelector(output),
                _output_container = document.querySelector(output_container);

            if (_inp.value.length > 0) {
                _output.textContent = (_inp.files[0].name);
                _output_container.classList.add('show');
                _form.submit();
            } else {
                console.log('no value');
            }
        }

        function clearInput(input, output_container) {
            let _inp = document.querySelector(input),
                _out = document.querySelector(output_container);

            _inp.value = '';
            _out.classList.remove('show');
        }
    </script>

@endsection







