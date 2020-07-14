@extends('layouts.lk')

@section('content')

    <section id="the-answers">
        <div class="container request">
            <div class="row request-row justify-content-between">
                <span class="info-top-txt"> <a href="{{ route('show.application', $application->id)}}"
                                               class="info-top-txt"> Назад </a>  |  Ответы на заявку №{{ $application->id }}</span>
                <div class="bucket-cont d-flex">

                    <span class="info-top-txt">{{ $application->created_at }}</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 table-col-1">
                    <div class="blue__title">
                        <span>Ответы</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Дата</th>
                                    <th scope="col">Перевозчик</th>
                                    <th scope="col">Машин</th>
                                    <th scope="col">Цена/разница</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($answers as $answer)
                                    <tr>
                                        <td data-label="Дата" scope="row">{{$answer->created_at}}</td>
                                        <td data-label="Перевозчик" class="carrier-info px-3"><a class="carrier"
                                                                                                 href="{{route('profile', $answer->user->id)}}">{{$answer->user->fio}}</a>
                                            <div class="rating-output"
                                                 data-rating="{{ isset($answer->user->rating) ? $answer->user->rating : '0'   }}">
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                            </div>
                                            <a href="tel:{{$answer->user->phone}}"
                                               class="carrier-phone">{{$answer->user->phone}}</a>
                                        </td>
                                        <td data-label="Машин" class="cars-count"><span>{{$answer->cars}}</span></td>
                                        <td data-label="Цена/разница" class="sale-count">
                                            <span>{{$answer->cost}}</span><br> <span>{{$answer->different}}</span></td>
                                        <td>
                                            <form
                                                action="{{ route('approve.answer', [ 'application' => $answer->application_id, 'answer' => $answer->id ]) }}"
                                                method="POST">
                                                {{ csrf_field() }}


                                                <button type="submit" class="btn btn-danger">
                                                    <img class="yes" src="/assets/img/yes.png" alt=""><br>
                                                </button>
                                            </form>

                                            <form
                                                action="{{ route('remove.answer', [ 'application' => $answer->application_id, 'answer' => $answer->id ]) }}"
                                                method="POST">
                                                {{ csrf_field() }}


                                                <button type="submit" class="btn btn-danger">
                                                    <img src="/assets/img/no.png" alt="">
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 table-col-2">
                    <div class="blue__title">
                        <span>Выбранные исполнители</span>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table text-center">
                                <thead>
                                <tr>
                                    <th scope="col">Дата</th scope="col">
                                    <th scope="col">Перевозчик</th>
                                    <th scope="col">Машин</th>
                                    <th scope="col">Цена/разница</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($approves as $answer)
                                    <tr>
                                        <td data-label="Дата"
                                            scope="row">{{$answer->created_at->format('H:i d.m.Y')}}</td>
                                        <td data-label="Перевозчик" class="carrier-info px-3"><a
                                                href="{{route('profile', $answer->user->id)}}"
                                                class="carrier">{{$answer->user->fio}}</a>
                                            <div class="rating-output"
                                                 data-rating="{{ isset($answer->user->rating) ? $answer->user->rating : '0'   }}">
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                                <div class="rating-star"></div>
                                            </div>
                                            <a href="tel:{{$answer->user->phone}}"
                                               class="carrier-phone">{{$answer->user->phone}}</a>
                                        </td>
                                        <td data-label="Машин" class="cars-count"><span>{{$answer->cars}}</span></td>
                                        <td data-label="Цена/разница" class="sale-count">
                                            <span>{{$answer->cost}}</span><br> <span>{{$answer->different}}</span></td>
                                        <td>
                                            <form
                                                action="{{ route('unapprove.answer', [ 'application' => $answer->application_id, 'answer' => $answer->id ]) }}"
                                                method="POST">
                                                {{ csrf_field() }}


                                                <button type="submit" class="btn btn-danger">
                                                    <img src="/assets/img/no.png" alt="">
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /*Эти стили нужны только для таблицы на этой странице*/

        .col-lg-12 tbody th {
            font-size: 12px;
            letter-spacing: 0px;
            color: #000000;
            font-weight: 400;
            width: 18%;
            padding-top: 68px;
            padding-bottom: 30px;
        }

        thead th:nth-child(2n) {
            background-color: #f2faff;
        }

        thead th:nth-child(2n+1) {
            background-color: #ffffff
        }

        tbody tr:nth-child(2n+1) {
            background-color: #f7fcff
        }

        tbody tr:nth-child(2n) {
            background-color: #ffffff
        }

        tbody td:nth-child(2n) {
            background-color: #ebf7ff
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
                padding-bottom: 15px;
                padding-top: 15px;
            }
        }
    </style>

@endsection
