<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','PostController@index');
Route::resource('discussions','PostController');
Route::resource('comment','CommentController');
Route::resource('favourite','FavouriteController');

Route::get('admin','AdminController@index');
Route::get('admin/tag','AdminController@taginfor');
//Route::post('admin/tag','AdminController@create');

Route::resource('infor','UserinforController');



Route::get('/user/register', 'UsersController@register');
Route::get('/user/login', 'UsersController@login');
//Route::get('/login','UsersController@github');
//Route::get('/github/login','UsersController@githublogin');
Route::get('/user/avatar', 'UsersController@avatar');
Route::get('/user/password','UsersController@changepassword');
Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
Route::get('mail/send','MailController@send');
Route::post('/user/search','UsersController@search');
Route::post('/user/infor','UsersController@infor');
Route::post('/user/password/change','UsersController@passwordchange');
Route::post('/user/register', 'UsersController@store');
Route::post('/user/login', 'UsersController@signin');
Route::post('user/avatar/change', 'UsersController@changeavatar');
Route::post('/crop/api','UsersController@cropAvatar');


Route::post('/post/upload','PostController@upload');

Route::get('/logout','UsersController@logout');

Route::group(['prefix'=>'api/v1'],function (){
    Route::resource('lessons','LessionController');
});