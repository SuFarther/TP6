<?php


namespace app\controller;





use app\model\User;
use app\Request;
use think\facade\View;
use think\Model;

class Show
{
    public $name = 'Mr.Lee';
    public $age = 'age';
    const PI = 3.14;

   /**
    * MVC简称 M (模型) C(控制器) V(视图)
    * 安装扩展composer require topthink/think-view
    *
    */
   public function index()
   {
//       return View::fetch('index');
       //View::assign('name','Mr.Lee');

       //assign()方法,支持通过数组的方式,传递模版变量
//       View::assign([
//           'name'=>'Mr.Lee',
//           'age' => 100
//       ]);

       //也可以直接通过 fetch()方法的第二参数，直接用数组传递模版变量;
//       return View::fetch('index',[
//          'name' => 'Mr.Lee',
//          'age' => 100
//       ]);

//       return view('index',[
//           'name' => 'Mr.Lee',
//           'age' => 100
//       ]);

       //可以使用 filter()方法，对所有模版的变量进行过滤操作;
//       return View::filter(function ($content){
//           return strtoupper($content);
//       })->fetch('index');
//       return view('index')->filter(function ($content){
//           return strtoupper($content);
//       });

        //除了在配置文件修改外,还可以在控制器动态修改模版配置
       //View::config(['view_dir_name' => 'view2']);

       // 默认情况下,调用的是本控制器的模版文件,也可以调用其他控制器的模版文件
       //return View::fetch('Address/index');

       // 如果你是多模块(多应用)模块下,也可以实现跨模块调用模版文件
//       return View::fetch('admin@User/index');

       //如果直接在view根目录下的模版文件,用一个斜杠来设定即可调用
       //return  View::fetch('/index');

       //如果想调用public公共目录的模版文件,用../public后面跟着URL即可
       //return View::fetch('../public/test/test');


       //这种做法的调用方式,和模版引擎调用一样,只不过通信的数据获取数据有差异
       //return View::engine('php')->fetch('index');

       //而是把所有的要传递的变量,通过在return之前设置的变量或者模版变量均无效
//       return View::engine('php')->fetch('
//           index', [ 'name' => 'Mr.Lee',
//           'age' => 100
//       ]);
   }

   public function outPut()
   {
       $arr = [
           'name' => 'Mr.Lee',
           'age' => 100
       ];
//       return View::fetch('output',[
//          'arr' => $arr
//       ]);

       return View::fetch('output',[
          'arr' => $arr,
          'obj' => $this,
          'password'=> 123456,
           'time' => time(),
           'number' => 10,
           'a' => 5,
           'b' => 5
       ]);
   }

   public function fn()
   {
       return '方法';
   }


   public function loop()
   {
       $list = User::select();
       return View::fetch('loop',[
           'list' => $list
       ]);
   }

   public function eq()
   {
       $list = User::select();
       return View::fetch('eq',[
           'name' => 'Mr.Lee',
           'name2' => 'Mr.Lee',
           'list' => $list,
       ]);
   }

   public function switch()
   {
       return View::fetch('switch',[
           'number' => 10,
           'id' => 10,
           'number2'=>12,
           'name' =>'mr.lee',
           'user' => '张三',
           'username' => 'zhangsan',
           'PI' => '3.14',
       ]);
   }

   public function block()
   {
       return View::fetch('block',[
           'title'=>'标题',
       ]);
   }

   public function extend()
   {
       return View::fetch('extend',[
           'title'=>'标题',
       ]);
   }

   public function form()
   {
       return View::fetch('form');
   }
}