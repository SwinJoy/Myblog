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


Route::group(['middleware'=>['web']],function (){
    Route::get('/', function () {
        return view('welcome');
    });

    //登录
    Route::get('admin/login', "Admin\LoginController@login");

    //验证码
    Route::get('admin/code', "Admin\LoginController@code");

    Route::get('admin/getcode', "Admin\LoginController@getcode");

});
