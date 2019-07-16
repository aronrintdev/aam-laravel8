<?php

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
    return view('welcome');
});


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index');
Route::any('register/activate/{code}', 'API\RegisterController@activate')->name('registration.activate');


Route::group(['middleware' => 'auth:web'], function () {
    Route::resource('academies', 'AcademyController');

    Route::resource('accounts', 'AccountController');

    Route::resource('swings', 'SwingController');
});
