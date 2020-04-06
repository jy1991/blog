<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//http://blog.hd/user/dfsdfds
//Route::get('user/{id}', function ($id) {
//    return 'User '.$id;
//})->where('id', '[0-9]+');


//Route::get('posts/{post}/comments/{comment?}', function ($postId=0, $commentId=null) {
//    return $postId .'----'.$commentId;
//});

//Route::get('user_{id}', function ($i) {
//    return 'User '.$i;
//});
//
//Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
//    return $commentId;
//});

//
//Route::get('/hd', function () {
//    echo 'get';
//});
//
//Route::post('/hd', function () {
//    echo 'post';
//});
//
//Route::put('/hd', function () {
//    echo 'put';
//});
//
//Route::delete('/hd', function () {
//    echo 'delete';
//});
//
//Route::patch('/hd', function () {
//    echo 'patch';
//});
//
//Route::options('/hd', function () {
//    echo 'options';
//});
//
//
//Route::match(['get', 'post','patch'], '/test', function () {
//    echo 'match';
//});
//
//Route::any('foo', function () {
//    echo 'foo';
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

//Route::group(['middleware' => ['web']], function () {
//    //
//});
