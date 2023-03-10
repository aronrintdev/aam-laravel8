<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::post('login', 'UserController@login', 'login');
    Route::post('register', 'RegisterController@register', 'register');
    Route::any('/register/activate/{code}', 'RegisterController@activate')->name('registration.activate');
    Route::any('/register/resend', 'RegisterController@resend', 'resend')->name('registration.resend');
});

Route::group(['middleware' => 'permissive'], function () {
    Route::get('/academies/{id}/branding', 'AcademyAPIController@branding')->name('academies.branding');
    Route::get('/academies/{id}/instructors', 'AcademyAPIController@showInstructors')->name('academies.instructors');
    Route::get('/avatar/{id}/defaultimage.png', 'AccountAvatarAPIController@defaultImage')->name('avatar.default.image');
    Route::get('/avatar/{id}', 'AccountAvatarAPIController@show');
    Route::get('/apicheck', 'VersionAPIController@check');
    Route::get('/instructors/', 'InstructorAPIController@index');
    Route::get('/instructors/search', 'InstructorAPIController@search')->name('instructors.search');
    Route::post('/session/refresh', 'SessionAPIController@refresh');

    Route::get('videos/models', 'LockerAPIController@showModels');
    Route::get('videos/pro-models', 'LockerAPIController@showPlusModels');
    Route::get('videos/plus-models', 'LockerAPIController@showPlusModels');
    Route::get('videos/drills', 'LockerAPIController@showDrills');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
Route::middleware('auth:api')->get('/me', 'UserController@details')->name('user.details');

//Route::get('/update-password-test/', 'AccountAPIController@updatePasswordTest');
Route::group(['middleware' => 'auth:backend,api'], function () {
    Route::get('/search-accounts/', 'AccountAPIController@search');
    Route::post('/update-password/', 'AccountAPIController@updatePassword');
    Route::get('/academies/{id}', 'AcademyAPIController@show')->name('academies.show');
    Route::patch('/academies/{id}/branding', 'AcademyAPIController@brandingUpdate')->name('academies.branding.update');
    Route::post('/academies/{id}/branding/logo', 'AcademyAPIController@uploadLogo')->name('academies.branding.uploadLogo');
    Route::post('/academies/{id}/branding/banner', 'AcademyAPIController@uploadBanner')->name('academies.branding.uploadBanner');
    Route::post('/accounts/{id}/pick/{instructorId}', 'AccountAPIController@pick')->name('accounts.pick.instructor');
    Route::post('/academies/{id}/enroll/{userid}', 'AcademyAPIController@enrollAcademyUser');
    Route::get('/videolessons', 'LockerAPIController@videoLessonIndex');

    Route::get('/accounts/{id}/', 'AccountAPIController@show');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('accounts', 'AccountAPIController');

    Route::resource('academies', 'AcademyAPIController');

    #Route::resource('instructors', 'InstructorAPIController');
    Route::get('instructors/{id}', 'InstructorAPIController@show');
    //Route::put('instructors/{id}', 'InstructorAPIController@store');
    Route::post('instructors/{id}', 'InstructorAPIController@update');

    #Route::resource('avatar', 'AvatarAPIController');
    Route::post('/avatar/{id}', 'AccountAvatarAPIController@store');
    Route::put('/avatar/{id}', 'AccountAvatarAPIController@update');
    Route::post('/avatar/{id}/update', 'AccountAvatarAPIController@update');
    Route::patch('/avatar/{id}', 'AccountAvatarAPIController@update');
    Route::delete('/avatar/{id}', 'AccountAvatarAPIController@destroy');
    Route::resource('avatar', 'AccountAvatarAPIController');


    #Route::resource('locker', 'LockerAPIController');
    Route::get('locker/{swingId}/analysis', 'LockerAPIController@swingAnalysis');
    Route::get('locker/{accountId?}', 'LockerAPIController@index');
    #Route::get('videolessons', 'LockerAPIController@videoLessonIndex');
    Route::post('locker/assignSwings', 'LockerAPIController@assignSwings');

    Route::get('/accounts/{id}/academies', 'AccountAPIController@showAcademies');
    Route::post('/accounts/{id}/follow/{instructorId}', 'AccountAPIController@follow')->name('accounts.follow.instructor');

    Route::get('/instructors/{id}/students', 'InstructorAPIController@showStudents', 'instructors.students.get');
    Route::post('/instructors/{id}/students', 'InstructorAPIController@showStudents', 'instructors.students.filter');
    Route::post('/instructors/{id}/headshot', 'InstructorAPIController@headshot', 'instructors.headshot.update');

    Route::post('/academies/{id}/enroll', 'AcademyAPIController@enrollAcademy');
    Route::post('/session/{id}/switch', 'SessionAPIController@switchAcademy');
    Route::post('/session/check', 'SessionAPIController@checkJwt');
    Route::post('/session/logout', 'SessionAPIController@logout');

    Route::resource('licenses', 'LicenseAPIController');
});
