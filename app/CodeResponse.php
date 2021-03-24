<?php

namespace App;

class CodeResponse
{
    // 通用返回码
    const SUCCESS = [0, 'success'];
    const FAIL = [-1, 'error'];
    const PARAM_ILLEGAL = [401, '参数错误'];
    const PARAM_VALUE_ILLEGAL = [402, '参数值错误'];
    const UPDATED_FAIL = [505, '更新数据失败'];

    // 业务返回码
    const AUTH_INVALID_ACCOUNT = [700, '账户不存在'];
    const AUTH_CAPTCHA_UNSUPPORT = [701, ''];
    const AUTH_CAPTCHA_FREQUENCY = [702, '请稍后再试'];
    const AUTH_CAPTCHA_UNMATCH = [703, ''];
    const AUTH_NAME_REGISTERED = [704, '用户已注册'];
    const AUTH_MOBILE_REGISTERED = [705, '号码已注册'];
    const AUTH_MOBILE_UNREGISTERED = [706, ''];
    const AUTH_INVALID_MOBILE = [707, '错误号码'];
    const AUTH_OPENID_UNACCESS = [708, ''];
    const AUTH_OPENID_BINDED = [708, ''];

    const GOODS_UNSHELVE = [710, ''];
    const GOODS_NO_STOCK = [711, ''];
    const GOODS_UNKNOW = [712, ''];
    const GOODS_INVALID = [713, ''];

    const ORDER_UNKNOW = [720, ''];
    const ORDER_INVALID = [721, ''];
    const ORDER_CHECKOUT_FAIL = [722, ''];
    const ORDER_CONCEL_FAIL = [723, ''];
    const ORDER_PAY_FAIL = [724, ''];

    const ORDER_INVALID_OPERATION = [725, ''];
    const ORDER_COMMENT = [726, ''];

    const GROUPON_EXPIRED = [730, ''];
}
