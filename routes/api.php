<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/search',function(){
//  $query = Input::get('query');
//  $users = \Auth::user()->where('name','like','%'.$query.'%')->get();
//  return response()->json($users);
//  return response()->json([['name' => 'Amanda'], ['name' => 'Mom']]);
// });

// Route::get('/search', 'ContactController@axiosGetContacts')->middleware('auth');