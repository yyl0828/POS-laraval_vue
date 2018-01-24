<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/3 0003
 * Time: 10:01
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{

    protected $table = 'MyGuests';
    protected $primaryKey = 'id';

    public function getUser()
    {
        /* $user = DB::select('select * from MyGuests');
         dd($user);*/

        $users = $this->paginate(5);
        return $users;
    }

    public function addUser($firname, $laname, $email)
//    public function addUser()
    {
        /*   $sql = DB::insert('insert into MyGuests(firstname,lastname,email) values(?,?,?) '
               , ['shalock', 'homles', 'shalock@host.com']);
           var_dump($sql);*/

        $sql = DB::table('MyGuests')->insert(
            ['firstname' => $firname, 'lastname' => $laname, 'email' => $email]);

        $re = ['result' => $sql, 'data' => ''];
        echo json_encode($re);
//        $sql;

    }

    public function userList()
    {
        $user = DB::table('MyGuests')->get();
        $re = ['result' => true, 'data' => $user];
        echo json_encode($re);
    }

    public function editUser($id, $firstname, $lastname, $email)
    {
        /* $sql = DB::update("update MyGuests set email='locked@sha.com' where firstname='shalock'");
         var_dump($sql);*/

        $sql = DB::table('MyGuests')->where('id', $id)->update(['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
        $re = ['result' => $sql, 'data' => ''];
        echo json_encode($re);
    }

    public function deleteUser($id)
    {
        $sql = DB::table('MyGuests')->where('id', $id)->delete();

        if ($sql > 0) {
            $re = true;
        } else {
            $re = false;
        }
        $data = ['result' => $re, 'data' => ''];
        echo json_encode($data);
    }
}