<?php


namespace app\controller;


use app\common\Shut;

class Service
{
  public function index(Shut $shut)
  {
      //依赖注入调用
      $shut->run();
      //容器标识调用
      $this->app->shut->run();
      return 'index';
  }

}