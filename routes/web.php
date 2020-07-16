<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::any('/owners', function () {
    return view('owners');
});

Route::any('/drivers', function () {
    return view('drivers');
});

Route::any('/lk', 'LkController@index')->name('lk');
Route::get('/lk/application/create', 'lk\ApplicationController@create')->name('create.application');
Route::post('/lk/application/create', 'lk\ApplicationController@store')->name('store.application');

Route::get('/contacts', function () {

    return view('front.contacts');

});

Route::get('/support', function () {

    return view('front.contacts');

});

Route::get('/app/main.json', function (Request $request) {

    if ($request->ip() == '193.161.215.214' or $request->ip() == '192.168.10.1') { //
        return response()->file(public_path('/app/main.android.json'));
    } else {
        return response()->file(public_path('/app/main.resource.json'));
    }

});


Route::post('/getdata/loadplace', 'lk\ApplicationController@getPlaceLoad');
Route::post('/getdata/application', 'lk\ApplicationController@getApplicationInfo');
Route::get('/', 'LandingController@index')->name('landing');
Route::get('/how', 'LandingController@howWork')->name('how');
Route::get('/policy', 'LandingController@policy')->name('policy');


Auth::routes();


Route::post('login', 'Auth\LoginController@login')->middleware('guest')->middleware('phone.render');
Route::get('login', 'Auth\LoginController@showLoginForm')->middleware('mobile.app')->middleware('guest')->name('login');

Route::group(['middleware' => 'guest'], function () {
    Route::post('/register', 'Auth\RegisterController@register')->middleware('register.security')->middleware('phone.render');
    Route::get('/password/reset', 'Auth\ResetPasswordController@showResetPasswordForm')->name('pssw');
    Route::post('/password/reset/phone/{phone}', 'Auth\ResetPasswordController@updatePasswordPhone');
    Route::post('/password/reset', 'Auth\ResetPasswordController@updatePasswordCode')->middleware('phone.render');

});

// принять токен-авторизацию
Route::get('/login/to/', 'Auth\AuthtokenController@enterToken')->name('token.enter');

