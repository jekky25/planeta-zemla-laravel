<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get/menu/top', 'MenuController@getMenuTop')->name('get.menu.top');
Route::get('/get/menu/left', 'MenuController@getMenuLeft')->name('get.menu.left');
Route::get('/get/posts', 'ItemController@getAll')->name('get.post.all');

Route::patch('/post/{id}', 'ItemController@update')->name('post.update');
