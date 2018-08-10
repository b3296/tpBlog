<?php

namespace app\index\controller;

use \think\Controller;
use \Think\Db;

class Index extends Controller
{
    protected $beforeActionList = [
        'before'=>['only'=>'test']
    ];
    protected function before()
    {
        echo '<br>'.$this->request->scheme.'<br>';
    }
    public function initialize(){
        //echo '继承了';
        //print_r($this->request->only('new'));

    }
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function read($id = 'nani')
    {
        echo $id;
        return;
    }

    public function test($name = 'name', $id = 'id')
    {
        echo 'this is test ' . $name . $id;
    }
    /**
    * @Description:
    * @Author:  buxl
    * @param: string $name
    * @return: mixed
    * @route('zs/:name')
    * @CreateDate: 2018/8/7
    */
    public function zs($name)
    {
        echo 'zs'.$name;
        return 'ok';
    }
    public function successJump()
    {
        $this->success('jump','new/009','123456','0');
    }
    public function miss()
    {
        return  $this->request->url();
    }
    public function db()
    {
        $user = Db::name('users')->fetchSql(false)->field(['count(id)'=>'count','max(id)'=>'max','max(admin)'=>'admin'])->find();
        return json($user);
    }
}
