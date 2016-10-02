<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@home');
Route::get('/login', 'HomeController@home');
Route::get('/installation', 'HomeController@installation');
Route::post('/installation/setup', 'HomeController@setup');

Route::post('/login' ,'Auth\LoginController@login');
Route::post('/logout' ,'Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/subject', 'AdminController@subject');
    Route::post('/subject/add', 'AdminController@subjectAdd');
    Route::delete('/subject/add', ['as' => 'subject.delete',
        'uses' => 'AdminController@destroySubject']);

});

