@extends('layouts.lk')

@section('content')
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
                    <table class="table table-borderless text-center fixtable">
                        <thead class="thead-fixed">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Заказчик</th>
                            <th scope="col">Погрузка</th>
                            <th scope="col">Выгрузка</th>
                            <th scope="col">Культура</th>
                            <th scope="col">Объем, тонн</th>
                            <th scope="col">Расстояние</th>
                            <th scope="col">Цена</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach ($applications as $application)

                            <tr onclick="window.location.href = '{{ route('show.application',$application->id) }}'"
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
                                                stroke="#f0f3f8" stroke-width="4"></circle>
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
                                                stroke="#f0f3f8" stroke-width="4"></circle>
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
            <div class="filter pb-4">
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
                <p class="stats-header">
                    <img src="/img/menu.png" alt="">
                    Статистика платформы</p>
                <div class="row">
                    <div class="col-4 count-all-users">
                        <span>1335</span>
                    </div>
                    <div class="col-8 count-all-users-text">
                        всего пользователей на платформе
                    </div>
                    <div class="row drivers">
                        <div class="col-6">
                            <svg width="105px" height="105px" viewBox="0 0 42 42" class="donut">
                                <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                        fill="#fff"></circle>
                                <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                        stroke="#f0f3f8" stroke-width="4"></circle>
                                <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                        fill="transparent"
                                        stroke="#196de7" stroke-width="4"
                                        stroke-dasharray="{{$driversPr}} {{$all_drPr}}"
                                        stroke-dashoffset="25"></circle>
                            </svg>
                        </div>
                        <div class="col-6 col-text">
                            <span class="drivers">1100</span>
                            Водителей
                        </div>
                    </div>
                    <div class="row owners">
                        <div class="col-6">
                            <svg width="105px" height="105px" viewBox="0 0 42 42" class="donut">
                                <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954"
                                        fill="#fff"></circle>
                                <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent"
                                        stroke="#f0f3f8" stroke-width="4"></circle>
                                <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954"
                                        fill="transparent"
                                        stroke="#72af5a" stroke-width="4"
                                        stroke-dasharray="{{$ownersPr}} {{$all_owPr}}"
                                        stroke-dashoffset="25"></circle>
                            </svg>
                        </div>
                        <div class="col-6 col-text">
                            <span class="owners">235</span> Заказчиков
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
