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

Route::get('/', 'UsersController@index');
Route::post('/login', 'UsersController@login');
Route::get('/logout', 'UsersController@logout');
Route::get('/adminusercreatenow', 'UsersController@create');

Route::get('/authorize','APIController@authorize');
Route::get('/callback', 'APIController@authorizeReturn');
Route::get('/get-user-info','APIController@userInfo');

Route::get('/teste','APIController@teste');

//protected routes
Route::group(['middleware' => 'auth'], function(){
  Route::get('/product/stock','ProductsController@listStock');
  Route::get('/product/{id}/publish','ProductsController@publish');
  Route::get('/product/{id}/update-status/{status}','ProductsController@updateStatus');
  Route::get('/product/{id}/relist','ProductsController@relistProduct');
  Route::resource('/product','ProductsController');

  Route::get('/question/{id}/reply','QuestionsController@reply');
  Route::post('/question/{id}/send-reply','QuestionsController@sendReply');
  Route::get('/question/{id}/delete','QuestionsController@destroy');
  Route::resource('/question','QuestionsController');

  Route::get('/order/{id}','SellsController@show');
  Route::get('/order','SellsController@index');
});

Route::post('/notifications','NotificationsController@index');


// test routes
Route::get('/notifications/teste', 'NotificationsController@testGotNotification');

