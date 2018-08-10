<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 11:11
 */

namespace app\users\validate;


use think\Validate;

class Blogs extends Validate
{
    protected $rule = [
        'name|标题' => 'require|max:50',
        'summary|摘要' => 'require',
        'content|内容' => 'require'
    ];
}