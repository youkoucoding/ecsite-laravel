<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
}
