@extends('layouts.promo')

@section('content')
    <div class="owners">

        <div class="header">
            <div class="container">
                <nav class="navbar navbar-light navbar-expand-lg p-1">
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
                        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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
            </div>

            <section class="promo">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-6 text-white p-1">
                            <h2 class="text-white">
                                Цифровая платформа грузоперевозок
                            </h2>
                            <ul>
                                <li>Легкое взаимодействие грузовладельцев с перевозчиками</li>
                                <li>Функциональный личный кабинет</li>
                            </ul>
                            <button class="button-promo">
                                Начать работу сейчас
                            </button>
                        </div>

                    </div>
                </div>
            </section>
        </div>

        <div class="items">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <h1 class="mt-5 text-white">
                            Личный кабинет поможет Вам:
                        </h1>
                    </div>

                    <div class="col-12 col-md-4 dropdown dropbtn">
                        <div class="dropdown-content">
                            <div class="row dropdown-item p-3 m-0">
                                <div class="col-3">
                                    <img src="/img/test.png" alt="">
                                </div>
                                <div class="col-9 text-white">
                                    <p>
                                        Повысить эффективность
                                    </p>
                                </div>
                            </div>
                            <div class="row dropdown-item p-3 m-0">
                                <div class="col-3">
                                    <img src="/img/verified-text-paper.png" alt="">
                                </div>
                                <div class="col-9 text-white">
                                    <p>
                                        Минимизировать риски
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row p-3">
                            <div class="col-3">
                                <img src="/img/clock (1).png" alt="">
                            </div>
                            <div class="col-9">
                                <p>
                                    Оптимизировать рабочее время
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 item-col dropdown dropbtn">

                        <div class="row p-3">
                            <div class="col-3">
                                <img src="/img/phone-contact.png" alt="">

                            </div>
                            <div class="col-9">
                                <p>
                                    Сократить лишние звонки

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="advantages">
            <div class="container">
                <div class="row">
                    <h1>
                        Получите исключительные возможности с цифровой платформой “ Три кита ”
                    </h1>
                    <div class="col-12 col-md-6">
                        <img src="/img/line.png" alt="">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                               data-toggle="list"
                               href="#list-home" role="tab" aria-controls="home"> <img src="/img/analysis.png" alt="">
                                Привлекать любых Экспедиторов
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                               href="#list-profile" role="tab" aria-controls="profile"> <img src="/img/analysis.png"
                                                                                             alt="">
                                Работать напрямую с Перевозчиками
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                               href="#list-messages" role="tab" aria-controls="messages"> <img src="/img/analysis.png"
                                                                                               alt="">
                                Получать полный и правильный пакет документов от любого Экспедитора или Перевозчика
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                               href="#list-settings" role="tab" aria-controls="settings"> <img src="/img/analysis.png"
                                                                                               alt="">
                                Получать полный и правильный пакет документов от любого Экспедитора или Перевозчика
                            </a>
                            <a class="list-group-item list-group-item-action" id="list-other-list" data-toggle="list"
                               href="#list-other" role="tab" aria-controls="other"> <img src="/img/analysis.png"
                                                                                         alt="">
                                Автоматически создавать любые отчеты и реестры
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                                 aria-labelledby="list-home-list">
                                <img width="100%" height="auto" src="/img/devices.png" alt="">

                            </div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                 aria-labelledby="list-profile-list">

                            </div>
                            <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                 aria-labelledby="list-messages-list">

                            </div>
                            <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                 aria-labelledby="list-settings-list">

                            </div>
                            <div class="tab-pane fade" id="list-other" role="tabpanel"
                                 aria-labelledby="list-other-list">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="line-logo">
            <div class="container">
                <div class="row p-4 p-lg-5">
                    <div class="col-12 col-md-8">
                        <h2 class="text-white">
                            Переложите свою рутинную работу на наши автоматизированные процессы
                        </h2>
                    </div>
                    <div class="col-12 col-md-3 ml-auto">
                        <button class="button-promo">
                            Получить презентацию
                        </button>
                    </div>
                </div>
            </div>
        </div>
@endsection
