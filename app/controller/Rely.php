<?php


namespace app\controller;


//use think\Request;

use think\facade\Request;

class Rely
{
//   protected $request;


//   public function __construct(Request $request)
//   {
//       $this->request = $request;
//   }

   //  http://localhost/tp6/public/rely?username=Mr.Lee
//   public function  index()
//   {
//       return $this->request->param('username');
//   }

    //也可以在普通方法下直接使用，如下:
//    public function index(Request $request)
//    {
//        return $request->param('username');
//    }


//使用Facade方式应用于没有进行依赖注入时使用Request对象的场合;
//   public function index()
//   {
//       return Request::param('username');
//   }

     //请求信息和信息
     //使用助手函数request()方法也可以应用在没有依赖注入的场合;
//    public function index()
//    {
//        return \request()->param('username');
//    }

    //http://localhost/tp6/public/rely/get?name=Mr.Lee
     public function get($id)
     {
         //使用has()方法，可以检测全局变量是否已经设置:
//         dump(Request::has('id','get'));
//         dump(Request::has('name','get'));
//          dump(Request::has('name','post'));

         //param()变量方法是自动识别GET、POST等的当前请求，推荐使用;
         //获取请求为name的值,过滤
//         dump(Request::param('name'));



         //获取所有请求的变量,以数组形式,过滤
         //http://localhost/tp6/public/rely/get?name=Mr.Lee&age=18
         //dump(Request::param());

         //获取所有请求的变量(原始变量),不包含上传变量,不过滤
         //dump(Request::param(false));

         //dump(Request::param(['name','age']));


         // 如果没有设置字符过滤器，或者局部用别的字符过滤器，可以通过第三参数;
         //dump(Request::param('name', '', 'htmlspecialchars'));
         //dump(Request::param('name', '', 'strip_tags,strtolower'));


         //如果设置了全局字符过滤器，但又不想某个局部使用，可以只用null参数;
//         Request::param('name', '', null);

         //如果获取不到值，支持请求的变量设置一个默认值;
         //Request::param('name', '默认值');


         //如果采用的是路由 URL，也可以获取到变量，但 param::get()不支持路由变量;
         //Request::param('id');
         //Request::route('id');
         //Request::get('id'); //路由参数，get 获取不到

         //使用only()方法，可以获取指定的变量，也可以设置默认值;
         //dump(Request::only(['id','name']));
         //dump(Request::only(['id'=>1,'name'=>'默认值']));


         //使用 only()方法，默认是 param 变量，可以在第二参数设置 GET、POST 等;
         //dump(Request::only(['id','name'],'post'));

         //相反的 except()方法，就是排除指定的变量;
         //Request::except('id,name');
         //Request::except(['id','name']);
         //Request::except(['id'=>1,'name'=>'默认值']);
         //Request::except(['id','name'], 'post');

         // 使用变量修饰符，可以将参数强制转换成指定的类型;
         //s(字符串)、/d(整型)、/b(布尔)、/a(数组)、/f(浮点);
         //Request::param('id/d');

         //为了简化操作，Request对象提供了助手函数;
         //http://localhost/tp6/public/rely/get?id=5
         //判断get下的id是否存在
         //dump(input('?get.id'));

         //判断post下的name是否存在
         //input('?post.name');

         //获取param下的name值
         //input('param.name');


         //默认值
         //input('param.name', '默认值');

         //过滤器
         //input('param.name', '', 'htmlspecialchars');


         //设置强制转换
         //input('param.id/d');


//         dump(Request::isGet());
//         dump(Request::isPost());
//         return Request::method();
//         return Request::method(true);
//         dump(Request::header());
//         dump(Request::header('host'));

//         return Request::ext();

         //http://localhost/tp6/public/rely/get/id/5
//         echo $id;

         //http://localhost/tp6/public/rely/get/id/5/name/lee
//         return 'get:'.$id.','.$name;

         //http://localhost/tp6/public/rely/get/id/5/
         //响应输出，有好几种:包括return、json()和view()等等;
         //认输出方式是以html格式输出，如果你发起json请求，则输出json;
//         return json($id);

         //背后是response对象，可以用response()输出达到相同的效果;
        //return response($id);
         //使用response()方法可以设置第二参数，状态码，或调用code()方法;
         //return response($id,201);
         // return response($id)->code(202);

         //使用json()、view()方法和response()返回的数据类型不同，效果一样;
         //return json($id,201);
         //return json($id)->code(202);

         //使用redirect()方法可以实现页面重定向，需要return执行;
         //return redirect('http://www.baidu.com');

         //站内重定向，直接输入路由地址或相对地址即可，第二参数状态码;
//         return redirect('ds/5');
//         return redirect('/tp6/public/address/index');

         //http://localhost/tp6/public/rely/get/id/5
         //使用url自动生成跳转地址,普通地址或路由地址
         //  return redirect(url('address/index'));

         //附加session信息,并跳转重定向
          // return redirect(url('address/index'))->with('name','Mr.Lee');

         if(session('?flag')){
             return '死机警告';
         }else{
             //http://localhost/tp6/public/rely/get/id/5  ->  http://localhost/tp6/public/address/index.html
             return redirect(url('address/index'))->remember();
         }
     }
}