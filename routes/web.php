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

Route::resource('/contact', 'ContactController');

Route::match(array('GET', 'POST'), '/incoming', function()
{
  $twiml = new Twilio\Twiml();
  $twiml->say('Greetings from Link Sling. To begin using our service simply create an account on link sling dot com. Thank you.', array('voice' => 'alice'));
  $response = Response::make($twiml, 200);
  $response->header('Content-Type', 'text/xml');
  return $response;
});
