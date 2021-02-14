<?php


namespace app\controller;
use think\facade\Cache;
use think\facade\Cookie;
use think\facade\Lang;
use think\facade\Log;
use  \think\facade\Session;
use \think\facade\Request;
use think\facade\View;


class Store
{
  public function  session()
  {
      //设置 session，参数 1 名称，参数 2 值
      //Session::set('user','Mr.Lee');
      //Session::set('count',10);

      //读取 session，参数为名称
//      return  Session::get('user');

      //读取 session 所有内容
      //dump(Session::all());

      //读取 session，参数为名称
      //return Request::session('user');

      //读取 session 所有内容
     //dump(Request::session());

      //::has()判断是否赋值，::delete()删除，::pull()取值后删除;
      //echo Session::has('user');
      //Session::delete('count');
      //Session::pull('user');
      //dump(Session::all());


      //::clear()清空整个session;
      //Session::clear('');

      //::flash()方法，设置闪存数据，只请求一次有效的情况，再请求会失效;
      //Session::flash('user','Mr.Lee');

      // 二维操作，就是对象和数组的调用方式，如下:
      // 赋值(当前作用域)
      //Session::set('obj.user','Mr.Lee');
      //判断(当前作用域) 是否赋值
      //Session::has('obj.user');
      //取值(当前作用域)
      //Session::get('obj.user');
      //删除(当前作用域)
      //Session::delete('obj.user');
      //dump(Session::all());

      //赋值
      session('user','Mr.Wang');
      //has 判断
      session('?user');
      //delete 删除
      session('user',null);
      //清理全部
      session(null);
      //输出
      echo session('user');
  }

  public function  cookie()
  {
      Cookie::set('user','Mr,Lee');
      //Cookie::set('user', 'Mr.Lee', 3600); //3600 秒
      //Request::cookie('user');
      //Request::cookie();
      //Cookie::forever('user', 'Mr.Lee');
      //Cookie::has('user');
     // echo Cookie::get('user');

      //Cookie::delete('user');

      //助手函数
      echo cookie('user');
      cookie('user','Mr.Lee',3600);
      cookie('user',null);
  }


  public function cache()
  {
      //配置文件cache.php进行缓存配置，默认生成在runtime/cache目录;
      //Cache::set('user', 'Mr.Lee');
      //Cache::set('user', 'Mr.Lee', 3600);

      //::has()方法，判断缓存是否存在，返回布尔值;
      //Cache::has('user');

      //::get()方法，从缓存中获取到相应的数据，无数据返回null;
      //Cache::get('user');

      //::inc()和::dec()实现缓存数据的自增和自减操作;
      //Cache::inc('num');
      //Cache::inc('price', 3);
      //Cache::dec('num');
      //Cache::dec('price', 3);

      //::push()实现缓存的数组数据追加的功能;
      //Cache::set('arr', [1,2,3]);
      //Cache::push('arr', 4);

      //::delete()方法，可以删除指定的缓存文件;
      //Cache::delete('user');

//      ::pull()方法，先获取缓存值，然后再删除掉这个缓存，无数据返回 null;
      //Cache::pull('user');
      //Cache::remember('start_time', time());
      //Cache::remember('start_time', function (Request $request) {})

    //::clear()方法，可以清除所有缓存;
     // Cache::clear();

      //::tag()标签，可以将多个缓存归类到标签中，方便统一管理，比如清除;
      //Cache::tag('tag')->set('user', 'Mr.Lee');
      //Cache::tag('tag')->set('age',20);
      //Cache::tag('tag')->clear();


      //助手函数
      //设置
      cache('user','Mr.Lee',3600);
      //输出
      echo cache('user');
      //清空
      cache('user',null);
  }


  public function upload()
  {
      return View::fetch('upload');
  }

  public function lang()
  {
      //系统默认会指定:zh-cn这个语言包，我们通过::get()来输出错误信息;
      //echo Lang::get('require_name');
      //echo lang('require_name'); //助手函数

      return View::fetch('lang');
  }

  public function log()
  {
      //Log::record('测试日志！','error');
//      try {
//          echo 0/0;
//      } catch (ErrorException $e)
//      {
//          echo '发生错误:'.$e->getMessage();
//          Log::record('被除数不得为零', 'error');
//      }

      Log::error('错误日志!'); //Log::record('错误日志!', 'error')
      Log::info('信息日志!');  //Log::record('信息日志!', 'info')
     trace('错误日志!', 'error');
     trace('信息日志', 'info');
     Log::diy('自定义日志');

      //使用::getLog()方法,可以获取写入到内存中到日志
      $logs = Log::getLog();
      dump($logs);

      Log::clear();
  }

}