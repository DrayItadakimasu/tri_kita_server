<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo asset('/assets/css/styles.min.css')?>" type="text/css">
    <title>Три кита</title>
</head>
<body>


@yield('content')

@if($_SERVER["REQUEST_URI"] != '/actual')
<div class="container">
    <div class="row feedback">
        <div class="col-12 col-md-4 mb-5 mb-md-0 p-0">
            <h2 class="feedback-header">У вас остались вопросы?</h2>
            <p>Оставьте контактные даные
                и мы вам перезвоним!</p>
            <form action="">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <input class="border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                                   placeholder="Ваше имя">
                        </div>
                        <div class="form-group">
                            <input class="border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                                   placeholder="Телефон">
                        </div>
                    </div>
                    <div class="col-4">
                        <button class="button-form"></button>
                    </div>
                    <small class="pl-3">*Нажимая кнопку «Отправить» Вы соглашаетесь с
                        обработкой <a href="">персональных данных</a></small>
                </div>
            </form>
        </div>
        <div class="col-12 col-md-8 p-0">
            <h2>
                Нам доверяют
            </h2>
            <div class="partners bg-gray">
                <div class="row m-0">
                    <div class="col-3 partner1">
                        <img src="/img/partner2.png" alt="">
                    </div>
                    <div class="col-3 partner2">
                        <img src="/img/partner5.png" alt="">
                    </div>
                    <div class="col-3 partner3">
                        <img src="/img/partner6.png" alt="">
                    </div>
                    <div class="col-3 partner4">
                        <img src="/img/partner12.png" alt="">
                    </div>
                    <div class="col-3 partner5">
                        <img src="/img/partner1.png" alt="">
                    </div>
                    <div class="col-3 partner6">
                        <img src="/img/partner10.png" alt="">
                    </div>
                    <div class="col-3 partner7">
                        <img src="/img/partner4.png" alt="">
                    </div>
                    <div class="col-3 partner8">
                        <img src="/img/partner9.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<div class="contacts">
    <a id="contacts"></a>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 p-3 pt-4">
                                <img src="/img/phone.png" alt="">
                            </div>
                            <div class="col-9 p-3">
                                +7(861)201-86-93
                                +7(928)037-45-45
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 p-3 pt-4">
                                <img src="/img/avatar.png" alt="">
                            </div>
                            <div class="col-9 p-3">
                                Фамилия Имя
                                +7(000)000-00-00
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 p-3 pt-4 pl-4">
                                <img src="/img/placeholder.png" alt="">
                            </div>
                            <div class="col-9 p-3">
                                г. Краснодар, ул. Российская 361/1
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3  pt-2">
                                <img src="/img/avatar.png" alt="">
                            </div>
                            <div class="col-9 ">
                                Фамилия Имя
                                +7(000)000-00-00
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 pl-4 pt-3">
                                <img src="/img/mail.png" alt="">
                            </div>
                            <div class="col-9 pt-3">
                                info@gk-snd.ru
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3  pt-2">
                                <img src="/img/avatar.png" alt="">
                            </div>
                            <div class="col-9 ">
                                Фамилия Имя
                                +7(000)000-00-00
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 bg-white">
                <img width="100%" src="/img/map.png" alt="">
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-copy col-9">
                <img src="/img/logo.png" width="247px" alt="logo">
                © 2020 ТРИ КИТА | Все права защищены. info@trikita.ru
            </div>
            <div class="footer-copy col-3">
                <p class=" align-middle">Сайт разработан <a href="">Сектор бизнеса</a></p>
            </div>
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
</body>
</html>
