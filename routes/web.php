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

Route::any('/wx/link','WeiXin\WxController@index');

//后台登陆
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/do_login','Admin\LoginController@do_login');
//首页
Route::get('/admin/lists','Admin\IndexController@index');
//素材管理
Route::get('/admin/media_add','Admin\MediaController@add');
Route::any('/admin/do_add','Admin\MediaController@do_add');
Route::get('/admin/media_show','Admin\MediaController@show');

Route::get('/test/index','Test\IndexController@index');

Route::get('/code/code_add','Code\CodeController@code_add');
Route::get('/code/code_index','Code\CodeController@code_index');
Route::post('/code/add_do','Code\CodeController@add_do');

