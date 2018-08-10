<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//Route::get('hello/:name', 'index/hello');

Route::get('new/:id','index/Index/read');

Route::get('item<name><id>','index/test')->pattern(['name'=>'\w+','id'=>'\d+']);

Route::get('hello/:name','index/:name');

Route::get('static',response()->code(502));

Route::get('success','successJump');
Route::get('db','db');
Route::get('show','users/users/show');
Route::rule('register','users/users/register');
Route::rule('login','users/users/login');
Route::rule('list','users/blogs/list');
Route::rule('createBlog','users/blogs/createBlog');
Route::rule('comment_add','users/blogs/commentAdd');
Route::get('logout','users/users/logout');
Route::get('content/:id','users/blogs/content');

Route::get('function',function(){
    return 'function test';
});

Route::miss('index/miss');
return [
    'new/:id'=>'index/Index/read',
    'hello/:name'=>'index/hello'
];
