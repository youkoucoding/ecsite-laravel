<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use Illuminate\Http\Request;
use App\Services\Goods\BrandServices;

class BrandController extends WxController
{
    protected $only = [];

    /**
     * 
     */
    public function list(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = $request->input('limit', 10);
        $sort = $request->input('sort', 'add_time');
        $order = $request->input('order', 'desc');

        $list = BrandServices::getInstance()->getBrandList($page, $limit, $sort, $order);
        return $this->successPaginate($list);
    }

    /**
     * brand detail
     * @param Request $request
     * @return JsonResponse
     */
    public function detail(Request $request)
    {
        $id = $request->input('id', 0);
        if (empty($id)) {
            return $this->fail(CodeResponse::PARAM_VALUE_ILLEGAL);
        }
        $brand = BrandServices::getInstance()->getInstance($id);
        if (empty($brand)) {
            return $this->fail(CodeResponse::PARAM_VALUE_ILLEGAL);
        }

        return $this->success($brand);
    }
}
