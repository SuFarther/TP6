<?php


namespace app\controller;


use app\BaseController;
use app\model\User;


class Test extends BaseController
{
    /**
     *基础控制器
     */
   public function  index(){
//       return 'test';
       //返回实际路径  /Applications/MAMP/htdocs/tp6/app    //返回当前方法index
       return $this->app->getBasePath().$this->request->action();

   }

   public function hello($value = '')
   {
       return 'hello'.$value;
   }

}