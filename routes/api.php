<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('comment', 'CommentController@index');
Route::middleware('auth:api')->post('/comment', 'CommentController@store');
Route::middleware('auth:api')->put('/comment/{comment}', 'CommentController@update');
Route::middleware('auth:api')->delete('/comment/{comment}', 'CommentController@destroy');
