<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 11:30
 */

namespace app\users\model;


use think\Model;

class Comments extends Model
{
    protected $type = [
        'created_at' => 'timestamp'
    ];
}