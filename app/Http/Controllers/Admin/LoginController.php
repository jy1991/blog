<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use App\Http\Model\User;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login()
    {
        if($input = Input::all())
        {
            $code = new \Code;
//            if(strtoupper($input['code']) != strtoupper($code->get()))
//            {
//                return back()->with('msg','验证码错误');
//            }

            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pass) != $input['user_pass'])
            {
                return back()->with('msg','用户名密码错误');
            }

            session(['user' => $user]);

            return redirect('admin/index');

        }
        else
        {
            return view('admin.login');
        }
    }

    public function code()
    {
        $code = new \Code;
        $code->make();
    }

    public function getCode()
    {
        $code = new \Code;
        echo $code->get();
    }

    public function crypt()
    {
        $str = '123456';

        echo Crypt::encrypt($str);
    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

}
