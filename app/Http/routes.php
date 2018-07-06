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


Route::group(['middleware'=>[]],function (){//web中间件从5.2.27版本以后默认全局加载，
                                            //不需要自己手动载入，如果自己手动重复载入，会导致session无法加载等情况。
    Route::get('/', function () {
        return view('welcome');
    });

    //登录
    Route::any('admin/login', "Admin\LoginController@login");

    //验证码
    Route::any('admin/code', "Admin\LoginController@code");

    //后台密码Crypt加密和解密
    Route::any('admin/crypt','Admin\LoginController@crypt');

});
