<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logoutAPI')->middleware('auth:api');
Route::middleware('auth:api')->post('/search', 'TwitterController@search');
Route::middleware('auth:api')->post('/follow','TwitterController@follow');
Route::middleware('auth:api')->post('/tweet','TwitterController@tweet');
Route::middleware('auth:api')->post('/like','TwitterController@likeTweet');
Route::middleware('auth:api')->post('/delete','TwitterController@deleteTweet');
Route::middleware('auth:api')->post('/mention','TwitterController@mention');
Route::middleware('auth:api')->get('/newsFeeds','TwitterController@newsFeeds');
Route::middleware('auth:api')->get('/activityFeeds','TwitterController@activityFeeds');


