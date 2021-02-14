<?php


namespace app\controller;


use app\event\UserEvent;
use think\facade\Event;

class TestEvent
{
   //测试事件的类
    public function __construct()
    {
        //注册监听器
        Event::listen('TestListen', function ($param) {
          echo '我是监听器，我被触发了!'.$param;
        });
    }

    public function info()
    {
        echo '登录前准备!';
        //Event::trigger('TestListen', 'ok');  //触发监听器
        //event('TestListen');  //助手函数触发
        Event::listen('TestListen', TestListen::class); //这句可以定义到配置文件
        Event::trigger('TestListen');
    }

    public function login(){
        echo '登录成功!'; Event::trigger('UserLogin');
    }

    public function logout(){
        echo '退出成功!'; Event::trigger('UserLogout');
    }

    public function event()
    {
        Event::trigger(new UserEvent());
    }
}