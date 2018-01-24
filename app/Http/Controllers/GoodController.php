<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4 0004
 * Time: 16:58
 */

namespace App\Http\Controllers;


use App\model\GoodModel;

class GoodController extends Controller
{
    public function getAllGoods()
    {
        $goods1 = GoodModel::where('type', '汉堡')->get();
        $goods2 = GoodModel::where('type', '小食')->get();
        $goods3 = GoodModel::where('type', '饮料')->get();
        $goods4 = GoodModel::where('type', '套餐')->get();
        $goods = array($goods1, $goods2, $goods3, $goods4);
        return $goods;
    }

    public function getCommonGoods()
    {
        $goods = GoodModel::where('common', '1')->get();
        return $goods;
    }


}