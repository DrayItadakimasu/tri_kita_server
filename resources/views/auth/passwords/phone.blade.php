@extends('layouts.login')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 enter-col">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                <div class="enter-container">
                    <div class="enter-img-cont text-center">
                        <img src="/assets/img/logo-blue.png" alt="">
                    </div>

                    <div class="col-12 pb-3" id="message">
                        1. Введите номер телефона указанный при регистрации<br>
                        2. Нажмите на кнопку "Получить код"<br>
                        3. Введите полученый код<br>
                        4. Введите новый пароль<br>
                        3. Нажмите на кнопку "Изменить пароль"<br>
                    </div>

                    <div class="enter-input-container">
                        <label for="phone" id="phone_container">
                            <span>Телефон:</span>
                            <input id="phone" class="form-control enter-redaction @error('phone') is-invalid @enderror"
                                   name="phone" placeholder="+7" value="{{ old('phone') }}" required
                                   autocomplete="phone">
                            <div class="text-center pt-2">
                                <input id="send" class="primary-but" type="submit" value="Получить код">
                            </div>
                        </label>

                        <div class="edit_container">
                            <label for="phone">
                                <span>Введите код:</span>
                                <input id="code" class="form-control enter-redaction" type="number" minlength="5"
                                       maxlength="5" name="code">
                            </label>


                            <label for="phone">
                                <span>Введите новый пароль</span>
                                <input id="password" class="form-control enter-redaction" name="password"
                                       type="password" minlength="8">
                            </label>

                            <label for="phone">
                                <span>Подтвердите пароль</span>
                                <input id="password_confirmed" class="form-control enter-redaction" name="password"
                                       type="password" minlength="8">
                            </label>

                            <div class="text-center pt-1 pb-1">
                                <input id="password_edit" class="primary-but" type="submit" value="Изменить пароль">
                            </div>
                        </div>


                    </div>

                    <div class="grey-btn-cont d-flex align-items-center justify-content-center">
                        <a href="/login/">
                            <img src="/assets/img/back-home.png" alt="">Ко входу
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var phone;

            $('#send').click(function () {

                phone = $('#phone').val();

                if (phone != "") {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/password/reset/phone/" + phone,
                        dataType: "json",
                        beforeSend: function () {
                            $('#send').val("Отправка кода");
                        },
                        success: function (msg) {
                            if (msg.result == "success") {

                                $('#message').text(msg.message);
                                $('.edit_container').show(500);
                                $('#phone_container').hide(500);
                                //setTimeout( function (){ window.location.replace('/login'); }, 3000)
                            }


                            if (msg.result == "fail") $('#message').text(msg.message);
                            $('#send').val("Получить код");

                        }
                    })

                }

            });

            $('#password_edit').click(function () {

                //phone = $('#phone').val();
                password = $('#password').val();
                password_confirmed = $('#password_confirmed').val();
                code = $('#code').val();

                if (password !== password_confirmed || password == '' || password_confirmed == '') {

                    $('#message').text('Пароли не совпадают');
                    return false;

                } else {

                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/password/reset",
                        dataType: "json",
                        data: {phone: phone, password: password, code: code},
                        beforeSend: function () {
                            $('#password_edit').val("Отправка пароля");
                        },
                        success: function (msg) {
                            if (msg.result == "success") {

                                $('#message').text(msg.message);
                                setTimeout(function () {
                                    window.location.replace('/login');
                                }, 3000)
                            }


                            if (msg.result == "fail") $('#message').text(msg.message);
                            $('#password_edit').val("Изменить пароль");

                        }
                    })

                }

            });

        });

    </script>



    <style>
        body {
            background-image: url(/assets/img/enter.png);
            background-size: cover;
            background-position: top 15px center;
        }

        .edit_container {
            display: none;
        }
    </style>

@endsection
