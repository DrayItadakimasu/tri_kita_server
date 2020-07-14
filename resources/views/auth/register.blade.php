@extends('layouts.login')

@section('content')


    <div class="container">
        <div class="row justify-content-center enter-col">
            <div class="col-lg-6 registration-container ">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="reg-logo-container text-center">
                                <img src="/assets/img/logo-blue.png" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12 reg-col">

                            <div class="reg-input-container">
                                <label for="">
                                    <span>Имя</span>
                                    <input id="name" type="text"
                                           class="enter-redaction form-control @error('name') is-invalid @enderror"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </label>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>


                            <div class="reg-input-container">
                                <label for="">
                                    <span>Фамилия</span>
                                    <input id="last_name" type="text"
                                           class="enter-redaction form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required
                                           autocomplete="last_name">
                                </label>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="reg-input-container">
                                <label for="">
                                    <span>Выберите род деятельности</span>


                                    <select class="enter-redaction" name="group_id">
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->label }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                @error('group_id')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="reg-input-container">
                                <label for="">
                                    <span>Название организации</span>
                                    <input id="org" type="text"
                                           class="org-input enter-redaction form-control @error('name') is-invalid @enderror"
                                           name="org" value="{{ old('org') }}" autocomplete="org">
                                </label>
                                @error('org')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="reg-input-container">
                                <label for="">
                                    <span>Пароль</span>
                                    <input id="password" type="password"
                                           class="enter-redaction form-control @error('name') is-invalid @enderror"
                                           name="password" value="{{ old('password') }}" name="password" required
                                           autocomplete="new-password">
                                </label>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                            <div class="reg-input-container">
                                <label for="">
                                    <span>Повторите пароль</span>
                                    <input id="password-confirm" type="password"
                                           class="enter-redaction form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" value="{{ old('password_confirmation') }}"
                                           name="password_confirmation" required autocomplete="new-password">
                                </label>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                            <div class="reg-input-container">
                                <label for="">
                                    <span>Телефон</span>
                                    <input id="phone" type="text"
                                           class="phone-input enter-redaction form-control @error('name') is-invalid @enderror"
                                           name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                </label>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>
                            <div class="reg-input-container">
                                <label for="">
                                    <span>Адрес регистрации:</span>
                                    <input id="reg_address" type="text"
                                           class="default-address enter-redaction form-control @error('reg_address') is-invalid @enderror"
                                           name="reg_address" value="{{ old('reg_address') }}" required
                                           autocomplete="reg_address">
                                </label>
                                @error('reg_address')
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                @enderror
                            </div>

                            <div class="reg-input-container registr-btn-cont">
                                <input class="primary-but" type="submit" value="Регистрация">
                                <a href="/login">Вход</a>
                                <span class="registr-warning">Регистрацией вы подтверждание
                        свое согласие с публичной офертой</span>
                            </div>
                            @if(!Cookie::get('mobile_app'))
                                <div class="col-lg-12">
                                    <div class="grey-btn-cont-reg d-flex align-items-center justify-content-center">
                                        <a href="/">
                                            <img src="/assets/img/back-home.png" alt="">На главную
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
