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
    Route::get('/academies/{id}/branding', 'AcademyAPIController@branding')->name('academies.branding');
    Route::get('/academies/{id}/instructors', 'AcademyAPIController@showInstructors')->name('academies.instructors');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
//Route::get('/update-password-test/', 'AccountAPIController@updatePasswordTest');
Route::group(['middleware' => 'auth:backend,api'], function () {
    Route::get('/search-accounts/', 'AccountAPIController@search');
    Route::post('/update-password/', 'AccountAPIController@updatePassword');
    Route::get('/academies/{id}', 'AcademyAPIController@show')->name('academies.show');
    Route::put('/academies/{id}/branding', 'AcademyAPIController@brandingUpdate')->name('academies.branding.update');
    Route::post('/accounts/{id}/follow/{instructorId}', 'AccountAPIController@follow')->name('accounts.follow');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('accounts', 'AccountAPIController');

    Route::resource('academies', 'AcademyAPIController');

    Route::resource('instructors', 'InstructorAPIController');

    Route::resource('locker', 'LockerAPIController');
    Route::post('locker/assignSwings', 'LockerAPIController@assignSwings');

    Route::get('/accounts/{id}/academies', 'AccountAPIController@showAcademies');
    Route::get('/instructors/{id}/students', 'InstructorAPIController@showStudents', 'instructors.students.get');
    Route::post('/instructors/{id}/students', 'InstructorAPIController@showStudents', 'instructors.students.filter');
    Route::post('/academies/{id}/enroll', 'AcademyAPIController@enrollAcademy');
});
