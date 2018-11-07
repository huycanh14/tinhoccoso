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

//Route cho giao diện người dùng
Route::get('trang-chu', 'PagesController@index')->name('index');
Route::get('loai-san-pham/{id}', 'PagesController@loai_sanpham');
Route::get('thuong-hieu-san-pham/{id}', 'PagesController@thuonghieu_sanpham');