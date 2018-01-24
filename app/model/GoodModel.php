<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/1/4 0004
 * Time: 16:58
 */

namespace App\model;


use Illuminate\Database\Eloquent\Model;

class GoodModel extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'goodId';
}