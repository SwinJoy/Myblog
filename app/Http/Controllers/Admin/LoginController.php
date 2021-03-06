<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
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
               return back()->with('msg','验证码错误!');//提示信息储存到session里
            }
            $user = User::first();
            if ($user->user_name!=$input['user_name'] || Crypt::decrypt($user->user_pass)!=$input['user_pass']){
                return back()->with('msg','用户名或密码错误!');
            }
            session(['user'=>$user]);//保存登录用户
//            dd(session('user'));
//            echo 'ok';
            return redirect('admin/index');//验证成功后跳转到登录页面
        }else{
            return view('admin.login');
        }
    }

    //退出登录
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

    public function crypt()
    {
        //后台密码Crypt加密和解密
        //encrypt加密  decrypt解密
        $str = '123456';
        echo Crypt::encrypt($str);
    }
}
