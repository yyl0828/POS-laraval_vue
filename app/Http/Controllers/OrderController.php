<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4 0004
 * Time: 18:00
 */

namespace App\Http\Controllers;

use App\model\OrderGood;
use App\model\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $dayNum = 0;
    public $pageLength = 20;

    public function insertOrder(Request $request)
    {
        if (!isset($request->goodlist)) return '';
        $goodlist = $request->goodlist;
        $this->dayNum = $this->dayNum + 1;
        $result = true;
        $waiter = DB::table('waiter')->where('status', '1')->value('waiterId');
        $orderId =DB::table('order')->insertGetId(
            [
                'dayNum' => $this->dayNum,
                'status' => $request->status, 'totalprice' => $request->totalprice,
                'totalcount' => $request->totalcount, 'made' => '0','waiterId'=>$waiter,
                'pay' => $request->pay, 'bale' =>$request->bale , 'time' => date('y-m-d h:i:s', time())
            ]);
        foreach ($goodlist as $good) {
            $sql = DB::table('ordergood')->insert(
                [
                    'orderId' =>$orderId,
                    'goodId' => $good['goodId'],
                    'count' =>$good['count']
                ]);
            if (!$sql) {
                $result = false;
                return json_encode(['result' => $result, 'data' => (object)array('msg' => '失败', 'data' => '')]);
            }
        }
        $re = ['result' => $result, 'data' => (object)array('msg' => '成功', 'data' => '')];
        echo json_encode($re);
    }

    public function getPendOrder()
    {
        $order = DB::select('SELECT * from `order` a,ordergood b ,goods c where a.orderId=b.orderId  and c.goodId = b.goodId and a.`status`=0');
        $id = 0;
        $re = array();
        foreach ($order as $key => $val) {
            if ($id == 0 || $id != $val->orderId) {
                $id = $val->orderId;
                $re[$id] = array($val);
            } elseif ($id == $val->orderId) {
                array_push($re[$id], $val);
            }
        }
        $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => $re)];
        echo json_encode($result);

    }

    public function pendUpdate(Request $request)
    {
        if (!isset($request->orderId)) return '';
        $order = OrderModel::where('orderId', $request->orderId)
            ->update(['status' => 1]);
        if ($order > 0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => '')];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        echo json_encode($result);
    }

    public function deleteOrder(Request $request)
    {
        if (!isset($request->orderId)) return '';
        $order = OrderModel::where('orderId', $request->orderId)->delete();
        if ($order > 0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => '')];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        echo json_encode($result);
    }

    public function getOrderPage(Request $request)
    {
        if (!isset($request->pageNo))
            return json_encode(['result' => false, 'data' => (object)array('msg' => '失败，传入参数错误', 'data' => '')]);
        $start = ($request->pageNo - 1) * $this->pageLength;
        $end = $request->pageNo * $this->pageLength;
        $order = DB::select('SELECT * FROM `order` a,waiter b WHERE a.waiterId=b.waiterId AND a.`status`=1 LIMIT '.$start.','.$end.' ');
        $count = DB::select('SELECT count(*) from `order` where `status`=1 ');
        foreach ($order as $key=>$val){
            $arr = (array)$val;
            $good = DB::select('SELECT b.name,b.img,b.price,b.goodId  from ordergood a , goods b WHERE a.goodId=b.goodId and a.orderId = '.$arr['orderId']. ' ');
            $arr['goodlist'] = $good;
            $order[$key]=$arr;
        }
//        echo typeOf($order);
//        $result = ['result' => true, 'data' => ];
        return json_encode((object)array('result' => true, 'data' => $order,'count'=>$count));
    }

    public function getOrderGood()
    {
        $sql = OrderGood::find(1)->good;
        dd($sql);
    }


}