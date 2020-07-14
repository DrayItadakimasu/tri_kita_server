@extends('layouts.lk')

@section('content')



    <section id="unloading">
        <div class="container request">
            <div class="row request-row justify-content-between">
                <span class="info-top-txt"> <a href="{{ route('lk')}}" class="info-top-txt back"> Назад </a>  |  Заявка №{{ $application->id }}  @if($application->status==2)
                        (закрыта) @endif @if($application->date_end->getTimestamp()+86400 <= time()) (Завершен прием
                    заявок) @endif </span>
                <div class="bucket-cont d-flex" style="background: none;">
                    <span class="info-top-txt">  {{ $application->created_at->format('H:i d.m.Y') }}</span>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="row info-row justify-content-center justify-md-auto">

                @if (session()->has('success_main'))
                    <div class="col-12">
                        <div id="popup_notification">
                            <strong>{{ session('success_main') }} </strong>
                        </div>
                    </div>
                @endif

                <div class="col-lg-3 info-card-col">
                    <div class="info-card-container">
                        <div class="info-card-header text-center">
                            <div class="user-avatar" style="background: none;">
                                <img
                                    src="/{{ isset($application->client->photo) ? $application->client->photo : 'assets/img/photo-camera.png' }}"
                                    alt="" class="user-photo">
                            </div>
                            <span
                                class="company-txt">  {{ isset($application->client->org) ? $application->client->org : $application->client->name .' '. $application->client->last_name  }} </span>
                            @if($application->allow_call_me)
                                <br>
                                <a class="phone_label"
                                   href="tel:{{$application->client->phone}}">{{$application->client->phone}}</a>
                            @endif
                            <div class="star-cont">
                                <div class="rating-output"
                                     data-rating="{{ isset($application->client->rating) ? $application->client->rating : '0'  }}">
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                    <div class="rating-star full-star"></div>
                                </div>
                            </div>
                            <a class="testemotionsla-link"
                               href="{{ route('profile', $application->user_id)}}">Отзывы</a>
                        </div>
                        <div class="info-card-text">
                            @if($application->information)
                                <span class="info-header-txt">
                            Примечание
                        </span>
                                <br>
                                <span class="info-body-txt">
                            {{ $application->information }}
                        </span>
                            @endif
                        </div>

                        <div class="info-card-text">
                            @if($application->answers and $application->user_id == Auth::user()->id)
                                <div class="info-btn-container ">
                                    <a class="blue-big-btn" href="{{ route('listing.answer', $application->id)}}">
                                        Список ответов</a>
                                </div>
                            @endif

                            @if($application->user_id == Auth::user()->id || Auth::user()->group->name == 'admin')
                                <div class="info-btn-container ">
                                    <a class="blue-big-btn" href="{{ route('edit.application', $application->id) }}">Редактировать </a>
                                </div>
                            @endif


                        </div>
                    </div>


                </div>
                <div class="custom-col-1 no_padding">
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                        Погрузка
                            </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->FullLoadPlace }}
                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                            Выгрузка
                                </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->FullUnloadPlace }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                            Способ погрузки
                                    </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->loadingType->label }}
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                            Грузоподъемность весов на погрузке, тонн
                                        </span>
                                <br>
                                <span class="info-body-txt">
                                    {{ $application->max_scale }}
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                            Просмотров
                                        </span>
                                <br>
                                <span class="info-body-txt">
                                    {{ $application->views }}
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-col-2 no_padding">
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                        Дата погрузки
                            </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->date_start->format('d.m.Y') }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                        Заявки до
                            </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->date_end->format('d.m.Y') }}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container bg-white">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                        Культура
                            </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->culture->name}}
                            </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container bg-white">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                            Расстояние, км
                                </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->distance }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container bg-white">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                                Объем, тонн
                                    </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->amount }}
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-load-container bg-white">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                                    Цена руб/кг
                                        </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->cost }}
                                        </span>
                            </div>
                        </div>
                    </div>
                    @if($application->where_calc)
                        <div class="card-load-container">
                            <div class="load-info-cont">
                                <div class="info-card-text">
                            <span class="info-header-txt">
                                            Оплата
                                </span>
                                    <br>
                                    <span class="info-body-txt">
                                {{ $application->where_calc }}
                                </span>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <div class="custom-col-3 no_padding">

                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                                    Последняя редакция
                                        </span>
                                <br>
                                <span class="info-body-txt">
                                {{ $application->updated_at->format('H:i d.m.Y') }}
                                        </span>
                            </div>
                        </div>
                    </div>

                    @if($application->exporter)
                        <div class="card-load-container">
                            <div class="load-info-cont">
                                <div class="info-card-text">
                            <span class="info-header-txt">
                                        Экспортер
                            </span>
                                    <br>
                                    <span class="info-body-txt">
                                {{ $application->exporter->name }}
                            </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($application->client->work_with_nds)
                        <div class="card-load-container">
                            <div class="load-info-cont">
                                <div class="info-card-text">
                            <span class="info-header-txt">
                                        Работа с ндс
                            </span>
                                    <br>
                                    <span class="info-body-txt">
                                {{ isset($application->client->work_with_nds) ? 'Да' : 'Нет' }}
                            </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($application->stand)
                        <div class="card-load-container">
                            <div class="load-info-cont">
                                <div class="info-card-text">
                            <span class="info-header-txt">
                                                Оплата простоя
                                    </span>
                                    <br>
                                    <span class="info-body-txt">

                                {{ $application->stand }}
                                        @if($application->stand_day)
                                            <br><b>С  {{ $application->stand_day }} дня</b>
                                        @endif


                            </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="card-load-container">
                        <div class="load-info-cont">
                            <div class="info-card-text">
                            <span class="info-header-txt">
                                                    Допустимая недосдача
                                        </span>
                                <br>
                                <span class="info-body-txt">
                                 {{ $application->max_shortage }} (% или кг)
                                        </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row f-width d-sm-flex justify-content-center">
                    <div class="col-lg-12 justify-content-center p-3 d-sm-block d-md-none">
                        <a href="javascript:void(0);" class="blue-big-btn map-accordion d-none"> Показать на карте</a>
                    </div>
                    @if($application->allow_call_me)
                        <div class="col-lg-12 justify-content-center p-3 d-sm-block d-md-none">
                            <a href="tel:{{$application->client->phone}}" class="blue-big-btn "> Позвонить заказчику</a>
                        </div>
                    @endif

                    <div class="row f-width bottom-info-row">
                        <div
                            class="@if($application->client->id <> Auth::user()->id) col-lg-8 @else col-lg-12 @endif map-container">


                            <div id="floating-panel">
                                <div id="map" style="height: 400px;"></div>
                                <div id="warnings-panel"></div>

                                <script>
                                    var geo = {
                                        center: {
                                            lat: {{ ($application->load_lat +  $application->unload_lat)/2 }},
                                            lng: {{ ($application->load_lon +  $application->unload_lon)/2 }}},
                                        load: {
                                            lat: {{$application->load_lat}} ,
                                            lon: {{$application->load_lon}}
                                        },
                                        unload: {
                                            lat: {{$application->unload_lat}} ,
                                            lon: {{$application->unload_lon}}
                                        }

                                    }
                                </script>
                                <script src="/assets/js/g.maps.directions.js?v=1.0"></script>
                                <script async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqhAI6Nv0gv-zFPsBwKaZ1Kd49Ym4Q_DA&callback=initMap">
                                </script>


                                @if(false)
                                    <div class="map1">
                                        <div id="map2"></div>
                                    </div>
                                @endif

                            </div>
                        </div>

                        @if($application->client->id <> Auth::user()->id)
                            <div class="col-lg-4 small-input">

                                <form action="{{$action_answer}}" method="{{$method_answer}}">
                                    @csrf

                                    <span class="info-header-txt">
                            Ваш Ответ
                        </span>

                                    @if (session()->has('success'))
                                        <div id="popup_notification">
                                            <strong>
                                                <script>alert(" {{ session('success') }} ")</script>
                                            </strong>
                                        </div>
                                    @endif

                                    <div class="loading-input-container">

                                        <label for="">
                                            <span class="answer-txt pr-3">Кол-во машин</span>
                                            <input class="load-redaction" name="cars" type="number" min="1"
                                                   value="{{ old('cars') }}">
                                        </label>

                                        @error('cars')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        <strong><script>alert(" {{ $message }}  ")</script></strong>
                                    </span>
                                        @enderror

                                    </div>
                                    @if($tender)
                                        <div class="loading-input-container">

                                            <label for="">
                                                <span class="answer-txt pr-5">Цена, руб</span>
                                                <input class="load-redaction" name="cash" type="number" min="0"
                                                       step="0.01" value="{{ old('cash') }}">
                                            </label>

                                            @error('cash')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror

                                        </div>
                                    @endif

                                    <div class="info-btn-container">
                                        <input class="blue-big-btn" type="submit" value="Ответить на заявку">
                                    </div>
                                </form>


                            </div>
                        @endif


                    </div>

                </div>
            </div>
    </section>


    <style>
        /* ДЛЯ ЭТОЙ СТРАНИЦЫ BODY ДОЛЖЕН БЫТЬ СЕРЫМ*/

        body {
            background: #f2f2f2;
        }

        .tab-card {
            cursor: pointer;
        }

        #map2 {
            width: 100%;
            height: 320px;
        }

        .leaflet-tooltip-right {
            position: absolute;
            z-index: 99;
            left: 15px;
            top: -10px;
            background: white;
            padding: 0px 4px;
        }

    </style>

    <!-- Добавляем файлы стилей CSS для библиотеки -->
    <link rel="stylesheet" href="{{ asset('assets/lib/css/leaflet.css') }}"/>
    <!--[if lte IE 8]>
     <link rel="stylesheet" href="{{ asset('assets/lib/css/leaflet.ie.css') }}" />
 <![endif]-->

    <!-- Добавляем ссылку на JS-скрипт библиотеки -->
    <script src="{{ asset('/assets/js/leaflet.js') }}"></script>
    <script src="{{ asset('assets/js/leaflet.markercluster-src.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/lib/css/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/css/MarkerCluster.Default.css') }}">


    @if(false)
        <script type='text/javascript'>
            var greenIcon = L.icon({
                iconUrl: '/assets/img/marker.png',
                //shadowUrl: 'info/leaf-shadow.png',

                iconSize: [32, 32], // size of the icon
                //shadowSize:   [50, 64], // size of the shadow
                iconAnchor: [15, 27], // point of the icon which will correspond to marker's location
                //shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor: [-3, -20] // point from which the popup should open relative to the iconAnchor
            });


            var map2 = L.map('map2');
            map2.setView([ {{ ($application->load_lat +  $application->unload_lat)/2 }}, {{ ($application->load_lon +  $application->unload_lon)/2 }}], 6);


            L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(map2);
            L.marker([{{$application->load_lat}}, {{$application->load_lon}}], {icon: greenIcon}).addTo(map2).bindTooltip("Погрузка", {
                permanent: true,
                direction: 'right'
            });
            L.marker([{{$application->unload_lat}}, {{$application->unload_lon}}], {icon: greenIcon}).addTo(map2).bindTooltip("Выгрузка", {
                permanent: true,
                direction: 'right'
            });


        </script>
    @endif

@endsection
