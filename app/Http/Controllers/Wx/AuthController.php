<?php

namespace App\Http\Controllers\Wx;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserServices;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
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
        $validator = Validator::make(['mobile' => $mobile], ['mobile' => 'regex:/^1[0-9]{10}$/']);
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

    //发送手机短信模块
    public function regCaptcha(Request $request)
    {
        //todo get mobile number
        $mobile = $request->input('mobile');
        //todo 验证手机号是否为空
        if (empty($mobile)) {
            return ['errno' => 401, 'errmsg' => '参数错误'];
        }

        $validator = Validator::make(['mobile' => '$mobile'], ['mobile' => 'regex:/^1[0-9]{10}$/']);
        if ($validator->failed()) {
            return ['errno' => 707, 'errmsg' => '号码格式不正确'];
        }

        //todo 验证手机号是否已注册
        $user = (new UserServices())->getByMobile($mobile);
        if (!is_null($user)) {
            return ['errno' => 705, 'errmsg' => '已注册'];
        }

        //todo 随机生成6位验证码
        $code = random_int(100000, 999999);
        //todo 防刷验证码
        $lock = Cache::add('register_captcha_count_' . $mobile);
        if ($lock) {
            return ['errno' => 702, 'errmsg' => '稍后再试'];
        }

        $isPass = (new UserServices())->checkMobileSendCaptchaCount($mobile);
        if (!$isPass) {
            return ['errno' => 702, 'errmsg' => '当日验证码发送不能超过10次'];
        }

        Cache::put('register_captcha_' . $mobile, $code, 600);
        //todo 发送短信
        //
        return ['errno' => 0, 'errmsg' => 'success', 'data' => null];
    }
}
