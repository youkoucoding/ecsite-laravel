<?php

namespace App\Http\Controllers\Wx;

use App\CodeResponse;
use Illuminate\Http\Request;
use App\Services\Goods\CatalogServices;

class CatalogController extends WxController
{
    protected $only = [];

    public function index(Request $request)
    {
        $id = $request->input('id', 0);
        $l1List = CatalogServices::getInstance()->getL1List();
        if (empty($id)) {
            $current = $l1List->first();
        } else {
            $current = $l1List->where('id', $id)->first();
        }

        $l2List = null;
        if (!is_null($current)) {
            $l2List = CatalogServices::getInstance()->getL2ListByPid($current->id);
        }
        return $this->success(
            [
                'catagoryList' => $l1List,
                'currentCatagory' => $current,
                'currentSubcategory' => $l2List
            ]
        );
    }

    public function current(Request $request)
    {
        $id = $request->input('id', 0);
        if (empty($id)) {
            return $this->fail(CodeResponse::PARAM_VALUE_ILLEGAL);
        }

        $category = CatalogServices::getInstance()->getL2ById($id);
        if (is_null($category)) {
            return $this->fail(CodeResponse::PARAM_VALUE_ILLEGAL);
        }

        $l2List = CatalogServices::getInstance()->getL2ListByPid($category->id);
        return $this->success(
            [
                'currentCategory' => $category,
                'currentSubCategory' => $l2List->toArray()
            ]
        );
    }
}
