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
    Route::get('/home', 'AdminController@dashboard');
    Route::get('/account', 'AccountController@index');
    Route::get('/account/delete/{encrypted}', 'AccountController@deleteAccount');
    Route::get('/teachers', 'TeachersController@index');
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/subject', 'AdminController@subject');
    Route::post('/subject/add', 'AdminController@subjectAdd');
    Route::post('/teachers/add', 'TeachersController@add');
    Route::post('/teachers/edit', 'TeachersController@pEdit');
    Route::get('/teacher/edit/{encrypted_id}', 'TeachersController@edit');
    Route::get('/teacher/view/{encrypted_id}', 'TeachersController@view');
    Route::post('edit/professional', 'TeachersController@editProfessional');
    Route::post('add/professional', 'TeachersController@addProfessional');
    Route::post('add/cordination', 'TeachersController@addCordination');
    Route::post('users/add', 'AccountController@addUser');
    Route::post('search', 'SearchController@search');
    // we could use the for post and delete request point but since the app is going to be a desktop app we are safe to do this
    Route::get('professional/delete/{encrypted_id}', 'TeachersController@deleteProfessional');
    Route::get('cordination/delete/{encrypted_id}', 'TeachersController@deleteCordination');

    Route::delete('/subject/add', ['as' => 'subject.delete',
        'uses' => 'AdminController@destroySubject']);

});

