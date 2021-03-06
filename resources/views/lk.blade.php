<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="<?php echo asset('/assets/css/styles.min.css')?>" type="text/css">
    <title>Три кита</title>
</head>
<body>


<div class="header_space show_app">
</div>

<div class="lk">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-2 lk-user-col logo-header">
                        <a class="" href="/">
                            <img src="/img/owner-logo.png" width="100%" alt="logo">
                        </a>
                    </div>
                    <div class="col-8 ml-auto p-0">
                        <form class="filter-form">
                            <div class="row">
                                <div class="inputs">
                                    <select id="loadselect" name="load" class="filter-select1">

                                        <option
                                            value="{{$applicationFilter['load']}}"> {{$applicationFilter['load'] ?  $applicationFilter['load'] : 'Место погрузки'}} </option>

                                    </select>

                                    <select id="unloadselect" class="filter-select2" name="unload">
                                        <option
                                            value="{{$applicationFilter['unload']}}">{{$applicationFilter['unload'] ?  $applicationFilter['unload'] : 'Место выгрузки'}}</option>
                                    </select>

                                    <select class="filter-select3" name='culture'>
                                        <option value=""> Культура</option>
                                        @foreach ($cultures as $culture)
                                            <option
                                                {{$applicationFilter['culture']==$culture->id ? 'selected': ''}} value="{{ $culture->id }}">{{ $culture->name }}</option>
                                        @endforeach
                                    </select>

                                    <div class="filter-panel-buttons">
                                        <div class="filter1-submit">
                                            <a class="trash-but @if(!$hasFilter) unactive @endif"
                                               href="{{ route('lk') }}"><img
                                                    src="/img/x.png">Сбросить все</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 ml-auto search-box">
                                    <button class="search d-flex"></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2 p-0 header-user">
                        <div class="user-menu d-flex">
                            <div class="user-name text-center">
                                    <span>
                                            {{ Auth::user()->name }}  {{ Auth::user()->last_name }}
                                    </span>
                            </div>
                            <div class="user-info">
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        <img src="/img/toggle.png" alt="">
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(Auth::user()->group->name == 'admin')
                                            <a class="dropdown-item"
                                               href="{{ route('show.users') }}">Администратор</a>
                                        @endif

                                        <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}">Мой
                                            профиль</a>
                                        <a class="dropdown-item"
                                           href="{{ route('edit.user.profile', Auth::user()->id) }}">Изменить
                                            профиль</a>
                                        <a class="dropdown-item" href="{{ route('blacklist', Auth::user()->id) }}">Блокировки</a>
                                        <a class="dropdown-item"
                                           href="{{ route('show.subscribtions', Auth::user()->id) }}">Уведомления</a>
                                        <a class="dropdown-item" href="/forum/">Форум</a>
                                        <a class="dropdown-item" href="{{ route('free.drivers.show') }}">Свободные
                                            водители</a>
                                        @if(Auth::user()->group->name == 'customer' || Auth::user()->group->name == 'admin')
                                            <a class="dropdown-item"
                                               href="{{ route('my.application') }}/?status=archive">Архив
                                                заявок</a> @endif
                                        <div class="dropdown-divider"></div>
                                        <form method="post" action="/logout">
                                            @csrf
                                            <input class="dropdown-item" type="submit" value="Выход">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2 p-0">
                <div class="lk-user-col">
                    <div class="user-avatar">
                        <a href=""></a>
                    </div>
                    <p class="text-white text-center">ИП Краюшкин Денис Сергеевич</p>
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
                    <div class="list-group">
                        <div tabindex="1" class="list-group-item list-group-item-action">
                            Все заявки
                        </div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Мои заявки</div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Подать заявку</div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Форум</div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Профиль</div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Настройки</div>
                        <div tabindex="1" class="list-group-item list-group-item-action">Выйти</div>
                    </div>
                </div>
            </div>

            <div class="col middle-block">
                <div class="filter-inline">
                    <div class="list-inline">
                        <img src="/img/menu.png" alt="">
                        <div tabindex="1" class="list-inline-item list-inline-item-action">
                            Все заявки
                        </div>
                        <div tabindex="1" class="list-inline-item list-inline-item-action">Только новые</div>
                        <div tabindex="1" class="list-inline-item list-inline-item-action">Отвеченные</div>
                        <div tabindex="1" class="list-inline-item list-inline-item-action">В работе</div>
                        <div tabindex="1" class="list-inline-item list-inline-item-action">Архив</div>
                    </div>
                </div>
                <div class="map1" id="map">
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="show-map">
                            Развернуть карту
                        </button>
                        <div class="table-container">
                            <table class="table text-center fixtable table-striped">
                                <thead class="thead-fixed">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Заказчик</th>
                                    <th scope="col">Погрузка</th>
                                    <th scope="col">Выгрузка</th>
                                    <th scope="col">Культура</th>
                                    <th scope="col">Объем, тонн</th>
                                    <th scope="col">Расстояние, км</th>
                                    <th scope="col">Цена, руб/кг</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach ($applications as $application)

                                    <tr onclick="window.location.href = '
                                    {{--                                    {{ route('show.application',$application->id) }}--}}
                                        '"
                                        class=" @isset($application->answers->status) @if($application->answers->status == 1) bg-green-tr @elseif ($application->answers->status == 2) bg-red-tr  @endif @endisset ">
                                        <td data-label="">

                                        <span
                                            class="white-date"> {{ $application->created_at->format('H:i d.m.Y ') }} </span><br>
                                            @if($application->answer->count()) <a title="Ответов"
                                                                                  href="@if($application->user_id == auth::user()->id){{ route('listing.answer', $application->id)}}@else#@endif"
                                                                                  class="white-date"><img
                                                    src="/assets/img/user-white.png"
                                                    alt=""> {{ $application->answer->count() }}</a> @endif <a href="#"
                                                                                                              class="white-date"
                                                                                                              title="Просмотров"><img
                                                    src="/assets/img/view.png" width="12px"
                                                    alt=""> {{ $application->views }}
                                            </a>
                                            <div class="indentation">
                                                <a href="#"><img src="" alt=""></a>
                                            </div>
                                        </td>
                                        <td data-label="Заказчик" class="custom-width-order"><a
                                                href="
{{--{{ route('show.application',$application->id) --}}
                                                    }}"
                                                class="company-txt">{{ isset($application->client->org) ? $application->client->org : $application->client->name .' '. $application->client->last_name  }}</a>
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
                                        </td>
                                        <td data-label="Погрузка" class="custom-width-load-2"><a
                                                href="{{ route('show.application',$application->id) }}">
                                                {{ $application->FullLoadPlace }}

                                            </a></td>

                                        <td data-label="Выгрузка" class="custom-width-unload-2"><a
                                                href="{{ route('show.application',$application->id) }}">
                                                {{ $application->FullUnloadPlace}}</a></td>
                                        <td data-label="Культура" class="custom-width-culture-2"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->culture->name}}</a>
                                        </td>
                                        <td data-label="Объем, тонн" class="custom-width-weight-2">
                                            <a href="#">{{ $application->amount}}</a>
                                        </td>
                                        <td data-label="Расстояние, км" class="custom-width-distance-2"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->distance}}</a>
                                        </td>
                                        <td data-label="Цена, руб/кг" class="custom-width-sale-2"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->cost}}</a>
                                        </td>
                                    </tr>


                                @endforeach



                                <!--1-- bg-blue-tr bg-green-tr bg-white-tr > -->

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="stats stats-inline">
                            <?php
                            $all = 1335;
                            $drivers = 1100;
                            $owners = 235;
                            $driversPr = $drivers * 100 / $all;
                            $all_drPr = 100 - $driversPr;
                            $ownersPr = $owners * 100 / $all;
                            $all_owPr = 100 - $ownersPr;
                            ?>
                            <p>
                                <img src="/img/menu.png" alt="">
                                Статистика платформы</p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <span>1335</span>
                                        </div>
                                        <div class="col-8">
                                            всего пользователей на платформе
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <svg width="90px" height="90px" viewBox="0 0 42 42" class="donut">
                                                <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                                        fill="#fff"></circle>
                                                <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954"
                                                        fill="transparent"
                                                        stroke="#d2d3d4" stroke-width="4"></circle>
                                                <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                                        fill="transparent"
                                                        stroke="#196de7" stroke-width="4"
                                                        stroke-dasharray="{{$driversPr}} {{$all_drPr}}"
                                                        stroke-dashoffset="25"></circle>
                                            </svg>
                                        </div>
                                        <div class="col-8">
                                            <span class="drivers">1100</span>
                                            <p>Водителей</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="row">
                                        <div class="col-4">
                                            <svg width="90px" height="90px" viewBox="0 0 42 42" class="donut">
                                                <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                                        fill="#fff"></circle>
                                                <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954"
                                                        fill="transparent"
                                                        stroke="#d2d3d4" stroke-width="4"></circle>
                                                <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                                        fill="transparent"
                                                        stroke="#72af5a" stroke-width="4"
                                                        stroke-dasharray="{{$ownersPr}} {{$all_owPr}}"
                                                        stroke-dashoffset="25"></circle>
                                            </svg>
                                        </div>
                                        <div class="col-8">
                                            <span class="owners">235</span>
                                            <p>Заказчиков</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            <div class="col-2 right-col">
                <div class="right-fixed">
                    <div class="filter">
                        <p>
                            <img src="/img/menu.png" alt="">
                            Фильтрация по типам заявки</p>
                        <div class="list-group">
                            <div tabindex="1" class="list-group-item list-group-item-action">
                                Все заявки
                            </div>
                            <div tabindex="1" class="list-group-item list-group-item-action">Только новые</div>
                            <div tabindex="1" class="list-group-item list-group-item-action">Отвеченные</div>
                            <div tabindex="1" class="list-group-item list-group-item-action">В работе</div>
                            <div tabindex="1" class="list-group-item list-group-item-action">Архив</div>
                        </div>
                    </div>
                    <div class="stats">
                        <?php
                        $all = 1335;
                        $drivers = 1100;
                        $owners = 235;
                        $driversPr = $drivers * 100 / $all;
                        $all_drPr = 100 - $driversPr;
                        $ownersPr = $owners * 100 / $all;
                        $all_owPr = 100 - $ownersPr;
                        ?>
                        <p>
                            <img src="/img/menu.png" alt="">
                            Статистика платформы</p>
                        <div class="row">
                            <div class="col-4">
                                <span>1335</span>
                            </div>
                            <div class="col-8">
                                всего пользователей на платформе
                            </div>
                            <div class="col-6">
                                <svg width="90px" height="90px" viewBox="0 0 42 42" class="donut">
                                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                            fill="#fff"></circle>
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                            stroke="#d2d3d4" stroke-width="4"></circle>
                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                            fill="transparent"
                                            stroke="#196de7" stroke-width="4"
                                            stroke-dasharray="{{$driversPr}} {{$all_drPr}}"
                                            stroke-dashoffset="25"></circle>
                                </svg>
                            </div>
                            <div class="col-6">
                                <span class="drivers">1100</span> Водителей
                            </div>
                            <div class="col-6">
                                <svg width="90px" height="90px" viewBox="0 0 42 42" class="donut">
                                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                            fill="#fff"></circle>
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                            stroke="#d2d3d4" stroke-width="4"></circle>
                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                            fill="transparent"
                                            stroke="#72af5a" stroke-width="4"
                                            stroke-dasharray="{{$ownersPr}} {{$all_owPr}}"
                                            stroke-dashoffset="25"></circle>
                                </svg>
                            </div>
                            <div class="col-6">
                                <span class="owners">235</span> Заказчиков
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

    #map {
        width: 100%;
        height: 380px;
        border-radius: 15px;
        padding: 30px;
    }

    .table {
        font-size: 12px;
    }

    .table .td {
        vertical-align: middle;
    }

    .table a {
        color: #4d4d4d !important;
    }

    tbody {
        display: block;
        overflow-y: auto;
    }

    thead, tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    thead {
        width: calc(100% - 1em)
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

<script type='text/javascript'>

    var addressPoints = [
        [45.3008939, 37.9756569, '1540'],
        [47.0913474, 40.7406739, '1550'],
        [45.4879227, 38.6642029, '1552'],
        [46.0622921, 39.6074113, '1553'],
        [46.2921642, 39.6253271, '1556'],
        [47.2441118, 39.8327805, '1557'],
        [45.6432347, 40.4192152, '1564'],
        [45.6432347, 40.4192152, '1565'],
        [45.6432347, 40.4192152, '1566'],
        [45.6415181, 40.4134976, '1567'],
        [45.4542392, 40.833027, '1568'],
        [45.0012149, 41.1324168, '1569'],
        [45.0012149, 41.1324168, '1570'],
        [46.2776498, 38.4809024, '1574'],
        [47.7379667, 40.9102469, '1575'],
        [45.9769054, 39.360769, '1578'],
        [48.5289496, 43.0392596, '1579'],
        [46.3208193, 39.9705525, '1580'],
        [46.3208193, 39.9705525, '1581'],
        [46.3208193, 39.9705525, '1582'],
        [46.3208193, 39.9705525, '1583'],
        [45.0650429, 41.1167728, '1587'],
        [47.1121589, 39.4232555, '1590'],
        [46.71157, 38.2763895, '1594'],
        [46.0625578, 39.6110738, '1595'],
        [49.6474404, 44.288642, '1596'],
        [45.7974254, 42.6723444, '1601'],
        [46.0354122, 38.5864113, '1602'],
        [46.2776498, 38.4809024, '1603'],
        [46.0354122, 38.5864113, '1604'],
        [46.2776498, 38.4809024, '1605'],
        [46.2776498, 38.4809024, '1606'],
        [45.9430413, 38.546844, '1607'],
        [45.8410545, 39.0218648, '1609'],
        [45.9430413, 38.546844, '1613'],
        [45.8410545, 39.0218648, '1615'],
        [45.1118811, 37.6600691, '1619'],
        [45.5831775, 38.3744627, '1628'],
        [45.4848953, 38.3988223, '1632'],
        [45.1708784, 37.2712164, '1635'],
        [45.7974254, 42.6723444, '1640'],
        [45.7974254, 42.6723444, '1642'],
        [46.2776498, 38.4809024, '1643'],
        [46.2776498, 38.4809024, '1644'],
        [46.3251927, 38.744962, '1645'],
        [46.0002336, 39.987805, '1646'],
        [45.9430413, 38.546844, '1647'],
        [45.2025366, 37.6604386, '1649'],
        [47.7379667, 40.9102469, '1651'],
        [46.6715671, 39.8385199, '1653'],
        [46.7766026, 40.4595821, '1654'],
        [46.004502, 40.4386594, '1656'],
        [46.004502, 40.4386594, '1657'],
        [46.6715671, 39.8385199, '1659'],
        [46.6715671, 39.8385199, '1663'],
        [44.9454461, 42.3644475, '1667'],
        [46.6715671, 39.8385199, '1669'],
        [44.804535, 38.5460227, '1670'],
        [45.5831775, 38.3744627, '1673'],
        [45.4372647, 37.7691229, '1674'],
        [45.8410545, 39.0218648, '1677'],
        [47.5262644, 42.6020561, '1679'],
        [45.2797741, 40.1308331, '1681'],
        [45.9537272, 40.7069177, '1682'],
        [45.9537272, 40.7069177, '1683'],
        [47.5424582, 40.650056, '1684'],
        [48.6353069, 43.7215998, '1686'],
        [48.6540443, 41.0842787, '1687'],
        [46.3208193, 39.9705525, '1688'],
        [45.1708784, 37.2712164, '1689'],
        [45.3395699, 38.0179648, '1690'],
        [47.7379667, 40.9102469, '1691'],
        [47.7379667, 40.9102469, '1692'],
        [47.0913474, 40.7406739, '1696'],
        [47.5665634, 40.9223404, '1697'],
        [48.6097277, 41.6412356, '1698'],
        [48.2410434, 40.7105731, '1699'],
        [44.9134742, 41.2885808, '1700'],
        [44.9134742, 41.2885808, '1701'],
        [44.9134742, 41.2885808, '1702'],
        [44.9134742, 41.2885808, '1703'],
        [44.9134742, 41.2885808, '1704'],
        [44.9134742, 41.2885808, '1705'],
        [44.9134742, 41.2885808, '1706'],
    ];
    {{--var addressPoints = [--}}
    {{--        @foreach ($dataMap as $item)--}}
    {{--    [{{$item->load_lat}}, {{$item->load_lon}}, '{{$item->id}}'],--}}
    {{--    @endforeach--}}
    {{--];--}}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="/assets/js/jquery.maskedinput.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/css/suggestions.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@19.8.0/dist/js/jquery.suggestions.min.js"></script>

<script src="/assets/js/scripts.min.js?=v1.9.1"></script>

</body>

</html>
