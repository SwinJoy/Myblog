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

});


Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function (){
    //登录后跳转到主页
    Route::any('index','IndexController@index');

    //信息页
    Route::any('info','IndexController@info');

    //退出登录
    Route::any('quit','LoginController@quit');

});
