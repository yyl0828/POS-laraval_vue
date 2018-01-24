<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/10 0010
 * Time: 16:45
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class OrderGood extends Model
{
    protected $table = 'ordergood';
    protected $primaryKey = 'id';

    public function good()
    {
        return $this->hasOne('App\model\GoodModel','goodId','goodId');
    }
}