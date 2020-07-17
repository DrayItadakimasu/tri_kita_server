@extends('layouts.login')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 enter-col">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="enter-container">
                        <div class="enter-img-cont text-center">
                        </div>


                        <div class="enter-input-container">

                            <label for="phone">
                                <span>Телефон</span>
                                <input id="phone" class="enter-redaction" name="phone" value="{{ old('phone') }}"
                                       placeholder="+7" required autocomplete="phone">
                            </label>

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror

                        </div>
                        <div class="enter-input-container">
                            <label for="password">
                                <span>Пароль</span>
                                <input id="password" type="password" class="enter-redaction" name="password" required
                                       autocomplete="current-password">

                            </label>


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="forgot-pass d-flex justify-content-between">

                            <div class="d-flex">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>

                                <label class="form-check-label" for="remember">
                                    {{ __('Запомнить меня') }}
                                </label>

                            </div>
                            @if (Route::has('pssw'))
                                <a href="{{ route('pssw') }}">Забыли пароль?</a>
                            @endif
                        </div>


                        <div class="text-center">
                            <input class="primary-but" type="submit" value="Вход">
                        </div>
                        <div class="reg text-center">
                            <a href="/register">Зарегистрироваться</a>
                        </div>
                        @if(!Cookie::get('mobile_app'))
                            <div class="grey-btn-cont d-flex align-items-center justify-content-center">
                                <a href="/">
                                    <img src="/assets/img/back-home.png" alt="">На главную
                                </a>
                            </div>
                        @endif

                    </div>
                </form>
            </div>
        </div>
    </div>






@endsection
