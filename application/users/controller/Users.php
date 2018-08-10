<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/8
 * Time: 13:28
 */

namespace app\users\controller;

use think\Controller;
use \app\users\model\Users as M;

class Users extends Controller
{
    public function register()
    {
        if ( ( $post_d = \Request::post())) {
            $validate = new \app\users\validate\Users;
            if(!$validate->check($post_d)){
                fn_ajax_return(1,$validate->getError());
            }
            $name = isset($post_d['name'])?$post_d['name']:'';
            $email = isset($post_d['email'])?$post_d['email']:'';
            $passwd = isset($post_d['passwd'])?$post_d['passwd']:'';
            $model = new M();
            if($model->where(['name'=>$name])->whereOr(['email'=>$email])->find()){
                fn_ajax_return(1, '用户已存在！');
            }else{
                $time = time();
                $admin = 0;
                $image = '';
                $datas= ['name'=>$name,'email'=>$email,'passwd'=>md5($email.':'.$passwd),'admin'=>$admin,'image'=>$image,'created_at'=>$time];
                if($model->insert($datas)==0){
                    fn_ajax_return(1, '注册失败！');
                }else{
                    fn_ajax_return(0,'注册成功！');
                }
            }
        }
        return $this -> fetch('register');
    }
    public function login()
    {
        if (( $post_d =  \Request::post())) {
            $validate = new \app\users\validate\Users;
            if(!$validate->scene('login')->check($post_d)){
                fn_ajax_return(1,$validate->getError());
            }
            $email = isset($post_d['email'])?$post_d['email']:'';
            $passwd = isset($post_d['passwd'])?$post_d['passwd']:'';
            $where = array('email'=>$email);
            $model = new M();
            $user = $model->where($where)->find();
            if ($user) {
                if (md5($email.':'.$passwd) == $user['passwd']) {
                    \Session:: set('admin', $user);
                    fn_ajax_return(0,'登录成功');
                }else{
                    $message = '密码不正确';
                }
            }else{
                $message = '用户名不存在';
            }
            fn_ajax_return(1,$message);
        }
        return $this -> fetch('login');
    }
    public function logout()
    {
        \Session::clear();
        $this->redirect('/list');
    }
}