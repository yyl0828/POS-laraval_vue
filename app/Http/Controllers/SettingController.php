<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/6 0006
 * Time: 10:07
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class SettingController extends Controller
{
    public function getWaiter()
    {
        $waiter = DB::select('SELECT * FROM waiter ');
        if(count($waiter)>0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => $waiter)];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        return json_encode($result);
    }

    public function getSet()
    {
        $set = DB::select('SELECT * FROM `set`');
        if(count($set)>0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => $set)];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        return json_encode($result);
    }

    public function updateWaiter(Request $request)
    {
        if (!isset($request->newWaiter)) return '';
        $old = DB::update('UPDATE waiter SET `status`=0 WHERE `status`=1');
        $new = DB::update('UPDATE waiter SET `status`=1 WHERE waiterId = '.$request->newWaiter.' ');
        if($new>0 )
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => '')];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        return json_encode($result);
    }

    public function updateSet(Request $request)
    {
        if (!isset($request->setId)) return '';
        $set = DB::update('UPDATE `set` SET `status`='.$request->val.' WHERE `id` = '.$request->setId.' ');
        if($set > 0)
            $result = ['result' => true, 'data' => (object)array('msg' => '成功', 'data' => '')];
        else
            $result = ['result' => false, 'data' => (object)array('msg' => '失败', 'data' => '')];
        return json_encode($result);
    }

}