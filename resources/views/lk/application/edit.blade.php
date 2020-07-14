@extends('layouts.lk')

@section('content')



    <section id="unloading">
        <div class="container request">

            <div class="row request-row justify-content-between">
                <div class="reg-txt"><a class="text-white"
                                        href="{{ route('show.application',$application->id) }}">Назад</a> |
                    Редактироваие заявки №{{$application->id}}</div>
                <div class="bucket-cont d-flex">
                    <a class="trash-but" href="{{route('edit.application', $application->id )}}">
                        <div class="reg-txt"><img src="/assets/img/trash-white.png"> Сбросить</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="container">

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

            <form action="{{ $action }}" method="{{ $method }}" class="row loading">
                @csrf


                <div class="col-lg-4 col-md-4 col-sm-7 col-10 d-flex load-input-col">

                    <div class="loading-input-container">

                        <label for="">
                            <span>Регион погрузки</span>

                            <select class="load-redaction select-region select-region-load" name="local_region"
                                    type="text">
                                <option value="">Выберите регион</option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item->kladr }}"
                                            @if($item->kladr == old('local_region')) selected @endif>{{ $item->name }} {{ $item->type }}</option>
                                @endforeach

                            </select>


                        </label>

                        @error('local_region')
                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                        @enderror

                    </div>


                    <div class="loading-input-container">

                        <label for="">
                            <span>Населенный пункт погрузки</span>
                            <input id="load_address" onchange="$('#load_full_addres_h').val(this.value); return true;"
                                   @if($application->load_full_address) disabled="1" @endif class="load-redaction"
                                   name="load_full_address" value="{{ $application->load_full_address }}" type="text"
                                   required>
                            <input type="hidden" name="load_full_address" id="load_full_addres_h"
                                   value="{{ $application->load_full_address }}">
                            <input id="load_region" name="load_region" type="hidden"
                                   value="{{ $application->load_region }}">
                            <input id="load_region_code" name="load_region_code" type="hidden"
                                   value="{{ $application->load_region_code }}">
                            <input id="load_area" name="load_area" type="hidden" value="{{ $application->load_area }}">
                            <input id="load_area_code" name="load_area_code" type="hidden"
                                   value="{{ $application->load_area_code }}">
                            <input id="load_city" name="load_city" type="hidden" value="{{ $application->load_city }}">
                            <input id="load_city_code" name="load_city_code" type="hidden"
                                   value="{{ $application->load_city_code }}">
                            <input id="load_settlement" name="load_settlement" type="hidden"
                                   value="{{ $application->load_settlement }}">
                            <input id="load_settlement_code" name="load_settlement_code" type="hidden"
                                   value="{{ $application->load_settlement_code }}">
                            <input id="load_street" name="load_street" type="hidden"
                                   value="{{ $application->load_street }}">
                            <input id="load_street_code" name="load_street_code" type="hidden"
                                   value="{{ $application->load_street_code }}">
                            <input id="load_house" name="load_house" type="hidden"
                                   value="{{ $application->load_house}}">
                            <input id="load_lat" name="load_lat" type="hidden" value="{{ $application->load_lat }}">
                            <input id="load_lon" name="load_lon" type="hidden" value="{{ $application->load_lon }}">
                        </label>

                        @error('load_full_address')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                    </div>

                    <div class="loading-input-container">

                        <label for="">
                            <span>Место погрузки</span>
                            <input id="load_place" class="load-redaction load_place" disabled="1" name="load_place"
                                   type="text" value="{{ $application->load_place }}">
                        </label>

                        @error('load_place')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="loading-input-container">

                        <label for="">
                            <span>Регион выгрузки</span>

                            <select class="load-redaction select-region select-region-unload" name="local_region_unload"
                                    type="text">
                                <option value="">Выберите регион</option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item->kladr }}"
                                            @if($item->kladr == old('local_region')) selected @endif>{{ $item->name }} {{ $item->type }}</option>
                                @endforeach

                            </select>


                        </label>

                        @error('local_region')
                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                        @enderror

                    </div>

                    <div class="loading-input-container">

                        <label for="">
                            <span>Населенный пункт выгрузки</span>

                            <input id="unload_address" class="load-redaction"
                                   onchange="$('#load_full_addres_h').val(this.value); return true;" disabled="1"
                                   name="unload_full_address" type="text"
                                   value="{{ $application->unload_full_address }}" required>
                            <input type="hidden" name="unload_full_address" id="unload_full_addres_h"
                                   value="{{ $application->unload_full_address }}">
                            <input id="unload_region" name="unload_region" type="hidden"
                                   value="{{ $application->unload_region }}">
                            <input id="unload_region_code" name="unload_region_code" type="hidden"
                                   value="{{ $application->unload_region_code }}">
                            <input id="unload_area" name="unload_area" type="hidden"
                                   value="{{ $application->unload_area }}">
                            <input id="unload_area_code" name="unload_area_code" type="hidden"
                                   value="{{ $application->unload_area_code }}">
                            <input id="unload_city" name="unload_city" type="hidden"
                                   value="{{ $application->unload_city }}">
                            <input id="unload_city_code" name="unload_city_code" type="hidden"
                                   value="{{ $application->unload_city_code }}">
                            <input id="unload_settlement" name="unload_settlement" type="hidden"
                                   value="{{ $application->unload_settlement }}">
                            <input id="unload_settlement_code" name="unload_settlement_code" type="hidden"
                                   value="{{ $application->unload_settlement_code }}">
                            <input id="unload_street" name="unload_street" type="hidden"
                                   value="{{ $application->unload_street }}">
                            <input id="unload_street_code" name="unload_street_code" type="hidden"
                                   value="{{ $application->unload_street_code }}">
                            <input id="unload_house" name="unload_house" type="hidden"
                                   value="{{ $application->unload_house}}">
                            <input id="unload_lat" name="unload_lat" type="hidden"
                                   value="{{ $application->unload_lat }}">
                            <input id="unload_lon" name="unload_lon" type="hidden"
                                   value="{{ $application->unload_lon }}">
                        </label>

                        @error('unload_full_address')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>

                    <div class="loading-input-container">

                        <label for="">
                            <span>Место выгрузки</span>
                            <input id="unload_place" class="load-redaction unload_place" disabled="1"
                                   name="unload_place" type="text" value="{{ $application->unload_place }}">
                        </label>

                        @error('unload_place')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror


                    </div>


                    <div class="loading-input-container">

                        <label for="">
                            <span>Расстояние, км (Апелляция к авторасчету)</span>
                            <input class="load-redaction" id="distance" name="distance" type="number" min="0"
                                   step="0.01" value="{{ $application->distance }}" required>
                        </label>

                        @error('distance')
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror

                    </div>

                    <div class="loading-input-container">

                        <label for="">
                            <span>Допустимая недостача % или КГ.</span>
                            <input class="load-redaction" name="max_shortage" type="number" min="0" step="0.01"
                                   value="{{ $application->max_shortage }}" required>
                        </label>

                        @error('max_shortage')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>


                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-12 load-input-col">
                    <div class="row center-row">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-10 center-col">


                            <div class="loading-input-container">

                                <label for="">
                                    <span>Экспортер</span>
                                    <select class="load-redaction" name="exporter" type="text">

                                        <option value="">Выберите экспортера</option>
                                        @foreach ($exporters as $item)
                                            <option value="{{ $item->id }}"
                                                    @if($item->id == $application->exporter_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach

                                    </select>

                                </label>
                                <a class="form_link" onclick="$('#add_exporter').show(500)" href="#add_exporter">Добавить
                                    экспортера</a>

                                <div id="add_exporter" class="add_exporter hide">

                                    <span>Введите наименование организации (экспортера) </span>
                                    <input class="load-redaction" id="new_exporter" type="text" name="new_exporter">

                                </div>

                                @error('new_exporter')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                                @error('exporter')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="loading-input-container">

                                <label for="">
                                    <span>Культура</span>
                                    <select class="load-redaction" name="culture_id" type="text" required>
                                        <option value="">Выберите культуру</option>
                                        @foreach ($culture as $item)
                                            <option value="{{ $item->id }}"
                                                    @if($item->id == $application->culture_id) selected @endif>{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                </label>

                                @error('culture')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="loading-input-container">

                                <label for="">
                                    <span>Дата начала погрузки </span>
                                    <input class="load-redaction" onchange="correctDateEnd(this.value)"
                                           name="date_start" max="{{ date('Y-m-d', time()+1209600) }}" type="date"
                                           value="{{ $application->date_start->format('Y-m-d') }}" required>
                                </label>

                                @error('date_start')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="loading-input-container">

                                <label for="">
                                    <span>Дата закрытия получения заявок</span>
                                    <input class="load-redaction" name="date_end" type="date" min="{{ date('Y-m-d') }}"
                                           max="{{ date('Y-m-d', time()+1209600) }}"
                                           value="{{ $application->date_end->format('Y-m-d') }}" required>
                                </label>

                                @error('date_end')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror


                            </div>


                            <div class="loading-input-container">

                                <label for="">
                                    <span>Способ погрузки</span>

                                    <select class="load-redaction" name="loading_id" type="text" required>
                                        <option value="">Выберите способ погрузки</option>
                                        @foreach ($loading_type as $type)
                                            <option value="{{ $type->id }}"
                                                    @if($type->id == $application->loading_id ) selected @endif>{{ $type->label }}</option>
                                        @endforeach
                                    </select>

                                </label>

                                @error('loading_id')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                            </div>

                            <div class="loading-input-container">
                                <br>
                                <label class="d-flex" for="">

                                    <span>Разрешить перевозчикам звонить <br> на мой номер</span>
                                    <label class="radio disp-inl" style="width: auto;">
                                        <input name="allow_call_me" type="checkbox" value="1"
                                               @if($application->allow_call_me) checked="" @endif>
                                        <div class="radio__text disp-inl"></div>
                                    </label>

                                </label>

                                @error('allow_call_me')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>


                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-7 col-10">

                            <div class="loading-input-container">

                                <label for="">
                                    <span>Цена перевозки, руб/кг</span>
                                    <input class="load-redaction" name="cost" type="number" min="0" step="0.01"
                                           value="{{ $application->cost }}" required>
                                </label>

                                @error('cost')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                            </div>


                            <div class="loading-input-container">

                                <label class="d-flex" for="">
                                    <span>Без торга</span>
                                    <label class="radio disp-inl" style="width: auto;">
                                        <input name="without_tender" type="checkbox" value="1"
                                               @if($application->without_tender == 1) checked="" @endif >
                                        <div class="radio__text disp-inl"></div>
                                    </label>
                                </label>

                                @error('without_tender')
                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                @enderror

                            </div>


                            <div class="loading-input-container">

                                <label for="">
                                    <span>Объем перевозки, тонн</span>
                                    <input class="load-redaction" name="amount" type="number" min="0" step="0.01"
                                           value="{{ $application->amount }}" required>
                                </label>

                                @error('amount')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror

                            </div>


                            <div class="loading-input-container">

                                <label for="">
                                    <span>Грузоподъемность весов на погрузке, тонн</span>
                                    <input class="load-redaction" name="max_scale" type="number" min="0" step="0.01"
                                           value="{{ $application->max_scale }}" required>
                                </label>

                                @error('max_scale')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>


                            <div class="loading-input-container">

                                <label for="">
                                    <span>Простой</span>
                                    <input class="load-redaction" name="stand" type="text"
                                           value="{{ $application->stand }}" placeholder="Как оплачиваете простой">
                                </label>


                                @error('stand')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>

                            <div class="loading-input-container">

                                <label for="">
                                    <span>С какого дня оплата простоя?</span>
                                    <input class="load-redaction" name="stand_day" type="number" min="1" max="10"
                                           step="1" placeholder="от 1 до 10" value="{{ $application->stand_day }}">
                                </label>

                                @error('stand_day')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror

                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="loading-input-container">

                                <label class="f-width" for="">
                                    <span>Дополнительное описание</span>
                                    <textarea class="load-redaction big-input" name="information" type="text"
                                              placeholder="Укажите важную информацию по перевозке">{{ $application->information }}</textarea>
                                </label>

                                @error('information')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror


                            </div>
                            <div class="loading-btn-container">
                                <label class="blue-but-sub" for="">
                                    <div class="blue-big-cont">
                                        <input class="blue-big-btn" type="submit" value="Отправить">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
    </section>







@endsection
