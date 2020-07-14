@extends('layouts.lk')

@section('content')



    <section id="profile">
        <div class="container">

            <div class="row messages">
                @if (isset($message))
                    <div class="d-inline-flex" id="popup_notification">
                        <strong>{{ $message }} </strong>
                    </div>
                @endif

            </div>
            <div class="row profile-info">

                <form action="{{ $action }}" method="{{ $method }}" class="row" enctype="multipart/form-data">
                    @csrf

                    @if(!Cookie::get('mobile_app'))
                        <div class="col-lg-2 col-md-12 d-flex align-items-center avatar-col">
                            <label for="">
                                <div class="user-avatar">
                                    <img
                                        src="/{{ isset($profile->photo) ? $profile->photo : 'assets/img/photo-camera.png' }}"
                                        class="user-photo" alt="">
                                </div>
                                <br>

                                <input type="file" accept=".jpg, .jpeg, .png" name="photo">

                                @error('photo')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror

                            </label>

                        </div>
                    @endif

                    <div class="col-lg-10 col-md-12">
                        <div class="info-cont d-flex">
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Фамилия</span>
                                    <input class="user-redaction" name="last_name" type="text"
                                           value="@if(@isset($profile->last_name)){{$profile->last_name}}@endif">

                                </label>
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Телефон</span>
                                    <input class="user-redaction" name="phone" type="text" value="{{ $profile->phone }}"
                                           placeholder="+7">
                                </label>
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Название организации</span>
                                    <input class="user-redaction" name="org" type="text" value="{{ $profile->org }}">
                                </label>
                                @error('org')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Имя</span>
                                    <input class="user-redaction" name="name" type="text" value="{{ $profile->name }}">
                                </label>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Email</span>
                                    <input class="user-redaction" name="email" type="text"
                                           value="{{ $profile->email }}">
                                </label>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span class="activity">Род деятельности</span><span
                                        class="activity-user">{{ $profile->group->label }}</span>
                                    <br>
                                    <span>Работаю с НДС</span>
                                    <label class="radio disp-inl">
                                        <input type="checkbox" name='work_with_nds' value="1"
                                               @if ($profile->work_with_nds) checked @endif >
                                        <div class="radio__text disp-inl"></div>
                                    </label>
                                </label>
                                @error('work_with_nds')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="profile-input-container">
                                <label for="">
                                    <span>Отчество</span>
                                    <input class="user-redaction" name="middle_name" type="text"
                                           value="{{ $profile->middle_name }}">
                                </label>
                                @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="profile-input-container">
                                <label for="">
                                    <span>Адрес регистрации:</span>
                                    <input id="reg_address" type="text"
                                           class="default-address user-redaction form-control @error('reg_address') is-invalid @enderror"
                                           name="reg_address" value="{{ $profile->reg_address }}" required>
                                </label>
                                @error('reg_address')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="profile-input-container-btn flex-end no_padding">
                                <label class="blue-but-sub" for="">
                                    <div class="blue-big-cont">
                                        <input class="blue-big-btn" type="submit" value="Сохранить">
                                    </div>
                                </label>
                            </div>

                        </div>
                    </div>
                </form>
                <hr class="bottom-line"></hr>

                <div class="row profile-info-bottom">
                    <form action="{{ $action_password }}" method="{{ $method }}" class="row">
                        @csrf
                        <div class="col-lg-12">

                            <div class="profile-bottom-container d-flex">
                                <span>Изменить пароль</span>
                                <div class="profile-input-container">
                                    <label for="">
                                        <span>Старый пароль</span>
                                        <input class="user-redaction" name="old_password" type="text">
                                    </label>

                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="profile-input-container">
                                    <label for="">
                                        <span>Новый пароль</span>
                                        <input class="user-redaction" name="password" type="text">
                                    </label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="profile-input-container">
                                    <label for="">
                                        <span>Повторите новый пароль</span>
                                        <input class="user-redaction" name="password_confirmation" type="text">
                                    </label>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="profile-input-container-btn flex-end no_padding">
                                    <label class="blue-but-sub" for="">
                                        <div class="blue-big-cont">
                                            <input class="blue-big-btn" type="submit" value="Сохранить">
                                        </div>
                                    </label>

                                </div>
                                @if (session()->has('success'))
                                    <div class="alert-success" id="popup_notification">
                                        <strong>{{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>


                </div>

                <hr class="bottom-line"></hr>
                <div class="row profile-info-bottom">
                    <form action="{{ action('lk\UserProfileController@setUserGroup',$profile->id) }}" method="POST"
                          class="row">
                        @csrf
                        <div class="col-lg-12">

                            <div class="profile-bottom-container d-flex">
                                <span>Изменить Группу</span>
                                <div class="profile-input-container" style="min-width:250px;">
                                    <label for="">
                                        <span>Выберите</span>
                                        <select class="enter-redaction" name="group_id">
                                            @foreach (app\UserGroup::where('allow_register',1)->get() as $group)
                                                <option value="{{ $group->id }}">{{ $group->label }}</option>
                                            @endforeach
                                        </select>
                                    </label>

                                    @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>

                                <div class="profile-input-container-btn flex-end no_padding">
                                    <label class="blue-but-sub" for="">

                                        <input class="blue-big-btn" type="submit" value="Сохранить">

                                    </label>

                                </div>
                                @if (session()->has('success'))
                                    <div class="alert-success" id="popup_notification">
                                        <strong>{{ session('success') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>


                </div>


                <hr class="bottom-line">
                <!-- Банковские реквизиты  -->
                <form enctype="multipart/form-data" action="{{ route('user.bank.info', $profile->id) }}" method="POST">
                    @csrf
                    <div class="col-lg-12">
                        <div class="row profile-info-bottom">
                            <div class="col-lg-12">
                                <div class="bank-bottom-container d-flex">
                                    <span>Банковские реквизиты</span>
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>БИК</span>
                                            <input value="@isset($profile->banks) {{ $profile->banks->bik }}  @endisset"
                                                   class="user-redaction" name="bik" type="text">
                                        </label>
                                        @error('bik')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Название банка</span>
                                            <input
                                                value="@isset($profile->banks) {{ $profile->banks->bank_name }}@endisset"
                                                class="user-redaction" name="bank_name" type="text">
                                        </label>
                                        @error('bank_menu')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="profile-bottom-container d-flex" style="padding-top: 0px;">
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Счет</span>
                                            <input
                                                value="@isset($profile->banks) {{ $profile->banks->bank_account }} @endisset"
                                                class="user-redaction" name="bank_account" type="text">
                                        </label>
                                        @error('bank_account')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Номер счёта</span>
                                            <input
                                                value="@isset($profile->banks){{ $profile->banks->bank_account_number }} @endisset"
                                                class="user-redaction" name="bank_account_number" type="text">
                                        </label>
                                        @error('bank_account_number')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="profile-input-container"></div>
                                    <div class="profile-input-container-btn flex-end no_padding pd-xs">
                                        <label class="blue-but-sub" for="">
                                            <div class="blue-big-cont">
                                                <input class="blue-big-btn" type="submit" value="Сохранить">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                @if(Cookie::get('vendor')=="android")
                    <hr class="bottom-line">

                    <div class="row profile-info-bottom">
                        <form action="{{ route('token.exit') }}" method="POST" class="row">
                            @csrf
                            <div class="col-lg-12">

                                <div class="profile-bottom-container d-flex">
                                    <span>Загрузить документы</span>

                                    <div class="profile-input-container-btn flex-end no_padding">
                                        <label class="blue-but-sub" for="">

                                            <input class="blue-big-btn" style="min-width: 200px" type="submit"
                                                   value="Перейти к загрузке">

                                        </label>

                                    </div>
                                    @if (session()->has('success'))
                                        <div class="alert-success" id="popup_notification">
                                            <strong>{{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>


                    </div>




                @endif

                @if(Cookie::get('vendor')!="android")
                    <hr class="bottom-line">
                    <!-- Пользовательские документы  -->
                    <form enctype="multipart/form-data" action="{{ route('user.private.info', $profile->id) }}"
                          method="POST">
                        @csrf
                        <div class="col-lg-12">
                            <div class="row profile-info-bottom">
                                <div class="bank-bottom-container d-flex">
                                    <span>Пользовательские документы</span>
                                </div>
                                <div class="documents-cont">
                                    <div class="documents">
                                        <div class="profile-input-container">
                                            <label for="">
                                                <span>ИНН</span>
                                                <input id="inn" class="user-redaction"
                                                       value="@isset($profile->documents) {{ $profile->documents->inn }} @endisset"
                                                       name="inn" type="text">
                                            </label>
                                            @error('inn')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <div class="profile-input-container">
                                            <div class="add-file-cont">
                                                <span class="sts-2">ИНН (скан)</span>
                                                <div>
                                                    <input name="inn_image" type="file">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-input-container">
                                        <label for="">
                                            <span>Полное название организации</span>
                                            <input id="agency_name"
                                                   value="@isset($profile->documents) {{ $profile->documents->agency_name }} @endisset"
                                                   class="user-redaction" name="agency_name" type="text">
                                        </label>
                                        @error('agency_name')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                    <div class="documents">
                                        <div class="profile-input-container">
                                            <label for="">
                                                <span>ОГРН</span>
                                                <input
                                                    value=" @isset($profile->documents){{ $profile->documents->ogrn }} @endisset"
                                                    class="user-redaction" name="ogrn" id="ogrn" type="text">
                                            </label>
                                            @error('ogrn')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <div class="profile-input-container">
                                            <div class="add-file-cont">
                                                <span class="sts-2">ОГРН (скан)</span>
                                                <div>
                                                    <input name="ogrn_image" type="file">
                                                </div>
                                                @error('ogrn_image')
                                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="documents">
                                        <div class="profile-input-container">
                                            <label for="">
                                                <span>Серия паспорта</span>
                                                <input
                                                    value=" @isset($profile->documents){{ $profile->documents->passport_series }} @endisset"
                                                    class="user-redaction" name="passport_series" type="text">
                                            </label>
                                            @error('passport_series')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <div class="profile-input-container">
                                            <label for="">
                                                <span>Номер паспорта</span>
                                                <input
                                                    value=" @isset($profile->documents){{ $profile->documents->passport_number }} @endisset"
                                                    class="user-redaction" name="passport_number" type="text">
                                            </label>
                                            @error('passport_number')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <div class="profile-input-container" style="padding-right: 10px;">
                                            <div class="add-file-cont">
                                                <span class="sts-2">Паспорт (главная+подписка)</span>
                                                <div>
                                                    <input name="passport_front" type="file">
                                                </div>
                                                <div>
                                                    <input name="passport_back" type="file">
                                                </div>
                                            </div>
                                            @error('inn_image')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                        <div class="profile-input-container-btn flex-end no_padding pd-xs">
                                            <label class="blue-but-sub" for="">
                                                <div class="blue-big-cont">
                                                    <input class="blue-big-btn" type="submit" value="Сохранить">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif


            </div>
        </div>
    </section>

@endsection
