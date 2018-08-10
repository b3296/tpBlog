<?php
/**
 * Created by IntelliJ IDEA.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 18:11
 */

namespace app\users\controller;

use app\users\model\Blogs as M;
use app\users\model\Comments as C;
use think\Controller;

class Blogs extends Controller
{
    public function list()
    {
        $model = new M();
        $list = $model->order('created_at','desc')->paginate(10);
        // 获取分页显示
        $page = $list->render();
        $this->assign('list', $list);
        $this->assign('page', $page);
        return $this->fetch();
    }
    public function content($id=0)
    {
        if(empty($id)){
            $this->redirect('list');
        }
        \Session::set('blog_id',$id);
        $modelBlog = new M();
        $blog = $modelBlog->find($id);
        $where = array('blog_id'=>$id);
        $modelComment = new C();
        $commentsinfo = $modelComment->order('created_at','desc')->where($where)->select();
        $commentsinfo = empty($commentsinfo)?[]:$commentsinfo;
        $this->assign(['blog'=>$blog,'comments'=>$commentsinfo]);
        return $this -> fetch();
    }
    public function commentAdd()
    {
        $content = input('post.content');
        if(empty($content)){
            fn_ajax_return(1, '请填写评论内容！');
        }
        $user_name = \Session::get('admin.name');
        $user_id = \Session::get('admin.id');
        $user_image = \Session::get('admin.image');
        $blog_id = \Session::get('blog_id');
        $data = ['blog_id'=>$blog_id,'user_id'=>$user_id,'user_name'=>$user_name,'user_image'=>$user_image,'content'=>$content,'created_at'=>time()];
        $model = new C();
        if($model->insert($data)==0){
            fn_ajax_return(1,'评论失败');
        }else{
            fn_ajax_return(0,'评论成功',$blog_id);
        }

    }
    public function createBlog()
    {
        if (!fn_isAdmin()) {
            $this->redirect('/list');
        }
        if ( ( $post_d = \Request::post())) {
            $name = $post_d['name']??'';
            $summary = $post_d['summary']??'';
            $content = $post_d['content']??'';
            $validate = new \app\users\validate\Blogs();
            if(!$validate->check($post_d)){
                fn_ajax_return(1,$validate->getError());
            }

            $user_name = \Session::get('admin.name');
            $user_id = \Session::get('admin.id');
            $user_image = \Session::get('admin.image');
            $time = time();
            $data = ['name'=>$name,'summary'=>$summary,'content'=>$content,'user_id'=>$user_id,'user_name'=>$user_name,'user_image'=>$user_image,'created_at'=>$time];
            $model = new M();
            if($model->insert($data)==0){
                fn_ajax_return(1,'保存失败');
            }else{
                fn_ajax_return(0,'保存成功');
            }
        }
        return $this -> fetch('create_blog');
    }
}