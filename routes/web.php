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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/history', 'MessageController@history');

Route::resource('/message', 'MessageController');

Route::get('/contacts', 'ContactController@contacts');

Route::post('/contacts/{id}', 'ContactController@editContact');

Route::get('/search', 'ContactController@axiosGetContacts');

Route::resource('/contact', 'ContactController');

Route::match(array('GET', 'POST'), '/inboundCALL', 'InboundController@inboundCALL');

Route::match(array('GET', 'POST'), '/inboundSMS', 'InboundController@inboundSMS');

