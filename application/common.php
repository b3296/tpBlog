<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * Ajax 返回JSON
 * @param  integer $return 1：失败， 0：成功
 * @param  string $message 提示信息
 * @param  array $data 返回的数据
 * @return JSON
 * */
function fn_ajax_return( $return = 0, $message = NULL, $data = NULL )
{
    $r_data['code'] = $return;
    if ($message)
    {
        $r_data['msg'] = $message;
    }
    if ($data)
    {
        $r_data['data'] = $data;
    }
    echo  json_encode( $r_data ); exit;
}
function fn_isAdmin(){
    $is_admin = \Session::get('admin.admin');
    if($is_admin==1){
        return TRUE;
    }
    return FALSE;

}
