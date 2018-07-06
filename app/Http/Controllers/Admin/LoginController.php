<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    //登录验证
    public function login()
    {
        //验证码判断
        if ($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();

            if (strtoupper($input['code'])!=$_code){//Code类中生成的验证码统一转成大写字母后保存
               return back()->with('msg','验证码错误');//提示信息储存到session里
            }
            echo 'ok';
        }else{
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

}
