<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

// 用户模块的类
class UserServices
{
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
