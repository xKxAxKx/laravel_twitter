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

Auth::routes();


//imageテスト用
Route::get('/jpg', function(){

  $image = Image::make(file_get_contents('http://goo.gl/uDTEzv'));

  return $image->response('jpg');

});

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
