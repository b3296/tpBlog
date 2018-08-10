<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 13:16
 */

namespace app\users\model;


use think\Model;

class Users extends Model
{
    protected $type = [
        'created_at'=>'timestamp'
    ];
}