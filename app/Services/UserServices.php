<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

// 用户模块的类
class UserServices extends BaseService
{
    //使用单例模式
    // 三个私有，私有的实例变量，私有的构造函数，私有的克隆方法
    // 一个公有， 公有的 getInstance
    //两个静态， 静态的单例变量，静态的 getInstance() 
    // 封装以下方法，然后继承这个封装的类
    // private static $instance;

    // public static function getInstance()
    // {
    //     if (self::$instance instanceof self) {
    //         return self::$instance;
    //     }
    //     self::$instance = new self();
    //     return self::$instance;
    // }

    // //防止外部调用构造函数
    // private function __construct()
    // {
    // }
    // private function __clone()
    // {
    // }
    /**
     * get user by username
     * @param [type] $username
     * @return User|null|Model
     */
    public function getByUsername($username)
    {
        return User::query()->where('username', $username)
            ->where('deleted', 0)->first();
    }

    /**
     * get user by mobile
     * @param   $mobile
     * @return User|null|Model
     */
    public function getByMobile($mobile)
    {
        return User::query()->where('mobile', $mobile)
            ->where('deleted', 0)->first();
    }

    // 封装函数， 有利于单元测试
    public function checkMobileSendCaptchaCount(string $mobile)
    {
        $countKey = 'register_captcha_count_' . $mobile;
        if (Cache::has($countKey)) {
            $count = Cache::increment($countKey);
            if ($count > 10) {
                return false;
            }
        } else {
            Cache::put($countKey, 1, Carbon::tomorrow()->diffInSeconds(now()));
        }
        return true;
    }
}
