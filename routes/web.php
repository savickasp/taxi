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

Auth::routes();

Route::get('/', 'FrontController@index')->name('front.home');
Route::get('/index', 'FrontController@index')->name('front.index');
Route::get('/feedback', 'FrontController@feedback')->name('front.feedback');
