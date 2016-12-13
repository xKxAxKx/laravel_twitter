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
// Route::get('/jpg', function(){
//
//
//   $image = Image::make(file_get_contents('http://goo.gl/uDTEzv'));
//   $file = 'sample.jpg';
//   $path = public_path() . '/images/';
// 
//   $image->save($path . $file) // 画像を保存する
//         ->crop(200, 200) // 画像をクロップする
//         ->greyscale() // 画像を白黒にする
//         ->save($path . 'thumbnail-' . $file); // 加工した画像を保存する
//
//   return $image->response('jpg');
//
// });

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
