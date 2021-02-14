<?php


namespace app\model;


use think\Model;


/**
 * 容器和依赖注入
 * 依赖注入其实本质上是指对类的依赖通过构造器完成自动注入，例如在控制器架构方法和操作
 * 方法中一旦对参数进行对象类型约束则会自动触发依赖注入，由于访问控制器的参数都来自于 URL 请求
 * ，普通变量就是通过参数绑定自动获取，对象变量则是通过依赖注入生成。
 */
class One extends Model
{
     public $username = 'Mr.Lee';


     public function __construct(array $data = [])
     {
         parent::__construct($data);
         print_r($data);
     }
}