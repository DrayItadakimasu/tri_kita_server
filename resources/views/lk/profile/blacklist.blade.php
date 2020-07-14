@extends('layouts.lk')

@section('content')



    <section id="unloading">
        <div class="container request">

            <div class="row request-row justify-content-between">
                <div class="reg-txt"><a class="text-white" href="{{ route('profile',Auth::user()->id) }}">Профиль</a> |
                    Черный список пользователя
                </div>

            </div>
        </div>
        <div class="container mt-3">

            <div class="row">
                @if (session()->has('success_main'))
                    <div class="d-inline-flex alert success" id="popup_notification">
                        <strong>{{ session('success_main') }} </strong>
                    </div>
                @endif

                @if (session()->has('fail_main'))
                    <div class="d-inline-flex alert fail" id="popup_notification">
                        <strong>{{ session('fail_main') }} </strong>
                    </div>
                @endif


            </div>


            <div class="table-container">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th scope="col">Запись о блокировке создана</th>
                        <th scope="col">Идентификатор пользователя</th>
                        <th scope="col">ФИО заблокированного пользователя</th>
                        <th scope="col">Организация при наличии</th>


                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <!--1-->
                    @foreach ($black_list as $item)


                        <tr>
                            <td data-label="Создано"><span
                                    class="white-date"> {{$item->created_at->format('H:i d.m.Y ')}}</span></td>
                            <td data-label="user_id" class="custom-width-date"><a href="#">{{$item->blocked->id}}</a>
                            </td>
                            <td data-label="user" class="">{{$item->blocked->Fio}}
                            </td>
                            <td data-label="org" class="custom-width-load">{{$item->blocked->org}}</td>


                            <td class="custom-width-doit">
                                <form method="post"
                                      action="{{ route('delete.blacklist', Request::route()->parameter('user_id')) }}">
                                    @csrf
                                    <input type="hidden" name="user" value="{{$item->user_id}}">
                                    <input type="hidden" name="blocked" value="{{$item->blocked_id}}">
                                    <input class="blue-link" type="submit" value="Разблокировать">

                                </form>

                            </td>
                        </tr>
                    @endforeach
                    <!--1-->


                    </tbody>

                </table>
            </div>


    </section>




    <style>
        /*Эти стили нужны только для таблицы на этой странице*/

        .pagination {
            padding-top: 17px;
        }

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
            background-color: #ebf7ff;
        }

        tbody td:first-child {
            background-color: #31a2ec;
            width: 10%;
        }

        .col-lg-12 tbody td:first-child {
            width: 7.2%;
            border-bottom: 1px solid #ffffff;
        }

        .table td {
            padding-top: 30px;
            padding-bottom: 24px;
        }

        @media screen and (max-width: 930px) {
            tbody td:first-child {
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
