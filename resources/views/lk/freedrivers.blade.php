@extends('layouts.lk')

@section('content')

    <section id="freedriver" class="mt-3">

        <div class="container request">

            <div class="row request-row justify-content-between">
                <div class="reg-txt"><a class="text-white" href="/forum">Свободные водители</a></div>
            </div>
        </div>
        @can('create', App\clients\FreeDrivers::Class)
            <div class="container form-freedriver mb-3 mt-3">
                <form action="{{ route("free.drivers.create") }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            @if (session()->has('success'))
                                <div class="d-inline-flex alert success" id="popup_notification">
                                    <strong>{{ session('success') }} </strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-12">
                            @if ($errors->all())

                                @foreach ($errors->all() as $message)
                                    <div>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @endforeach

                            @endif
                        </div>
                    </div>

                    <div class="col-12">

                        <span>Место нахождения:</span>
                        <input id="place" class="default-address load-redaction place fullwidth" data_value=""
                               name="place" type="text" value="{{ old('place') }}">

                    </div>

                    <div class="col-12">

                        <span>Сообщение:</span>
                        <textarea id="description" class="load-redaction  fullwidth" maxlength="500"
                                  name="description"> {{ old('place') }} </textarea>

                    </div>
                    <div class="col-12">
                        <input class="blue-btn-message" type="submit" value="Опубликовать">
                    </div>

            </div>
            </form>
            </div>
        @endcan

        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-container">
                        <table class="table text-center fixtable">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Водитель</th>
                                <th scope="col">Место стоянки</th>
                                <th scope="col">Сообщение</th>
                            </tr>
                            </thead>
                            <tbody>


                            @foreach ($freeDrivers as $driver)

                                <!--1-->

                                <tr>
                                    <td data-label="">

                                        @can('delete', $driver)
                                            <form action="{{route("free.drivers.destroy", $driver->id)}}" method="POST">
                                                @csrf
                                                <input type="submit" value="Удалить">
                                            </form>
                                            <br>
                                        @endcan

                                        <span
                                            class="white-date"> {{ $driver->created_at->format('H:i d.m.Y ') }} </span>

                                    </td>
                                    <td data-label="Водитель" class="custom-width-order"><a
                                            href="{{ route('profile',$driver->user_id) }}"
                                            class="company-txt">{{ $driver->user->Fio  }}</a>
                                        @if($driver->allow_call_me)
                                            <br>
                                            <a class="phone_label"
                                               href="tel:{{$driver->user->phone}}">{{$driver->user->phone}}</a>
                                        @endif
                                        <div class="star-cont">
                                            <div class="rating-output"
                                                 data-rating="{{ isset($driver->user->rating) ? $driver->user->rating : '0'  }}">
                                                <div class="rating-star full-star"></div>
                                                <div class="rating-star full-star"></div>
                                                <div class="rating-star full-star"></div>
                                                <div class="rating-star full-star"></div>
                                                <div class="rating-star full-star"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Место" class="custom-width-load-2">
                                        {{ $driver->place }}

                                    </td>

                                    <td data-label="Сообщение" class="custom-width-unload-2">
                                        {{ $driver->description}}</td>
                                </tr>


                            @endforeach



                            <!--1-- bg-blue-tr bg-green-tr bg-white-tr > -->

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-center">
                    <div class="pagination-container">

                        {{$freeDrivers->links()}}


                    </div>

                </div>
            </div>
        </div>
    </section>


    <style>
        /*Эти стили нужны только для таблицы на этой странице*/

        tbody th {
            background-color: #31a2ec;
        }

        thead th:nth-child(2n) {
            background-color: #ffffff
        }

        thead th:nth-child(2n+1) {
            background-color: #f2faff
        }

        tbody tr:nth-child(2n+1) {
            background-color: #f7fcff
        }

        tbody tr:nth-child(2n) {
            background-color: #ffffff
        }

        tbody td:nth-child(2n+1) {
            background-color: #ebf7ff42;
        }

        tbody td:first-child {
            background-color: #31a2ec;
        }

        .col-lg-12 tbody td:first-child {
            width: 8.5%;
            border-bottom: 1px solid #ffffff;
        }

        .table td {
            padding-top: 36px;
            padding-bottom: 12px;
        }

        label {
            width: auto;
        }

        @media screen and (max-width: 930px) {
            .col-lg-12 tbody td:first-child {
                width: auto;
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
                padding-bottom: 3px;
                padding-top: 3px;
                border-bottom: 1px solid white;
            }

    </style>

@endsection
