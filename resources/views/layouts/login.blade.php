<!DOCTYPE html>
<html lang="ru">

<head>
    @extends("sections.head")
</head>

<body class="login">
<section>
    <div class="container">
        <div class="row">
            <div class="col-6 left-image">
                <div class="left-image-child"></div>
                <div class="login-card">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <img src="/img/logo.png" alt="">
                    <div class="">
                        <label for="phone">
                            <span>Логин</span>
                            <input id="phone" class="enter-redaction form-control" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="+7" required autocomplete="phone">
                        </label>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <span>Пароль</span>
                            <input id="password" type="password" class="enter-redaction form-control" name="password"
                                   required
                                   autocomplete="current-password">
                        </label>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input class="login-button" type="submit" value="Войти">
                    </div>
                    @if (Route::has('pssw'))
                        <a href="{{ route('pssw') }}">Забыли пароль?</a>
                    @endif
                    </form>
                </div>
            </div>
            <div class="col-6 login-right">
                <h2>
                    Перевозка наливных и сельскохозяйственных грузов в больших объемах
                </h2>
                <p class="login-text">
                    Прозрачный и надежный сервис обслуживания грузоперевозок
                </p>
                <form class="feedback-form" action="">
                    <div class="d-flex">
                        <input class=" m-2 border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                               placeholder="Ваше имя">
                        <input class="m-2 border-top-0 border-left-0 border-right-0 border-bottom" type="text"
                               placeholder="Телефон">
                        <button class="button-form"></button>
                    </div>
                    <small class="">*Нажимая кнопку «Отправить» Вы соглашаетесь с<br>
                        обработкой <a href="">персональных данных</a></small>
                </form>
                <div class="row buttons">
                    <a class="" href="/">
                        <button class=" text-center button-login button-home">
                            На главную
                        </button>
                    </a>
                    <a class="" href="">
                        <button class=" text-center button-login button-contacts">
                            Контакты
                        </button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-7 ml-auto partners bg-gray">
                <div class="bg-gray-child"></div>
                <div class="partners-content">
                    <p>
                        Нам доверяют!
                    </p>
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
    <div class="footer py-4">
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
</section>

@include ("sections.js")

</body>

</html>
