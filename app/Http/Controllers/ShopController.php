<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/5 0005
 * Time: 14:17
 */

namespace App\Http\Controllers;


use App\model\ShopModel;

class ShopController extends Controller
{
    public function getShop()
    {
        $shop = ShopModel::all();
        if(count($shop)>0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => $shop)];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        echo json_encode($result);
    }
}