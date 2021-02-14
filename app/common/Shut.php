<?php


namespace app\common;


class Shut
{
   //服务系统
    //定义一个属性的字段
    protected static $name = 'Mr.Lee';

    //设置
    public static function setName($name)
    {
        self::$name = $name;
    }

    //获取
    public function  run()
    {
        halt(self::$name.'提醒你,系统已关闭');
    }
}