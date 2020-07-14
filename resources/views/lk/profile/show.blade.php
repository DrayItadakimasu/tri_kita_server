@extends('layouts.lk')

@section('content')


    <section id="comment">

        <div class="container profile-three">
            <div class="row">
                @if (session()->has('success_main'))
                    <div class="d-inline-flex" id="popup_notification">
                        <strong>{{ session('success_main') }} </strong>
                    </div>
                @endif

                @if (session()->has('fail_main'))
                    <div class="d-inline-flex" id="popup_notification">
                        <strong>{{ session('fail_main') }} </strong>
                    </div>
                @endif


            </div>

            @if(Auth::user()->id == $profile->id)
                <div class="user-info show_app my_profile">
                    <a class="dropdown-item" href="{{ route('edit.user.profile', Auth::user()->id) }}">Изменить
                        профиль</a>
                    <a class="dropdown-item" href="{{ route('blacklist', Auth::user()->id) }}">Блокировки</a>
                    @if(Auth::user()->group->name == 'customer' || Auth::user()->group->name == 'admin') <a
                        class="dropdown-item" href="{{ route('my.application') }}/?status=active">Мои заявки</a> @endif
                    @if(Auth::user()->group->name == 'customer' || Auth::user()->group->name == 'admin') <a
                        class="dropdown-item" href="{{ route('my.application') }}/?status=archive">Архивные
                        заявки</a> @endif
                    <a class="dropdown-item" href="{{ route('show.subscribtions', Auth::user()->id) }}">Уведомления</a>
                    <a class="dropdown-item" href="{{ route('free.drivers.show') }}">Свободные водители</a>
                    <div class="dropdown-divider"></div>
                    <form method="post" action="/logout">
                        @csrf
                        <input class="dropdown-item" type="submit" value="Выход">

                    </form>
                </div>
            @endif


            <div class="row profile-three-row">
                <div class="col-lg-2 col-md-12 text-center">
                    <div class="user-avatar">
                        <img src="/{{ isset($profile->photo) ? $profile->photo : 'assets/img/photo-camera.png' }}"
                             alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-10 col-9 pt-4 pl-5">
                    <div class="user-profile-info pl-2">
                        <div class="user-profile-info">
                            <span class="company-txt">{{ $profile->group->label }}</span><br>
                            <span
                                class="info-header-txt">{{ $profile->last_name }} {{ $profile->name }} {{ $profile->middle_name }}</span>
                            @isset($profile->documents)
                                @if($profile->documents->verify == 2)
                                    <img class="ml-3" src="/assets/img/checked.png" alt="Верифицирован">
                                @endif
                            @endisset

                            <span class="text-blue">{{ $profile->org }}</span>
                        </div>
                        <div class="star-cont">
                            <div class="rating-output"
                                 data-rating="{{ isset($profile->rating) ? $profile->rating : '0'  }}">
                                <div class="rating-star full-star"></div>
                                <div class="rating-star full-star"></div>
                                <div class="rating-star full-star"></div>
                                <div class="rating-star full-star"></div>
                                <div class="rating-star full-star"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 pt-4 col-md-4 col-sm-6 no_padding">
                    <div class="user-profile-info">
                        <a href="tel:{{ $profile->phone }}"><img src="/assets/img/phone.png"
                                                                 alt="">{{ $profile->phone }}</a>
                        @if($profile->email)<a href="mailto:{{ $profile->email }}"><img src="/assets/img/mail-blue.png"
                                                                                        alt="">{{ $profile->email }}
                        </a>@endif
                        @if($profile->inn)<a href="#"> <img src="/assets/img/question.png"
                                                            alt="">ИНН: {{ $profile->inn }}</a>@endif
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 pt-4 no_padding">
                    <div class="user-profile-info user-do-it">


                        <a href="{{ route('lk') }}/?user={{$profile->id}}" class=""><img src="/assets/img/view.png"
                                                                                         alt="">Посмотреть заявки</a>


                        @if(Auth::user()->id <> $profile->id and !Auth::user()->black_list->where('blocked_id', $profile->id)->first())
                            <form method="post" action="{{ route('add.blacklist', $profile->id) }}">
                                @csrf
                                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                                <input type="hidden" name="blocked" value="{{$profile->id}}">

                                <img src="/assets/img/esc.png" alt=""><input class="blue-link" type="submit"
                                                                             value="Добавить в черный список">

                            </form>
                        @endif


                    </div>
                </div>
            </div>
            @if(Auth::user()->id == $profile->id)
                <div class="row">
                    <div class="info-box">
                        <ul>
                            <li class="tab active">Машины</li>
                            <li class="tab">Водители</li>
                        </ul>
                        <article>
                            <!-- Машины -->
                            <section class="fake-content active text-center">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                        <table class="table text-center">
                                            <tbody>
                                            @foreach ($cars as $car)
                                                <tr>
                                                    <td data-label="Номер"><span class="num">#1</span></td>
                                                    <td data-label="Номер машины" class=""><span
                                                            class="car-number">{{$car->car_number}}</span>
                                                        @if ($car->verify == 1)
                                                            <img src="/assets/img/!.png" alt="">

                                                        @elseif($car->verify == 2)
                                                            <img src="/assets/img/checked.png" alt="">

                                                        @elseif($car->verify == 3)
                                                            <img src="/assets/img/redno.png" alt="">
                                                        @endif
                                                    </td>
                                                    <td data-label="Стс1" class=""><a target="_blank"
                                                                                      href="{{route('getfile',['user_id'=>$profile->id,'type'=>'car_sts','file_id'=>$car->sts_front])}}"
                                                                                      class="sts-link">Посмотреть СТС (1
                                                            сторона)</a></td>
                                                    <td data-label="Стс2" class=""><a target="_blank"
                                                                                      href="{{route('getfile',['user_id'=>$profile->id,'type'=>'car_sts','file_id'=>$car->sts_back])}}"
                                                                                      class="sts-link">Посмотреть СТС (2
                                                            сторона)</a></td>
                                                    <td class="cars-tab-doit">
                                                        {{-- <a href="#" class="blue-link">Изменить</a> --}}
                                                        <form method="POST"
                                                              action="{{ route('user.car.delete', ['car'=>$car->id, 'user_id'=>$profile->id]) }}">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="blue-link clear-button">
                                                                Удалить
                                                            </button>
                                                    </td>
                                                    </form>
                                                </tr>
                                            @endforeach

                                            {{-- <tr>
                                                <td data-label="Номер"><span class="num">#2</span></td>
                                                <td data-label="Номер машины" class=""><span class="car-number">KK230E 123 rus</span><img src="/assets/img/!.png" alt="">
                                                </td>
                                                <td data-label="Стс1" class=""><a href="#" class="sts-link">Посмотреть СТС (1 сторона)</a></td>
                                                <td data-label="Стс2" class=""><a href="#" class="sts-link">Посмотреть СТС (2 сторона)</a></td>
                                                <td class="cars-tab-doit">
                                                    <a href="#" class="blue-link">Изменить</a>
                                                    <button type="submit" class="blue-link clear-button">Удалить</button></td>
                                            </tr>
                                            <tr>
                                                <td data-label="Номер"><span class="num">#3</span></td>
                                                <td data-label="Номер машины" class=""><span class="car-number">KK230E 123 rus</span> <img src="/assets/img/redno.png" alt="">
                                                </td>
                                                <td data-label="Стс1" class=""><a href="#" class="sts-link">Посмотреть СТС (1 сторона)</a></td>
                                                <td data-label="Стс2" class=""><a href="#" class="sts-link">Посмотреть СТС (2 сторона)</a></td>
                                                <td class="cars-tab-doit">
                                                    <a href="#" class="blue-link">Изменить</a>
                                                    <button type="submit" class="blue-link clear-button">Удалить</button></td>
                                            </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(Cookie::get('vendor')!="android")
                                    <form enctype="multipart/form-data"
                                          action="{{ route('user.car.new', $profile->id )}}" method="POST">
                                        @csrf
                                        <div class="row add-file-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 add-car">Добавить
                                                машину
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12 d-flex car-num-col">
                                                <div class="carnum-input-container">
                                                    <span>Номер автомобиля </span>
                                                    <input class="car-num-input" name="car_number" type="text">
                                                    @error('car_number')
                                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="add-file-cont">
                                                    <span class="sts-2">СТС (с двух сторон)</span>
                                                    <div>
                                                        <input name="sts_front" type="file">
                                                        @error('sts_front')
                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        <input name="sts_back" type="file">
                                                        @error('sts_back')
                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                                                <div class="add-file-btn-container-1">
                                                    <label class="blue-but-sub" for="">
                                                        <div class="blue-big-cont">
                                                            <input class="blue-big-btn" type="submit"
                                                                   name="add-new-file-1" value="Добавить">
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                @if(Cookie::get('vendor')=="android")
                                    <form action="{{ route('token.exit') }}" method="POST">
                                        @csrf
                                        <div class="row add-file-row">
                                            <input class="blue-btn-message" style="min-width: 200px" type="submit"
                                                   value="Добавить автомобиль">
                                        </div>
                                    </form>
                                @endif
                            </section>
                            <!-- Водители -->
                            <section class="fake-content text-center">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                                        <table class="table text-center">
                                            <tbody class="tab-two-table">
                                            @foreach ($drivers as $driver)

                                                <tr>
                                                    <td data-label="Номер"><span class="num">{{$driver->id}}</span></td>
                                                    <td data-label="Имя водителя" class=""><span
                                                            class="name-driver">{{ $driver->last_name .' '.$driver->name .' '.$driver->middle_name}}</span>
                                                        @if ($driver->verify == 1)
                                                            <img src="/assets/img/!.png" alt="">

                                                        @elseif($driver->verify == 2)
                                                            <img src="/assets/img/checked.png" alt="">

                                                        @elseif($driver->verify == 3)
                                                            <img src="/assets/img/redno.png" alt="">
                                                        @endif
                                                    </td>
                                                    <td data-label="Номер телефона" class=""><a
                                                            href="tel:{{$driver->phone}}"
                                                            class="driver-num">{{$driver->phone}}</a></td>
                                                    <td data-label="Посмотреть права" class="">
                                                        <a target="_blank"
                                                           href="{{route('getfile',['user_id'=>$profile->id,'type'=>'drive_licence','file_id'=>$driver->drive_front])}}"
                                                           class="driver-link flex">Посмотреть права</a>
                                                        <a target="_blank"
                                                           href="{{route('getfile',['user_id'=>$profile->id,'type'=>'drive_licence','file_id'=>$driver->drive_back])}}"
                                                           class="driver-link flex">Посмотреть права</a>

                                                        <a target="_blank"
                                                           href="{{route('getfile',['user_id'=>$profile->id,'type'=>'drivers_passports','file_id'=>$driver->passport_front])}}"
                                                           class="driver-link flex">Посмотреть паспорт</a>
                                                        <a target="_blank"
                                                           href="{{route('getfile',['user_id'=>$profile->id,'type'=>'drivers_passports','file_id'=>$driver->passport_back])}}"
                                                           class="driver-link flex">Посмотреть паспорт</a>
                                                    </td>
                                                    <td class="cars-tab-doit">
                                                        {{-- <a href="#" class="blue-link">Изменить</a> --}}
                                                        <form method="POST"
                                                              action="{{ route('user.driver.delete', ['user_id'=>$profile->id,'driver'=>$driver->id]) }}">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="blue-link clear-button">
                                                                Удалить
                                                            </button>
                                                    </td>
                                                    </form>
                                                    </td>
                                                </tr>


                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @if(Cookie::get('vendor')!="android")
                                    <form enctype="multipart/form-data"
                                          action="{{ route('user.driver.new', $profile->id) }}" method="POST">
                                        @csrf
                                        <div class="row add-file-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 add-car">Добавить
                                                Водителя
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="carnum-input-container">
                                                    <span>Фамилия</span>
                                                    <input class="car-num-input" name="last_name" type="text">
                                                </div>
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="carnum-input-container">
                                                    <span>Имя</span>
                                                    <input class="car-num-input" name="name" type="text">
                                                </div>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="carnum-input-container">
                                                    <span>Отчество</span>
                                                    <input class="car-num-input" name="middle_name" type="text">
                                                </div>
                                                @error('middle_name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12 xs-none"></div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="carnum-input-container">
                                                    <span>Телефон</span>
                                                    <input class="car-num-input" name="phone" type="tel">
                                                </div>
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="add-file-cont">
                                                    <span class="sts-2">Права с (2х сторон)</span>
                                                    <div>
                                                        <input name="drive_front" type="file">
                                                    </div>
                                                    <div>
                                                        <input name="drive_back" type="file">
                                                    </div>
                                                </div>
                                                @error('drive_front')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                                @error('drive_back')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="add-file-cont">
                                                    <span class="sts-2">Паспорт (главная+прописка)</span>
                                                    <div>
                                                        <input name="passport_front" type="file">
                                                    </div>
                                                    <div>
                                                        <input name="passport_back" type="file">
                                                    </div>
                                                </div>
                                                @error('passport_front')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                                @error('passport_back')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 col-12">
                                                <div class="add-flie-btn-container">
                                                    <label class="blue-but-sub" for="">
                                                        <div class="blue-big-cont">
                                                            <input class="blue-big-btn" type="submit"
                                                                   name="add-new-file" value="Добавить">
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                @endif

                                @if(Cookie::get('vendor')=="android")
                                    <form action="{{ route('token.exit') }}" method="POST">
                                        @csrf
                                        <div class="row add-file-row">
                                            <input class="blue-btn-message" style="min-width: 200px" type="submit"
                                                   value="Добавить водителя">
                                        </div>
                                    </form>
                                @endif


                            </section>
                        </article>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-12 bg-violet">
                    @if(!count($reviews))
                        <div class="info-message">
                            Отзывов нет
                        </div>
                    @endif
                    @foreach ($reviews as $review)
                        <div class="comment-container">
                            <span class="comment-user">{{$review->autor->name}} {{$review->autor->last_name}}</span>
                            <div class="star-cont">
                                <div class="rating-output"
                                     data-rating="{{ isset($review->rating) ? $review->rating : '0'  }}">
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                </div>
                            </div>
                            <span class="comment-txt">
                        {{$review->content}}
                    </span>
                            @if(Auth::user()->group->name=='admin')
                                <div class="del text-right">
                                    <form
                                        action="{{ route('remove.review', [ 'user_id' => $profile->id, 'review' => $review]) }}"
                                        method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-danger">
                                            Удалить отзыв
                                        </button>
                                    </form>
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>

                @if(Auth::user()->id <> $profile->id)
                    <div class="col-lg-6 col-md-12 comment-col">
                        <div class="do-emotion text-blue">Оставить отзыв</div>
                        @if(!$canRewiew) Для написания отзыва необходимо как минимум 1 одобренная заказчиком
                        заявка. @else
                            <form method="POST" action="{{ route('add.review', $profile->id)}}">
                                @csrf
                                <div class="star-cont">
                                    <div class="rating-output rating-input" data-rating="0">
                                        <div class="rating-star-big"></div>
                                        <div class="rating-star-big"></div>
                                        <div class="rating-star-big"></div>
                                        <div class="rating-star-big"></div>
                                        <div class="rating-star-big"></div>
                                        <input type="hidden" value="0" name="rating">
                                    </div>
                                </div>

                                @error('rating')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror


                                <div class="comment-form">

                                    <textarea class="load-redaction profile-width" name="content"></textarea>

                                </div>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror
                                <div class="blue-big-cont">
                                    <input class="blue-big-btn" type="submit" value="Отправить">
                                </div>
                            </form>

                            @if (session()->has('success'))
                                <div id="popup_notification">
                                    <strong>{{ session('success') }} </strong>
                                </div>
                            @endif

                        @endif


                    </div>
                @endif


            </div>
        </div>

    </section>





    <style>
        /*ЭТИ СТИЛИ ТОЛЬКО ДЛЯ ТАБЛИЦ НА ЭТОЙ СТРАНИЦЕ*/

        .table {
            margin-bottom: 0rem;
        }

        table td {
            padding: 1.90rem !important;
        }

        tbody td:first-child {
            background-color: #31a2ec !important;
            width: 8%;
        }

        tbody td:nth-child(2n) {
            text-align: left;
        }

        tbody tr:nth-child(2n) td:nth-child(2n+1) {
            background-color: #f2faff;
        }

        tbody td:nth-child(2n+1) {
            background-color: #ebf7ff;
        }

        tbody td:nth-child(2) {
            width: 19%;
        }

        tbody td:nth-child(3) {
            width: 22.7%;
        }

        tbody td:nth-child(4) {
            width: 38%;
        }

        tbody tr:nth-child(2n) {
            background-color: #ffffff
        }

        tbody tr:nth-child(2n+1) {
            background-color: #f7fcff
        }

        .tab-two-table td:nth-child(2) {
            width: 34.5%;
        }

        @media screen and (max-width: 930px) {
            .col-lg-12 tbody td:first-child {
                width: auto;
            }

            tbody td:nth-child(2) {
                width: auto;
            }

            tbody td:nth-child(3) {
                width: auto;
                text-align: end;
            }

            tbody td:nth-child(4) {
                width: auto;
            }

            .tab-two-table td:nth-child(2) {
                width: auto;
            }

            tbody td:nth-child(2n) {
                text-align: end;
            }

            table {
                border: 0;
            }

            table caption {
                font-size: 1.3em;
            }

            table thead {
                border: none;
                clip: rect(0 0 0 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                width: 1px;
            }

            table tr {
                border-bottom: 3px solid #ddd;
                display: block;
                margin-bottom: 2.625em;
            }

            table td {
                border-bottom: 1px solid #ddd;
                display: block;
                font-size: .8em;
                text-align: right;
            }

            table td::before {
                /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }

            table td:last-child {
                border-bottom: 0;
            }

            .table td {
                padding-bottom: 15px;
                padding-top: 15px;
            }
        }
    </style>

    <script>
        (() => {
            let oUl = document.querySelector(".info-box ul"),
                Tab = oUl.getElementsByTagName("li"),
                activeTab = oUl.querySelector("ul .active"),
                activeSection = document.querySelector("article .active"),
                Section = document.querySelectorAll(".fake-content"),
                Activeindex;
            oUl.addEventListener(
                "click",
                e => {
                    let {
                        target
                    } = e;
                    if (target == activeTab) return;
                    if (target.nodeName.toLowerCase() == "li") {
                        activeTab.classList.remove("active");
                        target.classList.add("active");
                        activeTab = target;
                    }

                    for (Activeindex = 0; Activeindex < 2; Activeindex++) {
                        if (Tab[Activeindex] == activeTab) break;
                    }

                    activeSection.classList.remove("active");
                    Section[Activeindex].classList.add("active");
                    activeSection = Section[Activeindex];
                },
                false
            );
        })();


        let button = document.querySelectorAll('.tab');
        let sec = document.querySelectorAll('.fake-content');
        button[0].onclick = () => {
            localStorage.clear()
        }
        button[1].onclick = () => {
            localStorage.setItem('active', 1);
        }
        if (localStorage.getItem('active')) {
            button[0].classList.remove('active')
            sec[0].classList.remove('active')
            button[1].classList.add('active')
            sec[1].classList.add('active')
        }

    </script>

@endsection
