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

//Route::get('/user','User\UserController@index');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Home\IndexController@index');
    Route::get('/cate', 'Home\IndexController@cate');
    Route::get('/art', 'Home\IndexController@article');

    Route::any('admin/login','Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');
    Route::get('admin/getCode','Admin\LoginController@getCode');
    Route::any('admin/crypt','Admin\LoginController@crypt');

});

Route::group(['middleware' => ['web','admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin'], function () {

    Route::any('index','IndexController@index');
    Route::any('info','IndexController@info');
    Route::get('quit','LoginController@quit');
    Route::any('pass','IndexController@pass');

    Route::resource('category','CategoryController');
    Route::post('cate/changeOrder','CategoryController@changeOrder');

    Route::resource('article','ArticleController');

    Route::any('upload','CommonController@upload');

    Route::resource('links','LinksController');
    Route::post('links/changeOrder','LinksController@changeOrder');

    Route::resource('navs','NavsController');
    Route::post('navs/changeOrder','NavsController@changeOrder');

    Route::resource('config','ConfigController');
    Route::post('config/changeOrder','ConfigController@changeOrder');

});