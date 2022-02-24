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

Route::get('profile_edit', 'ProfileController@index');
Route::put('profile_edit', 'ProfileController@update');

Route::resource('memo', 'MemoController');
Route::resource('memo.comment', 'CommentController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');