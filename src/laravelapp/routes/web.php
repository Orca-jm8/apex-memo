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
    return view('index');
});

Route::get('memos', 'MemosController@index');
Route::get('memos_edit', 'MemosController@update');

Route::get('comments', 'CommentsController@index');
Route::get('comments_edit', 'CommentsController@update');

Route::get('profile_edit', 'ProfileController@index');