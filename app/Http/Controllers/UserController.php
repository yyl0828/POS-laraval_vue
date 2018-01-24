<?php

namespace App\Http\Controllers;


use App\model\UserModel;
use App\RegexTool;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /* public function info($id)
     {

         $user = new UserModel();

         return $user->getUser();
     }*/
    public function sql(){
        $attr = array(1,2,3,4);

        while(list($key,$value) = each($attr))

        {

            echo $key."=>".$value."<br>";
            echo '0';

        }

        while(list($key,$value) = each($attr))

        {

            echo $key."=>".$value."<br>";

        }
    }

    public function addUser(Request $request)
    {
//        $userInfo = 'firname' . $request->input('firname') . ' -' . 'laname' . $request->input('laname');
        $res = $this->setCookie();
//        return $re;
        $user = new UserModel();
        $re = $user->addUser($request->input('firname'), $request->input('laname'), $request->input('email'));
        return $re;
//        return $user->addUser($firname, $laname, $email);
    }

    public function setCookie()
    {
        $minutes = 3600;
        $response = new Response();
        $response->withCookie(cookie('ddd', 'ddd', $minutes));
        return $response;
    }

    public function getCookie(Request $request)
    {
        $value = $request->cookie('name');
        echo $value;
    }

    /* public function setCookie($userInfo)
     {
         $response = new Response();
         $response->withCookie(cookie('user', $userInfo, 3600));
         return $response;
     }

     public function userinfoPage(Request $request)
     {
         return view('user/info', ['user' => $request->cookie('user')]);
     }*/
    public function userinfoPage(Request $request)
    {
        return view('user/info', ['user' => $request->cookie('user')]);
    }

    public function userList()
    {
        $user = new UserModel();
        return $user->userList();
    }

    public function editUser(Request $request)
    {
        $re = new UserModel();
        return $re->editUser($request->input('id'), $request->input('firstname'), $request->input('lastname'), $request->input('email'));
    }

    public function deleteUser(Request $request)
    {
        $re = new UserModel();
        return $re->deleteUser($request->input('id'));
    }

    public function getUser()
    {
        $re = new UserModel();

        $users = $re->getUser();
        return view('user.paginate', ['users' => $users]);
    }

    public function regex()
    {
        return view('regex/regex');
    }

    function show($var = null, $is_dump = false)
    {
        $fun = $is_dump ? 'var_dump' : 'print_r';
        if (empty($var)) {
            echo 'null';
        } elseif (is_array($var) || is_object($var)) {
            echo "<pre>";
            $fun($var);
            echo "<pre>";
        } else {
            $fun($var);
        }
    }

    public function regCheck(Request $request)
    {
        $regex = new RegexTool();
        if (!$regex->noEmpty($request->input('username'))) exit('用户名必须填写');
        /*  $re = $regex->isEmail('yyusd_ddd@139.com');
          $this->show($re);*/
    }

    public function activity0()
    {
        return '活动马上开始';
    }
    public function activity1()
    {
        return '活动正在进行';
    }
    public function activity2()
    {
        return '活动结束';
    }

}