<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
            if (is_array($data)) {
                $data = array_filter($data, function ($item) {
                    return $item !== null;
                });
            }
            $ret['data'] = $data;
        }
        return response()->json($ret);
    }

    protected function successPaginate($page)
    {
        return $this->success($this->paginate($page));
    }


    public function paginate($page)
    {
        if ($page instanceof LengthAwarePaginator) {
            return [
                'total' => $page->total(),
                'page'  => $page->currentPage(),
                'limit' => $page->perPage(),
                'pages' => $page->lastPage(),
                'list'  => $page->items()
            ];
        } elseif (is_array($page)) {
            $total = count($page);
            return [
                'total' => $total,
                'page'  => 1,
                'limit' => $total,
                'pages' => 1,
                'list'  => $page
            ];
        }

        return $page;
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
