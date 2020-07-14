@extends('layouts.login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" class="form-control @error('phone') is-invalid @enderror"
                                           name="phone" value="{{ $phone ?? old('phone') }}" required placeholder="+7"
                                           autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>

                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 enter-col">
                <form method="POST" action="{{ route('password.update') }}">

                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="enter-container">
                        <div class="enter-img-cont text-center">
                            <img src="/assets/img/logo-blue.png" alt="">
                        </div>


                        <div class="enter-input-container">

                            <label for="email">
                                <span>Телефон</span>
                                <input id="email" class="enter-redaction" type="email" name="email"
                                       value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </label>

                            @error('email')
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


                        <div class="enter-input-container">
                            <label for="password">
                                <span>Повторите пароль</span>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">

                            </label>


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="text-center">
                            <input class="primary-but" type="submit" value="Изменить пароль">
                        </div>

                        <div class="grey-btn-cont d-flex align-items-center justify-content-center">
                            <a href="/login/">
                                <img src="/assets/img/back-home.png" alt="">Ко входу
                            </a>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>


    <style>
        body {
            background-image: url(/assets/img/enter.png);
            background-size: cover;
            background-position: top 15px center;
        }
    </style>




@endsection
