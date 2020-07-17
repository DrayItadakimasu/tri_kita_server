@extends('layouts.promo')

@section('content')
    <div class="header">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-lg p-1">
                <a href="/">
                    <img src="/img/logo.png" width="247px" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                        aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="header-link" href="/owners">Для грузовладельцев</a>
                        </li>
                        <li class="nav-item">
                            <a class="header-link" href="">Для перевозчиков</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-white ml-lg-2 header-link" href="#">Контакты </a>
                        </li>
                    </ul>
                    <a href="#" class="text-white header-link">Регистрация</a>
                    <button class="d-none d-lg-block user-login align-middle"></button>
                    <a class="d-block d-lg-none header-link align-middle">Вход</a>
                </div>
            </nav>
        </div>

        <div class="promo">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 bg-white">
                        <h2>Перевозка наливных
                            и сельскохозяйственных грузов в больших объемах</h2>
                        <p>Прозрачный и надежный сервис обслуживания грузоперевозок</p>
                        <form action="">
                            <div class=" pl-2">
                                <input class=" m-2 border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                                       placeholder="Ваше имя">
                                <input class="m-2 border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                                       placeholder="Телефон">
                                <button class="button-form"></button>
                            </div>
                            <small class="">*Нажимая кнопку «Отправить» Вы соглашаетесь с<br>
                                обработкой <a href="">персональных данных</a></small>
                        </form>
                    </div>
                    <div class="col-6 d-none d-md-block devices">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="items">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <h2 class="mt-4 text-white">
                        Lorem ipsum dolor sit amet,
                    </h2>
                </div>
                <div class="col-12 col-md-4 dropdown dropbtn">
                    <div class="dropdown-content">
                        <ul>
                            <li><a href="#">Растительные масла, в том числе рафинированные и дезодорирован</a>
                            </li>
                            <li><a href="#">Пальмовое масло, стеарин, олеин </a>
                            </li>
                            <li><a href="#">Патока, меласса свекловичная</a>
                            </li>
                            <li><a href="#">Виноматериал, концентрат фруктового сока</a>
                            </li>
                            <li><a href="#">Пищевые добавки и смеси</a>
                            </li>
                            <li><a href="#">Питьевая вода, морская вода</a>
                            </li>
                        </ul>
                        <p class="dropdown-text">Актуальные заявки</p>
                        <img src="/img/double-angle.png" alt="">
                    </div>
                    <img src="/img/coconut-oil.png" alt="">
                    <p>
                        Неопасные жидкие грузы
                    </p>
                </div>

                <div class="col-12 col-md-4 item-col dropdown dropbtn">
                    <img src="/img/wheat.png" alt="">
                    <p>
                        Сельскохозяйственная продукция
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="reasons">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h2>Надежный партнер для профессионалов</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore
                        et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu
                    </p>
                </div>
                <div class="col-4 col-md-2">
                    <img src="/img/83.png" alt="">
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
                <div class="col-4 col-md-2">
                    <img src="/img/27.png" alt="">
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
                <div class="col-4 col-md-2">
                    <img width="100%" height="auto" src="/img/2К.png" alt="">
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
            </div>
        </div>
    </div>

    <div class="advantages">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1>
                        Почему выбирают нас
                    </h1>
                    <img src="/img/line.png" alt="">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list"
                           href="#list-home" role="tab" aria-controls="home"> <img src="/img/analysis.png" alt="">
                            Lorem
                            ipsum
                            dolor sit amet, consectetur</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list"
                           href="#list-profile" role="tab" aria-controls="profile"> <img src="/img/analysis.png"
                                                                                         alt="">Lorem
                            ipsum dolor sit amet, consectetur</a>
                        <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list"
                           href="#list-messages" role="tab" aria-controls="messages"> <img src="/img/analysis.png"
                                                                                           alt="">Lorem
                            ipsum dolor sit amet, consectetur</a>
                        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list"
                           href="#list-settings" role="tab" aria-controls="settings"> <img src="/img/analysis.png"
                                                                                           alt="">Lorem
                            ipsum dolor sit amet, consectetur</a>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                             aria-labelledby="list-home-list">
                            <img width="100%" height="auto" src="/img/453_2961044.png" alt="">
                            <h2>
                                Lorem ipsum dolor sit amet, consectetur
                            </h2>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt
                                ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                ullamco
                                laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                in
                                voluptate velit esse cillum dolore eu fugiat nulla pariatur.

                            </p>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="line-logo">
        <div class="container">
            <div class="row register-row">
                <div class="col-12 col-md-4">
                    <div class="row register-col">
                        <div class="col-4">
                            <img src="/img/flour.png" alt="">
                        </div>
                        <div class="col-8 text-white">
                            Для грузовладельцев<br>Регистрация
                            <img src="/img/arrow.png" alt="">
                        </div>
                    </div>
                    <div class="row register-col">
                        <div class="col-4">
                            <img src="/img/truck.png" alt="">
                        </div>
                        <div class="col-8 text-white">
                            Для перевозчиков<br>Регистрация
                            <img src="/img/arrow.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7 text-white text-right p-5 pr-4">
                    <h2>
                        Удобный, автоматизированный сервис организации грузоперевозок
                    </h2>
                    <a class="register-link" href="">Зарегистрируйся сейчас!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="images">
        <div class="container">
            <div class="row">
                <div class="images-item col-8 col-md-4 p-0">
                    <img width="100%" height="100%" src="/img/img-1.png" alt="">
                    <p class="text-white">
                        <img src="/img/underline.png" alt=""> <br>
                        Перемещение больших объемов
                        грузов из хранилищ в порты,
                        между хранилищами, на производства
                    </p>
                </div>
                <div class="images-item col-4 col-md-2 p-0">
                    <img width="100%" height="100%" src="/img/img-2.png" alt="">
                    <p class="text-white">
                        <img src="/img/underline.png" alt=""> <br>
                        02
                    </p>
                </div>
                <div class="images-item col-4 col-md-2 p-0">
                    <img width="100%" height="100%" src="/img/img-3.png" alt="">
                    <p class="text-white">
                        <img src="/img/underline.png" alt=""> <br>
                        03
                    </p>
                </div>
                <div class="images-item col-4 col-md-2 p-0">
                    <img width="100%" height="100%" src="/img/img-5.png" alt="">
                    <p class="text-white">
                        <img src="/img/underline.png" alt=""> <br>
                        04
                    </p>
                </div>
                <div class="images-item col-4 col-md-2 p-0">
                    <img width="100%" height="100%" src="/img/img-6.png" alt="">
                    <p class="text-white">
                        <img src="/img/underline.png" alt=""> <br>
                        05
                    </p>
                </div>
            </div>
        </div>
    </div>



@endsection
