<?php


namespace app\controller;


class Address
{
    protected $middleware = ['Check'];

   //路由的定义详情见40
    //路由的作用就是让URL地址更加的规范和优雅，或者说更加简洁;
    //设置路由对URL的检测、验证等一系列操作提供了极大的便利性;
    //路由的配置文件在config/route.php中，定义文件在route/app.php;

    //为了让我们路由看更加直观，我们采用内置服务器的方式来演示;
    //通过命令行模式键入到当前项目目录后输入命令:php think run 启动;
    //此时，public目录会自动被绑定到顶级域名:127.0.0.1:8000上;
    //我们只要在地址栏键入:http://localhost:8000 或(127.0.0.1:8000)即可;
   public function index()
   {

//       echo session('redirect_url');
//       return 'index';
       $url = url('address/back');
       return '<a href="'.$url.'">返回<a>';
   }


    public function read(Request $request, $id)
    {
        echo $request->name;
        return 'id:'.$id;
    }


    public function back()
    {
        //跳转回去原来的地址
        //http://localhost/tp6/public/rely/get/id/5
        return redirect('1')->with('flag', '1')->restore();
    }

   public function  details($id)
   {
       return 'details 目前调用的id: '.$id;
   }

//   public  function read($name)
//   {
//       return '读取:'.$name;
//   }

   public static function details2($id)
   {
       return 'details2 目前调用的id:'.$id;
   }

   public function search($id,$uid)
   {
       return '详情id:'.$id.',详情uid:'.$uid;
   }

   public function miss(){
       return '404,miss';
   }


}