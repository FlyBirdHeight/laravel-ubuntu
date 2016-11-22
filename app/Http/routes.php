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
use Illuminate\Support\Facades\Redis;

//Route::get('/redis',function (){
////    $data = [
////        'event'=>'aNewMessage',
////        'data'=>[
////            'name'=>'Jelly'
////        ]
////    ];
////    Redis::publish('test-channel',json_encode($data));
//    event(new \App\Events\ANewMessage('Jelly'));
//    return view('welcome');
//});



Route::get('/captcha/{config?}',function (\Mews\Captcha\Captcha $captcha,$config  = 'default'){
    return $captcha->create($config);
});

Route::get('/','PostController@index');

Route::resource('discussions','PostController');
Route::resource('comment','CommentController');
Route::resource('favourite','FavouriteController');

Route::group(['middleware'=>'admin'],function (){
    Route::get('admin','AdminController@index');
    Route::get('admin/tag','AdminController@taginfor');
    Route::post('admin/tag','AdminController@tagcreate');
    Route::delete('admin/tag/{tag_id}','AdminController@tagdelete');
    Route::get('admin/discuss','AdminController@discussinfo');
    Route::delete('admin/discuss/{discuss_id}','AdminController@discussdelete');
    Route::get('admin/article','AdminController@articleinfo');
    Route::get('admin/article/create','AdminController@article');
    Route::post('admin/article','AdminController@articlecreate');
    Route::delete('admin/article/{article_id}','AdminController@articledelete');
});


Route::resource('infor','UserinforController');


Route::group(['prefix'=>'user'],function (){
    Route::get('register', 'UsersController@register');
    Route::get('login',function (){
        return view('users.login');
    });
    Route::post('search','UsersController@search');
    Route::post('infor','UsersController@infor');
    Route::post('password/change','UsersController@passwordchange');
    Route::post('register', 'UsersController@store');
    Route::post('login', 'UsersController@signin');
    Route::post('avatar/change', 'UsersController@changeavatar');
    Route::get('avatar', 'UsersController@avatar');
    Route::get('password','UsersController@changepassword');
});

//Route::get('/login','UsersController@github');
//Route::get('/github/login','UsersController@githublogin');

Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
Route::get('mail/send','MailController@send');
Route::post('/crop/api','UsersController@cropAvatar');
Route::post('/post/upload','PostController@upload');

Route::get('/logout','UsersController@logout');


Route::group(['prefix'=>'api/v1'],function (){
    Route::resource('lessons','LessionController');
});