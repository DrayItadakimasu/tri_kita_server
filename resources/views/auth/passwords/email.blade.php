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


                <form method="POST" action="{{ route('password.email') }}">

                    @csrf


                    <div class="enter-container">
                        <div class="enter-img-cont text-center">
                            <img src="/assets/img/logo-blue.png" alt="">
                        </div>


                        <div class="enter-input-container">
                            <label for="phone">
                                <span>Телефон:</span>
                                <input id="phone"
                                       class="form-control enter-redaction @error('phone') is-invalid @enderror"
                                       name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            </label>


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>


                        <div class="text-center pb-5">
                            <input class="primary-but" type="submit" value="Отправить код">
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

@endsection





<style>
    body {
        background-image: url(/assets/img/enter.png);
        background-size: cover;
        background-position: top 15px center;
    }
</style>
