<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 16:46
 */

namespace app\users\validate;


use think\Validate;

class Users extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'email' => 'require|email',
        'passwd' => 'require|min:6',
    ];
    protected $scene = [
      'login' => ['email','passwd'],
    ];

}