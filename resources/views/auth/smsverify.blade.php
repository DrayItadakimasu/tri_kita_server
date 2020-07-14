@extends('layouts.login')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 enter-col">

                @csrf
                <div class="enter-container">
                    <div class="enter-img-cont text-center">
                        <img src="/assets/img/logo-blue.png" alt="">
                    </div>

                    <div class="text-center pb-3">
                        На ваш телефон было отправлено sms с кодом подтверждения:
                    </div>

                    <div class="enter-input-container">

                        <label for="phone">
                            <span>Введите код:</span>

                            <input id="sms-code" minlength="5" maxlength="5" class="enter-redaction" value="" required
                                   autofocus>
                        </label>

                        <div class="col-12 text-center">
                            <span id="message" class="invalid-feedback " role="alert">

                            </span>
                        </div>


                    </div>

                    <div class="row">

                        <div class="text-center col-md-6 mb-5">
                            <input id="send_code" class="primary-but f-width" type="submit" value="Повторная SMS">
                        </div>

                        <div class="text-center col-md-6 mb-3">
                            <input id="send" class="primary-but f-width" type="submit" value="Подтвердить">
                        </div>


                    </div>

                    <div class="col text-center">
                        <a href="{{ route('edit.user.profile', Auth::user()->id) }}">
                            Изменить данные
                        </a>

                        <form method="post" action="/logout">
                            @csrf
                            <input class="dropdown-item" type="submit" value="Выход">

                        </form>

                    </div>

                    @if(!Cookie::get('mobile_app'))
                        <div class="grey-btn-cont d-flex align-items-center justify-content-center mt-3">
                            <a href="/">
                                <img src="/assets/img/back-home.png " alt="">На главную
                            </a>

                        </div>
                    @endif


                </div>
            </div>

        </div>
    </div>
    </div>


    <script>

        document.addEventListener("DOMContentLoaded", function () {
            var smsCode;

            $('#send').click(function () {

                smsCode = $('#sms-code').val();

                if (smsCode.length == 5) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/lk/profile/smsverify/validate/" + smsCode,
                        dataType: "json",
                        beforeSend: function () {
                            $('#send').val("Проверка, ожидайте");
                        },
                        success: function (msg) {
                            if (msg.result == "success") setTimeout(function () {
                                window.location.replace('/lk');
                            }, 1000);
                            if (msg.result == "fail") $('#message').text(msg.message);
                            $('#send').val("Проверить");

                        }
                    })
                }

            });

            $('#send_code').click(function () {

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/lk/profile/smsverify/sendcode",
                    dataType: "json",
                    beforeSend: function () {
                        $('#send_code').val("Отправка, ожидайте");
                    },
                    success: function (msg) {
                        $('#message').text(msg.message);
                        $('#send_code').val("Повторная СМС");

                    }
                });

            });

        });

    </script>




@endsection
