<?php


namespace app\controller;
use app\facade\Test;

use think\Facade\Route;

class Url
{
  public function index()
  {
//      return 'index';
      //使用Route::buildUrl('地址',[参数]...)方式来获取路由的URL地址;
//      return Route::buildUrl('Url/details',['id'=>5]);


     //  注意:这里的地址和路由的定义是相辅相成的，如果没有定义，地址将会变化;
      //  也可以给路由定义取一个别名，然后在生成URL的时候，直接使用这个别名调用;
     //Route::rule('ds/:id','details/id')->name('u');
      //return Route::buildUrl('u',['id'=>5]);

      //也可以直接使用路由地址生成 URL，但这个方式并不需要和路由定义相匹配;
//      return Route::buildUrl('ds/5');

      //由于，我们默认在配置设置了后缀为.html，所以，生成的URL会自动加上;
//      return Route::buildUrl('ds/5')->suffix('shtml');


      //如果，你想添加完整域名路径，可以再添加 domain 方法;
//      return Route::buildUrl('ds/5')->domain(true);
//      return Route::buildUrl('ds/5')->domain('news');
//        return Route::buildUrl('ds/5')->domain('news.juzss.com');
//      return Route::buildUrl('ds/5@news.juzss.com');

      //也可以直接使用助手函数 url()来代替 Route::buildUrl();
      return url('ds/5');
  }

  public function details($id)
  {
      return 'Id:'.$id;
  }


  public function test()
  {
//     return \app\facade\Test::hello('world');
      return Test::hello('Mr.Lee');
  }
}