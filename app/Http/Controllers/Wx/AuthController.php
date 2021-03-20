<?php

namespace App\Http\Controllers\Wx;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 用户注册
    public function register(Request $request)
    {
        // 获取参数
        $username = $request->input('username');
        $password = $request->input('password');
        $mobile = $request->input('mobile');
        $code = $request->input('code');

        // 判断参数是否为空
        if (empty($username) || empty($password) || empty($mobile) || empty($code)) {
            // 按规范返回错误信息
            return ['errno' => 401, 'errmsg' => '参数错误'];
        }

        // 验证用户是否存在
        $user = (new UserServices())->getByUsername($username);
        if (!is_null($user)) {
            return ['errno' => 704, 'errmsg' => '用户名已注册'];
        }

        //判断号码格式
        $validator = Validator::make(['mobile' => $mobile], ['mobile' => 'regex:/^1[0-9]{10}$']);
        if ($validator->failed()) {
            return ['errno' => 707, 'errmsg' => "号码格式不正确"];
        }

        $user = (new UserServices())->getByMobile($mobile);
        if (!is_null($user)) {
            return ['errno' => 705, 'errmsg' => '此号码已注册'];
        }

        //todo 验证验证码

        $avatarUrl             = 'https://image.flaticon.com/icons/png/512/64/64572.png';

        //写入用户表
        $user                  = new User();
        $user->username        = $username;
        $user->password        = Hash::make($password);
        $user->avatar          = $avatarUrl;
        $user->nickname        = $username;
        $user->last_login_time = Carbon::now()->toDateTimeString();                       // 'Y-m-d H:i:s'
        $user->last_login_ip   = $request->getClientIp();
        $user->add_time        = Carbon::now()->toDateTimeString();
        $user->update_time     = Carbon::now()->toDateTimeString();
        $user->save();

        //todo coupon
        //return 用户信息和 token 
        $token = Auth::login($user);
        return ['errno' => 0, 'errmsg' => 'success', 'data' => [
            'token' => $token,
            'userInfo' => [
                'nickName'  => $username,
                'avatarUrl' => $avatarUrl
            ]
        ]];
    }
}
