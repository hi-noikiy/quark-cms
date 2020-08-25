<?php

/*
|--------------------------------------------------------------------------
| Server Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 不需要验证CSRF
Route::group(['prefix' => 'cashier'], function ($router) {
    $router->any('server/token', 'ServerController@token')->name('wechat/server/token');
});