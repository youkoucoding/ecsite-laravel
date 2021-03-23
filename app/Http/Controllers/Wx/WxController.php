<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;

class WxController extends Controller
{
    //代码优化
    //格式化返回参数 
    protected function codeReturn(array $codeResponse, $data = null, $info = '')
    {
        //list()->将数组中的值，赋给一组变量
        list($errno, $errmsg) = $codeResponse;

        $ret = ['errno' => $errno, 'errmsg' => $info ?: $errmsg];
        if (!is_null($data)) {
            $ret['data'] = $data;
        }
        return response()->json($ret);
    }

    protected function success($data = null)
    {
        return $this->codeReturn(CodeResponse::SUCCESS, $data);
    }

    protected function fail(array $codeResponse = CodeResponse::FAIL, $info = '')
    {
        return $this->codeReturn($codeResponse, null,  $info);
    }
}