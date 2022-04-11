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

Route::get('/', 'MainController@index');

Route::get('search', 'SearchController@search');
Route::get('hashtag', 'HashtagController@index');
Route::get('hashtag/{hashtag}', 'HashtagController@show');

Route::resource('memos', 'MemoController');
Route::resource('memos.comments', 'CommentController');
Route::resource('users', 'UserController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');