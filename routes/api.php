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
    Route::any('register/activate/{code}', 'RegisterController@activate')->name('verification.verify');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});
//Route::get('/update-password-test/', 'AccountAPIController@updatePasswordTest');
Route::group(['middleware' => 'auth:backend,api'], function () {
    Route::get('/search-accounts/', 'AccountAPIController@search');
    Route::post('/update-password/', 'AccountAPIController@updatePassword');
    Route::get('/academies/{id}', 'AcademyAPIController@show');
    Route::get('/academies/{id}/instructors', 'AcademyAPIController@showInstructors');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('accounts', 'AccountAPIController');

    Route::resource('academies', 'AcademyAPIController');

    Route::resource('instructors', 'InstructorAPIController');

    Route::resource('locker', 'LockerAPIController');

    Route::get('/accounts/{id}/academies', 'AccountAPIController@showAcademies');
    Route::post('/instructors/{id}/students', 'InstructorAPIController@showStudents');
});
