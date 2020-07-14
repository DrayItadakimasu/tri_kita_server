@extends('layouts.lk')

@section('content')




    <section id="profile">
        <div class="container">

            <div class="row">

                @if (session()->has('subscribe_load_info'))
                    <div class="d-block alert success" id="popup_notification">
                        <strong> {{ session('subscribe_load_info') }} </strong>
                    </div>
                @endif

                @if (session()->has('subscribe_load_error'))
                    <div class="d-block alert fail" id="popup_notification">
                        <strong> {{ session('subscribe_load_error') }} </strong>
                    </div>
                @endif

                @if (session()->has('subscribe_unload_info'))
                    <div class="d-block alert success" id="popup_notification">
                        <strong> {{ session('subscribe_unload_info') }} </strong>
                    </div>
                @endif

                @if (session()->has('subscribe_unload_error'))
                    <div class="d-block alert fail" id="popup_notification">
                        <strong> {{ session('subscribe_load_error') }} </strong>
                    </div>
                @endif


            </div>

            <div class="row profile-info">


                @if(true)

                    <div class="row profile-info-bottom w-100">


                        <form class="subscribe_form" id="subscribe_load"
                              action="{{ route('store.load.subscribtion', ['user_id' => $profile->id ]) }}"
                              method="post">
                            @csrf


                            <div class="col-lg-12 add-pd-top">


                                <div class="profile-bottom-container  d-flex">
                                    <span>Уведомления</span>
                                    <span class="load-loc">Место погрузки</span>

                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Регион</span>
                                            <input id="subscribe_load_region" class="user-redaction" name="load_region"
                                                   type="text">
                                        </label>

                                        @error('load_region')
                                        <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                                        @enderror

                                    </div>
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Район</span>
                                            <input id="subscribe_load_area" class="user-redaction" name="load_area"
                                                   type="text" disabled="">
                                        </label>
                                        @error('load_area')
                                        <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="profile-input-container-btn flex-end no_padding pd-xs">
                                        <label class="blue-but-sub" for="">
                                            <div class="blue-big-cont">
                                                <input class="blue-big-btn" type="submit" name="subscr"
                                                       value="Подписаться">
                                            </div>
                                        </label>
                                    </div>
                        </form>
                        @foreach ( $subscriptionLoad as $subscribe )

                            <div class="check-1 d-flex w-100">
                                <label>{{ $subscribe->Adress }}</label>
                                <label class="switch">
                                    <input class="del-subscr" data-user-id="{{$profile->id}}" name="del-subscr"
                                           data-subscribe-id="{{$subscribe->id}}" data-subscribe-type="load"
                                           type="checkbox" @if($subscribe->active) checked @endif >
                                    <span class="slider round"></span>
                                </label>
                                <form
                                    action="{{ route('destroy.subscribtion', ['user_id'=>$subscribe->user_id, 'type'=>'load', 'id' => $subscribe->id ]) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="blue-link clear-button">Удалить подписку</button>
                                </form>
                            </div>

                        @endforeach


                    </div>
            </div>
        </div>

        <form class="subscribe_form" id="subscribe_unload"
              action="{{ route('store.unload.subscribtion', ['user_id' => $profile->id ]) }}" method="post">
            @csrf

            <div class="col-lg-12">

                <div class="profile-bottom-container d-flex">
                    <span class="unload-loc">Место выгрузки</span>

                    <div class="w-100 d-flex">
                        <div class="profile-input-container">
                            <label for="">
                                <span>Край</span>
                                <input id="subscribe_unload_region" class="user-redaction" name="unload_region"
                                       type="text">
                            </label>
                            @error('unload_region')
                            <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                            @enderror


                        </div>
                        <div class="profile-input-container">
                            <label for="">
                                <span>Район</span>
                                <input id="subscribe_unload_area" class="user-redaction" name="unload_area" type="text"
                                       disabled="">
                            </label>
                            @error('unload_area')
                            <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="profile-input-container">
                        <label for="">
                            <span>Населенный пункт</span>
                            <input id="subscribe_unload_settlement" class="user-redaction" name="unload_settlement"
                                   type="text" disabled="">
                        </label>
                        @error('unload_settlement')
                        <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="profile-input-container">
                        <label for="">
                            <span>Организация</span>
                            <input id="subscribe_unload_org" class="user-redaction" name="unload_org" type="text"
                                   disabled="">
                        </label>
                        @error('unload_org')
                        <span class="invalid-feedback" role="alert">
                                        <strong> {{ $message }} </strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="profile-input-container-btn flex-end no_padding pd-xs">
                        <label class="blue-but-sub" for="">
                            <div class="blue-big-cont">
                                <input class="blue-big-btn" type="submit" name="subscr" value="Подписаться">
                            </div>
                        </label>
                    </div>
        </form>
        @foreach ( $subscriptionUnload as $subscribe )

            <div class="check-1 d-flex w-100">
                <label>{{ $subscribe->Adress }}</label>
                <label class="switch">
                    <input class="del-subscr" data-user-id="{{$profile->id}}" name="del-subscr"
                           data-subscribe-id="{{$subscribe->id}}" data-subscribe-type="unload" type="checkbox"
                           @if($subscribe->active) checked @endif >
                    <span class="slider round"></span>
                </label>
                <form
                    action="{{ route('destroy.subscribtion', ['user_id'=>$subscribe->user_id, 'type'=>'unload', 'id' => $subscribe->id]) }}"
                    method="post">
                    @csrf
                    <button type="submit" class="blue-link clear-button">Удалить подписку</button>
                </form>
            </div>

            @endforeach

            </div>
            <div class="profile-bottom-container w-100">

                <div class="check-1 d-flex w-100">
                    <label>Уведомлять о всех заявках на сайте</label>
                    <label class="switch">
                        <input data-id="{{ $profile->id }}" data-setting="n_new_app" class="user_settings_checkbox"
                               id="n-all" name="push-all" type="checkbox" @if($profile->n_new_app) checked @endif >
                        <span class="slider round"></span>
                    </label>
                </div>
                @if(auth::user()->group->name=='customer' or auth::user()->group->name=='admin')
                    <div class="check-1 d-flex w-100">
                        <label>Уведомлять об ответах водителей на мои заявки</label>
                        <label class="switch">
                            <input data-id="{{ $profile->id }}" data-setting="n_answer_approve"
                                   class="user_settings_checkbox" id="n-driver" name="push-driver" type="checkbox"
                                   @if($profile->n_answer_approve) checked @endif >
                            <span class="slider round"></span>
                        </label>
                    </div>
                @endif

                @if(auth::user()->group->name=='driver' or auth::user()->group->name=='admin')
                    <div class="check-1 d-flex w-100">
                        <label>Уведомлять об одобрении заявки</label>
                        <label class="switch add-ml">
                            <input data-id="{{ $profile->id }}" data-setting="n_new_answer"
                                   class="user_settings_checkbox" name="push-unload" type="checkbox"
                                   @if($profile->n_new_answer) checked @endif>
                            <span class="slider round"></span>
                        </label>
                    </div>
                @endif

            </div>
            </div>



            @endif

            </div>
            </div>
    </section>

@endsection
