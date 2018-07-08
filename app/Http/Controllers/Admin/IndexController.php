<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    //更改超级管理员密码
    public function pass()
    {
        if ($input=Input::all()){
            $rules = [
                'password'=>'required|between:6,20|confirmed',//确认密码就使用confirmed来指定，这里注意是confirmed而不是confirme。而且第二次输入密码的字段需要写成password_confirmation这个形式
            ];

            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！'
            ];

            //Validator表单验证器  Validator::make(参数,规则,提示信息);
            $validator = Validator::make($input,$rules,$message);
            if ($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if ($input['password_o']==$_password){//判断输入的原密码与数据库中查询的原密码是否相等
                    //修改密码
                    $user->user_pass = Crypt::encrypt($input['password']);//加密输入的新密码
                    //dd($user);
                    $user->update();
                    return redirect('admin/info');
                }else{
                    return back()->with('errors','原密码错误！');
                }
            }else{
                //dd($validator->errors()->all());//显示错误信息
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }
}
