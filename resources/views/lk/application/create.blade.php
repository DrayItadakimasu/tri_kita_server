@extends('layouts.lk')

@section('content')

    <div class="col middle-block">
        <section id="unloading">
            <div class="row messages">
                @if (session()->has('success'))
                    <div class="d-inline-flex alert success" id="popup_notification">
                        <strong>{{ session('success') }} </strong> <a class="open_application"
                                                                      href="{{ session('application_url') }}">Перейти к
                            заявке</a>
                    </div>
                @endif


                @if($errors->has('load_lat'))
                    <div class="alert fail" id="popup_notification">
                        <b>Ошибка получения данных:</b><br>
                        Обратите внимание что поля <b>"Населенный пункт погрузки"</b> <b>"Населенный пункт выгрузки"</b>
                        <b>"Место выгрузки" </b> <br>
                        в обязательном порядке должны быть заполнены путем выбора соответствующих адресов из выпадающего
                        списка<br>
                        <hr>
                        Попробуйте следующее: <br>
                        1. Начните вводить нужный адрес/населенный пункт/название организации <br>
                        2. Выберите из выпадающего списка нужный вариант
                        <hr>
                        <div style="font-size: 10px;">
                            @if($errors->has('load_lat')) {{ $errors->first('load_lat') }} <br> @endif
                            @if($errors->has('load_lon')) {{ $errors->first('load_lon') }} <br> @endif
                            @if($errors->has('unload_lat')) {{ $errors->first('load_lat') }} <br> @endif
                            @if($errors->has('unload_lon')) {{ $errors->first('unload_lon') }} <br> @endif
                        </div>
                    </div>
                @endif



                @if ($errors->all())
                    <div class="d0-inline-flex flex-wrap d-none">
                        @foreach ($errors->all() as $message)
                            <div>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <form id="create_application" action="{{ $action }}" method="{{ $method }}" class="row loading">
                @csrf
                <div class="col-xl-7">
                    <div class="form-card goods">
                        <p>
                            <img src="/img/1.png" alt="">
                            <span class="ml-2">Груз</span>
                        </p>
                        <div class="form-row">
                            <div class="col-xl-4 form-group mt-0">
                                <label for="culture">
                                    Культура
                                </label>
                                <select id="culture" class="load-redaction form-control" name="culture_id" type="text"
                                        required>
                                    <option value="">Выберите культуру</option>
                                    @foreach ($culture as $item)
                                        <option value="{{ $item->id }}"
                                                @if($item->id == old('culture_id')) selected @endif>{{ $item->name }}</option>
                                    @endforeach

                                </select>

                                @error('culture')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>



                            <div class="col-xl-4 form-group mt-0">

                                <label for="amount">
                                    Объем перевозки, тонн
                                </label>
                                <input id="amount" class="load-redaction form-control" name="amount" type="number"
                                       min="0"
                                       step="0.01"
                                       value="{{ old('amount') }}" required>

                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                            </div>
                            <div class="col-xl-4 form-group mt-0">

                                <label for="cost">
                                    Цена перевозки, руб/кг
                                </label>
                                <input id="cost" class="load-redaction form-control" name="cost" type="number" min="0"
                                       step="0.01"
                                       value="{{ old('cost') }}" required>

                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                                <div class="form-group price mt-1">

                                    <label class="checkbox-wrapper">
                                        <input type="checkbox">
                                        <span class="fake"></span>
                                        <span class="text">Без торга</span>
                                    </label>

                                    @error('without_tender')
                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-card">
                        <p>
                            <img src="/img/2.png" alt="">
                            <span class="ml-2">Погрузка и разгрузка</span>
                        </p>
                        <div class="form-row">
                            <div class="col-xl-4 mt-auto">
                                <div class="form-group">

                                    <label for="load-data-start">
                                        Дата начала погрузки
                                    </label>
                                    <input id="load-data-start" class="load-redaction form-control" name="date_start"
                                           onchange="correctDateEnd(this.value)" type="date"
                                           min="{{ date('Y-m-d') }}"
                                           max="{{ date('Y-m-d', time()+1209600) }}"
                                           value="@if(old('date_start')){{ old('date_start') }}@else{{ date('Y-m-d', time()+86400) }}@endif"
                                           required>

                                    @error('date_start')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">

                                    <label for="load-data-end">
                                        Дата закрытия получения заявок
                                    </label>
                                    <input id="load-data-end" class="load-redaction form-control" name="date_end"
                                           type="date"
                                           min="{{ date('Y-m-d', time()+86400) }}"
                                           max="{{ date('Y-m-d', time()+1209600) }}"
                                           value="@if(old('date_end')){{ old('date_end') }}@else{{ date('Y-m-d', time()+1209600) }}@endif"
                                           required>

                                    @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror


                                </div>
                            </div>
                            <div class="col-xl-4 mt-auto">
                                <div class="form-group">

                                    <label for="load-type">
                                        Способ погрузки
                                    </label>
                                    <select id="load-type" class="load-redaction form-control" name="loading_id"
                                            type="text"
                                            required>
                                        <option value="">Выберите способ погрузки</option>
                                        @foreach ($loading_type as $type)
                                            <option value="{{ $type->id }}"
                                                    @if($type->id == old('loading_id')) selected @endif>{{ $type->label }}</option>
                                        @endforeach
                                    </select>


                                    @error('loading_id')
                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">

                                    <label for="load-scale">
                                        Грузопдъемность весов, тонн
                                    </label>
                                    <input id="load-scale" class="load-redaction form-control" name="max_scale"
                                           type="number"
                                           min="0" step="0.01"
                                           value="{{ old('max_scale') }}" required>

                                    @error('max_scale')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">

                                    <label for="load-width">
                                        Длина весов на погрузке, м
                                    </label>
                                    <input id="load-width" class="load-redaction form-control" name="max_width"
                                           type="number"
                                           min="0" step="0.01"
                                           value="{{ old('max_width') }}" required>

                                    @error('max_width')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">

                                    <label for="load-height">
                                        Высота загрузки, м
                                    </label>
                                    <input id="load-height" class="load-redaction form-control" name="max_height"
                                           type="number"
                                           min="0"
                                           step="0.01"
                                           value="{{ old('max_height') }}" required>

                                    @error('max_height')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-xl-6 load-form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h2>
                                            Загрузка
                                        </h2>
                                        <div class="form-group">
                                            <label for="load-region">
                                                Регион погрузки
                                            </label>
                                            <select required id="load-region"
                                                    class="load-redaction select-region select-region-load form-control"
                                                    name="local_region"
                                                    type="text">
                                                <option value="">Выберите регион</option>
                                                @foreach ($regions as $item)
                                                    <option value="{{ $item->kladr }}"
                                                            @if($item->kladr == old('local_region')) selected @endif>{{ $item->name }} {{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                            @error('local_region')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 form-row">
                                        <div class="form-group col-xl-5">
                                            <div class="">
                                                <label for="load_address">
                                                    Населенный пункт
                                                </label>
                                                <input id="load_address" required data_value=""
                                                       @if(!old('load_full_address'))
                                                       @endif class="load-redaction form-control"
                                                       name="load_full_address"
                                                       value="{{ old('load_full_address') }}" type="text">
                                                <span id="load_area_label" class="input_info_area"></span>
                                                <input id="load_region" name="load_region" type="hidden"
                                                       value="{{ old('load_region') }}">
                                                <input id="load_region_code" name="load_region_code" type="hidden"
                                                       value="{{ old('load_region_code') }}">
                                                <input id="load_area" name="load_area" type="hidden"
                                                       value="{{ old('load_area') }}">
                                                <input id="load_area_code" name="load_area_code" type="hidden"
                                                       value="{{ old('load_area_code') }}">
                                                <input id="load_city" name="load_city" type="hidden"
                                                       value="{{ old('load_city') }}">
                                                <input id="load_city_code" name="load_city_code" type="hidden"
                                                       value="{{ old('load_city_code') }}">
                                                <input id="load_settlement" name="load_settlement" type="hidden"
                                                       value="{{ old('load_settlement') }}">
                                                <input id="load_settlement_code" name="load_settlement_code"
                                                       type="hidden"
                                                       value="{{ old('load_settlement_code') }}">
                                                <input id="load_street" name="load_street" type="hidden"
                                                       value="{{ old('load_street') }}">
                                                <input id="load_street_code" name="load_street_code" type="hidden"
                                                       value="{{ old('load_street_code') }}">
                                                <input id="load_house" name="load_house" type="hidden"
                                                       value="{{ old('load_house') }}">
                                                <input id="load_lat" name="load_lat" type="hidden"
                                                       value="{{ old('load_lat') }}">
                                                <input id="load_lon" name="load_lon" type="hidden"
                                                       value="{{ old('load_lon') }}">

                                                @error('load_full_address')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group col-xl-7">
                                            <div class="">

                                                <label for="load_place">
                                                    Место погрузки
                                                </label>
                                                <input id="load_place"
                                                       class="load-redaction load_place form-control" data_value=""
                                                       @if(!old('load_place'))  @endif name="load_place"
                                                       type="text"
                                                       value="{{ old('load_place') }}">

                                                @error('load_place')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="response-person">
                                                Отведственный представитель на загрузке
                                            </label>
                                            <input id="response-person" class="form-control"
                                                   @if(!old('response-person'))  @endif name="response-person"
                                                   type="text"
                                                   value="{{ old('response-person') }}">
                                            @error('response-person')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="response-person-phone">
                                                Телефон ответсвенного</label>
                                            <input id="response-person-phone" class="form-control"
                                                   @if(!old('response-person-phone'))  @endif name="response-person-phone"
                                                   type="text"
                                                   value="{{ old('response-person-phone') }}">
                                            @error('response-person-phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 unload-form">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h2>
                                            Разгрузка
                                        </h2>
                                        <div class="form-group">
                                            <label for="unload-region">
                                                Регион разгрузки
                                            </label>
                                            <select required id="unload-region"
                                                    class="load-redaction select-region select-region-load form-control"
                                                    name="local_region"
                                                    type="text">
                                                <option value="">Выберите регион</option>
                                                @foreach ($regions as $item)
                                                    <option value="{{ $item->kladr }}"
                                                            @if($item->kladr == old('local_region')) selected @endif>{{ $item->name }} {{ $item->type }}</option>
                                                @endforeach
                                            </select>
                                            @error('local_region')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12 form-row">
                                        <div class="form-group col-xl-5">
                                            <div class="">
                                                <label for="unload_address">
                                                    Населенный пункт
                                                </label>
                                                <input id="unload_address" required data_value=""
                                                       @if(!old('unload_full_address'))
                                                       @endif class="load-redaction form-control"
                                                       name="unload_full_address"
                                                       value="{{ old('unload_full_address') }}" type="text">
                                                <span id="unload_area_label" class="input_info_area"></span>
                                                <input id="unload_region" name="unload_region" type="hidden"
                                                       value="{{ old('unload_region') }}">
                                                <input id="unload_region_code" name="unload_region_code" type="hidden"
                                                       value="{{ old('unload_region_code') }}">
                                                <input id="ununload_area" name="unload_area" type="hidden"
                                                       value="{{ old('unload_area') }}">
                                                <input id="unload_area_code" name="unload_area_code" type="hidden"
                                                       value="{{ old('unload_area_code') }}">
                                                <input id="unload_city" name="unload_city" type="hidden"
                                                       value="{{ old('unload_city') }}">
                                                <input id="unload_city_code" name="unload_city_code" type="hidden"
                                                       value="{{ old('unload_city_code') }}">
                                                <input id="unload_settlement" name="unload_settlement" type="hidden"
                                                       value="{{ old('unload_settlement') }}">
                                                <input id="unload_settlement_code" name="unload_settlement_code"
                                                       type="hidden"
                                                       value="{{ old('unload_settlement_code') }}">
                                                <input id="unload_street" name="unload_street" type="hidden"
                                                       value="{{ old('unload_street') }}">
                                                <input id="unload_street_code" name="unload_street_code" type="hidden"
                                                       value="{{ old('unload_street_code') }}">
                                                <input id="unload_house" name="unload_house" type="hidden"
                                                       value="{{ old('unload_house') }}">
                                                <input id="unload_lat" name="unload_lat" type="hidden"
                                                       value="{{ old('unload_lat') }}">
                                                <input id="unload_lon" name="unload_lon" type="hidden"
                                                       value="{{ old('unload_lon') }}">

                                                @error('unload_full_address')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="form-group col-xl-7">
                                            <div class="">

                                                <label for="unload_place">
                                                    Место погрузки
                                                </label>
                                                <input id="unload_place"
                                                       class="load-redaction load_place form-control" data_value=""
                                                       @if(!old('load_place'))  @endif name="lunoad_place"
                                                       type="text"
                                                       value="{{ old('unload_place') }}">

                                                @error('unload_place')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="response-person-unload">
                                                Отведственный представитель на разгрузке
                                            </label>
                                            <input id="response-person-unload" class="form-control"
                                                   @if(!old('response-person-unload'))  @endif name="response-person-unload"
                                                   type="text"
                                                   value="{{ old('response-person-unload') }}">
                                            @error('response-person-unload')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="form-group">
                                            <label for="response-person-unload-phone">
                                                Телефон ответсвенного</label>
                                            <input id="response-person-unload-phone" class="form-control"
                                                   @if(!old('response-person-unload-phone'))  @endif name="response-person-unload-phone"
                                                   type="text"
                                                   value="{{ old('response-person-unload-phone') }}">
                                            @error('response-person-unload-phone')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="form-card other-info">
                        <p>
                            <img src="/img/3.png" alt="">
                            <span class="ml-2">Дополнительные условия</span>
                        </p>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="type-transport">
                                    Тип транспорта
                                </label>
                                <input id="type-transport" class="load-redaction form-control" name="type-transport"
                                       type="text"

                                       value="{{ old('type-transport') }}" required>

                                @error('type-transport')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-xl-4">
                                <label for="max_shortage">
                                    Норма естественной убыли
                                </label>
                                <input id="max_shortage" class="load-redaction form-control" name="max_shortage"
                                       type="number"
                                       min="0" step="0.01"
                                       value="{{ old('max_shortage') }}" required>

                                @error('max_shortage')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group col-xl-2">
                                <label for="max_shortage_val">
                                    % или кг
                                </label>
                                <input id="max_shortage_val" class="load-redaction form-control" name="max_shortage_val"
                                       type="text"
                                       value="{{ old('max_shortage_val') }}" required>

                                @error('max_shortage_val')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="dayly_norm">
                                    Суточная норма отгрузки, тонн</label>
                                <input id="dayly_norm" class="form-control"
                                       @if(!old('dayly_norm'))  @endif name="dayly_norm"
                                       type="text"
                                       value="{{ old('dayly_norm') }}">
                                @error('dayly_norm')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-xl-1">
                                <label for="stand">&nbsp;</label>
                                <div class="col-xl-1">
                                    <input id="stand" class="form-control"
                                           @if(!old('stand'))  @endif name="stand"
                                           type="text"
                                           value="{{ old('stand') }}">
                                </div>
                                @error('stand')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group-2 mt-4 pt-2 ml-2">
                                <label for="stand">
                                    Простой транспорта
                                </label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="f-width" for="information">
                                <span>Дополнительное описание</span>
                            </label>
                            <textarea id="information" class="load-redaction big-input form-control" name="information"
                                      type="text"
                            >@if(old('information')){{ old('information') }}@elseif(Auth::user()->text_info){{ Auth::user()->text_info->text }}@endif</textarea>

                            @error('information')
                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                            @enderror

                        </div>
                        <label class="checkbox-wrapper">
                            <input type="checkbox">
                            <span class="fake"></span>
                            <span class="text">Сохранить описание</span>
                        </label>

                    </div>
                    <div class="form-card">
                        <p>
                            <img src="/img/4.png" alt="">
                            <span class="ml-2">Контакты менеджера</span>
                        </p>
                        <div class="form-group">
                            <label for="name-manager">
                                ФИО</label>
                            <input id="name-manager" class="form-control"
                                   @if(!old('name-manager'))  @endif name="name-manager"
                                   type="text"
                                   value="{{ old('name-manager') }}">
                            @error('name-manager')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xl-6">
                                <label for="email-manager">
                                    Email</label>
                                <input id="email-manager" class="form-control"
                                       @if(!old('email-manager'))  @endif name="email-manager"
                                       type="text"
                                       value="{{ old('email-manager') }}">
                                @error('email-manager')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-xl-6">
                                <label for="number-manager">
                                    Телефон</label>
                                <input id="number-manager" class="form-control"
                                       @if(!old('number-manager'))  @endif name="number-manager"
                                       type="text"
                                       value="{{ old('number-manager') }}">
                                @error('number-manager')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-2 float-right">
                        <button type="submit" class="send-form p-3">Подать заявку</button>
                    </div>
                </div>

            </form>
        </section>
    </div>






@endsection
