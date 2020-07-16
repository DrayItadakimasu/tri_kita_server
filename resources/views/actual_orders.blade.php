@extends('layouts.promo')

@section('content')
    <div class="actual-orders">
        <section class="header">
            <div class="container p-0">
                <nav class="navbar navbar-light navbar-expand-lg">
                    <a href="/">
                        <img src="/img/owner-logo.png" width="247px" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarTogglerDemo02"
                            aria-controls="navbarTogglerDemo02" aria-expanded="false"
                            aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="header-link" href="/owners">Для грузовладельцев</a>
                            </li>
                            <li class="nav-item">
                                <a class="header-link" href="/drivers">Для перевозчиков</a>
                            </li>
                            <li class="nav-item">
                                <a class="text-white ml-lg-2 header-link header-link-right" href="#">Контакты </a>
                            </li>
                        </ul>
                        <a href="#" class=" header-link header-link-right">Регистрация</a>
                        <button class="d-none d-lg-block user-login align-middle"></button>
                        <a class="d-block d-lg-none header-link align-middle">Вход</a>
                    </div>
                </nav>
                <h2 class="header-text">
                    Актуальные заявки
                </h2>
            </div>
        </section>
        <section class="filter">
            <div class="container lk p-0">
                <form class="filter-form">
                    <div class="row m-0">
                        <div class="inputs p-0 ml-0">
                            <select id="loadselect" name="load"
                                    class="filter-select1 @if(($_SERVER["REQUEST_URI"] != '/lk') and ($_SERVER["REQUEST_URI"] != '/lk/myapplications')) filter-disable @endif">

                                <option
                                    value="{{$applicationFilter['load']}}"> {{$applicationFilter['load'] ?  $applicationFilter['load'] : 'Место погрузки'}} </option>

                            </select>

                            <select id="unloadselect"
                                    class="filter-select2 @if(($_SERVER["REQUEST_URI"] != '/lk') and ($_SERVER["REQUEST_URI"] != '/lk/myapplications')) filter-disable @endif"
                                    name="unload">
                                <option
                                    value="{{$applicationFilter['unload']}}">{{$applicationFilter['unload'] ?  $applicationFilter['unload'] : 'Место выгрузки'}}</option>
                            </select>

                            <select
                                class="filter-select3 @if(($_SERVER["REQUEST_URI"] != '/lk') and ($_SERVER["REQUEST_URI"] != '/lk/myapplications')) filter-disable @endif"
                                name='culture'>
                                <option value=""> Культура</option>
                                @foreach ($cultures as $culture)
                                    <option
                                        {{$applicationFilter['culture']==$culture->id ? 'selected': ''}} value="{{ $culture->id }}">{{ $culture->name }}</option>
                                @endforeach
                            </select>

                            <div class="filter-panel-buttons">
                                <div class="filter1-submit">
                                    <a class="trash-but "
                                       href="{{ route('lk') }}"><img
                                            src="/img/x-white.png">Сбросить все</a>
                                </div>
                            </div>
                        </div>
                        <div class="search-box">
                            <button class="search d-flex"></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="orders">
            <div class="container">
                        <div class="table-container">
                            <table class="table table-borderless text-center ">
                                <thead class="thead-fixed">
                                <tr>
                                    <th scope="col">Погрузка</th>
                                    <th scope="col">Выгрузка</th>
                                    <th scope="col">Культура</th>
                                    <th scope="col">Цена</th>
                                    <th scope="col">Телефон менеджера</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <!--1-->
                                @foreach ($applications as $application)
                                    <tr onclick="window.location.href = '{{ route('show.application',$application->id) }}'">
                                        <td data-label="Погрузка" class="custom-width-load"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->FullLoadPlace }}</a>
                                        </td>
                                        <td data-label="Выгрузка" class="custom-width-unload"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->FullUnloadPlace }}</a>
                                        </td>
                                        <td data-label="Культура" class="custom-width-culture"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->culture->name }}</a>
                                        </td>
                                        <td data-label="Цена" class="custom-width-sale"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->cost }}</a>
                                        </td>
                                        <td data-label="Телефон менеджера" class="custom-width-distance"><a
                                                href="{{ route('show.application',$application->id) }}">{{ $application->manager_number ?? '+7(000)000-00-00' }}</a>
                                        </td>
                                        <td class="custom-width-doit">
                                            <div class="row justify-content-center">
                                                <a href="#">
                                                    <button class="button-form">
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!--1-->

                                </tbody>

                            </table>
                        </div>
                    </div>
        </section>
    </div>
    <style>

        table {
            font-size: 12px;
        }

        table td {
            vertical-align: middle !important;
        }

        table a {
            color: #4d4d4d !important;
        }

        tbody {
            display: block;
            overflow-y: auto;
        }

        table th {
            border-top: none;
        }

        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        tbody tr {
            background-color: #f9fafc;
        }

        tbody tr:nth-child(even) {
            background-color: white;
        }

        tr {
            height: 100px;
        }

        thead tr {
            height: 60px;
        }

        .thead-fixed {
            height: 60px;
        }
    </style>
@endsection