Route::group(['middleware' => 'auth'], function () {

    // открыть токен-авторизацию
    Route::post('/login/exit/', 'Auth\AuthtokenController@exitToken')->name('token.exit');

    Route::group(['middleware' => 'sms.validate'], function () {
        // Машруты верификации
        Route::post('/lk/profile/smsverify/sendcode', 'Auth\SmsVerificationController@updateCode');
        Route::post('/lk/profile/smsverify/validate/{sms_code}', 'Auth\SmsVerificationController@verify');
        Route::get('/lk/profile/smsverify/', 'Auth\SmsVerificationController@PageVerification');
    });

    //Личный кабинет
    //Route::get('/lk', 'LkController@index')->middleware('mobile.app')->middleware('lk.access:admin,driver,customer')->name('lk');

    // Профиль
    Route::get('/lk/profile/', 'lk\UserProfileController@toProfile')->middleware('lk.access:admin,driver,customer')->name('to.profile');
    Route::get('/lk/profile/{user_id}', 'lk\UserProfileController@showProfile')->middleware('lk.access:admin,driver,customer')->name('profile');
    Route::get('/lk/profile/{user_id}/edit', 'lk\UserProfileController@showEditFormProfile')->middleware('lk.access:self,admin,noverify')->name('edit.profile.form');
    Route::post('/lk/profile/{user_id}/edit', 'lk\UserProfileController@editProfile')->middleware('lk.access:self,admin,noverify')->name('edit.user.profile');
    Route::post('/lk/profile/{user_id}/edit/password', 'lk\UserProfileController@editPassword')->middleware('lk.access:self,admin')->name('edit.user.password');
    Route::post('/lk/profile/update/{user_id}', 'lk\UserProfileController@updateNotificationSettings')->middleware('lk.access:self,admin,noverify')->name('notifications.settings');
    //Приватные данные пользователя
    Route::post('/lk/profile/{user_id}/userdoc/edit', 'UserDocumentsController@edit')->middleware('lk.access:self,admin')->name('user.private.info');
    Route::post('/lk/profile/{user_id}/userbank/edit', 'lk\UserProfileController@bankReqst')->middleware('lk.access:self,admin')->name('user.bank.info');
    //Добавить Машину
    Route::post('/lk/profile/{user_id}/new/car', 'lk\UserProfileController@addNewCar')->middleware('lk.access:self,admin')->name('user.car.new');
    //Удалить Машину
    Route::delete('/lk/profile/{user_id}/car/{car}/delete', 'lk\UserProfileController@deleteCar')->middleware('lk.access:self,admin')->name('user.car.delete');
    //Добавить Водителя
    Route::post('/lk/profile/{user_id}/new/driver', 'lk\UserProfileController@addNewDriver')->middleware('lk.access:self,admin')->middleware('phone.render')->name('user.driver.new');
    //Удалить Машину
    Route::delete('/lk/profile/{user_id}/driver/{driver}/delete', 'lk\UserProfileController@deleteDriver')->middleware('lk.access:self,admin')->name('user.driver.delete');

    Route::get('/lk/profile/{user_id}/getfile/{type}/{file_id}', 'privateFilesController@getFile')->middleware('lk.access:self,admin')->middleware('phone.render')->name('getfile');
    // обновить группу
    Route::post('/lk/profile/{user_id}/setgroup/', 'lk\UserProfileController@setUserGroup')->middleware('lk.access:self,admin')->middleware('register.security')->name('set.group');


    // Подписки
    Route::get('/lk/profile/{user_id}/subscribtions/', 'lk\SubscriptionController@show')->middleware('lk.access:self,admin')->name('show.subscribtions');
    Route::post('/lk/profile/{user_id}/subscribe/load/', 'lk\SubscriptionController@storeLoadSubscribtion')->middleware('lk.access:self,admin')->name('store.load.subscribtion');
    Route::post('/lk/profile/{user_id}/subscribe/unload/', 'lk\SubscriptionController@storeUnloadSubscribtion')->middleware('lk.access:self,admin')->name('store.unload.subscribtion');
    Route::post('/lk/profile/{user_id}/subscribe/destroy/{type}/{id}/', 'lk\SubscriptionController@destroy')->middleware('lk.access:self,admin')->name('destroy.subscribtion');
    Route::post('/lk/profile/{user_id}/subscribe/update/{type}/{id}', 'lk\SubscriptionController@update')->middleware('lk.access:self,admin')->name('update.subscribtion');

    // Отзывы
    Route::post('/lk/profile/{user_id}/review/add/', 'lk\ReviewController@store')->middleware('lk.access:admin,driver,customer')->name('add.review');
    Route::post('/lk/profile/{user_id}/review/{review}/remove/', 'lk\ReviewController@destroy')->middleware('lk.access:admin')->name('remove.review');

    //black_list
    Route::get('/lk/profile/{user_id}/blacklist/{user?}/', 'lk\BlackListController@allblackList')->middleware('lk.access:self,admin')->name('blacklist');
    Route::post('/lk/profile/{user_id}/blacklist/add', 'lk\BlackListController@create')->name('add.blacklist');
    Route::post('/lk/profile/{user_id}/blacklist/delete', 'lk\BlackListController@delete')->middleware('lk.access:self,admin')->name('delete.blacklist');

    //Заявки
    Route::get('/lk/application/create', 'lk\ApplicationController@create')->name('create.application');
    Route::post('/lk/application/create', 'lk\ApplicationController@store')->name('store.application');
    Route::get('/lk/application/{id}', 'lk\ApplicationController@show')->middleware('lk.access:admin,driver,customer')->name('show.application');
    Route::get('/lk/myapplications/', 'lk\ApplicationController@myApplications')->name('my.application');
    Route::get('/lk/application/{application}/edit/', 'lk\ApplicationController@edit')->middleware('lk.access:self_answers,admin')->name('edit.application');
    Route::post('/lk/application/{application}/edit/', 'lk\ApplicationController@update')->middleware('lk.access:self_answers,admin')->name('update.application');
    Route::post('/lk/application/{application}/close/', 'lk\ApplicationController@close')->middleware('lk.access:self_answers,admin')->name('close.application');
    Route::post('/lk/application/{application}/start/', 'lk\ApplicationController@start')->middleware('lk.access:self_answers,admin')->name('start.application');
    Route::post('/lk/application/{application}/remove/', 'lk\ApplicationController@destroy')->middleware('lk.access:self_answers,admin')->name('destroy.application');
    Route::post('/lk/application/{application}/up/', 'lk\ApplicationController@up')->middleware('lk.access:self_answers,admin')->name('up.application');
    Route::post('/getdata/distance', 'lk\ApplicationController@getDistance');

    // Ответы

    Route::post('/lk/application/{id}/answers/create', 'lk\AnswerController@store')->name('add.answer');
    Route::group(['middleware' => 'lk.access:self_answers,admin'], function () {
        Route::post('/lk/application/{application}/answers/{answer}/remove/', 'lk\AnswerController@destroy')->name('remove.answer');
        Route::post('/lk/application/{application}/answers/{answer}/approve/', 'lk\AnswerController@approve')->name('approve.answer');
        Route::post('/lk/application/{application}/answers/{answer}/unapprove/', 'lk\AnswerController@unapprove')->name('unapprove.answer');
        Route::get('/lk/application/{application}/answers/', 'lk\AnswerController@listing')->name('listing.answer');
    });

    // Свободные водители
    Route::get('/lk/freedrivers/', 'lk\FreeDriversController@show')->name('free.drivers.show');
    Route::post('/lk/freedrivers/', 'lk\FreeDriversController@create')->name('free.drivers.create');
    Route::post('/lk/freedrivers/delete/{FreeDrivers}', 'lk\FreeDriversController@destroy')->name('free.drivers.destroy');

    // форум

    Route::get('/forum', 'Forum\SectionController@index')->name('forum');
    // Разделы
    Route::get('/forum/{section}/', 'Forum\SectionController@show')->name('forum.section');
    Route::get('/forum/section/new', 'Forum\SectionController@create')->name('forum.section.create')->middleware('lk.access:admin');
    Route::post('/forum/section/new', 'Forum\SectionController@store')->name('forum.section.store')->middleware('lk.access:admin');
    Route::post('/forum/section/{section}/delete/', 'Forum\SectionController@destroy')->name('forum.section.delete')->middleware('lk.access:admin');

    // Темы
    Route::get('/forum/{section}/{topic}', 'Forum\TopicController@show')->name('forum.topic');
    Route::get('/forum/{section}/topic/new', 'Forum\TopicController@create')->name('forum.topic.create');
    Route::post('/forum/{section}/topic/new', 'Forum\TopicController@store')->name('forum.topic.store');
    Route::post('/forum/{section}/{topic}/delete', 'Forum\TopicController@destroy')->name('forum.topic.delete')->middleware('lk.access:admin');

    //сообщения
    Route::post('/forum/{section}/{topic}/message/send', 'Forum\MessageController@store')->name('forum.message.send');
    Route::post('/forum/{section}/{topic}/{message}/delete', 'Forum\MessageController@destroy')->name('forum.message.delete')->middleware('lk.access:admin');

    Route::post('/logout', 'Auth\LoginController@logout')->middleware('logout.app')->name('logout');


    //Админ
    Route::get('/admin/verify/users', 'adminController@ShowUsers')->middleware('lk.access:admin')->name('show.users');
    Route::post('/admin/verify/documents/{document}', 'adminController@verifyUser')->middleware('lk.access:admin')->name('verify.userDocs');
    Route::get('/admin/verify/cars', 'adminController@showCars')->middleware('lk.access:admin')->name('show.cars');
    Route::post('/admin/verify/cars/{car}', 'adminController@verifyCar')->middleware('lk.access:admin')->name('verify.car');
    Route::get('/admin/verify/drivers', 'adminController@showDrivers')->middleware('lk.access:admin')->name('show.drivers');
    Route::post('/admin/verify/drivers/{driver}', 'adminController@verifyDriver')->middleware('lk.access:admin')->name('verify.driver');
    Route::get('/admin/users/', 'Admin\UserListController@show')->middleware('lk.access:admin')->middleware('phone.render')->name('show.admin.users');
    // экспорт пользователей
    Route::get('/admin/users/export/', 'Admin\UserListController@export')->middleware('lk.access:admin')->middleware('phone.render')->name('export.admin.users');

    Route::get('/admin/users/{user}', 'Admin\UserSettings@show')->middleware('lk.access:admin')->name('show.admin.users.settings');
    Route::post('/admin/users/{user}', 'Admin\UserSettings@edit')->middleware('lk.access:admin')->name('show.admin.users.settings.edit');

    Route::get('/admin/newsletters/', 'Admin\NewsLettersController@show')->middleware('lk.access:admin')->name('show.admin.newsletters');
    Route::post('/admin/newsletters/', 'Admin\NewsLettersController@create')->middleware('lk.access:admin')->name('create.admin.newsletters');

});
Route::get('/', function () {
    return view('index');
});
Route::get('/actual', 'LandingController@actual')->name('actual');


