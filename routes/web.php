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

Route::resource('/message', 'MessageController');

Route::match(array('GET', 'POST'), '/incoming', function()
{
  $twiml = new Twilio\Twiml();
  $twiml->say('Greetings from Link Sling. To begin using our service simply create an account on link sling dot com.', array('voice' => 'alice'));
  $response = Response::make($twiml, 200);
  $response->header('Content-Type', 'text/xml');
  return $response;
});

// Route::post('/text', function()
// {

//   $number = Input::get('recipient');
//   $link = Input::get('link');
 
//   $client = new Twilio\Rest\Client($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

//   $message = $client->messages->create(
//   	$number,
//   	array(
//     	'from' => $_ENV['TWILIO_NUMBER'],
//     	'body' => $link . " | Sent By: " . \Auth::user()->name
//   	)
//  	);
//   print $message->sid;
// });