@extends('layouts.lk')

@section('content')
    <div class="col middle-block">
        <div class="row messages">
            @if (isset($message))
                <div class="d-inline-flex" id="popup_notification">
                    <strong>{{ $message }} </strong>
                </div>
            @endif
        </div>
        <form action="{{ $action }}" method="{{ $method }}" class="row" enctype="multipart/form-data">
            @csrf
            <div class="col-xl-7 pr-0">
                <div class="form-card main-settings">
                    <p class="goods-header">
                        <img src="/img/1.png" alt="">
                        <span class="">Основное</span>
                    </p>
                    <div class="form-row">
                        <div class="col-xl-2 form-group">
                                <img
                                    src="/{{ isset($profile->photo) ? $profile->photo : 'img/photo-camera.png' }}"
                                    class="user-photo" alt="">
                        </div>
                        <div class="col-xl-2 form-group mb-auto">
                            <input type="file" accept=".jpg, .jpeg, .png" title=" " class="form-control-file"
                                   id="photo">
                        </div>
                        <div class="col-xl-8">
                            <div class="form-row">
                                <div class="col-xl-6 form-group">
                                    <label for="last_name">
                                        Фамилия
                                    </label>
                                    <input id="last_name" class="user-redaction form-control" name="last_name"
                                           type="text"
                                           value="@if($profile->last_name){{$profile->last_name}}@endif">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="user_redaction">
                                        Имя
                                    </label>
                                    <input id="user_redaction" class="user-redaction form-control" name="name"
                                           type="text" value="{{ $profile->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="middle_name">
                                        Отчество
                                    </label>
                                    <input id="middle_name" class="user-redaction form-control" name="middle_name"
                                           type="text"
                                           value="{{ $profile->middle_name }}">
                                    @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="org">
                                        Название организации
                                    </label>
                                    <input id="org" class="user-redaction form-control" name="org" type="text"
                                           value="{{ $profile->org }}">
                                    @error('org')
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-card contacts_prop">
                    <p class="goods-header">
                        <img src="/img/2.png" alt="">
                        <span class="">Контакты и реквезиты</span>
                    </p>
                    <div class="form-row">
                        <div class="col-xl-4 form-group">
                            <label for="phone">
                                Телефон
                            </label>
                            <input id="phone" class="user-redaction form-control" name="phone" type="text"
                                   value="{{ $profile->phone }}"
                                   placeholder="+7">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-xl-4 form-group">
                            <label for="email">
                                Email
                            </label>
                            <input id="email" class="user-redaction form-control" name="email" type="text"
                                   value="{{ $profile->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-xl-4 form-group">
                            <label for="reg_adress">
                                Адрес регистрации:
                            </label>
                            <input id="reg_adress" id="reg_address" type="text"
                                   class="default-address user-redaction form-control @error('reg_address') is-invalid @enderror"
                                   name="reg_address" value="{{ $profile->reg_address }}" required>
                            @error('reg_address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-card change-password">
                    <p class="goods-header">
                        <img src="/img/3.png" alt="">
                        <span class="">Изменить пароль</span>
                    </p>
                    <div class="form-row">
                        <div class="col-xl-4 form-group">
                            <label for="">
                                Старый пароль
                            </label>
                            <input class="user-redaction form-control" name="old_password" type="text">

                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-xl-4 form-group">
                            <label for="">
                                Новый пароль
                            </label>
                            <input class="user-redaction form-control" name="password" type="text">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-xl-4 form-group">
                            <label for="">
                                Повторите новый пароль
                            </label>
                            <input class="user-redaction form-control" name="password_confirmation" type="text">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="form-card">
                    <p class="goods-header">
                        <img src="/img/4.png" alt="">
                        <span class="">Уведомления</span>
                    </p>
                    <div class="load_form">
                        <form class="subscribe_form" id="subscribe_load"
                              action="{{ route('store.load.subscribtion', ['user_id' => $profile->id ]) }}"
                              method="post">
                            @csrf
                            <h2 class="load-loc">Место погрузки</h2>
                            <div class="form-row">
                                <div class="col-xl-6 form-group">
                                    <label for="subscribe_load_region">
                                        Регион
                                    </label>
                                    <input id="subscribe_load_region" class="user-redaction form-control"
                                           name="load_region"
                                           type="text">

                                    @error('load_region')
                                    <span class="invalid-feedback" role="alert">
                                            <strong> {{ $message }} </strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="subscribe_load_area">
                                        Населенный пункт
                                    </label>
                                    <input id="subscribe_load_area" class="user-redaction form-control" name="load_area"
                                           type="text">
                                    @error('load_area')
                                    <span class="invalid-feedback" role="alert">
                                            <strong> {{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @foreach ( $subscriptionLoad as $subscribe )

                                <div class="check-1 d-flex w-100">
                                    <label>{{ $subscribe->Adress }}</label>

                                    <input type="checkbox" name="del-subscr" data-subscribe-id="{{$subscribe->id}}"
                                           class="del-subscr toggle" data-user-id="{{$profile->id}}"
                                           data-subscribe-type="load" id="toggle{{$subscribe->id}}"
                                           @if($subscribe->active) checked @endif>
                                    <label for="toggle{{$subscribe->id}}">
                                    </label>
                                    <form
                                        action="{{ route('destroy.subscribtion', ['user_id'=>$subscribe->user_id, 'type'=>'load', 'id' => $subscribe->id ]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-del-link">Удалить подписку
                                        </button>
                                    </form>
                                </div>

                            @endforeach
                            <div class="row justify-content-end">
                                <input class="btn btn-link" type="submit" name="subscr"
                                       value="Добавить подписку">
                            </div>
                        </form>
                    </div>
                    <div class="unload_form">
                        <form class="subscribe_form" id="subscribe_load"
                              action="{{ route('store.load.subscribtion', ['user_id' => $profile->id ]) }}"
                              method="post">
                            @csrf
                            <h2 class="load-loc">Место разгрузки</h2>
                            <div class="form-row">
                                <div class="col-xl-6 form-group">
                                    <label for="subscribe_unload_region">
                                        Регион
                                    </label>
                                    <input id="subscribe_unload_region" class="user-redaction form-control"
                                           name="unload_region"
                                           type="text">

                                    @error('load_region')
                                    <span class="invalid-feedback" role="alert">
                                            <strong> {{ $message }} </strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="col-xl-6 form-group">
                                    <label for="subscribe_unload_area">
                                        Населенный пункт
                                    </label>
                                    <input id="subscribe_unload_area" class="user-redaction form-control"
                                           name="unload_area"
                                           type="text">
                                    @error('load_area')
                                    <span class="invalid-feedback" role="alert">
                                            <strong> {{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @foreach ( $subscriptionUnload as $subscribe )

                                <div class="check-1 d-flex w-100">
                                    <label>{{ $subscribe->Adress }}</label>

                                    <input type="checkbox" name="del-subscr" data-subscribe-id="{{$subscribe->id}}"
                                           class="del-subscr toggle" data-user-id="{{$profile->id}}"
                                           data-subscribe-type="unload" id="toggle-unload{{$subscribe->id}}"
                                           @if($subscribe->active) checked @endif>
                                    <label for="toggle-unload{{$subscribe->id}}">
                                    </label>
                                    <form
                                        action="{{ route('destroy.subscribtion', ['user_id'=>$subscribe->user_id, 'type'=>'load', 'id' => $subscribe->id ]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-del-link">Удалить подписку
                                        </button>
                                    </form>
                                </div>

                            @endforeach
                            <div class="row justify-content-end">
                                <input class="btn btn-link" type="submit" name="subscr"
                                       value="Добавить подписку">
                            </div>
                        </form>
                    </div>
                    <div class="profile-bottom-container w-100">

                        <div class="check-1 d-flex w-100">
                            <label>Уведомлять о всех заявках на сайте</label>
                            <input data-id="{{ $profile->id }}" data-setting="n_new_app"
                                   class="user_settings_checkbox toggle"
                                   id="n-all" name="push-all" type="checkbox" @if($profile->n_new_app) checked @endif>
                            <label for="n-all"></label>
                        </div>
                        <div class="check-1 d-flex w-100">
                            <label>Уведомлять об ответах водителей на мои заявки</label>
                            <input data-id="{{ $profile->id }}" data-setting="n_answer_approve"
                                   class="user_settings_checkbox toggle" id="n-driver" name="push-driver"
                                   type="checkbox"
                                   @if($profile->n_answer_approve) checked @endif>
                            <label for="n-driver"></label>
                        </div>

                        <div class="check-1 d-flex w-100">
                            <label>Уведомлять об одобрении заявки</label>
                            <input data-id="{{ $profile->id }}" data-setting="n_new_answer" id="push_unload"
                                   class="user_settings_checkbox toggle" name="push-unload" type="checkbox"
                                   @if($profile->n_new_answer) checked @endif>
                            <label for="push_unload"></label>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end p-0">
                    <button class="edit-submit text-center text-white mr-3">
                        Сохранить все
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
